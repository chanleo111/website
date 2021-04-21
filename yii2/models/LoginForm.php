<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\BackEndUser;


class LoginForm extends Model
{
    public $username;    
    public $password;
    public $rememberMe = true;
    private $_user = false;
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],           
        ];
    }
    
    
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();            
            if (!$user || !BackEndUser::validatePassword(md5($this->password))) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }else{
            return true;
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $identity = BackEndUser::findOne(['username' => $this->username]);
            return Yii::$app->user->login($identity);
        }
        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {        
        if ($this->_user === false) {
            $this->_user = BackEndUser::findByUsername($this->username);
        }

        return $this->_user;
    }
}

