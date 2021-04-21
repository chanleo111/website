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
    <div class="col-md-8">
        <?= Html::button('Add Announcement',['class' => 'btn btn-success','onclick'=> "submitAction('edit','')"]) ?>        
    </div>
    
    <div class="col-md-4">
        <?= Html::button('Import Excel',['class' => 'btn btn-success','onclick'=> "submitAction('import','')"]) ?>
        <?= Html::button('Export Excel',['class' => 'btn btn-success','onclick'=> "submitAction('export','')"]) ?>        
    </div>
</div>
<br>
<br>

<div class="table-responsive">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
