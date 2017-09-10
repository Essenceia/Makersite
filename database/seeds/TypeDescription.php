<?php

use Illuminate\Database\Seeder;

class TypeDescription extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=array('Imprimante 3D'=>'Fornctionne par depot de plastic PLA ou ABS.',
            'Laser'=>'Permet de decouper et graver divers materieaux : carton, bois, papier , acrylique',
            'Soudure'=>'Tout le necessaire pour faire de la belle soudure.');
        $i = 0;

        foreach(array_keys($data) as $key){
            DB::table('type_desc')->insert([
                'id'=>$i,
                'name'=>$key,
                'desc'=>$data[$key]
            ]);

        }
    }
}
