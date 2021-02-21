<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "computer".
 *
 * @property int $computer_id
 * @property string $equipment_department รหัสสครุพันภาควิชา\n
 * @property string|null $equipment_university รหัสครุพันมหาลัย\n
 * @property int $status_com
 * @property int $check_status_id
 * @property int $computer_detail_id
 *
 * @property CheckStatus $checkStatus
 * @property ComputerDetail $computerDetail
 * @property StatusEquipment $statusCom
 * @property ComputerToLayout $computerToLayout
 */
class Computer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'computer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['computer_id', 'equipment_department', 'computer_detail_id'], 'required'],
            [['computer_id', 'status_com', 'check_status_id', 'computer_detail_id'], 'integer'],
            [['equipment_department', 'equipment_university'], 'string', 'max' => 100],
            [['equipment_department'], 'unique'],
            [['computer_id'], 'unique'],
            [['check_status_id'], 'exist', 'skipOnError' => true, 'targetClass' => CheckStatus::className(), 'targetAttribute' => ['check_status_id' => 'check_status_id']],
            [['computer_detail_id'], 'exist', 'skipOnError' => true, 'targetClass' => ComputerDetail::className(), 'targetAttribute' => ['computer_detail_id' => 'computer_detail_id']],
            [['status_com'], 'exist', 'skipOnError' => true, 'targetClass' => StatusEquipment::className(), 'targetAttribute' => ['status_com' => 'status_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'computer_id' => 'Computer ID',
            'equipment_department' => 'Equipment Department',
            'equipment_university' => 'Equipment University',
            'status_com' => 'Status Com',
            'check_status_id' => 'Check Status ID',
            'computer_detail_id' => 'Computer Detail ID',
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
     * Gets query for [[ComputerDetail]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputerDetail()
    {
        return $this->hasOne(ComputerDetail::className(), ['computer_detail_id' => 'computer_detail_id']);
    }

    /**
     * Gets query for [[StatusCom]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusCom()
    {
        return $this->hasOne(StatusEquipment::className(), ['status_id' => 'status_com']);
    }

    /**
     * Gets query for [[ComputerToLayout]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputerToLayout()
    {
        return $this->hasOne(ComputerToLayout::className(), ['computer_id' => 'computer_id']);
    }
}
