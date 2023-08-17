<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article_model extends Model
{
    protected $table = 'article';
public $timestamps = false;

    protected $fillable = [
        'nom', 'designation', 'designation_courte', 'id_categorie','id_sous_categorie', 'id_departement','id_service','id_methode_amortissement','duree_annee',
        'id_modele','id_marque','id_couleur','id_taille'
    ];
}
