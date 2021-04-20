<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class UserController extends Controller{

    public function actions(){
        return array(
            'usermanagement' => \app\controllers\user\UserManagementAction::class,
        );
    }

}
