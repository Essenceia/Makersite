<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class SpecialMachineCalanderEvent extends Controller
{
    function create_special_calander($event_id){
        $max_date = date_create('18:00:00');
        $time_interval = date_interval_create_from_date_string("30 minutes");
        for($day = 0 ; $day < 5 ; $day++){
            $time =date_create('8:00:00');
            while ($time < $max_date){
                DB::table('machine_calander_special')->insert([
                    'open'=>false,
                    'time'=>date_format($time,'H:i:s'),
                    'day'=>$day,
                    'event_id'=>$event_id,
                ]);
                date_add($time,$time_interval);
            }
        }
    }
    function create_event($event_name,$event_desc){
        //create event
        $id = DB::table('machine_calander_event')->insertGetId(['name'=>$event_name,
            'desc'=>$event_desc,

        ]);
        //create associated calander
        $this->create_special_calander($id);
        return $id;
    }
    function add_one_date_to_event($date,$event_id,$machine_id_list){
        foreach ($machine_id_list as $machine_id){
            DB::table('machine_calander_event_date')->insert([
                'event_id'=>$event_id,
                'monday_week_date'=>$date,
                'machine_id'=>$machine_id,
            ]);
        }

    }
    function delete_date($date,$event_id){
        $req = DB::table('machine_calander_event_date')->where('event_id','=',$event_id)->where('monday_week_date')->delete();
        if($req)Log::error('Machine calander event date was not found with date '.$date.'  event_id '.$event_id);

    }
    //will return true if the machines need to be updated
    /*function need_to_update_machines($machine_list,$event_id){
        //check if the machine list has changed
        $needschange = false;
        $liststored = DB::table('machine_calander_event_date')->select('machine_id')->where('event_id','=',$event_id)->get();
        foreach ($liststored as $machine_in_list){
            if(in_array($machine_in_list->machine_id,$machine_list)==false){
                //the machine is not in the new list
                $needschange = true;
            }else{
                //remove value from array
                $key = array_search($machine_in_list->machine_id, $machine_list);
                unset($machine_list[$key]);

            }

        }
        if($needschange==false) {
            //if we are not already false
            if(empty($machine_list)==false)$needschange=true;
        }
        return $needschange;
    }*/
    function update_dates_on_event($machine_id,$dates,$event_id){
        //change view, just wipe the entire thing and recreat it
        //delet all linked to event
        $req = DB::table('machine_calander_event_date')->where('event_id','=',$event_id)->delete();
        if($req == null ){
            Log::error(" Deletion error for machine events date on event id ".$event_id);
        }
        //create new entried
        foreach ($dates as $date){
            $this->add_one_date_to_event($date,$event_id,$machine_id);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //show events
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    function get_calander($event_id){
        $time =date_create('08:00:00');
        $max_time =date_create('18:00:00');
        $time_interval = date_interval_create_from_date_string("30 minutes");
        $i = 0;

        while ($time < $max_time) {
            for ($day = 0; $day < 5; $day++) {
                $req[$i] = DB::table('machine_calander_special')->where('event_id', '=', $event_id)->where('time', '=', date_format($time,'H:i:s'))->orderBy('day')->select('id', 'open', 'time')->get();
                foreach ($req[$i] as $obj){
                    Log::debug('obj found '.$obj->id);
                }
            }
            $i++;
            date_add($time,$time_interval);
        }
        return $req;
    }
    public function create()
    {
        //create default event
        $newid = $this->create_event(" "," ");
        $elem = DB::table('machine_calander_special')->where('event_id','=',$newid)->get();
        $machine_list = DB::table('machine')->select('id','name')->get();
        $elem = $this->get_calander($newid);
        $data=array('id'=>$newid,'machine'=>$machine_list,'date'=>null);
        return view('admin.panel')->with('component','calander.createspecialevent')->with('elem',$elem)->with('data',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //get a calander and update it's values
        $this->validate($request,[
            'eventname'=>'bail|required|max:1600',
            'eventdesc'=>'bail|required|max:20000',
            'date.*.selected'=>'bail|date_format:Y-m-d|after_or_equal:now',
            'machine.*'=>'bail|min:1',
            ''
        ]);
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
