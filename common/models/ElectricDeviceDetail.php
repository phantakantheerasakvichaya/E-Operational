<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "electric_device_detail".
 *
 * @property int $electric_device_detail_ID
 * @property string|null $year_electric_device
 * @property string|null $spec_electric_device
 * @property string|null $brand_electric_device
 * @property string|null $start_equipment_department
 * @property int|null $quantity_electric_device
 * @property int|null $warranty
 * @property int $type_id
 *
 * @property ElectricDevice[] $electricDevices
 * @property TypeEquipment $type
 */
class ElectricDeviceDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'electric_device_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['spec_electric_device'], 'string'],
            [['quantity_electric_device', 'warranty', 'type_id'], 'integer'],
            [['type_id'], 'required'],
            [['year_electric_device'], 'string', 'max' => 4],
            [['brand_electric_device', 'start_equipment_department'], 'string', 'max' => 100],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeEquipment::className(), 'targetAttribute' => ['type_id' => 'type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'electric_device_detail_ID' => 'Electric Device Detail ID',
            'year_electric_device' => 'Year Electric Device',
            'spec_electric_device' => 'Spec Electric Device',
            'brand_electric_device' => 'Brand Electric Device',
            'start_equipment_department' => 'Start Equipment Department',
            'quantity_electric_device' => 'Quantity Electric Device',
            'warranty' => 'Warranty',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * Gets query for [[ElectricDevices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElectricDevices()
    {
        return $this->hasMany(ElectricDevice::className(), ['electric_device_detail_ID' => 'electric_device_detail_ID']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(TypeEquipment::className(), ['type_id' => 'type_id']);
    }
}
