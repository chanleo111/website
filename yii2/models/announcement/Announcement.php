<?php
namespace app\models\announcement;

use Yii;

/**
 * This is the model class for table "announcement".
 *
 * @property int $id
 * @property int $annoid
 * @property string $language
 * @property string $voice_file
 */
class Announcement extends \yii\db\ActiveRecord
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
            [['annoid', 'language', 'voice_file'], 'required'],
            [['annoid'], 'integer'],
            [['language', 'voice_file'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'annoid' => Yii::t('app', 'Annoid'),
            'language' => Yii::t('app', 'Language'),
            'voice_file' => Yii::t('app', 'Voice File'),
        ];
    }
}
