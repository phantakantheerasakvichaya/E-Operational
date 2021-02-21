<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\jui\AutoComplete;
use yii\jui\Widget;
use yii\jui\InputWidget;
use yii\web\JsExpression;
use common\models\Computer;
use common\models\Rooms;
use common\models\ElectricDevice;
use common\models\Fix;
use common\models\Equipment;

/* @var $this yii\web\View */
/* @var $model common\models\Fix */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fix-form">

    <?php $this->registerJsFile('http://code.jquery.com/jquery-migrate-3.0.0.js', ['depends' => [\yii\web\JqueryAsset::className()]])?>
    <?php $this->registerJs('
                $.fn.init_id = function(){
                    $("#autocomplete-id").val($(this).val());            
                };
           
    ')?>

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data']
    ]); ?>

    <?= $form->errorSummary($model) ?>
    
    <?= $form->field($model, 'equipment_department')->widget(AutoComplete::className(), [
        'options' => [
            'class' =>'form-control'
        ],
        'clientOptions' => [
            //'appendTo'=>'#form-id',
            'source' => Equipment::find()
                ->select(['equipment_department as id','equipment_department as value','equipment_department as label'])
                ->groupBy('equipment_department')
                ->orderBy(['equipment_department' => SORT_ASC])
                ->asArray()->all(),
            'minLength' =>'1',
            'autoFill'=> true,
            'select' => new JsExpression("function( event, ui ) {
                $(this).val(ui.item.equipment_department);
                $(this).init_id();
            }")
        ],
    ]) ?>

    <?= $form->field($model, 'content')->textInput() ?>



    <?= $form->field($model, 'request_detail')->textarea(['rows' => 6]) ?>

    <?php if(!$model->isNewRecord) ?>
        <?=Html::img('@web/uploads/fix/'.$model->fix_photo, ['class'=>'img-responsive thumbnail', 'width'=>300]);?>
        <?= $form->field($model, 'fix_photo')->fileInput() ?>

    <div class="form-group">
        <p class="text-right">
            <?= Html::a('บันทึกการแจ้ง', ['_formConfirmation','Fix[equipment_department]' => $model->equipment_department,'Fix[content]' => $model->content,], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?php ActiveForm::end(); ?>

</div>

