<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->haveFixtures(['users' => app\tests\acceptance\fixtures\UserFixture::class]);

$I->wantTo('ensure that signup works');
$I->amOnPage(url(['/']));
$I->dontSee('Sign up', '.navbar');

$I->seePageNotFound(['/auth/signup/index']);
$I->loginAsAdmin();

$I->seeCurrentUrlEquals('/index-test.php');
$I->click('Signup', '.navbar');
$I->see('Sign up', 'h2');

$I->click('button[type=submit]');
$I->wait(1);
$I->seeElement('.is-invalid');

$I->fillField('#signupform-username', 'newuser');
$I->fillField('#signupform-email', 'newuser@example.com');
$I->fillField('#signupform-password', 'newusernewuser');
$I->click('button[type=submit]');
$I->wait(1);
$I->see('Signed up successfully.');
$I->seeCurrentUrlEquals('/index-test.php');
