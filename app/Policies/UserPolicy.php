<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function update(User $currentUser,User $user){
      //if(!$currentUser->isadmin and !$currentUser->issuper){
      if(!$currentUser->isadmin()){
        return $currentUser->id === $user->id;
      }else{
        return true;
      }

    }

    public function list(User $currentUser,User $user){
      if(!$currentUser->isadmin() and !$currentUser->issuper()){
        return false;
      }else{
        return true;
      }
    }

    public function destroy(User $currentUser,User $user){
      return $currentUser->isadmin() && $currentUser->id !== $user->id;
    }
}
