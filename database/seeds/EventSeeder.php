<?php

use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new DateTime();
        $now = $date;
        $date->modify('Monday next week');
        for($i = 1 ; $i<10 ; $i++){
            $end = $date;
            date_add($end,date_interval_create_from_date_string("2 hours"));
            DB::table('event')->insert([
                'id'=>$i,
                'open_spots' =>random_int(3,10),
                'name'=>'Random name'.$i,
                'title'=>'Had to say something, we make cookies',
                'start_time'=>date_format($date,'Y-m-d H:i:s'),
                'end_time'=>date_format($end,'Y-m-d H:i:s'),
                'created_at'=>date_format($now,'Y-m-d H:i:s'),
                'updated_at'=>date_format($now,'Y-m-d H:i:s'),
            ]);
            date_add($date,date_interval_create_from_date_string("1 day"));
    }
    }
}
