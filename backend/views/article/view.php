<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->article_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->article_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'article_id',
            'cate_id',
            'user_id',
            'user_type',
            'thumbnail',
            'writer',
            'title',
            'desc',
            'keyword',
            'content:ntext',
            'click',
            'is_comment',
            'is_recommend',
            'is_hot',
            'is_new',
            'is_deleted',
            'create_time:datetime',
            'update_time:datetime',
        ],
    ]) ?>

</div>
