<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "view_watt_computer_of_rooms".
 *
 * @property int $rooms_id
 * @property int $layout_id
 * @property int $computer_id
 * @property int|null $watt_computer
 */
class ViewWattComputerOfRooms extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'view_watt_computer_of_rooms';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rooms_id', 'layout_id', 'computer_id'], 'required'],
            [['rooms_id', 'layout_id', 'computer_id', 'watt_computer'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rooms_id' => 'Rooms ID',
            'layout_id' => 'Layout ID',
            'computer_id' => 'Computer ID',
            'watt_computer' => 'Watt Computer',
        ];
    }
}
