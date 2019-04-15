<?php

use yii\db\Migration;

/**
 * Class m190413_071437_admin_user
 */
class m190413_071437_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%admin_user}}';
	
	public function safeUp()
    {
	    $tableOptions = null;
	    if ($this->db->getDriverName() === 'mysql') {
		    $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="管理员信息表" ';
	    }
	
	    $this->createTable($this->tableName, [
		    'u_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
		    'name'=>$this->string(255)->notNull()->comment('姓名'),
		    'phone'=>$this->string(255)->defaultValue('')->comment('手机号码'),
		    'nickname'=>$this->string(255)->comment('别名'),
		    'avatar'=>$this->text()->comment('头像'),
		    'email'=>$this->string(255)->notNull()->comment('邮箱'),
		    'password'=>$this->string(255)->notNull()->comment('密码'),
		    'pwd_salt'=>$this->string(255)->notNull()->comment('密码盐，每个用户都不一样'),
		    'introduction'=>$this->string(255)->defaultValue('')->comment('自我介绍'),
		    'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
		    'last_login_id'=>$this->string(255)->defaultValue('')->comment('最近一次登录ip'),
		    'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
		    'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
	    ], $tableOptions);
	    $this->createIndex('idx_title',$this->tableName,'title');
	    $this->createIndex('idx_branch_name',$this->tableName,'branch_name');
	    $this->createIndex('idx_status',$this->tableName,'status');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190413_071437_admin_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190413_071437_admin_user cannot be reverted.\n";

        return false;
    }
    */
}
