<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class ParseProjectController extends Controller
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
        //init de l'objet
        return view('admin.panel')->with('component','parseprojectinit');
    }
    function breakwithascii($ascii, $text){
        $ret = [];

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //recupete les valheurs du create , parse et rendu une vue a l'utilisateur verifier pour voire si il valide
        $this->validate($request,['data'=>'required']);
        $projet = [];
        $i = 0;
        $data = $request->input('data');
        //get seperate lines
        $lines = explode(chr(10),$data);
        foreach ($lines as $line){
            Log::debug('line : '.$line);
        }
        foreach ($lines as $line){
            //get values serperated bby tab
            $projet[$i] = explode(chr(9),$line);
            foreach ($projet[$i] as $pro){
                Log::debug('i-'.$i.'-'.$pro);
            }
            $i++;

            /*index shoul be :
            0-project type+number also know as the project id used by the school
            1-project name
            2-project description
            3-project leader eamil
            */
        }
        return view('admin.panel')->with('component','parseprojectcreate')->with('elem',$projet);

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
        //sauvgarde
        //we validate that id is 1 so we know that the request is valide
        if($id==1){
            Log::debug('called into validation');
            $this->validate($request,[
                'project.*.id'=>'bail|required|min:6|max:7|distinct',
               'project.*.name'=>'bail|required|distinct',
               'project.*.desc'=>'bail|required|max:16000',
                'project.*.mail'=>'required|bail',
                //'project.*.email'=>'bail|required|distinct|email',//|regex:/(?:@edu.ece.fr)/',
            ]);
            Log::debug('passes validation');
            //creat project
            //return view('admin.panel')->with('component','');
            return view('utils.message')->with('message',(__('main.creatsuc')));
        }else{
            return view('utils.message')->with('message',(__('main.createrr')));
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
