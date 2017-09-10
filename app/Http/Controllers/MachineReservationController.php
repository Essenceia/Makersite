<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BlacklistHandler as BList;
use App\Http\Controllers\MachineHelper as Calculator;
use Illuminate\Support\Facades\Auth;


class MachineReservationController extends Controller
{
    public function __construct()
    {
        //TODO a decomenter pour authentification
        $this->middleware('auth');
    }

    public function update(Request $request,$mid)
    {
        //general validator
        $this->validate($request,[
           'CalanderID.*'=>'bail|required|min:1|max:'.(Auth::user()->status < 2? '10':'40'),
            'engage'=>'bail|required',
            'desc'=>'bail|required|max:600',
            'verified'=>'bail|required',

        ]);
        //specific validation acording to user satus
            $id = Auth::user()->id;
            $calanderlist = $request->input('CalanderID');
            if($calanderlist===null)Log::error("calander list is empty ");
            $calculator = Calculator::class;
            $emes = $this->reserve_valide($id, $request->input('is_project'), $calculator::cost($mid, (count($calanderlist))));
            $i = 0;
            $timelist = [];
            foreach ($calanderlist as $cl) {
                Log::debug('CalanderID ' . $cl);
                $time = DB::table('machine_calander_status')->select('date')->where('id', '=', $cl)->first();
                if ($time) {
                    $timelist[$i] = $time->date;
                } else {
                    $timelist[$i] = 'XX:XX:XX XX:XX';
                }
                $i++;
            }
            if ($emes->id == 5) {
                $this->add_to_calander($calanderlist, $id, $request->input('desc'));
                $emes->body .= 'Vous avez reserver l utilisation de la machine ' . $request->input('mname') . ' pendant ' . $i . ' creneaux de 30 minutes. Ces creneaux debuterons :';
            }
            return view('machine/reservation_confirmed')
                ->with('message', $emes->title)
                ->with('submessage', $emes->body)
                ->with('timelist', $timelist);


    }

    /*
     * Verify if user is valide
     * 0- does not existe
     * 1- can reserve machine
     * 2- doesn't have any more credits left
     *3 - doesn't have any more credits left - project
     * 4- is blacklisted
     *  5 -sucees
       */

    public function reserve_valide($userID, $is_for_project, $cost)
    {
        $res = DB::table('users')->select('status', 'id')->where('id', '=', $userID)->first();
        $val = objectValue();
        $val->id = 0;
        $val->title = (__('main.updateerr'));
        $val->body = (__('main.unknownuser'));

        if ($res) {
            switch ($res->status) {
                case 0: // standard user
                    //check if user is blacklisted
                    $bl = BList::class;
                    if ($bl::is_blacklisted($userID) == false) {
                        if ($is_for_project) {
                            if ($this->project_valide($userID, $cost)) {
                                $val->id = 5;
                                $val->title = (__('reservation.t5'));
                                $val->body = (__('reservation.b5'));

                            } else {
                                $val->id = 3;
                                $val->title = (__('reservation.t3'));
                                $val->body = (__('reservation.b3'));
                            }

                        } else {
                            if ($this->user_valide($userID, $cost)) {
                                $val->id = 5;
                                $val->title = (__('reservation.t5'));
                                $val->body = (__('reservation.b5'));

                            } else {
                                $val->id = 2;
                                $val->title = (__('reservation.t2'));
                                $val->body = (__('reservation.b3'));
                            }

                        }
                    } else {
                        $val->id = 4;
                        $val->title = (__('reservation.t4'));
                        $val->body = (__('reservation.b4'));

                    }
                    break;
                case 1 || 2:
                    $val->id = 5;
                    $val->title = (__('reservation.t5'));
                    $val->body = ($res->status == 1) ? (__('reservation.modb')): (__('reservation.adminb'));
                    break;
                default: //error thic case should not existe
                    Log::debug("unknow status for user , status is" . $res->status . " user id " . $res->id);
                    break;
            }

        }
        return $val;
    }

