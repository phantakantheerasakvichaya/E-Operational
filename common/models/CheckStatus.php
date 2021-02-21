<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "check_status".
 *
 * @property int $check_status_id
 * @property string $check_status_name
 *
 * @property Computer[] $computers
 * @property ElectricDevice[] $electricDevices
 */
class CheckStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'check_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['check_status_name'], 'required'],
            [['check_status_name'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'check_status_id' => 'Check Status ID',
            'check_status_name' => 'Check Status Name',
        ];
    }

    /**
     * Gets query for [[Computers]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputers()
    {
        return $this->hasMany(Computer::className(), ['check_status_id' => 'check_status_id']);
    }

    /**
     * Gets query for [[ElectricDevices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElectricDevices()
    {
        return $this->hasMany(ElectricDevice::className(), ['check_status_id' => 'check_status_id']);
    }
}
