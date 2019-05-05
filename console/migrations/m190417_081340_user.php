<?php

use yii\db\Migration;

/**
 * Class m190417_081340_user
 */
class m190417_081340_user extends Migration
{
    /**
     * {@inheritdoc}
     */
	public $tableName = '{{%user}}';
	
	public function safeUp()
	{
		$tableOptions = null;
		if ($this->db->getDriverName() === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="前台用户信息表" ';
		}
		
		$this->createTable($this->tableName, [
			'user_id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
			'name'=>$this->string(255)->notNull()->comment('姓名'),
			'phone'=>$this->string(255)->defaultValue('')->comment('手机号码'),
			'nickname'=>$this->string(255)->defaultValue('')->comment('别名'),
			'avatar'=>$this->text()->comment('头像'),
			'email'=>$this->string(255)->notNull()->comment('邮箱'),
			'password'=>$this->string(255)->notNull()->comment('密码'),
			'pwd_salt'=>$this->string(255)->notNull()->comment('密码盐，每个用户都不一样'),
			'introduction'=>$this->string(255)->defaultValue('')->comment('自我介绍'),
			'is_deleted'=>$this->integer(1)->defaultValue(0)->comment('是否删除：0、否；1、是，默认为0'),
			'last_login_ip'=>$this->string(255)->defaultValue('')->comment('最近一次登录ip'),
			'qq_token'=>$this->string(255)->defaultValue('')->comment('qq登陆的openid'),
			'wechat_token'=>$this->string(255)->defaultValue('')->comment('微信登陆的openid'),
			'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
			'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
		], $tableOptions);
		$this->createIndex('idx_is_deleted',$this->tableName,'is_deleted');
		$this->createIndex('idx_password',$this->tableName,'password');
		$this->createIndex('idx_email',$this->tableName,'email');
		$this->createIndex('idx_phone',$this->tableName,'phone');
	}

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190417_081340_user cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190417_081340_user cannot be reverted.\n";

        return false;
    }
    */
}
