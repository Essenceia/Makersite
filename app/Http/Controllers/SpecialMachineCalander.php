<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DefaultMachineCalander extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $req = DB::table('machine_calander_default')->join('machine','machine_calander_default.machine_id','=','machine.id')->select('machine.name as mname','machine.id as mid')->get();

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

    function create_special_calander_for_machine($machine_id,$event_id){
        $max_date = date_create('18:00:00');
        $time_interval = date_interval_create_from_date_string("30 minutes");
        for($day = 0 ; $day < 5 ; $day++){
            $time =date_create('8:00:00');
            while ($time < $max_date){
                DB::table('machine_calander_special')->insert([
                    'open'=>false,
                    'time'=>date_format($time,'H:i:s'),
                    'day'=>$day,
                    'machine_id'=>$machine_id,
                    'event_id'=>$event_id,
                ]);
                date_add($time,$time_interval);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //check to see if a calander already exists if not create it
        $exists = DB::table('machine_calander_default')->where('machine_id','=',$id)->where('day','=',0)->count();
        if($exists===0){
            $this->create_calander_for_machine($id);
        }
        $time =date_create('08:00:00');
        $max_time =date_create('18:00:00');
        $time_interval = date_interval_create_from_date_string("30 minutes");
        $i = 0;

        while ($time < $max_time) {
            for ($day = 0; $day < 5; $day++) {
                $req[$i] = DB::table('machine_calander_default')->where('machine_id', '=', $id)->where('time', '=', date_format($time,'H:i:s'))->orderBy('day')->select('id', 'open', 'time')->get();
                foreach ($req[$i] as $obj){
                    Log::debug('obj found '.$obj->id);
                }
            }
            $i++;
            date_add($time,$time_interval);
        }
        return view('admin.panel')->with('elem',$req)->with('component','calander')->with('data',$id);
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
        //TODO : find a way to detect an update error
        //get all ids of a machine
        $idsource = DB::table('machine_calander_default')->where('machine_id','=',$id)->select('id')->get();
        foreach ($idsource as $calid){
            //store all ids of this machine
            $requname = 'horaire'.$calid->id;
            DB::table('machine_calander_default')->where('id','=',$calid->id)->update([
                'open'=>($request->input($requname)?1:0)
            ]);
        }
        return view('utils.message')->with('message',(__('main.updatesuc')));
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
