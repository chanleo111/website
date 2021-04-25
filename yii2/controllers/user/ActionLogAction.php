<?php

namespace app\controllers\user;

use Yii;
use yii\base\Action;
use app\models\ActionLog;
use app\models\ActionLogSearch;
use app\common\ExcelReport;

class ActionLogAction extends Action {
    private $listViewFile = 'actionlog';
    
    public function run(){
        if(filter_has_var(INPUT_POST,'action')){
            $action = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
        }else{
            $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
        }
        
        $date_from = filter_input(INPUT_POST,'date_from',FILTER_SANITIZE_STRING);
        $date_to = filter_input(INPUT_POST,'date_to',FILTER_SANITIZE_STRING);
        
        if(empty($date_from)){
            $date_from =  date('Y-m-d H:i') ;
        }
        
        if(empty($date_to)){
            $date_to = date('Y-m-d H:i', strtotime($date_from. ' + 1 year'));
        }
       
        if($action == 'export'){
            $actionlogs = ActionLog::find()
                      ->where(['>=','log_time',$date_from])
                      ->andwhere(['<=','log_time',$date_to])
                      ->all();
            ExcelReport::exportActionLog($actionlogs,$date_from,$date_to);
            exit();
        }

        $searchModel = new ActionLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams); 
        
        return $this->controller->render($this->listViewFile, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'date_from' => $date_from,
            'date_to'  => $date_to
        ]);
    }    
}

