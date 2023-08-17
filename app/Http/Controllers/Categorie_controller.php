<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorie_model;
use DB;

class Categorie_controller extends Controller
{
public function create()
{
$categorie = Categorie_model::all();
return view('create', compact('categorie'));
}
public function taux_amortissement_categorie(){
        $liste_categorie = DB::select("SELECT * FROM categorie");
        return view('taux_amortissement_categorie', compact('liste_categorie'));
}
}
