<?php

use yii\db\Migration;

/**
 * Class m190418_025646_log
 */
class m190418_025646_log extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%sys_log}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="日志表" ';
		}
		
		$this->createTable($this->tableName, [
			'log_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'log_type'=>$this->integer(1)->defaultValue(1)->comment('日志类型：1、debug;2、warning；3、fatal'),
			'user_type'=>$this->integer(1)->notNull()->comment('用户类型：1、后台；2、前台'),
			'user_id'=>$this->integer(1)->notNull()->comment('用户的id'),
			'auth_name'=>$this->string(255)->defaultValue('')->comment('当前日志对应的功能名称'),
			'post'=>$this->text()->comment('post数据'),
			'get'=>$this->text()->comment('get数据'),
			'message'=>$this->text()->comment('日志内容'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_log_type',$this->tableName,'log_type');
		$this->createIndex('idx_user_type',$this->tableName,'user_type');
		$this->createIndex('idx_user_id',$this->tableName,'user_id');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190418_025646_log cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190418_025646_log cannot be reverted.\n";

        return false;
    }
    */
}
