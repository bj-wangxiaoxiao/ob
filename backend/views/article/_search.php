<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\ArticleSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'article_id') ?>

    <?= $form->field($model, 'cate_id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_type') ?>

    <?= $form->field($model, 'thumbnail') ?>

    <?php // echo $form->field($model, 'writer') ?>

    <?php // echo $form->field($model, 'title') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'keyword') ?>

    <?php // echo $form->field($model, 'content') ?>

    <?php // echo $form->field($model, 'click') ?>

    <?php // echo $form->field($model, 'is_comment') ?>

    <?php // echo $form->field($model, 'is_recommend') ?>

    <?php // echo $form->field($model, 'is_hot') ?>

    <?php // echo $form->field($model, 'is_new') ?>

    <?php // echo $form->field($model, 'is_deleted') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
