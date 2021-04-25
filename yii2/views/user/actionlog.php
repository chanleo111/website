<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->title = 'Action Log';
?>

<?php ActiveForm::begin(['id' => 'form','action'=>'#','method'=>'post']); ?>

<?= Html::hiddenInput('action', '',['id' => 'action']);?>
<?= Html::hiddenInput('id', '',['id' => 'id']);?>

<div class="form-group">
    <div class="col-md-4">
        <?= Html::label('Date From:'); ?>
        <?= DateTimePicker::widget([
            'name'  => 'date_from',
            'value' => $date_from,            
            'removeButton' => false,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'y-MM-dd h:i',
                'todayHighlight' => true,
                'todayBtn' => true,
            ]   
        ]);?>
    </div>    
    <div class="col-md-4">
        <?= Html::label('Date To:'); ?>
        <?= DateTimePicker::widget([
            'name' => 'date_to',
            'value' => $date_to,
            'removeButton' => false,
            'convertFormat' => true,
            'pluginOptions' => [
                'format' => 'y-MM-dd H:i',
                'todayHighlight' => true,
                'todayBtn' => true,
            ]
        ]);?>
    </div>
    <br>
    <div class="col-md-4">
        <?= Html::button('Export Excel',['class' => 'btn btn-success','onclick'=> "submitAction('export','')"]) ?>
    </div>
<?php ActiveForm::end();?>
</div>
<br>
<br>
<br>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
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
               'attribute' => 'log_time'
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
