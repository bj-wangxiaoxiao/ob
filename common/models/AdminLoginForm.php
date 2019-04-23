<?php
/**
 * User: wangxiaoxiao
 * Description: 后台表单验证
 */
namespace common\models;

use Yii;
use yii\base\Model;

/**
 * Admin Login form
 */
class AdminLoginForm extends Model
{
    public $name;
    public $password;
    public $rememberMe = true;

    private $_adminuser;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['name', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $adminuser = $this->getUser();
            if (!$adminuser || !$adminuser->ValidatePassword($this->password)) {
                $this->addError($attribute, '请输入正确用户名和密码');
            }
        }
    }


    public function attributeLabels()
    {
        return [
            'name'  =>  '用户名',
            'password'  =>  '密码',
            'rememberMe'  =>  '记住密码'
        ];
    }


    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Finds user by [[name]]
     *
     * @return AdminUser|null
     */
    protected function getUser()
    {
        if ($this->_adminuser === null) {
            $this->_adminuser = AdminUser::findByName($this->name);
        }
        return $this->_adminuser;
    }
}
