<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "ob_admin_user".
 *
 * @property int $admin_user_id 唯一键
 * @property string $name 姓名
 * @property string $phone 手机号码
 * @property string $nickname 别名
 * @property string $avatar 头像
 * @property string $email 邮箱
 * @property string $password 密码
 * @property string $pwd_salt 密码盐，每个用户都不一样
 * @property string $introduction 自我介绍
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property string $last_login_ip 最近一次登录ip
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property string password_hash
 */
class AdminUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_admin_user';
    }


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
            [['name', 'email', 'password'], 'required'],
//            ['email', 'email'],
            [['avatar'], 'string'],
            [['is_deleted'], 'integer'],
            [['name', 'phone', 'nickname', 'email', 'password', 'introduction'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'admin_user_id' => 'ID',
            'name' => '姓名',
            'phone' => '电话',
            'nickname' => '昵称',
            'avatar' => '头像',
            'email' => '邮箱',
            'password' => '密码',
            'pwd_salt' => '密码盐',
            'introduction' => '简介',
            'is_deleted' => '是否删除',
            'last_login_ip' => '最后一次登陆ip',
            'create_time' => '创建时间',
            'update_time' => '更新时间',
        ];
    }


    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        return md5(Yii::$app->security->generatePasswordHash($password));
    }

}
