<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AdminuserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('新增管理员', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p>
		<?= Html::a('角色权限分配', ['assignment'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'admin_user_id',
            'name',
            'phone',
            'nickname',
            //'avatar:ntext',
            'email:email',
            //'password',
            //'pwd_salt',
            //'introduction',
            //'is_deleted',
            'last_login_ip',
            //'create_time:datetime',
            //'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn',
                'template'  =>  '{view} {update} {resetpwd} {privilege}',
                'buttons'    =>  [
                        'resetpwd'  =>  function($url,$model,$key)
                        {
                            $options = [
                                'title' => Yii::t('yii','Repwd'),
                                'aria-label'    =>  Yii::t('yii','Repwd'),
                                'data-pjax'     =>  '0'
                            ];
                            return Html::a('<span class="glyphicon glyphicon-lock"></span>',$url,$options);
                        },
                        'privilege' =>  function($url,$model,$key)
                        {
                            $options = [
                                'title' => Yii::t('yii','Auth'),
                                'aria-label'    =>  Yii::t('yii','Auth'),
                                'data-pjax'     =>  '0'
                            ];
                            return Html::a('<span class="glyphicon glyphicon-user"></span>',$url,$options);
                        },
                ]
            ],
        ],
    ]); ?>


</div>
