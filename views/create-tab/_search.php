<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\searchs\CreateTab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="create-tab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'host') ?>

    <?= $form->field($model, 'tab_num') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'content_per1') ?>

    <?php // echo $form->field($model, 'content_per2') ?>

    <?php // echo $form->field($model, 'content_per3') ?>

    <?php // echo $form->field($model, 'content_per4') ?>

    <?php // echo $form->field($model, 'content_per5') ?>

    <?php // echo $form->field($model, 'content_per6') ?>

    <?php // echo $form->field($model, 'content_per7') ?>

    <?php // echo $form->field($model, 'content_per8') ?>

    <?php // echo $form->field($model, 'content_per9') ?>

    <?php // echo $form->field($model, 'content_per10') ?>

    <?php // echo $form->field($model, 'comment') ?>

    <?php // echo $form->field($model, 'sum') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <?php // echo $form->field($model, 'is_del') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
