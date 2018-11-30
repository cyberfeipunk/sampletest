<?php

use Illuminate\Database\Seeder;
use App\models\User;
class createActivationTokenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // User::where([])->update(
        //   ['activation_token'=>str_random(20)]
        // );
        // $users = User::all();
        // foreach($users as $user){
        //   $user->update(['activation_token'=>str_random(20),'activated'=>true]);
        // }
        $user = User::where(['email'=>'dingfei@jovision.com'])->first();
        $user->update(['activated'=>false]);
    }
}
