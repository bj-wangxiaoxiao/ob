<?php

use yii\db\Migration;

/**
 * Class m190415_101520_log
 */
class m190415_101520_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public $tableName = '{{%log}}';

    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->getDriverName() === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB COMMENT="日志表" ';
        }

        $this->createTable($this->tableName, [
            'id' => $this->primaryKey()->comment('唯一键'),//默认自动增长AUTO_INCREMENT
            'type'=>$this->integer(1)->defaultValue(1)->comment('日志类型1:登陆日志2:发布文章日志3:其他'),
            'message'=>$this->text()->comment('日志信息'),
            'create_time'=>$this->integer(11)->notNull()->comment('创建时间'),
            'update_time'=>$this->integer(11)->notNull()->comment('更新时间'),
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190415_101520_log cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190415_101520_log cannot be reverted.\n";

        return false;
    }
    */
}
