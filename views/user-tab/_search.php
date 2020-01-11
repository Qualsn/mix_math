<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\searchs\UserTabSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-tab-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'create_tab_id') ?>

    <?= $form->field($model, 'team_id') ?>

    <?= $form->field($model, 'score1') ?>

    <?php // echo $form->field($model, 'score2') ?>

    <?php // echo $form->field($model, 'score3') ?>

    <?php // echo $form->field($model, 'score4') ?>

    <?php // echo $form->field($model, 'score5') ?>

    <?php // echo $form->field($model, 'score6') ?>

    <?php // echo $form->field($model, 'score7') ?>

    <?php // echo $form->field($model, 'score8') ?>

    <?php // echo $form->field($model, 'score9') ?>

    <?php // echo $form->field($model, 'score10') ?>

    <?php // echo $form->field($model, 'evaluate') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <?php // echo $form->field($model, 'update_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
