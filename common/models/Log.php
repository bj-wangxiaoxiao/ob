<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_log".
 *
 * @property int $log_id 唯一键
 * @property int $log_type 日志类型：1、debug;2、warning；3、fatal
 * @property int $user_type 用户类型：1、后台；2、前台
 * @property int $user_id 用户的id
 * @property string $auth_name 当前日志对应的功能名称
 * @property string $post post数据
 * @property string $get get数据
 * @property string $message 日志内容
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['log_type', 'user_type', 'user_id', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['user_type', 'user_id', 'create_time', 'update_time'], 'required'],
            [['post', 'get', 'message'], 'string'],
            [['auth_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'log_id' => 'Log ID',
            'log_type' => 'Log Type',
            'user_type' => 'User Type',
            'user_id' => 'User ID',
            'auth_name' => 'Auth Name',
            'post' => 'Post',
            'get' => 'Get',
            'message' => 'Message',
            'is_deleted' => 'Is Deleted',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
