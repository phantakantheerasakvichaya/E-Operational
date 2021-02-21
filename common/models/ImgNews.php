<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "img_news".
 *
 * @property int $img_news_id
 * @property string $name_img_news
 * @property string $path_img_news
 * @property string|null $type ประเภท cover
 * @property int $news_id
 *
 * @property News $news
 */
class ImgNews extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'img_news';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['img_news_id', 'name_img_news', 'path_img_news', 'news_id'], 'required'],
            [['img_news_id', 'news_id'], 'integer'],
            [['name_img_news'], 'string', 'max' => 100],
            [['path_img_news'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 20],
            [['img_news_id'], 'unique'],
            [['news_id'], 'exist', 'skipOnError' => true, 'targetClass' => News::className(), 'targetAttribute' => ['news_id' => 'news_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'img_news_id' => 'Img News ID',
            'name_img_news' => 'Name Img News',
            'path_img_news' => 'Path Img News',
            'type' => 'Type',
            'news_id' => 'News ID',
        ];
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasOne(News::className(), ['news_id' => 'news_id']);
    }
}
