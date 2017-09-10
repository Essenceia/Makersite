<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EventListController extends Controller
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
        //
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
     * @param  int  $event_id
     * @return \Illuminate\Http\Response
     *
     * Display la liste des personnes ce rendant a un evenement, l'id reference l'evenement
     */
    public function show($event_id)
    {
        $empty = DB::table('event_list')->select('event_id')->where('event_id','=',$event_id)->get();
        if($empty->count()!=0){
        $req=DB::table('event_list')->where('event_list.event_id','=',$event_id)
            ->join('users', 'event_list.user_id','=','users.id')
            ->select('users.id as user_id','users.name as user_name','users.email as user_email','event_list.reservation_time as event_retime','event_list.event_id as event_id')
            ->get();
        if($req){
                        return view('admin.panel')->with('component','eventlistedit')->with('elem',$req);
        }else{
            Log::error("Show event list erreur , requette est null avec event id ".$event_id);
            return view('utils.message')->with('message',"Une erreur est survenu lors de la requette, veuillez signaler un administateur.");
        }}else{
            return view('utils.message')->with('message',"Personne n'est inscrit a cette evenement a l'heur actuelle");
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
        $blacklist = false;
        $res = DB::table('blacklist')->select('*')->where('user_id','=',Auth::id())->first();

        if($res != null)$blacklist=true;
        $doublon = DB::table('event_list')->select('*')->where('user_id','=',Auth::user()->id)->where('event_id','=',$id)->first();
        if($doublon ==false){
        $res = DB::table('event')->select('*')->where('id','=',$id)->first();
        Log::debug('Show was reatched');
        return view('event-registrationv2')->with('event',$res)->with('blacklist',$blacklist);
    }else{
            return view('utils.message')->with('message',"Vous etes deja inscrit a cette evenement");
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
        $msg = 'Une erreur est survenu, veuillez contacter un administateur ... Ceci est bizzard';
        //store reservation request
        $req=DB::table('event_list')->insert(['user_id'=>Auth::id(),'event_id'=>$id,'reservation_time'=>date('Y-m-d H:i:s'),
        ]);
        if($req){
            $req = DB::table('event')->select('id','=',$id)->decrement('open_spots');
            if($req){$msg = 'Reservation reussi';}else{
                Log::debug('Event list impossible d inscir utilisateur a la event list , utilisateur '.Auth::id().' event id '.$id);
            }
            //ont enleve un creneau

        }else{
            Log::error('Event list impossible d inscrire un utilisateur id '.Auth::id().' pour event id '.$id);
        }
        return view('utils.message')->with('message',$msg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$event_id)
    {

        $req = DB::table('event_list')->where('user_id','=',$user_id)->where('event_id','=',$event_id)->delete();
        //rajouter une place a l'evenement
        if(DB::table('event')->where('id','=',$event_id)->increment('open_spots')==false){
            Log::error('Impossible de incrementer le nombre de place de l event avec id '.$event_id);
        }
        if($req){
            return view('utils.message')->with('message',"Utilisateur a etait enlever de l'evenement.");
        }else{
            return view('utils.message')->with('message',"Une erreur est survenu lors de la suppression de l'utilisateur de l'evenement");
        }
    }
}
