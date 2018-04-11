<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "campus_programme".
 *
 * @property int $id
 * @property int $programme_id
 * @property int $campus_id
 *
 * @property Application[] $applications
 * @property LookupCampus $campus
 * @property LookupProgramme $programme
 */
class CampusProgramme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campus_programme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['programme_id', 'campus_id'], 'required'],
            [['programme_id', 'campus_id'], 'integer'],
            [['campus_id'], 'exist', 'skipOnError' => true, 'targetClass' => LookupCampus::className(), 'targetAttribute' => ['campus_id' => 'id']],
            [['programme_id'], 'exist', 'skipOnError' => true, 'targetClass' => LookupProgramme::className(), 'targetAttribute' => ['programme_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'programme_id' => 'Programme ID',
            'campus_id' => 'Campus ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::className(), ['campus_programme_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampus()
    {
        return $this->hasOne(LookupCampus::className(), ['id' => 'campus_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProgramme()
    {
        return $this->hasOne(LookupProgramme::className(), ['id' => 'programme_id']);
    }

    /**
     * @inheritdoc
     * @return CampusProgrammeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CampusProgrammeQuery(get_called_class());
    }
}
