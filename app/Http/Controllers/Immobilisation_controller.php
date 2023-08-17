<?php
namespace App\Http\Controllers;
use App\Models\Article_model;
use App\Models\Details_facture_model;
use App\Models\Categorie_model;
use App\Models\Emplacement_model;
use Illuminate\Http\Request;
use DB;
use App\Models\Immo_model;
use Carbon\Carbon;
use Milon\Barcode\DNS1D;
use App\Models\Transfert_model;

class Immobilisation_controller extends Controller
{
    public function fiche_immo(Request $request)
    {
        $id_immo = $request->id_fiche;
        $immo = Immo_model::find($id_immo);
        $emplacement = DB::select("SELECT immo.id,immo.id_emplacement,emplacement.emplacement FROM immo join emplacement on emplacement.id=immo.id_emplacement where immo.id=$id_immo");
       // dd($emplacement);
        $emplacement_immo = $emplacement[0]->emplacement;
        $barcode = new DNS1D();
        $code = str_pad((string) $immo->code_barre, 2, '0', STR_PAD_LEFT);

        $barcode->setStorPath(storage_path('app/barcodes/'));
        $barcodes = DNS1D::getBarcodePNG($code, 'C128');
        //dd($barcodes);
        $immo->barcode = $barcodes;
        $id_details_reception = $immo->id_details_reception;
        $details_reception = DB::select("SELECT immo.id, immo.id_details_reception, details_reception.id_reception,details_reception.id_article,details_reception.remarque as remarque,reception.id_facture,reception.date_reception,facture.date as date_facture,article.id_categorie,categorie.duree_vie
         from details_reception
        join immo on details_reception.id=immo.id_details_reception
        join reception on reception.id=details_reception.id_reception
        join facture on facture.id=reception.id_facture
      	join article on details_reception.id_article= article.code_article
        join categorie on categorie.id= article.id_categorie
        where immo.id=$id_immo
        ;");
     $date_acquisition = $details_reception[0]->date_reception;
            $duree = $details_reception[0]->duree_vie;
            $date_amortie = date('Y-m-d', strtotime("+$duree years", strtotime($date_acquisition)));
        $article = Article_model::where('code_article', '=', $details_reception[0]->id_article)->get();
        $detail_facture = Details_facture_model::where('id_article', '=', $details_reception[0]->id_article)->where('details_facture.id_facture', '=', $details_reception[0]->id_facture)->get();
        $taux_amortissement = Categorie_model::where('id', '=', $article[0]->id_categorie)->get();
        $taux_pourcentage_origine = $taux_amortissement[0]->taux_amortissement;
        $duree_vie = $taux_amortissement[0]->duree_vie;
        $date_acquisition = Carbon::parse($details_reception[0]->date_reception);
        $date_debut_exercice = Carbon::parse('January 1st')->year($date_acquisition->year);
        $date_fin_exercice = Carbon::parse('December 30th')->year($date_acquisition->year);
        $monthsDiff = $date_acquisition->diffInMonths($date_fin_exercice);
        $taux_prorata = ($monthsDiff * $taux_pourcentage_origine) / 12;
        $prix_unitaireHTT = $detail_facture[0]->prix_unitaire;
        $tva = $detail_facture[0]->tva;
        $prixTTC = $prix_unitaireHTT + ($prix_unitaireHTT / $tva);
        $taux_en_decimal = $taux_pourcentage_origine / 100;
        $taux_en_decimal_prorata = $taux_prorata / 100;
        $taux_en_decimal_derniere_annee = ($taux_pourcentage_origine - $taux_prorata) / 100;
        $annuite_premiere_annee = $taux_en_decimal_prorata * $prixTTC;
        $annuite = $taux_en_decimal * $prixTTC;
        $annuite_derniere_annee = $taux_en_decimal_derniere_annee * $prixTTC;
        $vnc_A1 = $prixTTC - ($taux_en_decimal_prorata * $prixTTC);
        $vnc_derniere_annee = $prixTTC - ($taux_en_decimal_derniere_annee * $prixTTC);
        $vnc = array();
        $vnc_important[$annuite] = $annuite;
        $vnc_important[$annuite_derniere_annee] = $annuite_derniere_annee;

        $vnc[1]["annee"] = 1;
        $vnc[1]["valeur_comptable_initiale"] = $prixTTC;
        $vnc[1]["annuite"] = $annuite_premiere_annee;
        $vnc[1]["valeur_comptable_finale"] = $vnc_A1;


        for ($i = 2; $i <= $duree_vie - 1; $i++) {
            $vnc[$i]["annee"] = $i;
            $vnc[$i]["valeur_comptable_initiale"] = $vnc[$i - 1]["valeur_comptable_finale"];
            $vnc[$i]["annuite"] = $vnc_important[$annuite];
            $vnc[$i]["valeur_comptable_finale"] = $vnc[$i - 1]["valeur_comptable_finale"] - $vnc_important[$annuite];
        }

        $vnc[$duree_vie]["annee"] = $duree_vie;
        $vnc[$duree_vie]["valeur_comptable_initiale"] = $vnc[$duree_vie - 1]["valeur_comptable_finale"];
        $vnc[$duree_vie]["valeur_comptable_finale"] = $vnc[$i - 1]["valeur_comptable_finale"] - $vnc_important[$annuite];
        $vnc[$duree_vie]["annuite"] = $vnc_important[$annuite];

        $vnc[$duree_vie + 1]["annee"] = $duree_vie + 1;
       $vnc[$duree_vie + 1]["valeur_comptable_finale"] = number_format((float)$vnc[$duree_vie]["valeur_comptable_finale"] - $vnc_important[$annuite_derniere_annee], 10, '.', '');
        $vnc[$duree_vie + 1]["annuite"] = $vnc_important[$annuite_derniere_annee];

     $vnc[$duree_vie + 1]["valeur_comptable_initiale"] = $vnc[$duree_vie]["valeur_comptable_finale"];
  return view('fiche_immo', ['vnc' => $vnc, 'vnc_important' => $vnc_important, 'immo' => $immo, 'details_reception' => $details_reception, 'categorie' => $taux_amortissement, 'article' => $article,],compact('date_amortie','emplacement_immo'));

    }

    public function transferer_immo(Request $request)
    {
        $emplacement = DB::select("SELECT * from emplacement ");
        $consignataire = DB::select("SELECT * from v_login ");
        $id_immo = $request->id_immo;
        $immo = Immo_model::find($id_immo);
        //dd($id_immo);
        return view('transferer_immo', compact('emplacement', 'consignataire', 'id_immo'));

    }
    public function update_immo(Request $request, $id_immo)
    {
        $emplacement = DB::select("SELECT * FROM emplacement");
        $emplacement_id = Emplacement_model::where('emplacement', $request->id_emplacement)->first();
        $consignataire = DB::table('V_login')->where('nom_gardien', $request->id__consignataire)->first();
        //dd($id_emplacement);
        $id_immo = $request->id_immo;
        $id_emplacement = $emplacement_id->id;
        Immo_model::where('id', $id_immo)->update([
            'id_emplacement' => $id_emplacement,
        ]);
        $transfert = new Transfert_model;
        $transfert->date_transfert = $request->date_transfert;
        $transfert->id_emplacement = $emplacement_id->id;
        $transfert->id_consignataire = $consignataire->id;
        $transfert->id_immo = $request->id_immo;
        $transfert->remarque = $request->remarque;
        $transfert->save();

         $liste_transfert=DB::table('v_transfert')
    ->select('code_transfert', 'date_transfert', 'is_immo', 'code_barre', 'emplacement', 'nom_gardien', 'prenom','remarque')
    ->paginate(5);
        return view('liste_transfert',compact('transfert','liste_transfert','emplacement'))->with('success', 'bien transférée avec succès');
    }
    public function liste_transfert_immo()
    {
    $liste_transfert=DB::table('v_transfert')
    ->select('code_transfert', 'date_transfert', 'is_immo', 'code_barre', 'emplacement', 'nom_gardien', 'prenom','remarque')
    ->paginate(5);
 $emplacement = DB::select("SELECT * FROM emplacement");
        return view('liste_transfert', compact('liste_transfert','emplacement'));
    }
    public function liste_transfert_entre_date(Request $request)
    {
         $emplacement = DB::select("SELECT * FROM emplacement");
          $id_emplacement = Emplacement_model::where('emplacement', $request->id_emplacement)->first();

        $date1 = $request->date1;
        $date2 = $request->date2;
         if($date1 && $date2){
            $liste_transfert = DB::table('v_transfert')
                ->whereBetween('date_transfert', [$date1, $date2])
                ->paginate(5);
        }
        if($id_emplacement){
                $liste_transfert = DB::table('v_transfert')
                ->Where('id_emplacement','=' ,$id_emplacement)
                ->paginate(5);
        }
        if($date1 && $date2 && $id_emplacement){
            $liste_transfert = DB::table('v_transfert')
                ->whereBetween('date_transfert', [$date1, $date2])
                ->where('id_emplacement', '=', $id_emplacement )
                ->paginate(5);
        }
//dd($request);
        //dd($id_emplacement);
        return view('liste_transfert', compact('liste_transfert','emplacement'));
    }
    public function immobilisation_amortie()
    {
        $immo = DB::select("SELECT immo.id,immo.code_barre,immo.deleted, reception.date_reception,details_reception.id_article,article.id_categorie,categorie.duree_vie
         from details_reception
        join immo on details_reception.id=immo.id_details_reception
        join reception on reception.id=details_reception.id_reception
        join article on article.code_article=details_reception.id_article
        join categorie on categorie.id=article.id_categorie
        where immo.deleted=0
        ");

        $date_today = Carbon::now();
        $amortis = array();
        foreach ($immo as $im) {
            $date_acquisition = $im->date_reception;
            $duree = $im->duree_vie;
            $date_amortie = date('Y-m-d', strtotime("+$duree years", strtotime($date_acquisition)));
            $id_immo = $im->id;
            if ($date_amortie < $date_today) {
                $im->date_amortie = $date_amortie;
                $amortis[] = $im;
            }
        }
 // dd($amortis);
           return view('liste_immo_amortie',['amortis' => $amortis]);
    }
}