    private function project_valide($userID, $cost)
    {
        $res = false;
        $q = DB::table('users')->select('project_id')->where('id', '=', $userID)->first();
        if ($q) {
            $proid = $q->project_id;
            Log::debug('project id '.$proid);
            $pro = DB::table('project')->select('*')->where('id', '=', $proid)->first();

            if ($pro) {
                if ($pro->points >= $cost) {
                    Log::debug('has enothe points for reservation');
                    //payup
                    $npoint = $pro->points - $cost;
                    $pay = DB::table('project')->where('id', '=', $q->project_id)->update(['points' => $npoint]);
                    if (!$pay) Log::debug('error un cost transaction project');
                    $res = true;
                }
            }
        } else {
            Log::debug('project_valide unknown project for user ' . $userID);
        }
        return $res;

    }

    private function user_valide($userID, $cost)
    {
        $ret = false;
        $res = DB::table('users')->select('*')->where('id', '=', $userID)->first();
        if ($res->points >= $cost) {
            Log::debug('cost for user is ' . $cost . ' user has points ' . $res->points);
            $npoints = $res->points - $cost;
            Log::debug('new points number ' . $npoints);
            $pay = DB::table('users')->where('id', '=', $userID)->update(['points' => $npoints]);
            if (!$pay) Log::debug('error in cost transaction user');
            $ret = true;

        }
        return $res;
    }

//TODO interface pour reservation sur un projet
//TODO croiser avec la presence d'un superviseur aillant la formation sur
//la machine en question

    public
    function add_to_calander(array $calanderID, $userID, $desc)
    {

        foreach ($calanderID as $cal) {
            //add date to reservation calander
            $caladd = DB::table('machine_reservation')->insertGetId([ 'user_id' => $userID, 'description' => $desc,'created_at'=>date('Y-m-d H:i:s'),'updated_at'=>date('Y-m-d H:i:s')]);
            if ($caladd == null){Log::debug('add_to_calander error unable to create reservation ');}else{
                Log::debug('add_to_calander creating reservation for calanderid ' . $cal . ' to user id ' . $userID . ' with description ' . $desc);
                //close dates so nobody else can reserce
                $clodate = DB::table('machine_calander_status')->where('id', '=', $cal)->update(['status' => 2,'reservation'=>$caladd]);
            }
        }
    }
    /*
     * Check if calander is availible for this week and next week if it is not
     * then generate it using the default calander database.
     * While you are doing it wipe lasts weeks data so it doesn't get to big.
     */
    function check_if_generated($machine_id){
        $needwipe = false;
        //genrate this week
        $monday = new \DateTime();
        $monday->modify("Monday this week");
        date_time_set($monday,8,0,0);
        $exits = DB::table('machine_calander_status')->where('machine_id','=',$machine_id)->where('date','=',date_format($monday,'Y-m-d H:i:s'))->first();
        if($exits===null){
            $this->generate_one_week($monday,$machine_id);
            $needwipe = true;
        }
        //generate next week
        $monday->modify('Monday next week');
        date_time_set($monday,8,0,0);
        $exits = DB::table('machine_calander_status')->where('machine_id','=',$machine_id)->where('date','=',date_format($monday,'Y-m-d H:i:s'))->first();
        if($exits===null){
            $this->generate_one_week($monday,$machine_id);
            $needwipe = true;
        }
        if($needwipe){
            date_sub($monday,date_interval_create_from_date_string('2 weeks'));
            $this->wipe_before_date($monday,$machine_id);
        }
    }
    function generate_one_week($date, $machine_id){

        $max_time =date_create('18:00:00');
        //use default database as base for calander
        for($day =0 ;$day<5;$day++){
            $time =date_create('08:00:00');
            while ($time<$max_time){
                $example = DB::table('machine_calander_default')->where('time','=',date_format($time,'H:i:s'))->where('machine_id','=',$machine_id)->where('day','=',$day)->select('open')->first();
                if($example){
                    DB::table('machine_calander_status')->insert([
                        'date'=>date_format($date,'Y-m-d').' '.date_format($time,'H:i:s'),
                        'status'=>($example->open?1:0),
                        'machine_id'=>$machine_id
                    ]);
                }
                date_add($time,date_interval_create_from_date_string("30 minutes"));

            }
            date_add($date,date_interval_create_from_date_string("1 day"));
        }

    }
    function wipe_before_date($date,$machine_id){
        DB::table('machine_calander_status')->where('machine_id','=',$machine_id)->where('date','<',$date)->join('machine_reservation','machine_calander_status.id','=','machine_reservation.id')->delete();
    }

