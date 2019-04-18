<?php

use yii\db\Migration;

/**
 * Class m190415_090232_admin_auth
 */
class m190415_090232_admin_auth extends Migration
{
	public $tableName = '{{%admin_auth}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="权限表" ';
		}
		
		$this->createTable($this->tableName, [
			'auth_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'name'=>$this->string(255)->notNull()->comment('权限名称'),
			'pid'=>$this->integer(11)->defaultValue(0)->comment('父id'),
			'desc'=>$this->string(255)->defaultValue('')->comment('简介，描述'),
			'is_menu'=>$this->integer(1)->defaultValue(1)->comment('是否是菜单：1、是；2、否'),
			'sort'=>$this->integer(11)->defaultValue(0)->comment('排序'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_name',$this->tableName,'name');
		$this->createIndex('idx_pid',$this->tableName,'pid');
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190415_090232_admin_auth cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190415_090232_admin_auth cannot be reverted.\n";

        return false;
    }
    */
}
