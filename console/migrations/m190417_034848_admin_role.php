<?php

use yii\db\Migration;

/**
 * Class m190417_034848_admin_role
 */
class m190417_034848_admin_role extends Migration
{
	public $tableName = '{{%admin_role}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="角色表" ';
		}
		
		$this->createTable($this->tableName, [
			'role_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'name'=>$this->string(255)->notNull()->comment('权限名称'),
			'desc'=>$this->string(255)->defaultValue('')->comment('角色简介'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_name',$this->tableName,'name');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190417_034848_admin_role cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_034848_admin_role cannot be reverted.\n";

        return false;
    }
    */
}
