<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "rooms".
 *
 * @property int $rooms_id
 * @property string|null $rooms_name
 * @property string|null $rooms_floor
 * @property int|null $rooms_capacity
 * @property int $rooms_type_id
 * @property string|null $buildings_id
 *
 * @property ElectricDevice[] $electricDevices
 * @property ElectricEstimation[] $electricEstimations
 * @property ImgRoom[] $imgRooms
 * @property Layout $layout
 * @property RoomHour[] $roomHours
 * @property Buildings $buildings
 * @property RoomsType $roomsType
 * @property StaffOfRooms[] $staffOfRooms
 */
class Rooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rooms_id', 'rooms_type_id'], 'required'],
            [['rooms_id', 'rooms_capacity', 'rooms_type_id'], 'integer'],
            [['rooms_name'], 'string', 'max' => 100],
            [['rooms_floor'], 'string', 'max' => 2],
            [['buildings_id'], 'string', 'max' => 50],
            [['rooms_id'], 'unique'],
            [['buildings_id'], 'exist', 'skipOnError' => true, 'targetClass' => Buildings::className(), 'targetAttribute' => ['buildings_id' => 'buildings_id']],
            [['rooms_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => RoomsType::className(), 'targetAttribute' => ['rooms_type_id' => 'rooms_type_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rooms_id' => 'Rooms ID',
            'rooms_name' => 'Rooms Name',
            'rooms_floor' => 'Rooms Floor',
            'rooms_capacity' => 'Rooms Capacity',
            'rooms_type_id' => 'Rooms Type ID',
            'buildings_id' => 'Buildings ID',
        ];
    }

    /**
     * Gets query for [[ElectricDevices]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElectricDevices()
    {
        return $this->hasMany(ElectricDevice::className(), ['rooms_id' => 'rooms_id']);
    }

    /**
     * Gets query for [[ElectricEstimations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElectricEstimations()
    {
        return $this->hasMany(ElectricEstimation::className(), ['rooms_id' => 'rooms_id']);
    }

    /**
     * Gets query for [[ImgRooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImgRooms()
    {
        return $this->hasMany(ImgRoom::className(), ['rooms_id' => 'rooms_id']);
    }

    /**
     * Gets query for [[Layout]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLayout()
    {
        return $this->hasOne(Layout::className(), ['rooms_id' => 'rooms_id']);
    }

    /**
     * Gets query for [[RoomHours]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoomHours()
    {
        return $this->hasMany(RoomHour::className(), ['rooms_id' => 'rooms_id']);
    }

    /**
     * Gets query for [[Buildings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBuildings()
    {
        return $this->hasOne(Buildings::className(), ['buildings_id' => 'buildings_id']);
    }

    /**
     * Gets query for [[RoomsType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoomsType()
    {
        return $this->hasOne(RoomsType::className(), ['rooms_type_id' => 'rooms_type_id']);
    }

    /**
     * Gets query for [[StaffOfRooms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStaffOfRooms()
    {
        return $this->hasMany(StaffOfRooms::className(), ['rooms_id' => 'rooms_id']);
    }
}
