<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.panel')->where('component','projectcreate');
    }
    function default_points_per_project($projecttype){
        $req = DB::table('points_default')->select('project_type'.$projecttype.' as points')->first();
        if($req){
            return $req->points;
        }else{
            //default value if there is a probeleme connecting with database
            Log::error('Connection probleme with points_default returned null, will return 10 credits as default for project creation');
            return 10;
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {//create a list of
        $this->validate($request,[
            'type'=>'required|numeric|min:0|max:2',
            'userid'=>'required|exists:users,id',
            'name'=>'required|max:200',
            'number'=>'required|numeric|min:99|max:299',
        ]);
        $req = DB::table('project')->insertGetId([
            'type'=>$request->input('type'),
            'number'=>$request->input('number'),
            'name'=>$request->input('name'),
            'points'=>$this->default_points_per_project($request->input('type')),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        if($req){
            //link the projectid to the user account and upgrade the user to project leader
            $updated = DB::table('users')->where('id','=',$request->input('userid'))->update([
                'is_leader'=>true,
                'project_id'=>$req,
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
            if($updated){
                return view('utils.message')->with('message',(__('main.creatsuc')));
            }else{
                return view('utils.message')->with('message',(__('main.createrr')));
            }
        }else{
            return view('utils.message')->with('message',(__('main.createrr')));
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
        $req = DB::table('project')->where('id','=',$id)->select('*')->first();
        if($req){
            return view('admin.panel')->with('component','projectview')->with('elem',$req);

        }else{
            return view('utils.message')->with('message',(__('account.errorfetch')));
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
        $req= DB::table('project')->select('id','number','type','name','points')->where('id','=',$id)->first();
        if($req){
            return view('admin.panel')->with('component','projectedit')->with('elem',$req);
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
        $this->validate($request,[
            'type'=>'required|numeric|min:0|max:2',
            'name'=>'required|max:200',
            'points'=>'required|numeric|min:0',
            'number'=>'required|numeric|min:100|max:299',
        ]);
        $req = DB::table('project')->where('id','=',$id)->update(['type'=>$request->input('type'),
            'name'=>$request->input('name'),
            'points'=>$request->input('points'),
            'number'=>$request->input('number'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ]);
        if($req){
            return view('utils.message')->with('message',(__('main.updatesuc')));
        }else{
            return view('utils.message')->with('message',(__('main.updateerr')));
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
        //destroy project
        $req = DB::table('project')->where('id','=',$id)->delete();
        if($req){
            return view('utils.message')->with('message',(__('main.destroysuc')));
        }else{
            return view('utils.message')->with('message',(__('main.destroyerr')));
        }
    }
}
