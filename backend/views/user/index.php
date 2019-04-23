<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
            'avatar:ntext',
            //'email:email',
            //'password',
            //'pwd_salt',
            //'introduction',
            //'is_deleted',
            //'last_login_ip',
            //'qq_token',
            //'wechat_token',
            //'create_time:datetime',
            //'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
