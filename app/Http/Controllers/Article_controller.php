<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article_model;
use App\Models\Categorie_model;
use App\Models\Sous_categorie_model;
use DB;

class Article_controller extends Controller
{
     public function nav()
    {
        return view('nav');
    }
    public function index()
    {
         $categorie = DB::select("SELECT * FROM categorie");
        $liste_article = DB::table('v_article')
         ->orderBy('code_article', 'asc')
        ->paginate(5);
        return view('liste_article', compact('categorie','liste_article',['liste_article' => $liste_article]));
    }

    public function create()
    {
        $categorie = DB::select("SELECT * FROM categorie");
        $sous_categorie = DB::select("SELECT * FROM sous_categorie");
        $departement = DB::select("SELECT * FROM departement");
        $service = DB::select("SELECT * FROM service");
        $modele = DB::select("SELECT * FROM modele");
        $marque = DB::select("SELECT * FROM marque");
        $couleur = DB::select("SELECT * FROM couleur");
        $taille = DB::select("SELECT * FROM taille");
        $methode_amortissement = DB::select("SELECT * FROM methode_amortissement");
        return view('create', compact('categorie', 'sous_categorie', 'departement', 'service', 'modele', 'marque', 'couleur', 'taille', 'methode_amortissement'));
    }
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'nom' => 'required',
            'designation' => 'required',
            'designation_courte' => 'required',
            'id_categorie' => 'required',
            'id_sous_categorie' => 'required',
            'id_departement' => 'required',
            'id_service' => 'required',
            'id_modele' => 'required',
            'id_marque' => 'required',
            'id_couleur' => 'required',
            'id_taille' => 'required',
            'id_methode_amortissement' => 'required',
            'duree_annee' => 'required',
        ]);

        $article = Article_model::create($validatedData);
        echo $article;
        return redirect('/liste')->with('success', 'Article créé avec succès');
    }
    public function liste_par_categorie()
    {
        $categorie = DB::select("SELECT * FROM categorie");
        return view('liste_par_categorie', compact('categorie'));
    }
    public function liste_categ(Request $request)
    {
        // dd($request);
        $id = $request->id_categorie;
        $liste_categ = DB::table('V_article')
            ->Where('id_categorie', $id)
            ->get();
     //   echo $id;
        return view('liste_categ', ['liste_categ' => $liste_categ]);
    }
    public function search_article(Request $request)
    {
         $categorie = DB::select("SELECT * FROM categorie");
        $sous_categorie = DB::select("SELECT * FROM sous_categorie");
        $departement = DB::select("SELECT * FROM departement");
        $service = DB::select("SELECT * FROM service");
        $modele = DB::select("SELECT * FROM modele");
        $marque = DB::select("SELECT * FROM marque");
        $couleur = DB::select("SELECT * FROM couleur");
        $taille = DB::select("SELECT * FROM taille");
        $methode_amortissement = DB::select("SELECT * FROM methode_amortissement");
        $designation_article=$request->designation_article;
        $liste_article = DB::table('V_article')
            ->where('designation_article', 'like', '%' . $designation_article . '%')
            ->paginate(5);
       // dd($article_search);
        return view('liste_article',compact('categorie', 'sous_categorie', 'departement', 'liste_article'));
    }
}
