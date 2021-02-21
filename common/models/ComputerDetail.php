<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "computer_detail".
 *
 * @property int $computer_detail_id
 * @property string|null $year_computer
 * @property string|null $spec_computer
 * @property string|null $brand_computer
 * @property string|null $start_equipment_department
 * @property int|null $quantity_computer
 * @property int|null $watt_computer
 * @property int|null $warranty
 * @property int $type_id
 *
 * @property Computer[] $computers
 * @property TypeEquipment $type
 */
class ComputerDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'computer_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['computer_detail_id', 'type_id'], 'required'],
            [['computer_detail_id', 'quantity_computer', 'watt_computer', 'warranty', 'type_id'], 'integer'],
            [['spec_computer'], 'string'],
            [['year_computer'], 'string', 'max' => 4],
            [['brand_computer', 'start_equipment_department'], 'string', 'max' => 100],
            [['computer_detail_id'], 'unique'],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TypeEquipment::className(), 'targetAttribute' => ['type_id' => 'type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'computer_detail_id' => 'Computer Detail ID',
            'year_computer' => 'Year Computer',
            'spec_computer' => 'Spec Computer',
            'brand_computer' => 'Brand Computer',
            'start_equipment_department' => 'Start Equipment Department',
            'quantity_computer' => 'Quantity Computer',
            'watt_computer' => 'Watt Computer',
            'warranty' => 'Warranty',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * Gets query for [[Computers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputers()
    {
        return $this->hasMany(Computer::className(), ['computer_detail_id' => 'computer_detail_id']);
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
