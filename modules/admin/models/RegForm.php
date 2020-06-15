<?php

namespace app\modules\admin\models;

use app\models\User;
use Yii;
use yii\base\Model;

class RegForm extends Model
{
    public $username;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            ['username', 'validateUser'],
        ];
    }

    /**
     * @param $attribute
     */
    public function validateUser($attribute)
    {
        if($this->getUser() != null) {
            $this->addError($attribute, 'User is already exist');
        }
    }

    public function add()
    {
        if($this->validate()) {
            $currentW = new User();
            $currentW->id = null;
            $currentW->login = $this->username;
            $currentW->password = $this->password;
            $currentW->save(false);
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
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}