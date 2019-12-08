<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CreateTab */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="create-tab-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'host')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tab_id')->textInput() ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'member_num')->textInput() ?>

    <?= $form->field($model, 'content_per1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per4')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per5')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per6')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per7')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per8')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per9')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content_per10')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sum')->textInput() ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <?= $form->field($model, 'update_time')->textInput() ?>

    <?= $form->field($model, 'is_del')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
