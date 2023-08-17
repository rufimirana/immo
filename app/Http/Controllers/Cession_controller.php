<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Models\Immo_model;
use App\Models\Devise_model;
use App\Models\Cession_model;
class Cession_controller extends Controller
{
    public function formulaire_cession(Request $request)
    {
        $devise = DB::select("SELECT * from devise");
        $type_cession = DB::select("SELECT * from type_cession");
        $id_immo = $request->id_immo;
        $immo = Immo_model::find($id_immo);
        return view('formulaire_cession', compact('devise', 'type_cession', 'id_immo'));
    }
    public function ceder_immo(Request $request, $id_immo)
    {
       $devise = Devise_model::where('devise', $request->id_devise)->first();
        $type_cession = DB::table('type_cession')->where('type_cession', $request->id_type)->first();

        $id_immo = $request->id_immo;
        Immo_model::where('id', $id_immo)->update([
           'deleted'=>1,
        ]);
        $cession_immo = new Cession_model();
        $cession_immo->date_cession = $request->date_cession;
        $cession_immo->id_devise = $devise->id;
        $cession_immo->id_type = $type_cession->id;
        $cession_immo->prix_final=$request->prix_final;
        $cession_immo->id_immo=$request->id_immo;
        $cession_immo->save();
         $liste_cession=DB::table('v_cession')
        ->select('*')
        ->where('deleted','=',1)
        ->paginate(5);
        return view('liste_immo_vendues', compact('cession_immo','liste_cession'));
    }
    public function liste_immo_vendues(){
       // $liste_cession = DB::select("SELECT * FROM v_cession where deleted=1");
        $liste_cession=DB::table('v_cession')
        ->select('*')
        ->where('deleted','=',1)
        ->paginate(5);
        return view('liste_immo_vendues', compact('liste_cession'));
    }
}
