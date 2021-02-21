<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\fixed\models\FixSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fix-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fix_id') ?>

    <?= $form->field($model, 'content') ?>

    <?= $form->field($model, 'request_at') ?>

    <?= $form->field($model, 'request_by') ?>

    <?= $form->field($model, 'request_detail') ?>

    <?php // echo $form->field($model, 'repair_by') ?>

    <?php // echo $form->field($model, 'repair_at') ?>

    <?php // echo $form->field($model, 'feedback') ?>

    <?php // echo $form->field($model, 'fix_photo') ?>

    <?php // echo $form->field($model, 'equipment_department') ?>

    <?php // echo $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'fix_status_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
