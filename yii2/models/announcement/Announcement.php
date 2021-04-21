<?php
namespace app\models\announcement;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "announcement".
 *
 * @property int $id
 * @property string $title
 * @property string description
 * @property date start_date
 * @property date end_date
 * @property int $enable
 
 */
class Announcement extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'announcement';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'enable', 'description'], 'required'],
            [['id'], 'integer'],
            [['start_date','end_date'], 'string'],            
            [['title'], 'string', 'max' => 25],
            [['description'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),            
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'enable' => Yii::t('app', 'Enable'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'), 
        ];
    }
}