<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{

    public function wipe_before_date($date){
        //check if exists
        $exists = DB::table('event')->where('start_time','<',date_format($date,'Y-m-d H:i:s'))->select('id')->get();
        if($exists){
            foreach ($exists as $eventid){
                //delet event and event_list
                DB::table('event_list')->where('event_id','=',$eventid->id)->delete();
                DB::table('event')->where('id','=',$eventid->id)->delete();
            }

        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $now =date('Y-m-d H:i:s');
        Log::debug('date today '.$now);
        $req = DB::table('event')->select('*')->where('start_time','>',$now)->get();
        Log::debug('Looking of dates');
        //debug
        foreach ($req as $d){
            Log::debug('event found'.$d->name.' id '.$d->id.' start_time '.$d->start_time);
        }
        $date = new \DateTime();
        $date->modify('Sunday last week');
        $this->wipe_before_date($date);
        return view('eventsv2')->with('event',$req);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.panel')->with('component','eventcreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'bail|required|max:255',
            'open_spots'=>'bail|required|numeric|min:0',
            'desc' => 'bail|required',
            'start_time_day'=>'required|date_format:Y-m-d|after_or_equal:now',
            'start_time_time'=>'required|date_format:H:i:s',
            'end_time_day'=>'required|date_format:Y-m-d|after_or_equal:start_time_day',
            'end_time_time'=>'required|date_format:H:i:s|after:start_time_time',
        ]);
        $msg = (__('main.createrr'));
        $req = DB::table('event')->insert(['open_spots'=>$request->input('open_spots'),
            'title'=>$request->input('desc'),
            'name'=>$request->input('name'),
            'start_time'=>$request->input('start_time_day').' '.$request->input('start_time_time'),
            'end_time'=>$request->input('end_time_day').' '.$request->input('end_time_time'),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        if($req){$msg=(__('main.creatsuc'));}
        else{
            Log::error('Probleme dans la creation de event avec liste de parametres : open spots '.$request->input('open_spots').' title '.$request->input('desc').' name '.$request->input('name'));
        }
        return view('utils.message')->with('message',$msg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        echo ' Called';
        Log::debug('Called event edit');
        $elem = DB::table('event')->select('*')->where('id','=',$id)->first();
        return view('admin.panel')->with('component','eventedit')->with('elem',$elem);
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
        $this->validate($request, [
            'name' => 'bail|required|max:255',
            'open_spots'=>'bail|required|numeric|min:0',
            'desc' => 'bail|required',
            'start_time_day'=>'required|date_format:Y-m-d|after_or_equal:now',
            'start_time_time'=>'required|date_format:H:i:s|after:today',
            'end_time_day'=>'required|date_format:Y-m-d|after_or_equal:start_time_day',
            'end_time_time'=>'required|date_format:H:i:s|after:start_time_time',
        ]);
        $msg = (__('main.updateerr'));
        $req = DB::table('event')->select('*')->where('id','=',$id)->update([
            'title'=>$request->input('desc'),
            'name'=>$request->input('name'),
            'open_spots'=>$request->input('open_spots'),
            'start_time'=>$request->input('start_time_day').' '.$request->input('start_time_time'),
            'end_time'=>$request->input('end_time_day').' '.$request->input('end_time_time'),
            'updated_at'=>date('Y-m-d H:i:s')]);
        if($req){$msg=(__('main.updatesuc'));}
        else{
            Log::error('Probleme de update dans event id '.$id.' liste de parametres : open spots '.$request->input('open_spots').' desc '.$request->input('title').' name '.$request->input('name').' start time '.$request->input('start_time').' end time '.$request->input('end_time'));
        }
        return view('utils.message')->with('message',$msg);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $msg =(__('main.destroyerr')).' id : '.$id.".";
        //destroy event list
        DB::table('event_list')->where('event_id','=',$id)->delete();
        //destroy the event
        $req = DB::table('event')->delete($id);
        if($req){
            $msg =(__('main.destroysuc'));
        }else{
            Log::error($msg);
        }
        return view('utils.message')->with('message',$msg);
    }
}
