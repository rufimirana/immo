<?php

use App\Http\Controllers\Dashboard_controller;
use App\Http\Controllers\Emplacement_controller;
use App\Http\Controllers\Facture_controller;
use App\Http\Controllers\Reception_controller;
use App\Http\Controllers\Stock_article_controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Article_controller;
use App\Http\Controllers\Login_controller;
use App\Http\Controllers\Immobilisation_controller;
use App\Http\Controllers\Inventaire_controller;
use App\Http\Controllers\Cession_controller;
use App\Http\Controllers\Categorie_controller;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
///Articles routes
Route::get('/nav', [Article_controller::class, 'nav'])->name('nav');
Route::get('/liste', [Article_controller::class, 'index'])->name('liste');
Route::get('/create', [Article_controller::class, 'create'])->name('create');
Route::post('/store', [Article_controller::class, 'store'])->name('store');
Route::get('/liste_par_categorie', [Article_controller::class, 'liste_par_categorie'])->name('liste_par_categorie');
Route::get('/liste_categorie', [Article_controller::class, 'liste_categ'])->name('liste_categ');
Route::get('/search_article',[Article_controller::class, 'search_article'])->name('search_article');
Route::get('/taux_categorie',[Categorie_controller::class,'taux_amortissement_categorie'])->name('taux_categorie');

/// Dashboad routes
Route::get('dashboard', [Login_controller::class, 'dashboard']);


///Login routes
Route::get('/login', [Login_controller::class, 'index'])->name('login');
Route::post('custom-login', [Login_controller::class, 'customLogin'])->name('login.custom');
Route::get('registration', [Login_controller::class, 'registration'])->name('register-user');
Route::post('custom-registration', [Login_controller::class, 'customRegistration'])->name('register.custom');
Route::get('/typeahead_autocomplete/action', [Login_controller::class, 'action'])->name('typeahead_autocomplete.action');
///Facture routes
Route::get('/create_facture', [Facture_controller::class, 'create_facture'])->name('create_facture');
Route::post('/store_facture', [Facture_controller::class, 'store_facture'])->name('store_facture');
//Route::get('/saisie_facture', [Facture_controller::class, 'saisie_facture'])->name('saisie_facture');
Route::get('/liste_facture', [Facture_controller::class, 'liste_facture'])->name('liste_facture');
Route::get('/liste_facture_entre_deux_date',[Facture_controller::class, 'liste_facture_entre_date'])->name('liste_facture_entre_date');
Route::get('/fiche_facture/{id}', [Facture_controller::class, 'fiche_facture'])->name('fiche_facture');
Route::get('/essai',[Facture_controller::class, 'essai'])->name('essai');
Route::post('/handle-form', function (Illuminate\Http\Request $request) {
    $name = $request->input('name');
    return view('result', ['name' => $name]);
})->name('handle-form');
// Route::get('/pdf', function () {
//     $pdf = PDF::loadView('fiche_facture_details'); // replace 'pdf' with your PDF view file name
//     return $pdf->stream();
// });

// Route::post('/pdf/import', [Facture_controller::class, 'importPdf'])->name('pdf.import');

/*Route::get('signout', [Login_controller::class, 'signOut'])->name('signout');

/*
    */

Route::get('/reception_info/{id}',[Facture_controller::class, 'reception'])->name('reception_info');
Route::post('/recevoir/{id}',[Reception_controller::class, 'recevoir' ])->name('recevoir');
Route::get('/liste_reception',[Reception_controller::class, 'liste_reception'])->name('liste_reception');
Route::get('/liste_reception_by_facture', [Reception_controller::class, 'liste_reception_by_facture'])->name('liste_reception_by_facture');
Route::get('/liste_immo',[Reception_controller::class, 'show'])->name('liste_immo');
Route::get('/liste_immo_by_code', [Reception_controller::class, 'liste_immo_by_code'])->name('liste_immo_by_code');
Route::post('/generer_barcode/{id}',[Reception_controller::class, 'generer_barcode'])->name('generer_barcode');
Route::post('/', function () {
    $pdf = PDF::loadView('fiche_details_facture', ['id' => 'to_pdf']);
    return $pdf->with('Success','Pdf bien imprimé');
})->name('facture_to_pdf');
Route::get('/fiche_immo/{id_fiche}',[Immobilisation_controller::class, 'fiche_immo'])->name('fiche_immo');
Route::get('/tranferer_immo/{id_immo}',[Immobilisation_controller::class, 'transferer_immo'])->name('transferer_immo');
Route::post('/update_immo/{id_immo}',[Immobilisation_controller::class, 'update_immo'])->name('update_immo');
Route::get('/liste_transfert_immo',[Immobilisation_controller::class, 'liste_transfert_immo'])->name('liste_transfert_immo');
Route::get('/liste_transfert__entre_date',[Immobilisation_controller::class, 'liste_transfert_entre_date'])->name('liste_transfert_entre_date');
Route::get('/liste_stock_all',[Stock_article_controller::class, 'liste_stock_all'])->name('liste_stock_all');
Route::get('/liste_stock_by',[Stock_Article_controller::class, 'stock_by_article'])->name('liste_stock_by');
Route::get('/all_emplacement',[Emplacement_controller::class,'all_emplacement'])->name('all_emplacement');
Route::get('/emplacement_by',[Emplacement_controller::class,'emplacement_by'])->name('emplacement_by');
Route::get('/immo_amortie',[Immobilisation_controller::class,'immobilisation_amortie'])->name('immo_amortie');
Route::get('/formulaire_inventaire',[Inventaire_controller::class,'formulaire_inventaire'])->name('formulaire_inventaire');
Route::post('/store_inventaire',[Inventaire_controller::class,'store_inventaire'])->name('store_inventaire');
Route::post('/liste_inventaire/{id_inventaire}/{categorie}/{emplacement}',[Inventaire_controller::class,'etablissement_inventaire'])->name('liste_inventaire');
Route::get('/liste_des_inventaires',[Inventaire_controller::class,'all_inventaire'])->name('liste_des_inventaires');
Route::post('/liste_inventaire_entre_deux_dates', [Inventaire_controller::class, 'liste_inventaire_entre_deux_dates'])->name('liste_inventaire_entre_deux_dates');
Route::get('/details_inventaire/{id_inventaire}', [Inventaire_controller::class, 'details_inventaire'])->name('details_inventaire');
Route::get('/liste_des_immos_disparues',[Inventaire_controller::class, 'immo_disparues'])->name('liste_des_immos_disparues');
Route::get('/formulaire_cession/{id_immo}',[Cession_controller::class, 'formulaire_cession'])->name('formulaire_cession');
Route::post('/ceder_immo/{id_immo}',[Cession_controller::class,'ceder_immo'])->name('ceder_immo');
Route::get('/liste_immos_vendues',[Cession_controller::class, 'liste_immo_vendues'])->name('liste_immos_vendues');
Route::get('/dashboard',[Dashboard_controller::class,'dashboard'])->name('dashboard');

Route::get('/logout',[Login_controller::class,'signOut'])->name('logout');
