<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lookup_campus".
 *
 * @property int $id
 * @property string $campus_name
 *
 * @property CampusProgramme[] $campusProgrammes
 */
class LookupCampus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_campus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['campus_name'], 'required'],
            [['campus_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'campus_name' => 'Campus Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampusProgrammes()
    {
        return $this->hasMany(CampusProgramme::className(), ['campus_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LookupCampusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LookupCampusQuery(get_called_class());
    }

    public function getProgrammes(){
        return $this->hasMany(LookupProgramme::className(), ['id' => 'programme_id'])
            ->viaTable('campus_programme', ['campus_id' => 'id']);
    }
}
