<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_menu".
 *
 * @property int $menu_id 唯一键
 * @property string $name 菜单名称
 * @property string $url 美化菜单url
 * @property int $sort 排序
 * @property int $pid 父id
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'create_time', 'update_time'], 'required'],
            [['sort', 'pid', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['name', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'menu_id' => 'Menu ID',
            'name' => 'Name',
            'url' => 'Url',
            'sort' => 'Sort',
            'pid' => 'Pid',
            'is_deleted' => 'Is Deleted',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
