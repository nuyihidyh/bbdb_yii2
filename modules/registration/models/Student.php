<?php

namespace app\modules\registration\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $gender 0- male, 1-female
 * @property string $dob
 * @property string $pob
 * @property string $mykid_no
 * @property string $passport_no
 * @property string $home_address
 * @property int $member_id
 *
 * @property Application[] $applications
 * @property Member $member
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'gender', 'dob', 'pob', 'home_address'], 'required'],
            [['gender', 'member_id'], 'integer'],
            [['dob'], 'safe'],
            [['first_name', 'last_name', 'pob', 'passport_no'], 'string', 'max' => 100],
            [['mykid_no'], 'string', 'max' => 12],
            [['home_address'], 'string', 'max' => 200],
            [['member_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['member_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'pob' => 'Pob',
            'mykid_no' => 'Mykid No',
            'passport_no' => 'Passport No',
            'home_address' => 'Home Address',
            'member_id' => 'Member ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['student_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['id' => 'member_id']);
    }

    /**
     * @inheritdoc
     * @return StudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StudentQuery(get_called_class());
    }
}
