<?php
namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $email;
    public $password;
    public $nickname;
    public $phone;
    public $introduction;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            [['name','nickname','introduction'], 'required'],
            ['name', 'unique', 'targetClass' => '\common\models\User', 'message' => '该用户名存在,请重新输入'],
            [['name','nickname'], 'string', 'min' => 2, 'max' => 255],

            [['phone'], 'required'],
            [['phone'], 'integer', 'min' => 11],
            ['phone', 'unique', 'targetClass' => '\common\models\User', 'message' => '该手机号码存在,请重新输入'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => '该邮箱存在,请重新输入'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'          =>  '用户名',
            'password'      =>  '密码',
            'email'         =>  '邮箱',
            'nickname'      =>  '昵称',
            'phone'         =>  '电话',
            'introduction'  =>  '介绍'
        ];
    }


    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->name = $this->name;//用户名
        $user->email = $this->email;//邮箱
        $user->last_login_ip = Yii::$app->getRequest()->getUserIP();//获取登录ip
        $user->nickname = $this->nickname;//昵称
        $user->phone = $this->phone;//电话
        $user->introduction = $this->introduction;//简介
        $user->setPassword($this->password);//密码
        $user->setPasswordSalt();//设置密码盐
        $user->generateAuthKey();
        $user->generatePasswordResetToken();
        $user->generateEmailVerificationToken();
        return $user->save();

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
