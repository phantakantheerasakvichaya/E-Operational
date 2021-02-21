<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "room_hour".
 *
 * @property int $room_hour_id
 * @property int $academic_year
 * @property int $semester
 * @property string $start_date
 * @property string $end_date
 * @property float $monday_hour
 * @property float $tuesday_hour
 * @property float $wednesday_hour
 * @property float $thursday_hour
 * @property float $friday_hour
 * @property float $saturday_hour
 * @property float $sunday_hour
 * @property int $rooms_id
 *
 * @property Rooms $rooms
 */
class RoomHour extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'room_hour';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_hour_id', 'academic_year', 'semester', 'start_date', 'end_date', 'monday_hour', 'tuesday_hour', 'wednesday_hour', 'thursday_hour', 'friday_hour', 'saturday_hour', 'sunday_hour', 'rooms_id'], 'required'],
            [['room_hour_id', 'academic_year', 'semester', 'rooms_id'], 'integer'],
            [['start_date', 'end_date'], 'safe'],
            [['monday_hour', 'tuesday_hour', 'wednesday_hour', 'thursday_hour', 'friday_hour', 'saturday_hour', 'sunday_hour'], 'number'],
            [['room_hour_id'], 'unique'],
            [['rooms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['rooms_id' => 'rooms_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'room_hour_id' => 'Room Hour ID',
            'academic_year' => 'Academic Year',
            'semester' => 'Semester',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'monday_hour' => 'Monday Hour',
            'tuesday_hour' => 'Tuesday Hour',
            'wednesday_hour' => 'Wednesday Hour',
            'thursday_hour' => 'Thursday Hour',
            'friday_hour' => 'Friday Hour',
            'saturday_hour' => 'Saturday Hour',
            'sunday_hour' => 'Sunday Hour',
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
