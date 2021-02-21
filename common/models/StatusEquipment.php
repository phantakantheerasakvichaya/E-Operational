<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "status_equipment".
 *
 * @property int $status_id
 * @property string $status_name
 *
 * @property Computer[] $computers
 * @property ElectricDevice[] $electricDevices
 */
class StatusEquipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_equipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_name'], 'required'],
            [['status_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'status_id' => 'Status ID',
            'status_name' => 'Status Name',
        ];
    }

    /**
     * Gets query for [[Computers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputers()
    {
        return $this->hasMany(Computer::className(), ['status_com' => 'status_id']);
    }

    /**
     * Gets query for [[ElectricDevices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElectricDevices()
    {
        return $this->hasMany(ElectricDevice::className(), ['status_electric_device' => 'status_id']);
    }
}
