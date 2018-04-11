<?php

namespace app\modules\registration\models;

use app\models\CampusProgramme;
use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property int $student_id
 * @property string $submit_datetime +8 gmt
 * @property int $campus_programme_id
 *
 * @property CampusProgramme $campusProgramme
 * @property Student $student
 */
class Application extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'submit_datetime', 'campus_programme_id'], 'required'],
            [['student_id', 'campus_programme_id'], 'integer'],
            [['submit_datetime'], 'safe'],
            [['campus_programme_id'], 'exist', 'skipOnError' => true, 'targetClass' => CampusProgramme::className(), 'targetAttribute' => ['campus_programme_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Student::className(), 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Student ID',
            'submit_datetime' => 'Submit Datetime',
            'campus_programme_id' => 'Campus Programme ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampusProgramme()
    {
        return $this->hasOne(CampusProgramme::className(), ['id' => 'campus_programme_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Student::className(), ['id' => 'student_id']);
    }

    /**
     * @inheritdoc
     * @return ApplicationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ApplicationQuery(get_called_class());
    }
}
