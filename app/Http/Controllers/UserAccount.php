<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class UserAccount extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function edit($id){
        $req = DB::table('users')->select('id','name','email','password','status','points')->where('id','=',$id)->first();
        if($req===null){
            return view('utils.message')->with('message',(__('account.errorfetch')));
        }else{
            return view('admin.panel')->with('component','useredit')->with('elem',$req);
        }

    }

    public function update(Request $request,$id){
        $this->validate($request, [
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|email',
            'status'=>'bail|required|in:0,1,2,3',
            'point'=>'bail|numeric|min:0',
        ]);
        //check if status changed
        if(Auth::user()->status!= $request->input('status')){
            Log::debug('chanching user type to type '.$request->input('status'));
            $req = DB::table('points_default')->select('user_type'.$request->input('status').' as points')->first();
            if($req!= null){$points = $req->points;
                Log::debug('calling database point value is '.$points);}else{
                $points = $request->input('point');
                Log::debug('using default input point value is '.$points);
            }
        }else{
            $points = $request->input('point');
        }
        $req = DB::table('users')->where('id','=',$id)->update([
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'status'=>$request->input('status'),
            'points'=>$points,
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        if($req===null){
            Log::error((__('main.updateerr'))." sur l'utilisateur avec id ".$id);
            return view('utils.message')->with('message',(__('main.updateerr')));
        }else{
            return view('utils.message')->with('message',(__('main.updatesuc')));
        }

    }

    public function index($pagenumber = 1){
        if($pagenumber<1)$pagenumber=1;
        $req = DB::table('users')->select('id','name','email','status','is_leader','points','project_id')->skip(($pagenumber-1)*20)->take(20)->get();
       return view('admin.panelscrole')->with('elem',$req)->with('pagenumber',$pagenumber);
    }
    public function show($id)
    {
        //TODO trouver comment utiliser lang fr account
        $projet = null;
        $max_date = new \DateTime();
        $max_date->modify('Yesterday');
        $max_date->setTime(23,59,59);
        $reservations_machine = DB::table('machine_calander_status')->where('date','>',date_format($max_date,'Y-m-d H:i:s'))->join('machine_reservation',function($join){
            $join->on('machine_calander_status.reservation','=','machine_reservation.id')->where('machine_reservation.user_id','=',Auth::user()->id);
        })->join('machine','machine_calander_status.machine_id','=','machine.id')->select('machine.name as mname','machine_calander_status.date as mtime','machine_reservation.description as mdesc')->get();
        $reservations_event= DB::table('event_list')->where('user_id','=',$id)->join('event','event_list.event_id','=','event_id')->where('event.end_time','>',date_format($max_date,'Y-m-d H:i:s'))->select('event.name as ename','event.title as edesc','event.start_time as estart','event.end_time as eend')->get();

        if(Auth::user()->is_leader){$projet = DB::table('project')->select('*')->where('id','=',Auth::user()->project_id)->first();}


        return view('account.status')->with('resamachine',$reservations_machine)->with('resaevent',$reservations_event)->with('projet',$projet);

    }
    public function delete($id){

        //destroy project
        $req = DB::table('users')->select('*')->where('id','=',$id)->where('is_leader','=',1)->get();
        if($req !=null){
            //user is leader of a project
            $drop = DB::table('project')->where('id','=',$req->project_id)->delete();
            if($drop===null)Log::error('Project drop a ratter avec id '.$req->project_id);
        }
        //destroy on event list
        $drop= DB::table('event_list')->where('user_id','=',$id)->delete();
        //destroy on blacklist
        DB::table('blacklist')->where('user_id','=',$id)->delete();
        //destroy user
        DB::table('users')->where('id','=',$id)->delete();
        return view('utils.message')->with('message',(__('account.supuser')));

    }
}
