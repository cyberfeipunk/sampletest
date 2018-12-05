<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','age',' activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot(){
      parent::boot();
      static::creating(function($user){
        $user->activation_token = str_random(30);
      });
    }

    public function statuses(){
      return $this->hasMany(Status::class,'user_id');
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     * 粉丝列表
     */
    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }

    /**
     * @return
     * 已关注列表
     */
    public function followings(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    /**
    * 头像
    */
    public function gravatar($size = '100')
    {
      $hash = md5(strtolower(trim($this->attributes['email'])));
      return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public static function getUserGravatar($user_id,$size='100'){
        $user = User::find($user_id)->firstOrFail();
        $hash = md5(strtolower(trim($user->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function isadmin(){
      if($this->is_admin===1){
        return true;
      }else{
        return false;
      }
    }

    public function issuper(){
      if($this->is_super===1){
        return true;
      }else{
        return false;
      }
    }

    public function sendPasswordResetNotification($token){
      $this->notify(new ResetPassword($token));
    }

    public function isFollowing($user_id){
        return $this->followings->contains($user_id);
    }

    public function follow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids,false);
    }

    public function unfollow($user_ids){
        if(!is_array($user_ids)){
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids,false);
    }


    public function feed()
    {
        return $this->statuses()->orderBy('created_at', 'desc');
    }

}
