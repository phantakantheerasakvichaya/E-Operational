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
 * @property string|null $request_detail
 * @property int|null $repair_by
 * @property int|null $repair_at
 * @property int|null $feedback
 * @property string|null $fix_photo
 * @property string $equipment_department
 * @property string $location
 * @property int $fix_status_id
 *
 * @property Equipment $equipmentDepartment
 * @property FixStatus $fixStatus
 * @property User $requestBy
 * @property User $repairBy
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
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'request_by', 'request_at', 'equipment_department', 'location', 'fix_status_id'], 'required'],
            [['content', 'request_detail'], 'string'],
            [['request_by', 'request_at', 'repair_by', 'repair_at', 'feedback', 'fix_status_id'], 'integer'],
            //[['fix_photo'], 'string', 'max' => 200],
            [['fix_photo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, png, gif'],
            [['equipment_department', 'location'], 'string', 'max' => 100],
            [['equipment_department'], 'exist', 'skipOnError' => true, 'targetClass' => Equipment::className(), 'targetAttribute' => ['equipment_department' => 'equipment_department']],
            [['fix_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => FixStatus::className(), 'targetAttribute' => ['fix_status_id' => 'fix_status_id']],
            [['request_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['request_by' => 'id']],
            [['repair_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['repair_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fix_id' => 'รหัสแจ้งปัญหา',
            'content' => 'เรื่อง',
            'request_by' => 'แจ้งโดย',
            'request_at' => 'แจ้งเมื่อ',
            'request_detail' => 'รายละเอียด',
            'repair_by' => 'แก้ไขโดย',
            'repair_at' => 'แก้ไขเมื่อ',
            'feedback' => 'ความพึงพอใจ',
            'fix_photo' => 'รูปภาพปัญหา',
            'equipment_department' => 'รหัสครุภัณฑ์',
            'location' => 'สถานที่',
            'fix_status_id' => 'สถานะ',
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

    /**
     * Gets query for [[RequestBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequestBy()
    {
        return $this->hasOne(User::className(), ['id' => 'request_by']);
    }

    /**
     * Gets query for [[RepairBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRepairBy()
    {
        return $this->hasOne(User::className(), ['id' => 'repair_by']);
    }

    public function getFixPhoto()
    {
        return $this->fix_photo;
    }
}
