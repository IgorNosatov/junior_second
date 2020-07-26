<?php 

use App\User;
use ApiTester;
use Faker\Factory;

class UserRegisterCest
{
    public function register(ApiTester $I)
    {

        $faker = Factory::create();
        $user=[
            User::NAME => $faker->name,
            User::EMAIL => $faker->email,
            User::PASSWORD => $faker->password
        ];

        $I->sendPOST('user',$user);
        $response=$I->grabResponse();
        $I->seeResponseCodeIs(200);
        $I->seeRecord(User::TABLE_NAME, $user);
        $I->assertEquals('Success' , $response);
    }
}
