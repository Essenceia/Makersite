<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendRegisterEmail;

class EmailController extends Controller
{
    public function create(){
        return view('admin.panel')->with('component','email.create');
    }
    public function store(Request $request){
        $this->validate($request,[
            'title'=>"bail|required|max:2000",
            'content'=>"bail|required|max:16000",
        ]);
        $title = $request->input('title');
        $content = $request->input('content');

        /*Mail::queue('component.email.send', ['title' => $title, 'content' => $content], function ($message)
        {

           // $message->from('me@gmail.com', 'Christian Nwamba');

            $message->to('julia.desmazes@gmail.com');
            $message->subject(__('mailusertoadminmail'));

        });*/
        $this->dispatch(new SendRegisterEmail('component.email.send',(__('registration.mailusertoadminmail')),env('MAIL_ADMIN_ADRESSE'),array('title' => $title, 'content' => $content)));


        return view('utils.message')->with('message',(__('mail.sendsuc')));
    }
}
