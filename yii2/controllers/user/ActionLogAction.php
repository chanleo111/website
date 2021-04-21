<?php

namespace app\controllers\user;

use Yii;
use yii\base\Action;
use app\models\ActionLog;
use app\models\ActionLogSearch;


class ActionLogAction extends Action {
    private $listViewFile = 'actionlog';
    
    public function run(){
        if(filter_has_var(INPUT_POST,'action')){
            $action = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
        }else{
            $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
        }
        
        $url = Yii::$app->request->url;
        
        if($action == 'delete'){
            $this->delete($url);
        }else if($action == 'edit'){
            $this->edit();
        }

        $searchModel = new ActionLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->controller->render($this->listViewFile, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function delete($listView){        
        if(filter_has_var(INPUT_POST, 'id')){
            $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
        }else{
            $id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
        }
        
        $model = ActionLog::findOne(['id' => $id]);
        
        if($model != null){
           $model->deleted = 1;
           $model->save(false);
           Actionlog::saveActionLog(Yii::$app->controller->action->id,Yii::$app->controller->id,
                              Yii::$app->request->getUserIP(),'Delete User',
                              Yii::$app->user->identity->username,date('Y-m-d H:i:s'));
           Yii::$app->getSession()->setFlash('success','Delete User Success');
        }

        return $this->controller->redirect($this->listViewFile);
    }
}

