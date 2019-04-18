<?php

use yii\db\Migration;

/**
 * Class m190418_024914_picture
 */
class m190418_024914_picture extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%picture}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="图片表" ';
		}
		
		$this->createTable($this->tableName, [
			'pic_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'name'=>$this->string(255)->notNull()->comment('图片名称：qq截图'),
			'extension'=>$this->string(255)->notNull()->comment('图片格式：jpg/png'),
			'full_name'=>$this->string(255)->notNull()->comment('图片的全名称：qq截图.jpg'),
			'path'=>$this->string(255)->notNull()->comment('图片的全路径，一定要斜线开头：/public/image/qq截图.jpg'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190418_024914_picture cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190418_024914_picture cannot be reverted.\n";

        return false;
    }
    */
}
