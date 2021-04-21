<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\grid\ActionColumn;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

?>

<?php ActiveForm::begin(['id' => 'form','action'=>'#','method'=>'post']); ?>

<?= Html::hiddenInput('action', '',['id' => 'action']);?>
<?= Html::hiddenInput('id', '',['id' => 'id']);?>
<?php ActiveForm::end();?>

<div class="form-group">
    <div class="col text-left">       
    </div>
    <div class="col text-right">  
       <?= Html::button('Export Excel',['class' => 'btn btn-success','onclick'=> "submitAction('export','')"]) ?>
    </div>
</div>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [   
               'attribute' => 'action'                
            ],
            
            [
               'attribute' => 'controller',
               'format' => 'raw',
               'value' => function ($model) {
                            if(!empty($model->controller)){
                                return $model->controller;
                            }else{
                                return '';
                            }
                        },
            ],
            
            [
               'attribute' => 'ip',
               'format' => 'raw',
               'value' => function ($model) {
                            if(!empty($model->ip)){
                                return $model->ip;
                            }else{
                                return '';
                            }
                        }, 
            ],
            
            [
               'attribute' => 'username'                
            ],
            [
               'attribute' => 'remark'                
            ], 
        ]
    ]) ?>
</div>

<script>
    
function submitAction(action,id){    
    $("#action").val(action);
    $("#id").val(id);    
    $("#form").submit();
   
}

</script>
