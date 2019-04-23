<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\AdminUser */

$this->title = '新增管理员';
$this->params['breadcrumbs'][] = ['label' => '管理员', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
