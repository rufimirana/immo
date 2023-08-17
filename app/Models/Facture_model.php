<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture_model extends Model
{
    protected $table='facture';
    protected $fillable = ['date','id_fournisseur','id__consignataire','id_departement','id_devise'];
public $timestamps =false;
}
