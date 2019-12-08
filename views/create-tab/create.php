<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CreateTab */

$this->title = 'Create Create Tab';
$this->params['breadcrumbs'][] = ['label' => 'Create Tabs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="create-tab-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
