<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Login_model extends Model{

    protected $table = 'users';
public $timestamps =false;
    protected $fillable = ['name','email','password'];
   /* public function get_user(){

    }*/

}
