<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categorie_model extends Model
{
    protected $table = 'categorie';
    public function get_categorie()
    {
    return $this->pluck('categorie', 'id')->all();
    }
}
