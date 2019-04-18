<?php

use yii\db\Migration;

/**
 * Class m190417_081752_rotation_chart
 */
class m190417_081752_rotation_chart extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%rotation_chart}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="轮播图表" ';
		}
		
		$this->createTable($this->tableName, [
			'chart_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'name'=>$this->string(255)->notNull()->comment('图片名称'),
			'pic_id'=>$this->integer(11)->notNull()->comment('图片id'),
			'pic_url'=>$this->string(255)->notNull()->comment('图片对应的地址，冗余字段，为了不去连表查询图片'),
			'url'=>$this->string(255)->defaultValue('')->comment('图片对应的跳转链接，目标链接'),
			'sort'=>$this->integer(11)->defaultValue(1)->comment('排序'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_name',$this->tableName,'name');
		$this->createIndex('idx_sort',$this->tableName,'sort');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190417_081752_rotation_chart cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_081752_rotation_chart cannot be reverted.\n";

        return false;
    }
    */
}
