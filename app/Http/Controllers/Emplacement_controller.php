<?php
namespace App\Http\Controllers;

use DB;

class Emplacement_controller extends Controller
{
    public function all_emplacement()
    {
        $nombre_all_immo = DB::select("SELECT count(*) as count from v_stock_article");
        $emplacement = DB::select("SELECT * from emplacement ");
        $categorie = DB::select("SELECT * from categorie");
        $all_emplacement = DB::select("SELECT id_article,emplacement,designation,count(*) as count FROM v_stock_article group by emplacement");
        return view('all_emplacement', compact('all_emplacement', 'emplacement', 'categorie','nombre_all_immo'));
    }

}
