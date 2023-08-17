<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Categorie_model;
use App\Models\Emplacement_model;
use App\Models\Gardien_model;
use App\Models\Inventaire_model;
use App\Models\Details_inventaire_model;
use Illuminate\Http\Request;
use App\Models\Etat_usage_model;
use Illuminate\Database\Eloquent\Builder;
use Carbon\Carbon;

class Inventaire_controller extends Controller
{
    public function formulaire_inventaire()
    {
        $categorie = DB::select("SELECT * from categorie");
        $emplacement = DB::select("SELECT * FROM emplacement");
        $consignataire = DB::select("SELECT * FROM v_login");
        $gardien = DB::select("SELECT * FROM gardien");
        return view('formulaire_inventaire', compact('categorie', 'emplacement', 'consignataire', 'gardien'));
    }
    public function store_inventaire(Request $request)
    {
        $etat_usage = DB::select("SELECT * FROM etat_usage");
        $categorie = Categorie_model::where('id', $request->id_categorie)->first();
        $emplacement = Emplacement_model::where('id', $request->id_emplacement)->first();
        $consignataire = DB::table('V_login')->where('nom_gardien', $request->id_consignataire)->first();
        $gardien = Gardien_model::where('nom_gardien', $request->id_gardien)->first();
        // $inventaire = DB::select("SELECT inventaire_immo.date_inventaire, v_inventaire.id as id_inventaire,
        //  v_inventaire.id_categorie, v_inventaire.id_emplacement FROM v_inventaire
        //  join inventaire_immo on inventaire_immo.id= v_inventaire.id
        //  WHERE v_inventaire.id_categorie=$request->id_categorie and v_inventaire.id_emplacement=$request->id_emplacement");
        $inventaire = DB::select("SELECT * from inventaire_immo WHERE inventaire_immo.id_categorie=$request->id_categorie and inventaire_immo.id_emplacement=$request->id_emplacement
        ");
       // dd($request);
         //dd($inventaire);
        //raha misy
        if ($inventaire) {
            //echo "if voalohany";
            $date_ancien_inventaire = Carbon::parse($inventaire[0]->date_inventaire);
            $date_new_inventaire = Carbon::parse($request->date_inventaire);
          //  echo $date_new_inventaire;
//echo $date_ancien_inventaire;
            if ($date_ancien_inventaire < $date_new_inventaire) {
               /// echo "if faharoa";
                $diffInDays = $date_ancien_inventaire->diffInDays($date_new_inventaire);
              ///  echo $diffInDays;
               // dd($diffInDays);
                ///raha efa feno 180
                if ($diffInDays > 180) {
                   // echo "if fahatelo";
                    $inventaire = new Inventaire_model;
                    $inventaire->date_inventaire = $request->date_inventaire;
                    $inventaire->id_categorie = $categorie->id;
                    $inventaire->id_emplacement = $emplacement->id;
                    $inventaire->id_consignataire = $consignataire->id;
                    $inventaire->id_gardien = $gardien->id;
                    // dd($inventaire);
                    $inventaire->save();
                    $id_inventaire = $inventaire->id;
                    $liste_inventaire = DB::select("SELECT * FROM v_inventaire WHERE id_categorie=$categorie->id and id_emplacement=$emplacement->id");
                    return view('liste_a_inventaire', compact('liste_inventaire', 'id_inventaire', 'categorie', 'emplacement', 'etat_usage'));
                }
                ///raha mbola tsy feno 180
                else {
                    //echo "else voalohany";
                    $categorie = DB::select("SELECT * from categorie");
                    $emplacement = DB::select("SELECT * FROM emplacement");
                    $consignataire = DB::select("SELECT * FROM v_login");
                    $gardien = DB::select("SELECT * FROM gardien");
                    $error_existant = "Cet inventaire a été déjà établi";
                    return view('formulaire_inventaire', compact('error_existant', 'categorie', 'emplacement', 'consignataire', 'gardien'));
                }
            }
        } else {
            // raha mbola tsy misy inventaire natao mihitsy
           /// echo "else faharoa";
            $inventaire = new Inventaire_model;
            $inventaire->date_inventaire = $request->date_inventaire;
            $inventaire->id_categorie = $categorie->id;
            $inventaire->id_emplacement = $emplacement->id;
            $inventaire->id_consignataire = $consignataire->id;
            $inventaire->id_gardien = $gardien->id;
            //dd($inventaire);
            $inventaire->save();
            $id_inventaire = $inventaire->id;
            $liste_inventaire = DB::select("SELECT * FROM v_inventaire WHERE id_categorie=$categorie->id and id_emplacement=$emplacement->id");
            return view('liste_a_inventaire', compact('liste_inventaire', 'id_inventaire', 'categorie', 'emplacement', 'etat_usage'));
        }
    }
    public function etablissement_inventaire(Request $request, $id_inventaire, $categorie, $emplacement)
    {
         $liste_inventaire = DB::select("SELECT * FROM v_liste_inventaire");
        $liste_categorie = DB::select("SELECT * FROM categorie");
        $inventaire = DB::select("SELECT * FROM inventaire_immo where id=$id_inventaire");
        $categorie = $inventaire[0]->id_categorie;
        $emplacement = $inventaire[0]->id_emplacement;
        $liste_inv = DB::select("SELECT * FROM v_inventaire WHERE id_categorie=$categorie and id_emplacement=$emplacement");
        foreach ($liste_inv as $liste) {

            $id_immo = $liste->id_immo;
            $etat_usage = $request['id_etat_usage' . $id_immo];
            $etat = 0;
            if ($request['etat' . $id_immo]) {
                $etat = 1;
                //echo $etat;
            } else {
                $etat = 0;
                // echo $etat;
            }
            $details_inventaire = new Details_inventaire_model;
            $details_inventaire->id_inventaire = $id_inventaire;
            $details_inventaire->id_immo = $id_immo;
            $details_inventaire->id_etat_usage = $etat_usage;
            $details_inventaire->etat = $etat;
           // dd($details_inventaire);
            //echo $etat;
            //dd($request);

            $details_inventaire->save();
        }
            return view('liste_des_inventaires', compact('details_inventaire','liste_categorie','liste_inventaire','liste_inv'));

     //   dd($request);

    }
    public function all_inventaire(){
        $liste_inventaire = DB::select("SELECT * FROM v_liste_inventaire");
        $liste_categorie = DB::select("SELECT * FROM categorie");
        return view('liste_des_inventaires', compact('liste_inventaire','liste_categorie'));
    }
    public function liste_inventaire_entre_deux_dates(Request $request){
        $date1 = $request->date1;
        $date2 = $request->date2;
        $categorie_id = $request->categorie_id;
        if($date1 && $date2){
            $liste_inventaire = DB::table('v_liste_inventaire')
                ->whereBetween('date_inventaire', [$date1, $date2])
                ->get();
        }
        if($categorie_id){
            $liste_inventaire = DB::table('v_liste_inventaire')
                ->where('id_categorie', '=', $categorie_id )
                ->get();
        }
        if($date1 && $date2 && $categorie_id){
            $liste_inventaire = DB::table('v_liste_inventaire')
                ->whereBetween('date_inventaire', [$date1, $date2])
                ->where('id_categorie', '=', $categorie_id )
                ->get();
        }
        if(!$date1 && $date2 && $categorie_id){
            $liste_inventaire = DB::table('v_liste_inventaire')->get();
        }
        $liste_categorie = DB::select("SELECT * FROM categorie");

        return view('liste_des_inventaires', compact('liste_inventaire','liste_categorie'));
    }
    public function details_inventaire($id_inventaire){
        $details_inventaire = DB::select("SELECT * FROM v_details_inventaire WHERE id_inventaire=$id_inventaire");
        $categorie = DB::select("SELECT nom_categorie FROM v_details_inventaire WHERE id_inventaire=$id_inventaire");
        $emplacement=DB::select("SELECT emplacement FROM v_details_inventaire WHERE id_inventaire=$id_inventaire");
        $nombre_total = DB::select("SELECT count(*) as count_total from v_details_inventaire where id_inventaire=$id_inventaire");
        $nombre_ok=DB::select("SELECT count(*) as count_ok from v_details_inventaire where etat=1 and id_inventaire=$id_inventaire");
        $nombre_disparue=DB::select("SELECT count(*) as count_disparue from v_details_inventaire where etat=0 and id_inventaire=$id_inventaire");

        return view('details_inventaire', compact('details_inventaire', 'categorie', 'emplacement', 'nombre_ok', 'nombre_total', 'nombre_disparue'));
    }
    public function immo_disparues(){
        $disparues = DB::select("SELECT * from v_details_inventaire where etat=0");
        return view('liste_immo_disparues', compact('disparues'));
    }
}
