<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ob_article".
 *
 * @property int $article_id 唯一键
 * @property int $cate_id 文章分类id，关联表：article_category
 * @property int $user_id 文章是谁添加的，可以是前台用户，也可以是后台用户
 * @property int $user_type 用户类型：1、后台用户；2、前台用户；默认是后台用户添加
 * @property string $thumbnail 缩略图的链接
 * @property string $writer 作者
 * @property string $title 文章标题
 * @property string $desc 文章简介
 * @property string $keyword 关键词
 * @property string $content 内容
 * @property int $click 用户点击量
 * @property int $is_comment 是否允许评论：1、是；2、否
 * @property int $is_recommend 是否推荐：1、是；2、否
 * @property int $is_hot 是否最热：1、是；2、否
 * @property int $is_new 是否最新：1、是；2、否
 * @property int $is_deleted 是否删除：0、否；1、是，默认为0
 * @property int $create_time 创建时间
 * @property int $update_time 更新时间
 */
class Article extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ob_article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cate_id', 'writer', 'title','desc'], 'required'],
            [['cate_id',  'user_type', 'click', 'is_comment', 'is_recommend', 'is_hot', 'is_new', 'is_deleted', 'create_time', 'update_time'], 'integer'],
            [['content'], 'string'],
            [['thumbnail', 'writer', 'title', 'desc', 'keyword'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'article_id' => 'ID',
            'cate_id' => '文章分类',
            'user_id' => '用户id',
            'user_type' => '用户类型',
            'thumbnail' => '缩略图',
            'writer' => '作者',
            'title' => '文章标题',
            'desc' => '文章简介',
            'keyword' => '关键词',
            'content' => '内容',
            'click' => '点击量',
            'is_comment' => '是否允许评论',
            'is_recommend' => '是否推荐',
            'is_hot' => '是否最热',
            'is_new' => '是否最新',
            'is_deleted' => '是否删除',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
        ];
    }
}
