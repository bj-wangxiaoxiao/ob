<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_rotation_chart".
 *
 * @property int $chart_id 唯一键
 * @property string $name 图片名称
 * @property int $pic_id 图片id
 * @property string $pic_url 图片对应的地址，冗余字段，为了不去连表查询图片
 * @property string $url 图片对应的跳转链接，目标链接
 * @property int $sort 排序
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class RotationChart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_rotation_chart';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'pic_id', 'pic_url', 'create_time', 'update_time'], 'required'],
            [['pic_id', 'sort', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['name', 'pic_url', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'chart_id' => 'Chart ID',
            'name' => 'Name',
            'pic_id' => 'Pic ID',
            'pic_url' => 'Pic Url',
            'url' => 'Url',
            'sort' => 'Sort',
            'is_deleted' => 'Is Deleted',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
