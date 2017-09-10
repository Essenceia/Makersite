<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BlacklistHandler as BList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BlacklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {//Show all 
        $req = DB::table('blacklist')->join('users','blacklist.user_id','=','users.id')->select('users.name as user_name','users.email as user_email','blacklist.created_at as bl_created','blacklist.updated_at as bl_updated','blacklist.chances as bl_chances','blacklist.user_id as id')->get();
        return view('admin.panel')->with('elem',$req)->with('component','blacklistlist');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     *
     * rajoute un blacklist a un utilisateur
     */
    public function edit($userid)
    {
        $ubl = BList::user_exits($userid);
        if($ubl){
            Log::debug('User does exist '.$userid);
            BList::decrement_chance($userid,$ubl->chances);
        }else{
            Log::debug("user doesn't exist we are creating with 2 chances ");
            BList::add_to_blacklist($userid,'2');
        }
        return view('utils.message')->with('message',(__('blacklist.absentmsg')));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($userid)
    {

        $req = DB::table('blacklist')->select('user_id','=',$userid)->delete();
        if($req){
            return view('utils.message')->with('message',(__('blacklist.removerfrombl')));
        }else{
            return view('utils.message')->with('message',(__('blacklist.errorremover')));
        }
    }
}
