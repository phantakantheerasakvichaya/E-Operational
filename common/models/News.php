<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property int $news_id
 * @property string $title
 * @property string $author
 * @property string $crtime
 * @property string $udtime
 * @property string $content
 * @property int $user_id
 *
 * @property ImgNews[] $imgNews
 * @property User $user
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['news_id', 'title', 'author', 'crtime', 'udtime', 'content', 'user_id'], 'required'],
            [['news_id', 'user_id'], 'integer'],
            [['crtime', 'udtime'], 'safe'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 100],
            [['news_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'news_id' => 'News ID',
            'title' => 'Title',
            'author' => 'Author',
            'crtime' => 'Crtime',
            'udtime' => 'Udtime',
            'content' => 'Content',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[ImgNews]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getImgNews()
    {
        return $this->hasMany(ImgNews::className(), ['news_id' => 'news_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
