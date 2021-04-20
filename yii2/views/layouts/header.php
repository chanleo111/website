<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\models\BackEndUser;
?>

<?php
    NavBar::begin([
        'brandLabel' => "Web Portal",
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-right',
        ],
    ]);

    echo Nav::widget([        
        'encodeLabels' => false,// icon request
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
              'label' => '<i class="glyphicon glyphicon-home"></i>&nbsp;Home', 'url' => ['/site/index']
            ],
            [
              'label' => '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;About', 'url' => ['/site/about'],
             'visible' => Yii::$app->user->isGuest,
            ],
            [
                'label' => 'System',
                'visible' => !Yii::$app->user->isGuest,
                'items' => [
                    [
                        'label' => '<i class="glyphicon glyphicon-user"></i>User Management', 'url' => ['/user/usermanagement'],
                        'visible' => !Yii::$app->user->isGuest,
                    ],
                    [
                        'label' => '<i class="glyphicon glyphicon-user"></i>Profile', 'url' => ['/user/profile'],
                        'visible' => !Yii::$app->user->isGuest,
                    ],
                ],
            ],
          
            [
              'label' => '<i class=""></i>Contact', 'url' => ['/site/contact'],
              'visible' => Yii::$app->user->isGuest,
            ],
           
            [
              'label' => '<i class=""></i>Announcement menagement', 'url' => ['/announcement/announcement'],
              'visible' => !Yii::$app->user->isGuest && Yii::$app->user->identity->roleid == BackEndUser::ADMIN, 
            ],
            
            Yii::$app->user->isGuest ? (
                ['label' => '<i class="glyphicon glyphicon-lock"></i>&nbsp;Login', 'url' => ['/site/login']]
            ) : (
                '<li>'
                . Html::beginForm(['/site/logout'], 'post')
                . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->username . ')',
                    ['class' => 'btn btn-link logout']
                )
                . Html::endForm()
                . '</li>'
            )
        ],
    ]);
    NavBar::end();
?>