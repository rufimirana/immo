<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article_model;
use App\Models\Emplacement_model;
use DB;
class Stock_article_controller extends Controller{
    public function liste_stock_all()
    {
        $emplacement=DB::select("SELECT * from emplacement ");
        $article=DB::select("SELECT * from article");
        $liste_stock_all = DB::select("SELECT id_article,designation,count(*) as count FROM v_stock_article GROUP by id_article");
        $nombre_all_immo = DB::select("SELECT count(*) as count from v_stock_article");
     return view('all_stock', compact('emplacement','article','liste_stock_all', 'nombre_all_immo'));
    }

    public function stock_by_article(Request $request){
          $emplacement=DB::select("SELECT * from emplacement ");
        $article=DB::select("SELECT * from article");
        $id_article=Article_model::where('code_article', $request->id_article)->first();
        $id_emplacement=Emplacement_model::where('id', $request->id_emplacement)->first();
        $liste_stock_by = DB::select("SELECT code_barre,id_article,designation,emplacement FROM v_stock_article where id_article = $id_article->code_article and id_emplacement=$id_emplacement->id");
    $nombre_by = DB::select("SELECT count(*) as count from v_stock_article where id_article =$id_article->code_article and id_emplacement=$id_emplacement->id");
       // dd($liste_stock_by);
        //dd($nombre_by);
        return view('stock_by', compact('liste_stock_by', 'nombre_by','emplacement','article'));
    }
}
