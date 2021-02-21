<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipment".
 *
 * @property string $equipment_department
 * @property string $type_name
 * @property string|null $brand_electric_device
 * @property string|null $spec_electric_device
 * @property string|null $year_electric_device
 * @property int|null $warranty
 * @property string|null $rooms_name
 * @property string $status_name
 * @property string $check_status_name
 *
 * @property Check[] $checks
 * @property Fix[] $fixes
 */
class Equipment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipment_department'], 'required'],
            [['spec_electric_device'], 'string'],
            [['warranty'], 'integer'],
            [['equipment_department', 'type_name', 'brand_electric_device', 'rooms_name', 'status_name'], 'string', 'max' => 100],
            [['year_electric_device'], 'string', 'max' => 4],
            [['check_status_name'], 'string', 'max' => 45],
            [['equipment_department'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'equipment_department' => 'รหัสครุภัณฑ์',
            'type_name' => 'ประเภท',
            'brand_electric_device' => 'ยี่ห้อ',
            'spec_electric_device' => 'รายละเอียด',
            'year_electric_device' => 'ปี',
            'warranty' => 'ระยะเวลาประกัน',
            'rooms_name' => 'สถาที่',
            'status_name' => 'สถานะ',
            'check_status_name' => 'สถานะตรวจนับ',
        ];
    }

    /**
     * Gets query for [[Checks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChecks()
    {
        return $this->hasMany(Check::className(), ['equipment_department' => 'equipment_department']);
    }

    /**
     * Gets query for [[Fixes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFixes()
    {
        return $this->hasMany(Fix::className(), ['equipment_department' => 'equipment_department']);
    }

    public function getRoomsName()
    {
        return $this->rooms_name;
    }
}
