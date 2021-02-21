<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "buildings".
 *
 * @property string $buildings_id
 *
 * @property Rooms[] $rooms
 */
class Buildings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buildings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['buildings_id'], 'required'],
            [['buildings_id'], 'string', 'max' => 50],
            [['buildings_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'buildings_id' => 'Buildings ID',
        ];
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['buildings_id' => 'buildings_id']);
    }
}
