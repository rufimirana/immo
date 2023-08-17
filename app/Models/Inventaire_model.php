<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventaire_model extends Model{
     protected $table = 'inventaire_immo';
public $timestamps =false;
    protected $fillable = ['id_categorie', 'id_emplacement'];
}
