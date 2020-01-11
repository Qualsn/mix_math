<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CreateTab */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Create Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="create-tab-view">

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
            'title',
            'user_id',
            'host',
            'tab_num',
            'address',
            'status',
            'content_per1',
            'content_per2',
            'content_per3',
            'content_per4',
            'content_per5',
            'content_per6',
            'content_per7',
            'content_per8',
            'content_per9',
            'content_per10',
            'comment',
            'sum',
            'create_time:datetime',
            'update_time:datetime',
            'is_del',
        ],
    ]) ?>

</div>
