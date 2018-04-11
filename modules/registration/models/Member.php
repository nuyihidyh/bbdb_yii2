<?php

namespace app\modules\registration\models;

use app\models\LookupCurrency;
use app\models\LookupGuardian;
use app\models\LookupSalary;

use app\modules\user\models\User;
use Yii;

/**
 * This is the model class for table "member".
 *
 * @property int $id
 * @property string $name
 * @property string $mykad_no
 * @property string $passport_no
 * @property string $current_employer
 * @property string $position
 * @property int $salary_id
 * @property string $currency_id
 * @property string $work_address
 * @property string $city
 * @property string $state
 * @property string $country
 * @property string $work_phone
 * @property string $mobile
 * @property int $relationship
 *
 * @property LookupSalary $salary
 * @property LookupCurrency $currency
 * @property LookupGuardian $relationship0
 * @property User $id0
 * @property Student[] $students
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'current_employer', 'position', 'salary_id', 'currency_id', 'work_address',  'work_phone', 'mobile', 'relationship'], 'required'],
            [['id', 'salary_id', 'relationship'], 'integer'],
            [['work_address'], 'string'],
            [['name', 'passport_no', 'current_employer', 'position'], 'string', 'max' => 100],
            [['mykad_no'], 'string', 'max' => 12],
            [['currency_id'], 'string', 'max' => 5],
            [['work_phone', 'mobile'], 'string', 'max' => 15],
            [['id'], 'unique'],
            [['salary_id'], 'exist', 'skipOnError' => true, 'targetClass' => LookupSalary::className(), 'targetAttribute' => ['salary_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => LookupCurrency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['relationship'], 'exist', 'skipOnError' => true, 'targetClass' => LookupGuardian::className(), 'targetAttribute' => ['relationship' => 'id']],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id' => 'id']],
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
            'mykad_no' => 'Mykad No',
            'passport_no' => 'Passport No',
            'current_employer' => 'Current Employer',
            'position' => 'Position',
            'salary_id' => 'Salary ID',
            'currency_id' => 'Currency ID',
            'work_address' => 'Work Address',
            'work_phone' => 'Work Phone',
            'mobile' => 'Mobile',
            'relationship' => 'Relationship',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalary()
    {
        return $this->hasOne(LookupSalary::className(), ['id' => 'salary_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(LookupCurrency::className(), ['id' => 'currency_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRelationship0()
    {
        return $this->hasOne(LookupGuardian::className(), ['id' => 'relationship']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(User::className(), ['id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Student::className(), ['member_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return MemberQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MemberQuery(get_called_class());
    }
}
