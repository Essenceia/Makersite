<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Jobs\SendRegisterEmail;


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
    function user_exists($email){
       return DB::table('users')->select('id')->where('email','=',$email)->first();
    }
    function create_user($email){
        //random password
        $password = str_random(6);
        //get user name from email adresse
        $name = explode("@",$email);
        $name = $name[0];
        str_replace("."," ",$name);
        //create entry in database
        $points_default = 0;
        $ret = DB::table('points_default')->select('user_type0')->first();
        if($ret){
            $points_default = $ret->user_type0;
        }
        $req = DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
            'status'=>'0',
            'points'=>$points_default,
        ]);
        if($req==null)Log::debug("erreur dans la creation d'un utilisateur");
        //Send mail for account creations
        $this->dispatch(new SendRegisterEmail('component.email.registrationconfirmed',__('registration.mailaccountcreatedforprojecttitle'),$email,array('email'=>$email,'password'=>$password)));

    }
    function seperate_id($id){
        list($type,$number)=explode('_',$id);
        switch ($type){
            case (__('project.type0')):$type = '0';break;
            case (__('project.type1')):$type = '1';break;
            case (__('project.type2')):$type = '2';break;
            default:Log::error("Product type not identified ".$type);break;
        }
        return array($number,$type);
    }
    function set_default_project_points($type){
        $req = DB::table('points_default')->select("project_type".$type." as points")->first();
        if($req)return $req->points;
        else return 0;
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
                'project.*.id'=>'bail|required|min:7|max:8|distinct|regex:/(?:_)/',
               'project.*.name'=>'bail|required|distinct',
               'project.*.desc'=>'bail|required|max:16000',
                'project.*.mail'=>'required|bail',
                //'project.*.email'=>'bail|required|distinct|email',//|regex:/(?:@edu.ece.fr)/',
            ]);
            Log::debug('passes validation');
            //create user
            //create project
            //send mail
            foreach ($request->input('project') as $project){
                //check if user exists and create user if not
                if($this->user_exists($project['mail'])!=true){
                    $this->create_user($project['mail']);
                }
                //parse $project['id'] into number and type

                list($number,$type)=$this->seperate_id($project['id']);
                //create project
                $dataid = DB::table('project')->insertGetId([
                    'number'=>$number,
                    'type'=>$type,
                    'name'=>$project['name'],
                    'created_at'=>date("Y-m-d H:i:s"),
                    'updated_at'=>date("Y-m-d H:i:s"),
                    'points' =>$this->set_default_project_points($type),
                ]);
                if($dataid){
                    //save project to user account
                    $req = DB::table('users')->where('email','=',$project['mail'])->update([
                        'updated_at'=>date("Y-m-d H:i:s"),
                        'is_leader'=>1,
                        'project_id'=>$dataid,
                    ]);
                    if($req){
                        Log::debug("Creation sucessfull, link project to user with mail ".$project['mail']);
                    }else{
                        Log::error("Creation Fail, link project to user with mail ".$project['mail']);
                    }

                }else{
                    Log::error("error in creating project with parameters ".$number." ".$type." ".$project['name']." ".$this->set_default_project_points($type));
                }

            }

            Log::debug("We are finished");
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
