<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
//TODO : finish facory for shecdual
/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function ($date,$number) {
    if($number < 11 && $number >= 0){
        $time = 8*60 + $number*30;
    }else{ echo "time error invalide number :".$number;
    $time = 20*60; //
    }
    return [

    ];
});
