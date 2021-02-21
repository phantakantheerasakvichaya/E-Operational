<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "electric_estimation".
 *
 * @property int $es_id
 * @property int $rooms_id
 * @property string $DATE
 * @property float $Unit
 *
 * @property Rooms $rooms
 */
class ElectricEstimation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'electric_estimation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['es_id', 'rooms_id', 'DATE', 'Unit'], 'required'],
            [['es_id', 'rooms_id'], 'integer'],
            [['Unit'], 'number'],
            [['DATE'], 'string', 'max' => 10],
            [['es_id'], 'unique'],
            [['rooms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['rooms_id' => 'rooms_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'es_id' => 'Es ID',
            'rooms_id' => 'Rooms ID',
            'DATE' => 'Date',
            'Unit' => 'Unit',
        ];
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasOne(Rooms::className(), ['rooms_id' => 'rooms_id']);
    }
}
