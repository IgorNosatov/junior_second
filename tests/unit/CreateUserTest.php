<?php 
use Carbon\Carbon;
use Faker\Factory;
use UnitTester;
use Illuminate\Support\Str;

class CreateUserTest extends \Codeception\Test\Unit
{
    public function registerUser(UnitTester $I)
    {
        $faker = Factory::create('App\User');
        $name = $faker->name();
        $email = $faker->unique()->safeEmail;
        $email_verified_at = now();
        $provider = rand(5,20);
        $provider_id =  rand(5,20);
        $password =  '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi';
        $remember_token =  Str::random(10);
        $created_at = Carbon::now();
        $updated_at = Carbon::now();

        $I->haveRecord(
            'App\User',
            [
                'name' => $name,
                'email' => $email,
                'email_verified_at' => $email_verified_at,
                'provider' => $provider,
                'provider_id' => $provider_id,
                'password' => $password,
                'remember_token' => $remember_token,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]
        );

        $I->seeRecord(
            'users',
            [
                'name' => $name,
                'email' => $email,
                'email_verified_at' => $email_verified_at,
                'provider' => $provider,
                'provider_id' => $provider_id,
                'password' => $password,
                'remember_token' => $remember_token,
                'created_at' => $created_at,
                'updated_at' => $updated_at
            ]
        );

    }
}

