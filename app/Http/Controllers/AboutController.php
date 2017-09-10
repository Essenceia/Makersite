<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AboutController extends Controller
{
    public function __construct()
    {
        //nothing to be done
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    //TODO create entry in DB for members of team
    public function index(){
        $years= DB::table('team')->select('*')->orderByDesc('year')->get();
       /* foreach ($years as $y){
            Log::debug('year '.$y->year);
        }*/
    return view('about')->with('team',$years)->with('date',0);
    }
}
