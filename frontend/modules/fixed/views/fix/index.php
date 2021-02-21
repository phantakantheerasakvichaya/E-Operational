<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\timeago\TimeAgo;
use common\models\FixStatus;
use common\models\Rooms;
use common\models\Fix;
use common\models\Equipment;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\fixed\models\FixSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'การแจ้งปัญหา';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="fix-index">

    <p class="text-right">
        <?=Html::a('แจ้งปัญหา', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= ('รายการปัญหา') ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'fix_id',
            'content:ntext',
            [
                'attribute' => 'request_by',
                'value' => function($model){
                    return $model->requestBy->person->getFullname();
                }
            ],
            [   
                'attribute' => 'request_at',
                'label' => 'แจ้งล่าสุด',
                'format' => 'raw',
                'value' => function($model){
                    return TimeAgo::widget(['timestamp' => $model->request_at, 'language' => 'th']);
                }
            ],
            [
                'attribute' => 'location',
                //'filter' => ArrayHelper::map(Rooms::find()->all(),'rooms_id', 'rooms_name'),
                'label' => 'สถานที่',
                'value' => function($model){
                    return $model->location;
                }
            ],
            [
                'attribute' => 'fix_status_id',
                'filter' => ArrayHelper::map(FixStatus::find()->all(), 'fix_status_id', 'fix_status_name'),
                'value' => function($model){
                    return $model->fixStatus->fix_status_name;
                }
            ],
            //'request_detail:ntext',
            //'repair_by',
            //'repair_at',
            //'feedback',
            //'fix_photo',
            //'equipment_department',
            //'location',
            //'fix_status_id',

            [
                'class' => 'yii\grid\ActionColumn',
                'buttonOptions'=>['class'=>'btn btn-default'],
                'template'=>'<div class="btn-group btn-group-sm text-center" role="group"> {view}</div>',
            ],
        ],
    ]); ?>


</div>
