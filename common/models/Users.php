<?php
/**
 * User: wangxiaoxiao
 * Description: 后期覆盖原user模型,替换为前台用户登录认证
 */
namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_user".
 *
 * @property int $user_id 唯一键
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
 * @property string $qq_token qq登陆的openid
 * @property string $wechat_token 微信登陆的openid
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'password', 'pwd_salt', 'create_time', 'update_time'], 'required'],
            [['avatar'], 'string'],
            [['is_deleted', 'create_time', 'update_time'], 'integer'],
            [['name', 'phone', 'nickname', 'email', 'password', 'pwd_salt', 'introduction', 'last_login_ip', 'qq_token', 'wechat_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'name' => 'Name',
            'phone' => 'Phone',
            'nickname' => 'Nickname',
            'avatar' => 'Avatar',
            'email' => 'Email',
            'password' => 'Password',
            'pwd_salt' => 'Pwd Salt',
            'introduction' => 'Introduction',
            'is_deleted' => 'Is Deleted',
            'last_login_ip' => 'Last Login Ip',
            'qq_token' => 'Qq Token',
            'wechat_token' => 'Wechat Token',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