    public function show($machine_id)
    {
        $this->check_if_generated($machine_id);

        //0.get machine name
        $name = DB::table('machine')->select('name','id')->where('id', '=', $machine_id)->first();
        $name->name = str_replace('_', ' ', $name->name);
        Log::debug('machine id ' . $machine_id);
        // 0 - cette semaine
        // 1 - la semaine prochaine

        //1.get calander for this week and next week
        //1.1 init
        $max_time =date_create('18:00:00');
        $day = new \DateTime();
        $day->modify("Monday this week");
        //1.2 get weeks in first dimentions of matrix
        for($weeknumber = 0;$weeknumber<2;$weeknumber++){
            $time = date_create('08:00:00');
            $time_stamp =0;
            while ($time < $max_time){
                for($weekday = 0 ;$weekday<5 ; $weekday++){
                $data[$weeknumber][$time_stamp][$weekday] = DB::table('machine_calander_status')->where('machine_id','=',$machine_id)->where('date','=',(date_format($day,'Y-m-d').' '.date_format($time,'H:i:s')))->select('id','date','status','reservation')->first();
                    $data[$weeknumber][$time_stamp][$weekday]->date=date('H:i:s',strtotime($data[$weeknumber][$time_stamp][$weekday]->date));

                    //debug
                    /*if($data[$weeknumber][$time_stamp][$weekday]){
                        Log::debug('Found with id '.$data[$weeknumber][$time_stamp][$weekday]->id.' date '.date_format($day,'Y-m-d').' '.date_format($time,'H:i:s'));
                        $data[$weeknumber][$time_stamp][$weekday]->date=date('H:i:s',strtotime($data[$weeknumber][$time_stamp][$weekday]->date));

                }else{
                    Log::error('Not found in db with data mid '.$machine_id.' date '.date_format($day,'Y-m-d').' '.date_format($time,'H:i:s'));
                }*/

               // Log::debug('befor add date '.date_format($day,'Y-m-d'));
                    date_add($day,date_interval_create_from_date_string('1 day'));
                   // Log::debug('after add date '.date_format($day,'Y-m-d'));
            }
            $day->modify('-5 days');
            $time_stamp++;
                date_add($time,date_interval_create_from_date_string('30 minutes'));
            }
            $day->modify('Monday next week');

        }
        //array with all dates
        return view('admin.panel')->with('component','machinereservation')->with('elem',$data)->with('data', $name);

    }
    public function index(){
        $req = DB::table('machine_reservation')->join('users','machine_reservation.user_id','=','users.id')->join('machine_calander_status','machine_calander_status.reservation','=','machine_reservation.id')->orderBy('machine_calander_status.date')->select('users.email as user_mail','users.id as user_id','machine_reservation.description as desc','machine_reservation.updated_at as updated_at','machine_reservation.id as resaid','machine_calander_status.date as date','machine_calander_status.machine_id as mid')->get();
        if($req){
            return view('admin.panel')->with('component','machinereservationlist')->with('elem',$req);
        }else{
            return view('utils.message')->with('message',(__('account.errorfetch')));
        }
    }
}
