<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class TypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $req =DB::table('type_desc')->select('*')->get();
        return view('admin.panel')->with('component','machinetypelist')->with('elem',$req);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.panel')->with('component','machinetypecreate');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
           'name'=>'bail|required|max:400|unique:type_desc,name',
            'desc'=>'bail|required|max:16000',

        ]);
        $req=DB::table('type_desc')->insert([
            'name'=>$request->input('name'),
            'desc'=>$request->input('desc'),
        ]);
        if($req === null){
            return view('utils.message')->with('message',(__('main.createrr')));
        }else{
            return view('utils.message')->with('message',(__('main.creatsuc')));
        }

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
        $req= DB::table('type_desc')->where('id','=',$id)->first();
        return view('admin.panel')->with('component','machinetypeedit')->with('elem',$req);
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
        $this->validate($request,[
            'name'=>'bail|required|max:400',
            'desc'=>'bail|required|max:16000',

        ]);
        $req=DB::table('type_desc')->where('id','=',$id)->update([
            'name'=>$request->input('name'),
            'desc'=>$request->input('desc'),
        ]);
        if($req === null){
            return view('utils.message')->with('message',(__('main.updateerr')));
        }else{
            return view('utils.message')->with('message',(__('main.updatesuc')));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //destroy all machines in groupe + calanders + reservations
        $mlist = DB::table('machine')->where('type','=',$id)->select('id')->get();
        foreach ($mlist as $machine){
            $mid = $machine->id;
            //destroy calander
            $drop = DB::table('machine_calander_status')->select('reservation')->where('id','=',$mid)->where('reservation','!=',null)->get();
            foreach ($drop as $resa){
                DB::table('machine_reservation')->where('id','=',$resa->reservation)->delete();
            }
            DB::table('machine_calander_status')->where('machine_id','=',$mid)->delete();
            //destroy machine
            DB::table('machine')->where('id','=',$mid)->delete();
        }
        //destroy actual type
        $req = DB::table('type_desc')->where('id','=',$id)->delete();
        if($req){
            $msg =(__('main.destroysuc'));
        }else{
            $msg = (__('main.destroyerr'));
        }
        return view('utils.message')->with('message',$msg);

    }
}
