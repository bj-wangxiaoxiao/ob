<?php
/**
 * User: wangxiaoxiao
 * Description: 后台表单验证
 */
namespace backend\models;

use common\models\AdminUser;
use Yii;
use yii\base\Model;

/**
 * Admin Login form
 */
class SignupForm extends Model
{
    public $admin_user_id;
    public $name;
    public $password;
    public $email;
    public $nickname;
    public $phone;
    public $avatar;
    public $introduction;
    public $re_password;
    public $is_deleted;
    public $rememberMe = true;

    private $_adminuser;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            [['name','nickname'], 'required'],
            ['name', 'unique', 'targetClass' => '\common\models\AdminUser', 'message' => '该用户名存在,请重新输入'],
            [['name','nickname'], 'string', 'min' => 2, 'max' => 255],

            [['phone'], 'required'],
            [['phone'], 'integer', 'min' => 11],
            ['phone', 'unique', 'targetClass' => '\common\models\AdminUser', 'message' => '该手机号码存在,请重新输入'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\AdminUser', 'message' => '该邮箱存在,请重新输入'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['re_password', 'compare', 'compareAttribute' => 'password','message'=>'两次密码输入不一致!'],
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
            'name'                  => '用户名',
            'password'              => '密码',
            're_password'           => '重复密码',
            'rememberMe'            => '记住密码',
            'phone'                 => '电话',
            'nickname'              => '昵称',
            'avatar'                => '头像',
            'email'                 => '邮箱',
            'auth_key'              => '认证钥匙',
            'verification_token'    => 'Verification Token',
            'password_reset_token'  => 'Password Reset Token',
            'pwd_salt'              => '密码盐',
            'introduction'          => '简介',
            'is_deleted'            => '是否开启',
            'last_login_ip'         => '最后一次登陆ip',
            'create_time'           => '创建时间',
            'update_time'           => '更新时间',
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
     * User: wangxiaoxiao
     * Description: 管理员注册
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }

        $adminuser = new AdminUser();
        $adminuser->name = $this->name;//用户名
        $adminuser->email = $this->email;//邮箱
        $adminuser->last_login_ip = Yii::$app->id != 'app-console' ? Yii::$app->getRequest()->getUserIP() : '127.0.0.1';//获取登录ip
        $adminuser->nickname = $this->nickname;//昵称
        $adminuser->phone = $this->phone;//电话
        $adminuser->introduction = $this->introduction;//简介
        $adminuser->setPassword($this->password);//密码
        $adminuser->setPasswordSalt();//设置密码盐
        $adminuser->generateAuthKey();
        $adminuser->generatePasswordResetToken();
        $adminuser->generateEmailVerificationToken();
        return $adminuser->save() ? $adminuser : '';

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

    /**
     * User: wangxiaoxiao
     * Description: 用户状态转换(用于下拉框)
     */
    public static function allIsDeleted()
    {
        return AdminUser::allIsDeleted();
    }
}
