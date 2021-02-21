<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\equip\models\EquipmentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="equipment-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'equipment_department') ?>

    <?= $form->field($model, 'type_name') ?>

    <?= $form->field($model, 'brand_electric_device') ?>

    <?= $form->field($model, 'spec_electric_device') ?>

    <?= $form->field($model, 'year_electric_device') ?>

    <?php // echo $form->field($model, 'warranty') ?>

    <?php // echo $form->field($model, 'rooms_name') ?>

    <?php // echo $form->field($model, 'status_name') ?>

    <?php // echo $form->field($model, 'check_status_name') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
