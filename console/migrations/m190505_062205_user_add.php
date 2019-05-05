<?php

use common\models\AdminUser;
use common\models\User;
use yii\db\Migration;

/**
 * Class m190505_062205_user_add
 */
class m190505_062205_user_add extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
		$this->addColumn(User::tableName(),'auth_key',$this->string(32)->defaultValue('')->comment('认证钥匙'));
		$this->addColumn(User::tableName(),'verification_token',$this->string(255)->defaultValue('')->comment('验证密钥'));
		$this->addColumn(User::tableName(),'password_reset_token',$this->string(255)->defaultValue('')->comment('重置密码token'));
	    $this->addColumn(AdminUser::tableName(),'auth_key',$this->string(32)->defaultValue('')->comment('认证钥匙'));
	    $this->addColumn(AdminUser::tableName(),'verification_token',$this->string(255)->defaultValue('')->comment('验证密钥'));
	    $this->addColumn(AdminUser::tableName(),'password_reset_token',$this->string(255)->defaultValue('')->comment('重置密码token'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190505_062205_user_add cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190505_062205_user_add cannot be reverted.\n";

        return false;
    }
    */
}
