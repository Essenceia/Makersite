<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultPoints extends Controller
{


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
    public function index()
    {
        $req = DB::table('points_default')->select('*')->where('id','=',1)->first();
        if($req){
            return view('admin.panel')->with('component','defaultpointsview')->with('elem',$req);
        }else{
            //create with this id and use default values see migration
            $req = DB::table('points_default')->insert(['id'=>1]);
            if($req){
                $req = DB::table('default_points')->select('*')->where('id','=',1)->first();
                return view('admin.panel')->with('component','defaultpointsview')->with('elem',$req);
            }else{
                return view('utils.message')->with('message',(__('main.createrr')));
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
        $req = DB::table('points_default')->select('*')->where('id','=',$id)->first();
        if($req){
            return view('admin.panel')->with('component','defaultpointsedit')->with('elem',$req);
        }else{
            return view('utils.message')->with('message',(__('account.errorfetch')));
        }
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
        $this->validate($this,[
           'pt*'=>'required|numeric|min:0',
           'ut*'=>'required|numeric|min:0',
            ]);
        $req = DB::table('points_default')->where('id','=',$id)->update([
            'project_type0'=>$request->input('pt0'),
            'project_type1'=>$request->input('pt1'),
            'project_type2'=>$request->input('pt2'),
            'user_type0'=>$request->input('ut0'),
            'user_type1'=>$request->input('ut1'),
            'user_type2'=>$request->input('ut2'),
            'user_type3'=>$request->input('ut3'),
            ]);
        if($req){
            return view('utils.message')->with('message',(__('main.updatesuc')));
        }else{
            return view('utils.message')->with('message',(__('main.updaterr')));
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
        //
    }
}
