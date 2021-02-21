<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Fix */

$this->title = 'แก้ไขรายการ: ' . $model->content;
$this->params['breadcrumbs'][] = ['label' => 'การแจ้งปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->content, 'url' => ['view', 'id' => $model->fix_id]];
$this->params['breadcrumbs'][] = 'แก้ไขรายการ';
?>
<div class="fix-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
