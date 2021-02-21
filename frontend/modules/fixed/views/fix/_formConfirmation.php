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

    <?= $model->equipment_department; ?>
    <?= $model->content?>

</div>

