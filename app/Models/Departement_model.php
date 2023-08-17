<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Departement_model extends Model{

    protected $table = 'departement';
public $timestamps =false;
    protected $fillable = ['departement'];
}
