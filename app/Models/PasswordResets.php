<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class PasswordResets extends Model{
  protected $table="password_resets";

  protected $fillable=[
    'email','token','created_at'
  ];

  //public $timestamps = false;

  protected $created_at = true;
  protected $updated_at = false;



  public static function createtoken(){
    return str_random(30);
  }


}
