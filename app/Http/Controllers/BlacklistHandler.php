<?php
/**
 * Created by PhpStorm.
 * User: pookie
 * Date: 7/16/17
 * Time: 2:43 PM
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class BlacklistHandler
{
    public static function user_exits($userID){
        //does user already exist in database
         return DB::table('blacklist')->select('*')->where('user_id','=',$userID)->first();
    }
 public static function is_blacklisted($userID){
     $ret = false;
     $data = DB::table('blacklist')->select('*')->where('user_id','=',$userID)->first();
     if($data){
         if($data->chances===0){
             //TODO 1 week blackist periode

             $ret=true;
         }
         Log::debug('user with id '.$userID.' with chances '.$data->chances.' updated at '.$data->updated_at);
     }
     return $ret;
}
public static function add_to_blacklist($userid,$chances){

         if(!(($chances=='0')||($chances=='1')||($chances=='2'))){
             $chances='2';
         }
         $res = DB::table('blacklist')->insert(['user_id'=>$userid,
             'chances'=>$chances,
             'updated_at'=>date('Y-m-d H:i:s'),
             'created_at'=>date('Y-m-d H:i:s')
             ]);

}
public static function ban($userid){
        DB::table('blacklist')->where('user_id','=',$userid)->update(['chances'=>'0','updated_at'=>date('Y-m-d H:i:s')]);

}
public static function add_chance($userID,$current_chances){

         DB::table('blacklist')->where('user_id','=',$userID)->update(['updated_at'=>date('Y-m-d H:i:s'),'chances'=>self::changeval($current_chances,1)]);

    }
    public static function decrement_chance($userID,$current_chances){
           DB::table('blacklist')->where('user_id','=',$userID)->update(['updated_at'=>date('Y-m-d H:i:s'),'chances'=>self::changeval($current_chances,-1)]);

    }
    public static function changeval($current_chance,$modif){
        switch ($current_chance){
            case '0':$ret = 0 + $modif;break;
            case '1':$ret = 1 + $modif;break;
            case '2':$ret = 2 + $modif;break;
            default: $ret = 0;break;
                    }
        if($ret < 0)$ret = 0;
        if($ret >2)$ret = 2;
        return strval($ret);
    }
}