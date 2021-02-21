<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fix".
 *
 * @property int $fix_id
 * @property string $content
 * @property int $request_by
 * @property int $request_at
 * @property int|null $repair_by
 * @property int|null $repair_at
 * @property string|null $repair_detail
 * @property int|null $feedback
 * @property string|null $fix_photo
 * @property int $fix_status_id
 * @property string $equipment_department
 *
 * @property Equipment $equipmentDepartment
 * @property FixStatus $fixStatus
 */
class Fix extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fix';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db2','db');
    }
    /*public static function getDb2()
    {
        return Yii::$app->get('db');
    }*/
    //[['fix_photo'], 'file', 'skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'request_by', 'request_at', 'fix_status_id', 'equipment_department'], 'required'],
            [['content', 'repair_detail'], 'string'],
            [['request_by', 'request_at', 'repair_by', 'repair_at', 'feedback', 'fix_status_id'], 'integer'],
            //[['fix_photo'], 'string', 'max' => 200],
            [['fix_photo'], 'file', 'skipOnEmpty' => true, 'on' => 'update', 'extensions' => 'jpg,png,gif'],
            [['equipment_department'], 'string', 'max' => 100],
            [['equipment_department'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_department' => 'equipment_department']],
            [['fix_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => FixStatus::className(), 'targetAttribute' => ['fix_status_id' => 'fix_status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fix_id' => 'รหัสแจ้งซ่อม',
            'content' => 'เรื่อง',
            'request_by' => 'แจ้งโดย',
            'request_at' => 'แจ้งเมื่อ',
            'repair_by' => 'แก้ไขโดย',
            'repair_at' => 'แก้ไขเมื่อ',
            'repair_detail' => 'รายละเอียดการแก้ไข',
            'feedback' => 'ความพึงพอใจ',
            'fix_photo' => 'รูปภาพปัญหา',
            'fix_status_id' => 'Fix Status ID',
            'equipment_department' => 'รหัสครุภัณฑ์',
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
     * Gets query for [[FixStatus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFixStatus()
    {
        return $this->hasOne(FixStatus::className(), ['fix_status_id' => 'fix_status_id']);
    }

    public function getRequestBy()
    {
        return $this->hasOne(User::className(), ['id' => 'request_by']);
    }
    public function getRepairBy()
    {
        return $this->hasOne(User::className(), ['id' => 'repair_by']);
    }

}
