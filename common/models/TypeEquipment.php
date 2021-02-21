<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "type_equipment".
 *
 * @property int $type_id
 * @property string $type_name
 *
 * @property ComputerDetail[] $computerDetails
 * @property ElectricDeviceDetail[] $electricDeviceDetails
 */
class TypeEquipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'type_equipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type_id', 'type_name'], 'required'],
            [['type_id'], 'integer'],
            [['type_name'], 'string', 'max' => 100],
            [['type_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'type_id' => 'รหัสประเภท',
            'type_name' => 'ประเภท',
        ];
    }

    /**
     * Gets query for [[ComputerDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputerDetails()
    {
        return $this->hasMany(ComputerDetail::className(), ['type_id' => 'type_id']);
    }

    /**
     * Gets query for [[ElectricDeviceDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElectricDeviceDetails()
    {
        return $this->hasMany(ElectricDeviceDetail::className(), ['type_id' => 'type_id']);
    }
}
