<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cloud_request".
 *
 * @property int $id_cloud_request
 * @property string $firstname
 * @property string $lastname
 * @property string $student_code
 * @property string $email
 * @property string $purpose
 * @property string|null $subject
 * @property int|null $advisor_id
 * @property string|null $spec_addtion
 * @property string|null $RAM
 * @property string|null $HDD
 * @property int|null $status_advisor
 * @property int|null $status_staff
 * @property int|null $status_head_dept
 * @property string|null $descripe_advisor
 * @property string|null $descripe_staff
 * @property string|null $request_role
 * @property int $id_template_cloud
 * @property int $user_id
 *
 * @property TemplateCloud $templateCloud
 * @property User $user
 */
class CloudRequest extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cloud_request';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cloud_request', 'firstname', 'lastname', 'student_code', 'email', 'purpose', 'id_template_cloud', 'user_id'], 'required'],
            [['id_cloud_request', 'advisor_id', 'status_advisor', 'status_staff', 'status_head_dept', 'id_template_cloud', 'user_id'], 'integer'],
            [['purpose'], 'string'],
            [['firstname', 'lastname', 'email', 'subject', 'request_role'], 'string', 'max' => 100],
            [['student_code'], 'string', 'max' => 11],
            [['spec_addtion', 'descripe_advisor', 'descripe_staff'], 'string', 'max' => 255],
            [['RAM', 'HDD'], 'string', 'max' => 50],
            [['id_cloud_request'], 'unique'],
            [['id_template_cloud'], 'exist', 'skipOnError' => true, 'targetClass' => TemplateCloud::className(), 'targetAttribute' => ['id_template_cloud' => 'id_template_cloud']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cloud_request' => 'Id Cloud Request',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'student_code' => 'Student Code',
            'email' => 'Email',
            'purpose' => 'Purpose',
            'subject' => 'Subject',
            'advisor_id' => 'Advisor ID',
            'spec_addtion' => 'Spec Addtion',
            'RAM' => 'Ram',
            'HDD' => 'Hdd',
            'status_advisor' => 'Status Advisor',
            'status_staff' => 'Status Staff',
            'status_head_dept' => 'Status Head Dept',
            'descripe_advisor' => 'Descripe Advisor',
            'descripe_staff' => 'Descripe Staff',
            'request_role' => 'Request Role',
            'id_template_cloud' => 'Id Template Cloud',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[TemplateCloud]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTemplateCloud()
    {
        return $this->hasOne(TemplateCloud::className(), ['id_template_cloud' => 'id_template_cloud']);
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
