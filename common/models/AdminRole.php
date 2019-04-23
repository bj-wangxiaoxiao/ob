<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_admin_role".
 *
 * @property int $role_id 唯一键
 * @property string $name 权限名称
 * @property string $desc 角色简介
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class AdminRole extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_admin_role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'create_time', 'update_time'], 'required'],
            [['is_deleted', 'create_time', 'update_time'], 'integer'],
            [['name', 'desc'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'is_deleted' => 'Is Deleted',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
