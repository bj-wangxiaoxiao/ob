<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ob_wx_msg_record".
 *
 * @property int $wx_msg_record_id 唯一键
 * @property int $wx_user_id 关联id
 * @property string $content 信息内容
 * @property string $msg_id 用户发送消息的id,在微信里的id
 * @property string $ip 最近一次发送信息的ip
 * @property int $send_time 发送时间
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 */
class WxMsgRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_wx_msg_record';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['wx_user_id', 'send_time'], 'required'],
            [['wx_user_id', 'send_time', 'create_time', 'update_time', 'is_deleted'], 'integer'],
            [['content', 'msg_id', 'ip'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wx_msg_record_id' => Yii::t('app', 'Wx Msg Record ID'),
            'wx_user_id' => Yii::t('app', 'Wx User ID'),
            'content' => Yii::t('app', 'Content'),
            'msg_id' => Yii::t('app', 'Msg ID'),
            'ip' => Yii::t('app', 'Ip'),
            'send_time' => Yii::t('app', 'Send Time'),
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'is_deleted' => Yii::t('app', 'Is Deleted'),
        ];
    }
	
	public function behaviors()
	{
		return array_merge(
			[
				[
					'class' => TimestampBehavior::className(),
					'attributes' => [
						ActiveRecord::EVENT_BEFORE_INSERT => ['create_time', 'update_time'],
						ActiveRecord::EVENT_BEFORE_UPDATE => ['update_time'],
					],
					// if you're using datetime instead of UNIX timestamp:
					// 'value' => new Expression('NOW()'),
				],
			], parent::behaviors());
	}
}
