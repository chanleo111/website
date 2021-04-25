<?php

namespace app\models;
use yii\db\ActiveRecord;
use app\models\Role;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $deleted 
 * @property int $tel
*/

class BackEndUser extends ActiveRecord implements \yii\web\IdentityInterface
{
    const SUPERADMIN = '1';
    const ADMIN = '2';
    public static function tableName()

    {
        return 'user';
    }
    
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['id','tel','deleted'], 'integer'], 
            [['email'], 'string', 'max' => 50],
        ];
    }
    

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {        
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public static function findByUsername($username)
    {            
        $user = self::findAll(['username' => $username ,'deleted' => 0]); 
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        $user = self::findOne(['password' => $password, 'deleted' => 0]);
        
        if(!empty($user)){
            return $user->password === $password;
        }else{
            return false;
        }
    }
    
    public function getRoles(){
        return $this->hasOne(Role::className(), ['id' => 'roleid']);
    }
    
    public function getRole(){
        switch($this->roleid){
            case "1" :return "Super Admin"; break;
            case "2" :return "Admin"; break;
            case "3" :return "User"; break;
            default: return "";
        }
    }
}