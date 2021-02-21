<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Fix;
use common\models\Person;
use common\models\User;
use common\models\Equipment;

/* @var $this yii\web\View */
/* @var $model common\models\Fix */

$this->title = $model->content;
$this->params['breadcrumbs'][] = ['label' => 'การแจ้งปัญหา', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="fix-view">

<p class="text-right">

        <?= Html::a('ยกเลิก', ['cancel', 'id' => $model->fix_id], ['class' => 'btn btn-danger']) ?>
        <?= Html::a('แก้ไข', ['update', 'id' => $model->fix_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('ลบ', ['delete', 'id' => $model->fix_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'คุณแน่ใจที่จะลบรายการนี้ ?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="text-center">
            <?=Html::img('@web/uploads/fix/'.$model->fix_photo, ['class'=>'img-responsive thumnail', 'width'=>250])?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'equipment_department',
            [
                'attribute' => 'ประเภท',
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
