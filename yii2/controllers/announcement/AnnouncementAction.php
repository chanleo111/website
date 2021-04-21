<?php
namespace app\controllers\announcement;

use Yii;
use yii\base\Action;
use app\models\Actionlog;
use app\models\announcement\Announcement;
use app\models\announcement\AnnouncementSearch;


class AnnouncementAction extends Action {
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

        $searchModel = new AnnouncementSearch();
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
        
        $model = Announcement::findAll(['id' => $id]);
        
        if($model != null){
           Announcement::deleteAll();
           Actionlog::saveActionLog(Yii::$app->controller->action->id,Yii::$app->controller->id,
                              Yii::$app->request->getUserIP(),'Delete Announcement',
                              Yii::$app->user->identity->username,date('Y-m-d H:i:s'));
           Yii::$app->getSession()->setFlash('success','Delete Announcement Success');
        }

        return $this->controller->redirect($listView);
    }

}
