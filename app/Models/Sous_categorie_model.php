<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Sous_categorie_model extends Model
{
    protected $table = 'sous_categorie';
    public function get_sous_categorie()
    {
    return $this->pluck('sous_categorie', 'id')->all();
    }
}
