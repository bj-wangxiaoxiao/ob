<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "ob_admin_role_auth".
 *
 * @property int $role_id 角色id
 * @property int $auth_id 权限id
 */
class AdminRoleAuth extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_admin_role_auth';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role_id', 'auth_id'], 'required'],
            [['role_id', 'auth_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'role_id' => 'Role ID',
            'auth_id' => 'Auth ID',
        ];
    }
}
