<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "lookup_salary".
 *
 * @property int $id
 * @property string $salary_range
 *
 * @property Member[] $members
 */
class LookupSalary extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_salary';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['salary_range'], 'required'],
            [['salary_range'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'salary_range' => 'Salary Range',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['salary_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LookupSalaryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LookupSalaryQuery(get_called_class());
    }
}
