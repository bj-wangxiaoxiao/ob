<?php
/**
 * User: wangxiaoxiao
 * Description: 目前前台用户模型
 */
namespace common\models;

use common\lib\ObStrHelper;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $name
 * @property string $nickname
 * @property string $phone
 * @property string $password_hash
 * @property string $pwd_salt
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $introduction
 * @property string $auth_key
 * @property integer $is_deleted
 * @property integer $last_login_ip
 * @property integer $create_time
 * @property integer $update_time
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_NO_DELETED = 0;
    const STATUS_YES_DELETED = 1;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['is_deleted', 'default', 'value' => self::STATUS_NO_DELETED],
            ['is_deleted', 'in', 'range' => [self::STATUS_NO_DELETED,self::STATUS_YES_DELETED]],
        ];
    }


    public function attributeLabels()
    {
        return [
            'user_id'       => 'ID',
            'name'          => '用户名',
            'phone'         => '电话',
            'nickname'      => '昵称',
            'avatar'        => '头像',
            'email'         => '邮箱',
            'password'      => '密码',
            'auth_key'      => 'Auth Key',
            'introduction'  => '简介',
            'is_deleted'    => '是否开启',
            'last_login_ip' => '最后登录ip',
            'qq_token'      => 'qq授权',
            'wechat_token'  => '微信授权',
            'create_time'   => '创建时间',
            'update_time'   => '更新时间',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['user_id' => $id,'is_deleted'=>self::STATUS_NO_DELETED]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by name
     *
     * @param string $name
     * @return static|null
     */
    public static function findByName($name)
    {
        return static::findOne(['name' => $name,'is_deleted'=>0]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'is_deleted' => self::STATUS_NO_DELETED,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'is_deleted' => self::STATUS_NO_DELETED
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * User: wangxiaoxiao
     * Description: 生成密码盐
     */
    public function setPasswordSalt()
    {
        //随机生成密码盐12位
        $this->pwd_salt = ObStrHelper::randomkeys(20);
    }
    

    /**
     * User: wangxiaoxiao
     * Description: 用户状态转换(用于下拉框)
     */
    public static function allIsDeleted()
    {
        return [self::STATUS_NO_DELETED=>'开启',self::STATUS_YES_DELETED=>'关闭'];
    }


    /**
     * User: wangxiaoxiao
     * escription: 用户状态 
     */
    public function getIsDeleted()
    {
        return $this->is_deleted == self::STATUS_NO_DELETED?'开启':'关闭';
    }


    /**
     * User: wangxiaoxiao
     * Description: 更新用户状态
     * @param object $userInfo
     */
    public static function userinfoUpdate($userInfo)
    {
        //获取ip
        $ip = Yii::$app->getRequest()->getUserIP();
        $user = static::findOne(['user_id'=>$userInfo->user_id]);
        $user->last_login_ip = $ip;
        $user->save();
    }
}
