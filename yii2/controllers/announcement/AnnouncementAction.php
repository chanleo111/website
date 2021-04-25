<?php
namespace app\controllers\announcement;

use Yii;
use yii\base\Action;
use app\models\Actionlog;
use app\models\announcement\Announcement;
use app\models\announcement\AnnouncementSearch;
use app\common\ExcelReport;

class AnnouncementAction extends Action {
    private $listViewFile = 'list';   
    
    public function run(){
        if(filter_has_var(INPUT_POST,'action')){
            $action = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
        }else{
            $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
        }
        
        if($action == 'delete'){
            $this->delete($url);
        }else if($action == 'edit'){
            $this->edit();
        }
        
        $date_from = filter_input(INPUT_POST,'date_from',FILTER_SANITIZE_STRING);
        $date_to = filter_input(INPUT_POST,'date_to',FILTER_SANITIZE_STRING);
        
        if(empty($date_from)){
            $date_from =  date('Y-m-d H:i') ;        
            $date_to = date('Y-m-d H:i', strtotime($date_from. ' + 1 year'));
        }
        
        if($action == 'export'){
            $announcements = Announcement::find()
                      ->where(['>=','start_date',$date_from])
                      ->andwhere(['<=','end_date',$date_to])
                      ->all();
            ExcelReport::exportAnnouncement($announcements,$date_from,$date_to);
            exit();
        }

        $searchModel = new AnnouncementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->controller->render($this->listViewFile, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'date_from' => $date_from,
            'date_to'  => $date_to
        ]);
    }
    
    public function delete(){        
        if(filter_has_var(INPUT_POST, 'id')){
            $id = filter_input(INPUT_POST, 'id',FILTER_VALIDATE_INT);
        }else{
            $id = filter_input(INPUT_GET, 'id',FILTER_VALIDATE_INT);
        }
        
        $model = Announcement::findAll(['id' => $id,'deleted' =>0]);
        
        if($model != null){
           $model->deleted = 1;
           $model->save(false);
           Actionlog::saveActionLog(Yii::$app->controller->action->id,Yii::$app->controller->id,
                              Yii::$app->request->getUserIP(),'Delete Announcement',
                              Yii::$app->user->identity->username,date('Y-m-d H:i:s'));
           Yii::$app->getSession()->setFlash('success','Delete Announcement Success');
        }

        return $this->controller->redirect($this->listViewFile);
    }

}
