<?php

namespace app\controllers;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class AnnouncementController extends Controller{

    public function actions(){
        return array(
            'announcement' => \app\controllers\announcement\AnnouncementAction::class,
        );
    }
}