<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fournisseur_model extends Model{

    protected $table = 'fournisseur';
public $timestamps =false;
    protected $fillable = ['nom_fournisseur','siege_social','telephone','email'];
}
