<?php
use yii\grid\GridView;
?>



<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [       
        'annoid',
        'language',
        
    ],
]) ?>