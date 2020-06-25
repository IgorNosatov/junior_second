<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //reset roles table 
        //DB::table("roles")->truncate();
        DB::table('roles')->delete();
        //create admin role
        $admin = new Role;
        $admin->name = "admin";
        $admin->display_name = "Admin";
        $admin->description = "Admin";
        $admin->save();

         //create editor role
         $guest = new Role;
         $guest->name = "guest";
         $guest->display_name = "Guest";
         $guest->description = "Guest";
         $guest->save();


          //attach roles to users

          //first user as admin
         $user1 = User::find('1');   //get user where id is 1
         $user1->detachRole($admin); //detach role so that we wont get duplicate entry error if we run seeder again
         $user1->attachRole($admin); //attaching role here

    }
}
