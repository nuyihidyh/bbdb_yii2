<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lookup_guardian".
 *
 * @property int $id
 * @property string $name
 *
 * @property Member[] $members
 */
class LookupGuardian extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_guardian';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['relationship' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LookupGuardianQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LookupGuardianQuery(get_called_class());
    }
}
