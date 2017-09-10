<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class MachineController extends Controller
{
    public function __construct()
    {
        //TODO a decomenter pour forcer une autentification
        //$this->middleware('auth');
    }
    public function index(){
        $i = 1;
        $types = DB::table('type_desc')->orderBy('id')->get();
        foreach ($types as $cath){
            $machines=DB::table('machine')->select('id','type','desc','name','supervision')->where('type','=',$cath->id)->get();
            $mlist[$cath->id]=$machines;

        }

        //return view('machinereservation', ['materiel' => $mr]);
        return view('machine.machine')->with(['type'=>$types,'mlist'=>$mlist]);

    }
    public function create()
    {
        $data = DB::table('type_desc')->select('id','name')->get();
        foreach ($data as $type){
            Log::debug('type desc id '.$type->id.' name '.$type->name);
        }
        return view('admin.panel')->with('data',$data)->with('component','machinecreate');
    }
    public function store(Request $request)
    {
        $this->validate($request,[
            'type'=>"required|exists:type_desc,id",
            'desc'=>"required|max:16777215",
            'name'=>'required|max:191',
            'pointcost'=>'required|numeric|min:0',
        ]);
        $req = DB::table('machine')->insertGetId(['type'=>$request->input('type'),
            'desc'=>$request->input('desc'),
            'name'=>$request->input('name'),
            'supervision'=>($request->input('supervision') ? 1 : 0),
            'pointcost'=>$request->input('pointcost')
        ]);
        if($req){
            //redirect to default calander editer
            return \Redirect::route('defaultcalander.edit',
                array($req));
        }
        else{
            Log::error('Probleme dans la creation de la machine avec liste de parametres : type '.$request->input('type').' desc '.$request->input('desc').' name '.$request->input('name').' supervision '.$request->input('supervision').' pointcost '.$request->input('pointcost '));
            return view('utils.message')->with('message',(__('main.createrr')));
        }

            }
    public function edit($id)
    {
        $elem = DB::table('machine')->select('*')->where('id','=',$id)->first();
        $data = DB::table('type_desc')->select('id','name')->get();

        return view('admin.panel')->with('component','machineedit')->with('elem',$elem)->with('data',$data);
    }
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'type'=>"required|exists:type_desc,id",
            'desc'=>"required|max:16777215",
            'name'=>'required|max:191',
            'pointcost'=>'required|numeric|min:0',
        ]);
        $msg = 'Erreur dans la mise a jour de la machine';
        $req = DB::table('machine')->select('*')->where('id','=',$id)->update(['type'=>$request->input('type'),
            'desc'=>$request->input('desc'),
            'name'=>$request->input('name'),
            'supervision'=>($request->input('supervision') ? 1 : 0),
            'pointcost'=>$request->input('pointcost')
            ]);
        if($req){$msg='Mise a jour de la machine avec succes.';}
        else{
            Log::error('Probleme de update dans machine id '.$id.' liste de parametres : type '.$request->input('type').' desc '.$request->input('desc').' name '.$request->input('name').' supervision '.$request->input('supervision').' pointcost '.$request->input('pointcost '));
        }
        return view('utils.message')->with('message',$msg);

    }
    public function destroy($id)
    {
        $msg = (__('main.destroyerr')).' id : '.$id;
        //destroy calander
        $drop = DB::table('machine_calander_status')->select('reservation')->where('id','=',$id)->where('reservation','!=',null)->get();
        foreach ($drop as $resa){
            DB::table('machine_reservation')->where('id','=',$resa->reservation)->delete();
        }
        DB::table('machine_calander_status')->where('machine_id','=',$id)->delete();
        //destroy machine
        $req = DB::table('machine')->delete($id);
        if($req){
            $msg = (__('main.destroysuc'));
        }else{
            Log::error($msg);
        }
        return view('utils.message')->with('message',$msg);
    }

}

