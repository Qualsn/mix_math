<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserTab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-tab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'create_tab_id')->textInput() ?>

    <?= $form->field($model, 'team_id')->textInput() ?>

    <?= $form->field($model, 'score1')->textInput() ?>

    <?= $form->field($model, 'score2')->textInput() ?>

    <?= $form->field($model, 'score3')->textInput() ?>

    <?= $form->field($model, 'score4')->textInput() ?>

    <?= $form->field($model, 'score5')->textInput() ?>

    <?= $form->field($model, 'score6')->textInput() ?>

    <?= $form->field($model, 'score7')->textInput() ?>

    <?= $form->field($model, 'score8')->textInput() ?>

    <?= $form->field($model, 'score9')->textInput() ?>

    <?= $form->field($model, 'score10')->textInput() ?>

    <?= $form->field($model, 'evaluate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
