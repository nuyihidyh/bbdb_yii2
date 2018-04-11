<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lookup_programme".
 *
 * @property int $id
 * @property string $programme_name
 * @property int $programme_type 0 - preshool, 1 - international
 *
 * @property CampusProgramme[] $campusProgrammes
 */
class LookupProgramme extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_programme';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['programme_name', 'programme_type'], 'required'],
            [['programme_type'], 'integer'],
            [['programme_name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'programme_name' => 'Programme Name',
            'programme_type' => 'Programme Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampusProgrammes()
    {
        return $this->hasMany(CampusProgramme::className(), ['programme_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LookupProgrammeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LookupProgrammeQuery(get_called_class());
    }
}
