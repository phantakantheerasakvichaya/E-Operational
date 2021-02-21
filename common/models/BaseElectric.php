<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "base_electric".
 *
 * @property int $base_electric_id
 * @property string|null $base_electric_name
 */
class BaseElectric extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'base_electric';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['base_electric_id'], 'required'],
            [['base_electric_id'], 'integer'],
            [['base_electric_name'], 'string', 'max' => 150],
            [['base_electric_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'base_electric_id' => 'Base Electric ID',
            'base_electric_name' => 'Base Electric Name',
        ];
    }
}
