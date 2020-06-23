<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create([
            'name' => 'super_admin',
            'display_name' => 'super admin',
            'description' => 'can do anything in the project!'
        ]);

        $user = Role::create([
            'name' => 'user',
            'display_name' => 'user',
            'description' => 'can do specific tasks!'
        ]);
    }
}
