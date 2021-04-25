<?php
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

$this->title = 'Announcement management';
?>

<?php ActiveForm::begin(['id' => 'form','action'=>'#','method'=>'post']); ?>

<?= Html::hiddenInput('action', '',['id' => 'action']);?>
<?= Html::hiddenInput('id', '',['id' => 'id']);?>

<?= Html::button('Add Announcement',['class' => 'btn btn-success','onclick'=> "submitAction('edit','')"]) ?>
<br><br>
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
        <?= Html::button('Import Excel',['class' => 'btn btn-success','onclick'=> "submitAction('import','')"]) ?>
        <?= Html::button('Export Excel',['class' => 'btn btn-success','onclick'=> "submitAction('export','')"]) ?>
    </div>
<?php ActiveForm::end();?>
</div>

<br><br>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel'=>$searchModel,
        'columns' => [

            [   
               'attribute' => 'title'                
            ],
            
            [
               'attribute' => 'description'                
            ],
            
            [
               'attribute' => 'enable'                
            ],
            
            [
               'attribute' => 'start_date'                
            ],
            
            [
               'attribute' => 'end_date'                
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
                                      'onclick'=>"submitAction('delete','$model->id','$model->title')",
                                ]);
                    }
                ]
            ]
        ]
    ]) ?>
</div>

<script>
    
function submitAction(action,id,title){
    //console.log('action:'+action);
    //console.log('id:'+id);
    $("#action").val(action);
    $("#id").val(id);
    
    if(action == 'delete'){
       window.confirm("Are you delete announcement" + " title: ("+title +")");
       $("#form").submit();
    }else{
       $("#form").submit();
    }
}

</script>
