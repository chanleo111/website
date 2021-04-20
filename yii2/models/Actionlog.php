<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "actionlog".
 *
 * @property int $id
 * @property string $action
 * @property string $controller
 * @property string $ip
 * @property string $remark
 * @property date $log_time
 */
class Actionlog extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'actionlog';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['action', 'controller', 'ip', 'remark','log_time','username'], 'required'],
            ['id','integer'],
            [['action', 'controller', 'ip', 'remark','log_time','username'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'action' => Yii::t('app', 'Action'),
            'controller' => Yii::t('app', 'Controller'),
            'ip' => Yii::t('app', 'IP'),
            'remark' => Yii::t('app', 'Remark'),
            'log_time' => Yii::t('app', 'Log Time'),
            'username' => Yii::t('app', 'Username'),
        ];
    }
    
    public function saveActionLog($action,$controller,$ip,$remark,$username,$log_time){       
        $actionlog = new Actionlog();
        $actionlog->action = $action;
        $actionlog->controller = $controller;
        $actionlog->ip = $ip;
        $actionlog->remark = $remark;
        $actionlog->username = $username;
        $actionlog->log_time = $log_time;
        $actionlog->save(false);
    }
}
