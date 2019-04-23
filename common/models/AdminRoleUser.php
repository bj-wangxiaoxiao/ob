<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_admin_role_user".
 *
 * @property int $role_id 角色id
 * @property int $admin_user_id 用户id
 */
class AdminRoleUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_admin_role_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'admin_user_id'], 'required'],
            [['role_id', 'admin_user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'admin_user_id' => 'Admin User ID',
        ];
    }
}
