<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Fix */

$this->title = 'แจ้งปัญหา';
$this->params['breadcrumbs'][] = ['label' => 'การแจ้งปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fix-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
