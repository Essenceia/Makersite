<?php
/**
 * Created by PhpStorm.
 * User: pookie
 * Date: 7/16/17
 * Time: 6:36 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class MachineHelper
{
 public static function cost($id,$slots){
     $cost = 0;
         $m = DB::table('machine')->select('pointcost')->where('id','=',$id)->first();
         $cost =$m->pointcost*$slots;
         Log::debug('Cost calculation machine id'.$id.' for '.$slots.' slots cost is '.$cost);

     return $cost;
 }
 public static function get_name($id){
     return DB::table('machine')->select('name')->where('id','=',$id)->first()->name;
 }
}