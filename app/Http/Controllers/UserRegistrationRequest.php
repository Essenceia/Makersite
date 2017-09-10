<?php

namespace App\Http\Controllers;

use App\Jobs\SendRegisterEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\User;

use Illuminate\Support\Facades\Auth;

class UserRegistrationRequest extends Controller
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
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function create(){
        return view('auth.register');
    }



    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return view
     */
    protected function store(Request $data)
    {
        $this->validate($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:191|unique:users,email|regex:/(?:@edu\.ece\.fr)/',
            'password' => 'required|string|min:6|confirmed',
        ]);
        //create user registration request entry
        $token = str_random(16);
        $existsalready = DB::table('user_registration_request')->where('email','=',$data['email'])->count();
        if($existsalready){
            $req = DB::table('user_registration_request')->select('email','=',$data['email'])->update([
                'name' => $data['name'],
                'password' => $data['password'],
                'token' => $token,
                'updated_at'=>date('Y-m-d H:i:s'),
            ]);
        }else {
            $req = DB::table('user_registration_request')->insert([
                'email' => $data['email'],
                'name' => $data['name'],
                'password' => $data['password'],
                'token' => $token,
            ]);
        }
        $link = route('validate_registration.edit',$data['email']);
           // url('/').'validate_registration/'.$data['email'];
        //send user account creation validation mail

       $this->dispatch(new SendRegisterEmail('component.email.newuser',__('registration.mailregistrationsubject'),$data['email'],array('link'=>$link,'token'=>$token)));
        return view('utils.message')->with('message',(__('registration.mailsent')));
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
        //Alsk for the valide registration key
        $req = DB::table('user_registration_request')->select('email')->where('email','=',$id)->first();
        if($req){
            return view('admin.panel')->with('component','registration.validatetoken')->with('elem',$req);

        }else{
            return view('utils.message')->with('message',(__('mail.invalidemailerr')));
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
        //validate token ,create new user , send confirmation mail and wipe from database
        $this->validate($request,[
            'token'=>"required|max:191",
        ]);
        //validate token
        $req = DB::table('user_registration_request')->select('*')->where('email','=',$id)->first();
        if($req){

            //check token
            if($request->input('token')==$req->token){
                //send confirmation mail
                /*Mail::send('component.email.registrationconfirmed', ['email'=>$req->email,'password'=>$req->password], function ($message) use ($req)
                {

                    $message->subject(__('registration.mailregistrationsubjectfinished'));

                    $message->to($req->email);

                });*/
                $this->dispatch(new SendRegisterEmail('component.email.registrationconfirmed',__('registration.mailregistrationsubjectfinished'),$req->email,array('email'=>$req->email,'password'=>$req->password)));
                //wipe from database
                DB::table('user_registration_request')->where('email','=',$req->email)->delete();

                //create user
                $points_default = 0;
                $ret = DB::table('points_default')->select('user_type0')->first();
                if($ret){
                    $points_default = $ret->user_type0;
                }
                User::create([
                    'name' => $req->name,
                    'email' => $req->email,
                    'password' => bcrypt($req->password),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
                    'status'=>'0',
                    'points'=>$points_default,
                ]);
                //login user
                if (Auth::attempt(['email' => $req->email, 'password' => $req->password])) {
                    // Authentication passed...
                    return redirect()->intended('/');
                }else{
                    return view('admin.panel')->with('message',(__('userregistrationerr')));
                }
            }else{
                return view('utils.message')->with('message',(__('registration.tokenerr')));
            }

        }else{
            return view('utils.message')->with('message',(__('mail.invalidemailerr')));
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
