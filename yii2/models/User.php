<?php

namespace app\models;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $deleted 
 * @property int $tel
*/

class User extends ActiveRecord implements \yii\web\IdentityInterface
{   
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
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
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

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {       
        if(!empty($password)){
            $user = self::findOne(['password' => $password , 'deleted' => 0]); 
            return $user->password == $password;
        }else{
            return false;
        }
        
    }    
}
