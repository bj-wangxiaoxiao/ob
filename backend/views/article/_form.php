<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cate_id')->textInput() ?>

    <?= $form->field($model, 'writer')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'keyword')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'click')->textInput() ?>

    <?= $form->field($model, 'is_comment')->textInput() ?>

    <?= $form->field($model, 'is_recommend')->textInput() ?>

    <?= $form->field($model, 'is_hot')->textInput() ?>

    <?= $form->field($model, 'is_new')->textInput() ?>

    <?= $form->field($model, 'is_deleted')->textInput() ?>

    <!--<?= $form->field($model, 'create_time')->textInput() ?>-->

    <!--<?= $form->field($model, 'update_time')->textInput() ?>-->

    <div class="form-group">
        <?= Html::submitButton('保存', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
