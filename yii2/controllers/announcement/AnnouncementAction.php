<?php
namespace app\controllers\announcement;
use Yii;
use yii\base\Action;
use yii\filters\AccessControl;
use app\models\announcement\AnnouncementSearch;

class AnnouncementAction extends Action {
    private $listViewFile = 'list';
    private $editViewFile = 'edit';
    
    public function run(){        
        if(filter_has_var(INPUT_POST,'action')){
            $action = filter_input(INPUT_POST,'action',FILTER_SANITIZE_STRING);
        }else{
            $action = filter_input(INPUT_GET,'action',FILTER_SANITIZE_STRING);
        }
        
        
        $searchModel = new AnnouncementSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        return $this->controller->render($this->listViewFile, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
}
