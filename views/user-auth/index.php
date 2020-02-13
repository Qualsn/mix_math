<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchs\UserAuth */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Auths';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-auth-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Auth', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'auth_id',
            'create_time:datetime',
            'is_del',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
