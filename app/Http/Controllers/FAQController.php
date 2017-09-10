<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FAQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $req = DB::table('FAQ')->select('question','awnser')->get();
        //TODO change compoenent for not edit
       if($req){return view('admin.panel')->with('elem',$req)->with('component','FAQlist');}else{
           return view('utils.message')->with('message',(__('account.errorfetch')));
       }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.panel')->with('component','faqcreate');
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
            'question'=>'required|max:3000',
            'awnser'=>'required|max:20000',
        ]);
        $req = DB::table('FAQ')->insert(['question'=>$request->input('question'),
            'awnser'=>$request->input('awnser')]);
        if($req){
            return view('utils.message')->with('message',(__('main.creatsuc')));
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
    public function index()
    {
        //show all for modification
        $req = DB::table('FAQ')->select('*')->get();
        if($req){
            return view('admin.panel')->with('component','faqlistedit')->with('elem',$req);
        }else{
            return view('admin.panel')->with('message',(__('account.errorfetch')));
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
        $req = DB::table('FAQ')->where('id','=',$id)->select('*')->first();
        return view('admin.panel')->with('component','faqedit')->with('elem',$req);

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
            'question'=>'requied|max:2000',
            'awnser'=>'required|max:16000',
        ]);
        $req = DB::table('FAQ')->where('id','=',$id)->update([
          'question'=>$request->input('question'),
            'awnser'=>$request->input('awnser'),
        ]);
        if($req){
            return view('utils.message')->with('component',(__('main.updatesuc')));
        }else{
            return view('utils.message')->with('component',(__('main.updateerr')));
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
        $req = DB::table('FAQ')->where('id','=',$id)->delete();
        if($req){
            return view('utils.message')->with('message',(__('main.destroysuc')));
        }else{
            return view('utils.message')->with('message',(__('main.destroyerr')));
        }
    }
}
