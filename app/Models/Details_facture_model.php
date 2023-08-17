<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Details_facture_model extends Model{

    protected $table = 'details_facture';

    protected $fillable = ['id_article','description','tva','commanded','quantite','prix_unitaire'];
    public $timestamps =false;
}
