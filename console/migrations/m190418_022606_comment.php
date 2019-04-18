<?php

use yii\db\Migration;

/**
 * Class m190418_022606_comment
 */
class m190418_022606_comment extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%comment}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="评论表" ';
		}
		
		$this->createTable($this->tableName, [
			'comment_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'article_id'=>$this->integer(11)->notNull()->comment('关联的文章id'),
			'user_id'=>$this->integer(11)->notNull()->comment('前台用户的id，评论只能是前台用户，不能后台用户'),
			'pid'=>$this->integer(11)->defaultValue(0)->comment('评论某条评论的id,评论有层次关系'),
			'content'=>$this->text()->comment('评论内容'),
			'status'=>$this->integer(1)->defaultValue(1)->comment('是否通过：1、是；2、否，默认1'),
			'reason'=>$this->string(255)->defaultValue('')->comment('如果没有通过，记下原因'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_article_id',$this->tableName,'article_id');
		$this->createIndex('idx_user_id',$this->tableName,'user_id');
		$this->createIndex('idx_pid',$this->tableName,'pid');
		$this->createIndex('idx_status',$this->tableName,'status');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190418_022606_comment cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190418_022606_comment cannot be reverted.\n";

        return false;
    }
    */
}
