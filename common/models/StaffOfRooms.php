<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "staff_of_rooms".
 *
 * @property int $person_id
 * @property int $rooms_id
 *
 * @property Rooms $rooms
 */
class StaffOfRooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'staff_of_rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['person_id', 'rooms_id'], 'required'],
            [['person_id', 'rooms_id'], 'integer'],
            [['person_id'], 'unique'],
            [['rooms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['rooms_id' => 'rooms_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'person_id' => 'Person ID',
            'rooms_id' => 'Rooms ID',
        ];
    }

    /**
     * Gets query for [[Rooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRooms()
    {
        return $this->hasOne(Rooms::className(), ['rooms_id' => 'rooms_id']);
    }
}
