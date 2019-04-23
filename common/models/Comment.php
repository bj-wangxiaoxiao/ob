<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_comment".
 *
 * @property int $comment_id 唯一键
 * @property int $article_id 关联的文章id
 * @property int $user_id 前台用户的id，评论只能是前台用户，不能后台用户
 * @property int $pid 评论某条评论的id,评论有层次关系
 * @property string $content 评论内容
 * @property int $status 是否通过：1、是；2、否，默认1
 * @property string $reason 如果没有通过，记下原因
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_comment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['article_id', 'user_id', 'create_time', 'update_time'], 'required'],
            [['article_id', 'user_id', 'pid', 'status', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['content'], 'string'],
            [['reason'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'comment_id' => 'Comment ID',
            'article_id' => 'Article ID',
            'user_id' => 'User ID',
            'pid' => 'Pid',
            'content' => 'Content',
            'status' => 'Status',
            'reason' => 'Reason',
            'is_deleted' => 'Is Deleted',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
