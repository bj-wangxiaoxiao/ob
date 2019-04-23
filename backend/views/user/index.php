<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            'name',
            'phone',
            'nickname',
            [
                    'attribute' => 'is_deleted',
                    'value'     => 'IsDeleted',
            ],
            'last_login_ip',
            [
                'attribute' =>  'create_time',
                'format'     =>  ['date','php:Y-m-d H:i:s']
            ],
            [
                'attribute' =>  'update_time',
                'format'     =>  ['date','php:Y-m-d H:i:s']
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'  =>  '{update}',
            ],


        ],
    ]); ?>


</div>
