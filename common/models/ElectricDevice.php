<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "electric_device".
 *
 * @property int $electric_device_id
 * @property string $name_device
 * @property int $watt
 * @property int $quantity_device
 * @property int $rooms_id
 * @property string $equipment_department
 * @property string|null $equipment_university
 * @property int $status_electric_device
 * @property int $check_status_id
 * @property int $electric_device_detail_ID
 *
 * @property CheckStatus $checkStatus
 * @property ElectricDeviceDetail $electricDeviceDetail
 * @property Rooms $rooms
 * @property StatusEquipment $statusElectricDevice
 */
class ElectricDevice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'electric_device';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name_device', 'watt', 'quantity_device', 'rooms_id', 'equipment_department', 'electric_device_detail_ID'], 'required'],
            [['watt', 'quantity_device', 'rooms_id', 'status_electric_device', 'check_status_id', 'electric_device_detail_ID'], 'integer'],
            [['name_device'], 'string', 'max' => 150],
            [['equipment_department', 'equipment_university'], 'string', 'max' => 100],
            [['equipment_department'], 'unique'],
            [['check_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_status_id' => 'check_status_id']],
            [['electric_device_detail_ID'], 'exist', 'skipOnError' => true, 'targetClass' => ElectricDeviceDetail::className(), 'targetAttribute' => ['electric_device_detail_ID' => 'electric_device_detail_ID']],
            [['rooms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['rooms_id' => 'rooms_id']],
            [['status_electric_device'], 'exist', 'skipOnError' => true, 'targetClass' => StatusEquipment::className(), 'targetAttribute' => ['status_electric_device' => 'status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'electric_device_id' => 'Electric Device ID',
            'name_device' => 'Name Device',
            'watt' => 'Watt',
            'quantity_device' => 'Quantity Device',
            'rooms_id' => 'Rooms ID',
            'equipment_department' => 'Equipment Department',
            'equipment_university' => 'Equipment University',
            'status_electric_device' => 'Status Electric Device',
            'check_status_id' => 'Check Status ID',
            'electric_device_detail_ID' => 'Electric Device Detail ID',
        ];
    }

    /**
     * Gets query for [[CheckStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCheckStatus()
    {
        return $this->hasOne(CheckStatus::className(), ['check_status_id' => 'check_status_id']);
    }

    /**
     * Gets query for [[ElectricDeviceDetail]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElectricDeviceDetail()
    {
        return $this->hasOne(ElectricDeviceDetail::className(), ['electric_device_detail_ID' => 'electric_device_detail_ID']);
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

    /**
     * Gets query for [[StatusElectricDevice]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusElectricDevice()
    {
        return $this->hasOne(StatusEquipment::className(), ['status_id' => 'status_electric_device']);
    }
}
