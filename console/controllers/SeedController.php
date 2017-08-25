<?php

// commands/SeedController.php

namespace console\controllers;

use yii;
use yii\console\Controller;
use common\models\User;

class SeedController extends Controller {

    public function actionUser() {
        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            $user = new User();
            $user->username = $faker->username;
            $user->email = $faker->email;
            $user->password_hash = Yii::$app->security->generatePasswordHash('admin');
            $user->auth_key = Yii::$app->security->generateRandomString();
            $user->save();
            echo 'username : ' . $user->username . "\n";
            echo 'password : ' . $user->password_hash . "\n";
            echo 'key : ' . $user->auth_key . "\n";
            echo 'done insert user number ' . $i . ' : ' . $user->username . "\n\n";
        }
        echo 'done insert all';
    }

    public function actionTruncateUser() {
        User::deleteAll();
        echo 'done truncate user table';
    }

}
