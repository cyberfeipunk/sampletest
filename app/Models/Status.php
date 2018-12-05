<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
class Status extends Authenticatable
{
    //
    protected $table = 'statuses';
    protected $fillable = ['content'];

    public function user(){
      return $this->belongsTo(User::class);
    }




}
