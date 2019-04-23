<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUser */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="admin-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('更新', ['update', 'id' => $model->admin_user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('删除', ['delete', 'id' => $model->admin_user_id], [
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
            'admin_user_id',
            'name',
            'phone',
            'nickname',
            'avatar:ntext',
            'email:email',
            'password',
            'pwd_salt',
            'introduction',
            'last_login_ip',
            ['attribute'=>'create_time',             // 格式化时间
                'value'=>date('Y-m-d H:i:s',$model->create_time),
            ],
            ['attribute'=>'update_time',             // 格式化时间
                'value'=>date('Y-m-d H:i:s',$model->update_time),
            ],
        ],
    ]) ?>

</div>
