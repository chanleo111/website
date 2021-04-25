<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

$this->title = 'User management';
?>

<?php ActiveForm::begin(['id' => 'form','action'=>'#','method'=>'post']); ?>

<?= Html::hiddenInput('action', '',['id' => 'action']);?>
<?= Html::hiddenInput('id', '',['id' => 'id']);?>
<?php ActiveForm::end();?>



<div class="form-group">    
    <?= Html::button('Add User',['class' => 'btn btn-success','onclick'=> "submitAction('edit','')"]) ?>        

</div>
<br>
<br>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [
            [   
               'attribute' => 'username'                
            ],
            
            [
               'attribute' => 'tel',
               'format' => 'raw',
               'value' => function ($model) {
                            if(!empty($model->tel)){
                                return $model->tel;
                            }else{
                                return '';
                            }
                        },
            ],
            
            [
               'attribute' => 'email',
               'format' => 'raw',
               'value' => function ($model) {
                            if(!empty($model->email)){
                                return $model->email;
                            }else{
                                return '';
                            }
                        }, 
            ],
            
            [
               'attribute' => 'roleid',
               'value' => function ($model){
                            return $model->getRole();
                        },
            ],
            
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Action',
                'headerOptions' => ['style' => 'color:#337ab7'],
                'template' => '{edit}{delete}',
                'buttons' => [
                    'edit' => function ($url, $model) {
                                return Html::a('<span class="glyphicon glyphicon-pencil"></span>', '#', [                                
                            ]);
                    },
                    'delete'=> function($url,$model){
                                return Html::a('<span class="glyphicon glyphicon-trash"></span>', '#', [
                                      'onclick'=>"submitAction('delete','$model->id','$model->username')",
                                ]);
                    }
                ]
            ]
        ]
    ]) ?>
</div>

<script>
    
function submitAction(action,id,username){
    //console.log('action:'+action);
    //console.log('id:'+id);
    $("#action").val(action);
    $("#id").val(id);
    
    if(action == 'delete'){
       window.confirm("Are you delete user" + " username: ("+username +")");
       $("#form").submit();
    }else{
       $("#form").submit();
    }
}

</script>
