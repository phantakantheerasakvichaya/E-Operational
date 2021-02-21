<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Equipment */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'equipment_department')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand_electric_device')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'spec_electric_device')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'year_electric_device')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'warranty')->textInput() ?>

    <?= $form->field($model, 'rooms_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'check_status_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
