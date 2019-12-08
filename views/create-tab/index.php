<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\searchs\CreateTab */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Create Tabs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="create-tab-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Create Tab', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'host',
            'tab_id',
            'title',
            //'address',
            //'member_num',
            //'content_per1',
            //'content_per2',
            //'content_per3',
            //'content_per4',
            //'content_per5',
            //'content_per6',
            //'content_per7',
            //'content_per8',
            //'content_per9',
            //'content_per10',
            //'comment',
            //'sum',
            //'create_time:datetime',
            //'update_time:datetime',
            //'is_del',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
