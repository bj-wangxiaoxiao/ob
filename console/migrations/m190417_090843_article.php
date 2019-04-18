<?php

use yii\db\Migration;

/**
 * Class m190417_090843_article
 */
class m190417_090843_article extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%article}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="文章表" ';
		}
		
		$this->createTable($this->tableName, [
			'article_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'cate_id'=>$this->integer(11)->notNull()->comment('文章分类id，关联表：article_category'),
			'user_id'=>$this->integer(11)->notNull()->comment('文章是谁添加的，可以是前台用户，也可以是后台用户'),
			'user_type'=>$this->integer(1)->defaultValue(1)->comment('用户类型：1、后台用户；2、前台用户；默认是后台用户添加'),
			'thumbnail'=>$this->string(255)->defaultValue('')->comment('缩略图的链接'),
			'writer'=>$this->string(255)->notNull()->comment('作者'),
			'title'=>$this->string(255)->notNull()->comment('文章标题'),
			'desc'=>$this->string(255)->defaultValue('')->comment('文章简介'),
			'keyword'=>$this->string(255)->defaultValue('')->comment('关键词'),
			'content'=>$this->text()->comment('内容'),
			'click'=>$this->integer(11)->defaultValue(0)->comment('用户点击量'),
			'is_comment'=>$this->integer(1)->defaultValue(1)->comment('是否允许评论：1、是；2、否'),
			'is_recommend'=>$this->integer(1)->defaultValue(2)->comment('是否推荐：1、是；2、否'),
			'is_hot'=>$this->integer(1)->defaultValue(2)->comment('是否最热：1、是；2、否'),
			'is_new'=>$this->integer(1)->defaultValue(2)->comment('是否最新：1、是；2、否'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_cate_id',$this->tableName,'cate_id');
		$this->createIndex('idx_user_id',$this->tableName,'user_id');
		$this->createIndex('idx_is_comment',$this->tableName,'is_comment');
		$this->createIndex('idx_is_recommend',$this->tableName,'is_recommend');
		$this->createIndex('idx_is_hot',$this->tableName,'is_hot');
		$this->createIndex('idx_is_new',$this->tableName,'is_new');
		$this->createIndex('idx_user_type',$this->tableName,'user_type');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190417_090843_article cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_090843_article cannot be reverted.\n";

        return false;
    }
    */
}
