<?php


namespace app\modules\admin\models;


use app\models\User;
use Yii;
use yii\base\Model;

class BannedForm extends Model
{
    public $username;
    public $banned;

    private $_user = false;

    public function rules()
    {
        return [
            [['username', 'banned'], 'required'],
            ['banned', 'boolean'],
            ['username', 'validateUser'],
        ];
    }

    public function validateUser($attribute)
    {
        if($this->getUser() == null) {
            $this->addError($attribute, 'User is not exist');
        }
    }

    public function banned()
    {
        if($this->validate()) {
            $currentW = User::findByUsername($this->username);
            $currentW->banned = $this->banned;
            $currentW->update();

            if($this -> banned) {
                $manager = Yii::$app->authManager;
                $item = array_values($manager->getRolesByUser($this->getUser()->id))[0];
                $manager->revoke($item, $this->getUser()->id);

                $authorRole = $manager->getRole('blocked');
                $manager->assign($authorRole, $this->getUser()->id);
            }
            else{
                $manager = Yii::$app->authManager;
                $item = array_values($manager->getRolesByUser($this->getUser()->id))[0];
                $manager->revoke($item, $this->getUser()->id);

                $authorRole = $manager->getRole('editor');
                $manager->assign($authorRole, $this->getUser()->id);
            }
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