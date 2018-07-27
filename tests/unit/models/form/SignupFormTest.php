<?php

/*
 * This file is part of the plusarchive.com
 *
 * (c) Tomoki Morita <tmsongbooks215@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace app\tests\unit\models\form;

use app\models\form\SignupForm;
use app\models\User;
use app\tests\unit\fixtures\UserFixture;
use Codeception\Test\Unit;

class SignupFormTest extends Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function setUp(): void
    {
        parent::setUp();

        $this->tester->haveFixtures([
            'user' => UserFixture::class,
        ]);
    }

    public function testSignupFailure(): void
    {
        $model = new SignupForm();
        $this->assertNull($model->signup());
        $this->assertNotEmpty($model->errors);
    }

    public function testSignupSuccess(): void
    {
        $model = new SignupForm([
            'username' => 'newuser',
            'email' => 'newuser@example.com',
            'password' => 'newusernewuser',
        ]);

        $this->assertInstanceOf(User::class, $model->signup());
        $this->assertEmpty($model->errors);
    }
}
