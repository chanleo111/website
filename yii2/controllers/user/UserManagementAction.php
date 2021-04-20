<?php

namespace app\controllers\user;

use Yii;
use yii\base\Action;
use app\models\BackEndUser;
use app\models\BackEndUserSearch;

class UserManagementAction extends Action {
    private $listViewFile = 'list';
    
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

        //$searchModel = new BackEndUserSearch();
        //$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        /*
        return $this->controller->render($this->listViewFile, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
         
         */
    }
}
