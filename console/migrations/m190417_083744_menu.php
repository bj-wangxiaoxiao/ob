<?php

use yii\db\Migration;

/**
 * Class m190417_083744_menu
 */
class m190417_083744_menu extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%menu}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="菜单表" ';
		}
		
		$this->createTable($this->tableName, [
			'menu_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'name'=>$this->string(255)->notNull()->comment('菜单名称'),
			'url'=>$this->string(255)->defaultValue('')->comment('美化菜单url'),
			'sort'=>$this->integer(11)->defaultValue(1)->comment('排序'),
			'pid'=>$this->integer(11)->defaultValue(0)->comment('父id'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_sort',$this->tableName,'sort');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190417_083744_menu cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_083744_menu cannot be reverted.\n";

        return false;
    }
    */
}
