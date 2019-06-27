<?php

use yii\db\Migration;

/**
 * Class m190612_063441_wx_msg_record
 */
class m190612_063441_wx_msg_record extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%wx_msg_record}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="微信用户发送的信息表" ';
		}
		
		$this->createTable($this->tableName, [
			'wx_msg_record_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'wx_user_id'=>$this->integer(11)->notNull()->comment('关联id'),
			'content'=>$this->string(255)->defaultValue('')->comment('信息内容'),
			'msg_id'=>$this->string(255)->defaultValue('')->comment('用户发送消息的id,在微信里的id'),
			'ip'=>$this->string(255)->defaultValue('')->comment('最近一次发送信息的ip'),
			'send_time'=>$this->integer(11)->notNull()->comment('发送时间'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_wx_user_id',$this->tableName,'wx_user_id');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190612_063441_wx_msg_record cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190612_063441_wx_msg_record cannot be reverted.\n";

        return false;
    }
    */
}
