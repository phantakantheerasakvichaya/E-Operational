<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "computer_to_layout".
 *
 * @property int|null $row
 * @property int|null $col
 * @property int|null $number_computer
 * @property int|null $number_desk
 * @property int $layout_id
 * @property int $computer_id
 *
 * @property Computer $computer
 * @property Layout $layout
 */
class ComputerToLayout extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'computer_to_layout';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['row', 'col', 'number_computer', 'number_desk', 'layout_id', 'computer_id'], 'integer'],
            [['layout_id', 'computer_id'], 'required'],
            [['computer_id'], 'unique'],
            [['computer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Computer::className(), 'targetAttribute' => ['computer_id' => 'computer_id']],
            [['layout_id'], 'exist', 'skipOnError' => true, 'targetClass' => Layout::className(), 'targetAttribute' => ['layout_id' => 'layout_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'row' => 'Row',
            'col' => 'Col',
            'number_computer' => 'Number Computer',
            'number_desk' => 'Number Desk',
            'layout_id' => 'Layout ID',
            'computer_id' => 'Computer ID',
        ];
    }

    /**
     * Gets query for [[Computer]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComputer()
    {
        return $this->hasOne(Computer::className(), ['computer_id' => 'computer_id']);
    }

    /**
     * Gets query for [[Layout]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLayout()
    {
        return $this->hasOne(Layout::className(), ['layout_id' => 'layout_id']);
    }
}
