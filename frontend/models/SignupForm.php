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


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['name', 'trim'],
            ['name', 'required'],
            ['name', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This name has already been taken.'],
            ['name', 'string', 'min' => 2, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name'  =>  '用户名',
            'password'  =>  '密码',
            'email'  =>  '邮箱'
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
        $user->name = $this->name;
        $user->email = $this->email;
        $user->last_login_ip = $_SERVER["REMOTE_ADDR"];//获取登录ip
        $user->setPassword($this->password);
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
