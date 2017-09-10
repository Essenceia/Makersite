<?php

use Illuminate\Database\Seeder;

class MachineCalander extends Seeder
{
    /**
     * Run the database seeds.
     * Create 2 weeks of calander for machine
     *
     * @return void
     */
    public function run()
    {


        // $date = new DateTime(strtotime('next Monday -1 week', strtotime('this sunday')));
        $loop = date_interval_create_from_date_string('2 weeks')->format("%d");
        Log::debug("Loop ".$loop);

        for( $machine_number = 1 ; $machine_number <= 7 ; $machine_number ++) {
            //for reset of date to todays week
            $date = new DateTime();
            $date->modify("Monday this week");
            Log::debug('begin date '.$date->format('Y-m-d H:i:s'));
            for($j = 0 ; $j < $loop ; $j++) {

                date_time_set($date,8,0,0);

                    for ($i = 0; $i < 20; $i++) {
                        if (date_format($date,'N')<= 5 )  { $status = random_int(0, 2);}else{ $status = 0;}

                        DB::table('machine_calander_status')->insert([
                                                        'date' => date_format($date,'Y-m-d H:i:s'),

                            'status' => $status,
                            'reservation' => null,
                            'machine_id'=> $machine_number,
                        ]);
                        //increment by 30 minutes

                        date_add($date,date_interval_create_from_date_string("30 minutes"));                   }
                date_add($date,date_interval_create_from_date_string("1 day"));

            }
        }

        //
    }
}
