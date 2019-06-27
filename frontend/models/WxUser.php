<?php

namespace frontend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ob_wx_user".
 *
 * @property int $wx_user_id 唯一键
 * @property string $name 微信用户的真实姓名
 * @property string $open_id 用户的openid
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $remind 是否删除：0、否；1、是，默认为0
 */
class WxUser extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_wx_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['open_id'], 'required'],
            [['open_id'], 'unique'],
            [['create_time', 'update_time', 'is_deleted','remind'], 'integer'],
            [['name', 'open_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'wx_user_id' => 'Wx User ID',
            'name' => 'Name',
            'open_id' => 'Open ID',
	        'remind' => Yii::t('app', 'Remind'),
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'is_deleted' => 'Is Deleted',
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
