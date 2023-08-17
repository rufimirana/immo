<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Devise_model extends Model{

    protected $table = 'devise';
public $timestamps =false;
    protected $fillable = ['devise','description_devise'];
}
