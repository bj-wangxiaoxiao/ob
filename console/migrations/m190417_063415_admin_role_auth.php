<?php

use yii\db\Migration;

/**
 * Class m190417_063415_admin_role_auth
 */
class m190417_063415_admin_role_auth extends Migration
{
	public $tableName = '{{%admin_role_auth}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="权限-角色表" ';
		}
		
		$this->createTable($this->tableName, [
			'role_id' => $this->integer(11)->notNull()->comment('角色id'),
			'auth_id' => $this->integer(11)->notNull()->comment('权限id'),
		], $tableOptions);
		$this->createIndex('idx_role_id',$this->tableName,'role_id');
		$this->createIndex('idx_auth_id',$this->tableName,'auth_id');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190417_063415_admin_role_auth cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_063415_admin_role_auth cannot be reverted.\n";

        return false;
    }
    */
}
