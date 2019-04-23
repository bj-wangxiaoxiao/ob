<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUser */

$this->title = '更新管理员信息: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->admin_user_id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="admin-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
