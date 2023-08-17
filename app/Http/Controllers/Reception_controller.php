<?php

namespace App\Http\Controllers;
use App\Models\Reception_model;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use App\Models\Fournisseur_model;
use App\Models\Immo_model;
use App\Models\Facture_model;
use App\Models\Emplacement_model;
use App\Models\Details_reception_model;
use App\Models\Devise_model;
use App\Models\Details_facture_model;
use App\Models\Article_model;
use App\Models\Fiche_facture_model;
use App\Models\Grand_total_model;
use Milon\Barcode\DNS1D;
use DB;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Picqer\Barcode\BarcodeGeneratorPNG;

class Reception_controller extends Controller
{
        public function recevoir(Request $request, $id)
    {
            //$id_facture = $id;
            $fournisseur = Fournisseur_model::where('nom_fournisseur', $request->id_fournisseur)->first();
            $consignataire = DB::table('V_login')->where('nom_gardien', $request->id__consignataire)->first();
            $emplacement = Emplacement_model::where('emplacement', $request->id_emplacement)->first();
            $reception = new Reception_model();
            $reception->date_reception = $request->date_reception;
            $reception->id_fournisseur = $fournisseur->id;
            $reception->id_consignataire = $consignataire->id;
            $reception->id_emplacement = $emplacement->id;
            $reception->id_facture = $id;
            $reception->save();
            $details_reception = new Details_reception_model();
            $data['recevoir'] = DB::select("SELECT id_article,description,commanded,quantite from v_facture_details where id_facture=$id");
            foreach ($data['recevoir'] as $recevoir) {
                $details_reception = new Details_reception_model();
                $details_reception->id_article = $recevoir->id_article;
                $details_reception->remarque = $recevoir->description;
                $details_reception->commanded = $recevoir->commanded;
                $details_reception->recu = $recevoir->quantite;
                $details_reception->restant = 0;
                $details_reception->id_reception = $reception->id;
 $details_reception->save();
            }
return redirect('/liste_reception')->with('success', 'Bien reçue');

    }
    public function liste_reception()
    {
        $liste_reception=DB::table('v_reception')
                        ->select('code_reception','date_reception','fournisseur','facture_reception','nom_consignataire','prenom_consignataire','id_details_reception','code_article','commande','restant','recu','remarque')
                        ->paginate(7);
        return view('liste_reception', compact('liste_reception'));

    }
public function liste_reception_by_facture(Request $request){
        $facture_reception = $request->facture_reception;
    $liste_reception=DB::table('v_reception')
                        ->select('code_reception','date_reception','fournisseur','facture_reception','nom_consignataire','prenom_consignataire','id_details_reception','code_article','commande','restant','recu','remarque')
                        ->where('facture_reception','like', '%' . $facture_reception. '%')
                        ->paginate(7);
        return view('liste_reception', compact('liste_reception'));
}
    public function generer_barcode(Request $request, $id)
    {
        $count = DB::select("SELECT recu as count,id_reception from Details_reception where id=$id");
        $barcodes = [];
        $error_immo = "";
      $id_reception=$count[0]->id_reception;
       $emplacement= DB::select("SELECT reception.id_emplacement
        from details_reception join reception on reception.id=details_reception.id_reception where id_reception=$id_reception;");
        for ($i = 0; $i < $count[0]->count; $i++) {
            $barcode = str_pad($id, 10, '0', STR_PAD_LEFT) . str_pad($i + 1, 2, '0', STR_PAD_LEFT);
            $immo_new = new Immo_model();
             //dd($barcode);
            $immo_new->code_barre = $barcode;
            $immo_new->code_reception = $id_reception;
            $immo_new->id_details_reception = $id;
             $immo_new->id_emplacement = $emplacement[0]->id_emplacement;
            // mgenerer
            $check_if_exist= Immo_model::where('code_barre',$barcode)->get();
            if(count($check_if_exist) == 0){
           $immo_new ->save();
            } else {
                $error_immo = "Immobilisation ayant déjà un code barre";

        $liste_reception=DB::table('v_reception')
                        ->select('code_reception','date_reception','fournisseur','facture_reception','nom_consignataire','prenom_consignataire','id_details_reception','code_article','commande','restant','recu','remarque')
                        ->paginate(7);
                return view('liste_reception', compact('liste_reception','error_immo'));
            }
        }
         $immo = DB::table('immo')
            ->select('id', 'code_barre', 'id_details_reception', 'id_emplacement')
            ->orderBy('id','desc')
            ->paginate(5);

        // dd($immo);

        return view('liste_immo',compact('immo', 'error_immo'));
    }
     public function show()
    {
       // $immo = DB::select("SELECT id,code_barre,id_details_reception,id_emplacement from immo where deleted=0");
        $immo = DB::table('immo')
            ->select('id', 'code_barre', 'id_details_reception', 'id_emplacement')
            ->paginate(5);
        $val = array();
        $count = 0;

        foreach ($immo as $all_immo) {
         //   dd($all_immo);
              $barcode = new DNS1D();
              $code = str_pad((string)$all_immo->code_barre,10, '0', STR_PAD_LEFT);
              $barcode->setStorPath(storage_path('app/barcodes/'));
            $barcodes = DNS1D::getBarcodePNG($code, 'C128');

                $all_immo->barcode = $barcodes;
                $val[$count] = $all_immo;
                $count++;

        }
        // raha hijery hoe mitovy ve le code barre
       //dd($val);
       return view('liste_immo', [
    'immo' => $immo,
    'val' => $val,
]);
    }
    public function liste_immo_by_code(Request $request){
        $code_barre = $request->code_barre;
  $immo = DB::table('immo')
            ->select('id', 'code_barre', 'id_details_reception', 'id_emplacement')
            ->where('code_barre', 'like', '%' . $code_barre. '%')
            ->paginate(5);
             $val = array();
        $count = 0;

        foreach ($immo as $all_immo) {
         //   dd($all_immo);
              $barcode = new DNS1D();
              $code = str_pad((string)$all_immo->code_barre,10, '0', STR_PAD_LEFT);
              $barcode->setStorPath(storage_path('app/barcodes/'));
            $barcodes = DNS1D::getBarcodePNG($code, 'C128');

                $all_immo->barcode = $barcodes;
                $val[$count] = $all_immo;
                $count++;
return view('liste_immo', [
    'immo' => $immo,
    'val' => $val,
]);
        }
    }
}





















/**Essai 1 */
//        $details = DB::table('details_reception')->get();

// foreach ($details as $detail) {
//     $barcode = '';
//     $quantity = $detail->recu;

//     // Generate one or two barcodes depending on the recu quantity
//     if ($quantity == 1) {
//         $barcode = DNS1D::getBarcodeHTML($detail->id, "C128");
//     } elseif ($quantity > 1) {
//         for ($i = 1; $i <= 2; $i++) {
//             $barcode .= DNS1D::getBarcodeHTML($detail->id.$i, "C128");
//         }
//     }

//     // Insert the row into the `immo` table with the generated barcode(s)
//     DB::table('immo')->insert([
//         'code_barre' => $barcode,
//         'id_details_reception' => $detail->id,
//     ]);
// }
/**Essai 2 */
/**Tyh netinety kokoa */
// Get all the records from the 'details_invoice' table
// $details = DB::table('details_reception')->get();

// // Loop through each record and insert into the 'immo' table
// foreach ($details as $detail) {
//     // Generate a unique barcode based on the id
//     $barcode = new DNS1D();
//     $barcodeValue = $detail->id;
//     if ($detail->recu > 1) {
//         $barcodeValue .= 'B';
//     }
//     $barcodeType = 'C39';
//     $barcodeImage = $barcode->getBarcodePNG($barcodeValue, $barcodeType);

//     // Insert the record into the 'immo' table
//     DB::table('immo')->insert([
//         'code_barre' => $barcodeValue,
//         'id_details_reception' => $detail->id,

//     ]);
//             echo $barcodeImage;
// }
/**Essai 3 */


// Fetch all records with received > 1 or null
// $records = DB::table('details_reception')
//               ->where('recu', '>', 1)
//               ->orWhereNull('recu')
//               ->get();

// // Loop through each record
// foreach ($records as $record) {
//     // Generate two unique barcodes
//     $barcode1 = DNS1D::getBarcode($record->id, "C39");
//     $barcode2 = DNS1D::getBarcode($record->id+1, "C39");

//     // Insert record into the 'immo' table
//     DB::table('immo')->insert([
//         'code_barre' => $barcode1,
//         'id_details_reception' => $record->id,

//     ]);

//     // Insert another record with the second barcode if received > 1
//     if ($record->recu > 1) {
//         DB::table('immo')->insert([
//             'code_barre' => $barcode2,
//             'id_details_reception' => $record->id,
//         ]);
//     }
// }
/**Essai 4 */
    /** nnamoaka barcode fotsiny  */
//     $barcode = new DNS1D();
//     $barcode->setStorPath(storage_path('app/barcodes/'));
//     $code = str_pad($id, 10, '0', STR_PAD_LEFT); // pad the id with zeros to 10 digits
//     return $barcode->getBarcodeHTML($code, 'C39', 1, 40);
// $ids = DB::table('details_reception')->pluck('id');
// foreach ($ids as $id) {
//     $details = DB::table('details_reception')->where('id', $id)->first();
//     if ($details->recu > 1) {
//         $barcodes = [
//             generateBarcode($id),
//             generateBarcode($id),
//         ];
//     } else {
//         $barcodes = [
//             generateBarcode($id),
//         ];
//     }
//     foreach ($barcodes as $barcode) {
//         DB::table('immo')->insert([
//             'code_barre' => $barcode,
//             'id_details_reception' => $details->id,
//         ]);
//     }
// }
/**Essai 5 */
/** error ErrorException
Trying to access array offset on value of type int */
// $details = DB::table('details_reception')
//             ->where('recu', '>', 1)
//             ->get();
//             foreach ($details as $detail) {
//     // Generate a unique barcode
//     $barcode = DNS1D::getBarcodeHTML($detail->id, "C128", 1, 50);

//     // Insert a new record in the 'immo' table
//     DB::table('immo')->insert([
//         'code_barre' => $barcode,
//         'id_details_reception' => $detail->id,

//     ]);

//     // If the 'received' value is greater than 1, generate another barcode
//     if ($detail->received > 1) {
//         $barcode2 = DNS1D::getBarcodeHTML($detail->id, "C128", 1, 50);

//         DB::table('immo')->insert([
//             'code_barre' => $barcode2,
//             'id_details_reception' => $detail->id,

//         ]);
//     }
// }
// $details2 = DB::table('details_invoice')
//             ->where('received', '=', 1)
//             ->get();

// foreach ($details2 as $detail) {
//     // Generate a unique barcode
//     $barcode = DNS1D::getBarcodeHTML($detail->id, "C128", 1, 50);

//     // Insert a new record in the 'immo' table
//     DB::table('immo')->insert([
//         'code_barre' => $barcode,
//         'id_details_reception' => $detail->id,
//         'location_id' => $detail->location_id
//     ]);
// }
