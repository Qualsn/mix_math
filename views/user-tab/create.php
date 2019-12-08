<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\UserTab */

$this->title = 'Create User Tab';
$this->params['breadcrumbs'][] = ['label' => 'User Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-tab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
