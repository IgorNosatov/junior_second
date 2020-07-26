<?php

class LoginCest
{
    public function login(AcceptanceTester $I)
    {
        $I->amOnPage('/login');
        $I->fillField('email', 'example@example.com');
        $I->fillField('password', 'password');
        $I->click('button[type=submit]');
        $I->amOnPage('/');
    }
}
