<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "fix_status".
 *
 * @property int $fix_status_id
 * @property string $fix_status_name
 *
 * @property Fix[] $fixes
 */
class FixStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fix_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fix_status_name'], 'required'],
            [['fix_status_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fix_status_id' => 'Fix Status ID',
            'fix_status_name' => 'Fix Status Name',
        ];
    }

    /**
     * Gets query for [[Fixes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFixes()
    {
        return $this->hasMany(Fix::className(), ['fix_status_id' => 'fix_status_id']);
    }
}
