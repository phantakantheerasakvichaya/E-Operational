<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "img_room".
 *
 * @property int $img_room_id
 * @property string $name_img_room
 * @property string $path_img_room
 * @property string|null $type
 * @property int $rooms_id
 *
 * @property Rooms $rooms
 */
class ImgRoom extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'img_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img_room_id', 'name_img_room', 'path_img_room', 'rooms_id'], 'required'],
            [['img_room_id', 'rooms_id'], 'integer'],
            [['name_img_room'], 'string', 'max' => 100],
            [['path_img_room'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20],
            [['img_room_id'], 'unique'],
            [['rooms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['rooms_id' => 'rooms_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'img_room_id' => 'Img Room ID',
            'name_img_room' => 'Name Img Room',
            'path_img_room' => 'Path Img Room',
            'type' => 'Type',
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
