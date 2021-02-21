<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "layout".
 *
 * @property int $layout_id
 * @property int|null $rowsize
 * @property int|null $colsize
 * @property string|null $desk
 * @property string|null $walkway
 * @property int $rooms_id
 *
 * @property ComputerToLayout[] $computerToLayouts
 * @property Rooms $rooms
 */
class Layout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'layout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['layout_id', 'rooms_id'], 'required'],
            [['layout_id', 'rowsize', 'colsize', 'rooms_id'], 'integer'],
            [['desk', 'walkway'], 'string', 'max' => 255],
            [['rooms_id'], 'unique'],
            [['layout_id'], 'unique'],
            [['rooms_id'], 'exist', 'skipOnError' => true, 'targetClass' => Rooms::className(), 'targetAttribute' => ['rooms_id' => 'rooms_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'layout_id' => 'Layout ID',
            'rowsize' => 'Rowsize',
            'colsize' => 'Colsize',
            'desk' => 'Desk',
            'walkway' => 'Walkway',
            'rooms_id' => 'Rooms ID',
        ];
    }

    /**
     * Gets query for [[ComputerToLayouts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputerToLayouts()
    {
        return $this->hasMany(ComputerToLayout::className(), ['layout_id' => 'layout_id']);
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
