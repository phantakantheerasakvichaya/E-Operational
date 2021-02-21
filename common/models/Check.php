<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "check".
 *
 * @property int $check_id
 * @property int $count_by
 * @property int $count_at
 * @property string $count_year
 * @property string $equipment_department
 *
 * @property Equipment $equipmentDepartment
 * @property User $countBy
 */
class Check extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count_by', 'count_at', 'count_year', 'equipment_department'], 'required'],
            [['count_by', 'count_at'], 'integer'],
            [['count_year'], 'string', 'max' => 4],
            [['equipment_department'], 'string', 'max' => 100],
            [['equipment_department'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_department' => 'equipment_department']],
            [['count_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['count_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'check_id' => 'Check ID',
            'count_by' => 'Count By',
            'count_at' => 'Count At',
            'count_year' => 'Count Year',
            'equipment_department' => 'Equipment Department',
        ];
    }

    /**
     * Gets query for [[EquipmentDepartment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEquipmentDepartment()
    {
        return $this->hasOne(Equipment::className(), ['equipment_department' => 'equipment_department']);
    }

    /**
     * Gets query for [[CountBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountBy()
    {
        return $this->hasOne(User::className(), ['id' => 'count_by']);
    }
}
