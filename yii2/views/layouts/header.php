<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
            ['label' => '<i class="glyphicon glyphicon-home"></i>&nbsp;Home', 'url' => ['/site/index']],
            ['label' => '<i class="glyphicon glyphicon-info-sign"></i>&nbsp;About', 'url' => ['/site/about']],
            ['label' => '<i class=""></i>Contact', 'url' => ['/site/contact']],
            ['label' => '<i class="glyphicon glyphicon-user"></i>User Management', 'url' => ['/user/usermanagement']],
            ['label' => '<i class=""></i>Announcement', 'url' => ['/announcement/announcement']],
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