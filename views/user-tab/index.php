<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchs\UserTabSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Tabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-tab-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create User Tab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'create_tab_id',
            'team_id',
            'score1',
            //'score2',
            //'score3',
            //'score4',
            //'score5',
            //'score6',
            //'score7',
            //'score8',
            //'score9',
            //'score10',
            //'evaluate',
            //'create_time:datetime',
            //'update_time:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
