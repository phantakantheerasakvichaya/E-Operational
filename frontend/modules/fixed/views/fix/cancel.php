<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
/* @var $this yii\web\View */
/* @var $model common\models\Fix */
\yii\web\YiiAsset::register($this);

?>
<div class="fix-cancel">
    <?
        echo $model->equipmentDepartment->equipment_department;
        echo $model->fixStatus->fix_status_name;
    ?>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'equipment_department',
            [
                'attribute' => 'type_name',
                'value' => function($model){
                    return $model->equipmentDepartment->type_name;
                }
            ],
            'content:ntext',
            [
                'attribute' => 'request_by',
                'value' => function($model){
                    return $model->requestBy->person->getFullname();
                }
            ],
            [
                'attribute' => 'location',
                'value' => function($model){
                    return $model->equipmentDepartment->rooms_name;
                }
            ],
            'request_detail:ntext',
            'request_at:datetime',
            [
                'attribute' => 'สถานะดำเนินการ',
                'value' => $model->fixStatus->fix_status_name
            ]
            //'repair_by',
            //'repair_at',
            //'feedback',
            //'fix_photo',
            //'location',
            //'fix_status_id',
        ],
    ]) ?>
</div>
