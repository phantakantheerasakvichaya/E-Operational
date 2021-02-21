<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "equipmentv".
 *
 * @property string $EQUIPMENT_DEPARTMENT
 * @property string|null $BRAND_ELECTRIC_DEVICE
 * @property string|null $SPEC_ELECTRIC_DEVICE
 * @property string|null $YEAR_ELECTRIC_DEVICE
 * @property int|null $WARRANTY
 * @property string|null $ROOMS_NAME
 * @property int $STATUS_ELECTRIC_DEVICE
 */
class Equipmentv extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'equipmentv';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SPEC_ELECTRIC_DEVICE'], 'string'],
            [['WARRANTY', 'STATUS_ELECTRIC_DEVICE'], 'integer'],
            [['EQUIPMENT_DEPARTMENT', 'BRAND_ELECTRIC_DEVICE', 'ROOMS_NAME'], 'string', 'max' => 100],
            [['YEAR_ELECTRIC_DEVICE'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'EQUIPMENT_DEPARTMENT' => 'Equipment Department',
            'BRAND_ELECTRIC_DEVICE' => 'Brand Electric Device',
            'SPEC_ELECTRIC_DEVICE' => 'Spec Electric Device',
            'YEAR_ELECTRIC_DEVICE' => 'Year Electric Device',
            'WARRANTY' => 'Warranty',
            'ROOMS_NAME' => 'Rooms Name',
            'STATUS_ELECTRIC_DEVICE' => 'Status Electric Device',
        ];
    }
}
