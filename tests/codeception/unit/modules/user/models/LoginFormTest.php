<?php

namespace tests\codeception\unit\modules\user\models;

use tests\codeception\fixtures\UserFixture;
use tests\codeception\unit\DbTestCase;
use Yii;
use app\modules\user\models\LoginForm;
use Codeception\Specify;

class LoginFormTest extends DbTestCase
{
    use Specify;
    
    protected function tearDown()
    {
        Yii::$app->user->logout();
        parent::tearDown();
    }
    
    public function testLoginNoUser()
    {
        $model = new LoginForm([
            'username' => 'not_existing_username',
            'password' => 'not_existing_password',
        ]);
        expect('model should not login user', $model->login())->false();
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }
    
    public function testLoginWrongPassword()
    {
        $model = new LoginForm([
            'username' => 'admin',
            'password' => 'wrong_password',
        ]);
        expect('model should not login user', $model->login())->false();
        expect('error message should be set', $model->errors)->hasKey('password');
        expect('user should not be logged in', Yii::$app->user->isGuest)->true();
    }
    
    public function testLoginCorrect()
    {
        $model = new LoginForm([
            'username' => 'admin',
            'password' => '123456',
        ]);
        expect('model should login user' . ($model->login() ? 'OK' : 'NO'), $model->login())->true();
        //expect('error message should not be set', $model->errors)->hasntKey('password');
        //expect('user should be logged in', Yii::$app->user->isGuest)->false();
    }
    
    public function fixtures()
    {
        return [
            'users' => [
                'class' => UserFixture::className(),
            ],
        ];
    }
}