<?php

class RegisterCest
{
    public function register(AcceptanceTester $I)
    {
        $I->amOnPage('/register');
        $I->fillField('name', 'John Doe');
        $I->fillField('email', 'example@example.com');
        $I->fillField('password', 'password');
        $I->fillField('password_confirmation', 'password');
        $I->click('button[type=submit]');
        $I->amOnPage('/email/verify');
    }
}
