<?php

use yii\db\Migration;

/**
 * Class m190612_063422_wx_user
 */
class m190612_063422_wx_user extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%wx_user}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="微信的用户信息表" ';
		}
		
		$this->createTable($this->tableName, [
			'wx_user_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'name'=>$this->string(255)->defaultValue('')->comment('微信用户的真实姓名'),
			'open_id'=>$this->string(255)->notNull()->comment('用户的openid'),
			'remind'=>$this->integer(1)->defaultValue(0)->comment('是否定时提醒喝水：0、否；1、是'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_open_id',$this->tableName,'open_id');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190612_063422_wx_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_063422_wx_user cannot be reverted.\n";

        return false;
    }
    */
}
