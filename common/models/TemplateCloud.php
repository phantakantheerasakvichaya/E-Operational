<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "template_cloud".
 *
 * @property int $id_template_cloud
 * @property string $spec_cloud
 *
 * @property CloudRequest[] $cloudRequests
 */
class TemplateCloud extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'template_cloud';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_template_cloud', 'spec_cloud'], 'required'],
            [['id_template_cloud'], 'integer'],
            [['spec_cloud'], 'string', 'max' => 255],
            [['id_template_cloud'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_template_cloud' => 'Id Template Cloud',
            'spec_cloud' => 'Spec Cloud',
        ];
    }

    /**
     * Gets query for [[CloudRequests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCloudRequests()
    {
        return $this->hasMany(CloudRequest::className(), ['id_template_cloud' => 'id_template_cloud']);
    }
}
