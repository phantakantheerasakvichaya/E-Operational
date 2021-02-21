<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rooms_type".
 *
 * @property int $rooms_type_id
 * @property string $rooms_type_name
 * @property string|null $rooms_name_eng
 *
 * @property Rooms[] $rooms
 */
class RoomsType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rooms_type_id', 'rooms_type_name'], 'required'],
            [['rooms_type_id'], 'integer'],
            [['rooms_type_name', 'rooms_name_eng'], 'string', 'max' => 100],
            [['rooms_type_id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rooms_type_id' => 'Rooms Type ID',
            'rooms_type_name' => 'Rooms Type Name',
            'rooms_name_eng' => 'Rooms Name Eng',
        ];
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasMany(Rooms::className(), ['rooms_type_id' => 'rooms_type_id']);
    }
}
