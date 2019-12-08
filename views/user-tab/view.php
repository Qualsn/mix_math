<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\UserTab */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-tab-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'create_tab_id',
            'team_id',
            'score1',
            'score2',
            'score3',
            'score4',
            'score5',
            'score6',
            'score7',
            'score8',
            'score9',
            'score10',
            'create_time:datetime',
            'update_time:datetime',
        ],
    ]) ?>

</div>
