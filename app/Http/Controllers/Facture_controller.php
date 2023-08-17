<?php
namespace App\Http\Controllers;

use App\Models\Fiche_montant_facture;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Models\Fournisseur_model;
use App\Models\Facture_model;
use App\Models\Departement_model;
use App\Models\Devise_model;
use App\Models\Details_facture_model;
use App\Models\Article_model;
use App\Models\Fiche_facture_model;
use App\Models\Grand_total_model;
use Dompdf\Dompdf;
use Barryvdh\DomPDF\Facade as PDF;
use DB;
class Facture_controller extends Controller{

public function create_facture()
{
        $fournisseur = DB::select("SELECT * from fournisseur");
        $consignataire = DB::select("SELECT * from v_login ");
        $departement=DB::select("SELECT * from departement ");
        $devise=DB::select("SELECT * from devise");
        $article=DB::select("SELECT * from article");

return view('create_facture',compact('fournisseur','consignataire','departement','devise','article'));
}
public function store_facture(Request $request)
{
        // dd($request);
       // get the selected fournisseur object
    $fournisseur = Fournisseur_model::where('nom_fournisseur', $request->id_fournisseur)->first();
    $consignataire = DB::table('V_login')->where('nom_gardien', $request->id__consignataire)->first();
    $departement=Departement_model::where('departement', $request->id_departement)->first();
    $devise = Devise_model::where('devise', $request->id_devise)->first();
    $article=Article_model::where('code_article', $request->id_article)->first();
    // create a new Facture instance

    $facture = new Facture_model;

    // set the facture attributes using the user input and selected fournisseur object
    $facture->date = $request->date;
    $facture->id_fournisseur = $fournisseur->id; // set the fournisseur ID
    $facture->id__consignataire = $consignataire->id;
    $facture->id_departement = $departement->id;
    $facture->id_devise = $devise->id;

    $facture->save();


    $details_facture1 = new Details_facture_model;
    $article=Article_model::where('code_article', $request->id_article1)->first();
    $details_facture1->id_article = $request->id_article1;
    $details_facture1->description = $request->description1;
    $details_facture1->tva=$request->tva1;
    $details_facture1->quantite=$request->quantite1;
    $details_facture1-> prix_unitaire=$request-> prix_unitaire1;
    $details_facture1->commanded=$request->commanded1;
    $details_facture1->id_facture = $facture->id;
    if($request->id_article1 &&  $request->description1 && $request->tva1 && $request->quantite1 && $request->commanded1 && $request-> prix_unitaire1){
        $details_facture1->save();
    }

    $details_facture2 = new Details_facture_model;
    // save the facture and details_facture to the database
    $article=Article_model::where('code_article', $request->id_article2)->first();
    $details_facture2->id_article = $request->id_article2;
    $details_facture2->description = $request->description2;
    $details_facture2->tva=$request->tva2;
    $details_facture2->quantite=$request->quantite2;
    $details_facture2-> prix_unitaire=$request-> prix_unitaire2;
    $details_facture2->commanded=$request->commanded2;
    $details_facture2->id_facture = $facture->id;
    if($request->id_article2 &&  $request->description2 && $request->tva2 && $request->quantite2 && $request->commanded2 && $request-> prix_unitaire2){
        $details_facture2->save();
    }
    $details_facture3 = new Details_facture_model;
    $article=Article_model::where('code_article', $request->id_article3)->first();
    $details_facture3->id_article = $request->id_article3;
    $details_facture3->description = $request->description3;
    $details_facture3->tva=$request->tva3;
    $details_facture3->quantite=$request->quantite3;
    $details_facture3-> prix_unitaire=$request-> prix_unitaire3;
    $details_facture3->commanded=$request->commanded3;
    $details_facture3->id_facture = $facture->id;
    if($request->id_article3 &&  $request->description3 && $request->tva3 && $request->quantite3 && $request->commanded3 && $request-> prix_unitaire3){
        $details_facture3->save();
    }

    $details_facture4 = new Details_facture_model;
    $article=Article_model::where('code_article', $request->id_article4)->first();
    $details_facture4->id_article = $request->id_article4;
    $details_facture4->description = $request->description4;
    $details_facture4->tva=$request->tva4;
    $details_facture4->quantite=$request->quantite4;
    $details_facture4-> prix_unitaire=$request-> prix_unitaire4;
    $details_facture4->commanded=$request->commanded4;
    $details_facture4->id_facture = $facture->id;
    if($request->id_article4 &&  $request->description4 && $request->tva4 && $request->quantite4 && $request->commanded4 && $request-> prix_unitaire4){
        $details_facture4->save();
    }

// redirect the user to the index page with a success message
return redirect('/liste_facture')->with('success', 'Facture créé avec succès');

}
    public function liste_facture()
    {
 // $liste_facture= DB::select("SELECT id,date,nom_fournisseur,id_facture,nom_gardien,prenom,departement,devise FROM V_facture group by id");
        $liste_facture = DB::table('v_liste_facture')
            ->select('id', 'date', 'nom_fournisseur', 'nom_gardien', 'prenom', 'departement', 'devise')
            ->groupBy('id')
            ->paginate(5);

  return view('liste_facture', compact('liste_facture'));
    }
    public function liste_facture_entre_date(Request $request){
         $date1 = $request->date1;
        $date2 = $request->date2;
          $liste_facture = DB::table('v_liste_facture')
                ->whereBetween('date', [$date1, $date2])
                ->paginate(5);
                 return view('liste_facture', compact('liste_facture'));
    }
    public function fiche_facture($id){
        //dd($id);
         $fiche_facture = Fiche_facture_model::where('id', $id)->first();
        $fiche_montant_facture = DB::select("SELECT * from v_facture_details where id_facture=$id");
        $grand_total = Grand_total_model::where('id_facture', $id)->first();
        return view('fiche_facture_details', compact('fiche_facture','fiche_montant_facture','grand_total'));
    }

    public function reception($id)
    {
       // dd($id);
           $count_details_facture = DB::select("SELECT count(*) FROM details_facture WHERE id_facture=$id");
           $check_facture = DB::select("SELECT count(*) from v_reception where facture_reception=$id");
        //dd($count_details_facture);
       // dd($check_facture);
        if ($count_details_facture[0] > $check_facture[0]) {
            $facture = Fiche_facture_model::where('id_facture', $id)->first();
            $fournisseur = DB::select("SELECT * from fournisseur");
            $consignataire = DB::select("SELECT * from v_login ");
            $emplacement = DB::select("SELECT * from emplacement ");
            $recevoir = DB::select("SELECT numero_article_facture,id_article,description,commanded,quantite from v_facture_details where id_facture=$id");
            return view('reception', compact('id', 'facture', 'fournisseur', 'consignataire', 'emplacement', 'recevoir'));
        }else{
               $error_reception = "Cette facture a été déjà reçue";
                $liste_facture = DB::table('v_facture')
            ->select('id', 'date', 'nom_fournisseur', 'id_facture', 'nom_gardien', 'prenom', 'departement', 'devise')
            ->groupBy('id')
            ->paginate(5);
            return view('liste_facture',compact('liste_facture','error_reception'));
        }
    }

}
