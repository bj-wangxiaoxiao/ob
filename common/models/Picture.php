<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_picture".
 *
 * @property int $pic_id 唯一键
 * @property string $name 图片名称：qq截图
 * @property string $extension 图片格式：jpg/png
 * @property string $full_name 图片的全名称：qq截图.jpg
 * @property string $path 图片的全路径，一定要斜线开头：/public/image/qq截图.jpg
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class Picture extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_picture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'extension', 'full_name', 'path', 'create_time', 'update_time'], 'required'],
            [['is_deleted', 'create_time', 'update_time'], 'integer'],
            [['name', 'extension', 'full_name', 'path'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pic_id' => 'Pic ID',
            'name' => 'Name',
            'extension' => 'Extension',
            'full_name' => 'Full Name',
            'path' => 'Path',
            'is_deleted' => 'Is Deleted',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
