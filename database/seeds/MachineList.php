<?php

use Illuminate\Database\Seeder;

class MachineList extends Seeder
{
    private function setpara( $type,$name,$supervised,$description){
        return array('type'=>$type,'name'=>$name,'supervision'=>$supervised,'desc'=>$description);
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        //seed machine List

        $m[0]=$this->setpara(1,'Zortax200',true,'Imprimante la plus facile a utiliser');
        $m[1]=$m[0];
        $m[2]=$m[0]=$this->setpara(1,'Sharebot',true,'Double buse, beaucoup plus complex a utiliser');
        $m[3]=$this->setpara(2,'Speedy 100',true,'Le bebe du FabLab');
        $m[4]=$this->setpara(3,'Post_a_Souder_1',false,'Post a souder classic');

        $m[5]=$this->setpara(3,'Post_a_Souder_2',false,'Post a souder a indction');
        $m[6]=$this->setpara(3,'Post_a_Souder_CMS',false,'Post a souder pour les CMS.');
        for($i = 0 ; $i < count($m);$i++){
            DB::table('machine')->insert(['id'=>($i+1),
                'type'=>$m[$i]['type'],'name'=>$m[$i]['name'],
                'supervision'=>$m[$i]['supervision'],
                'desc'=>$m[$i]['desc']]);
        }

    }
}
