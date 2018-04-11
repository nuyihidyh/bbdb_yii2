<?php

namespace app\models;

use app\modules\registration\models\Member;
use Yii;

/**
 * This is the model class for table "lookup_currency".
 *
 * @property string $id
 * @property string $value
 *
 * @property Member[] $members
 */
class LookupCurrency extends \yii\db\ActiveRecord
{
    public $combined_currency;

    public function afterFind()
    {
        parent::afterFind(); // TODO: Change the autogenerated stub
        $this->combined_currency = $this->id . ' = ' . $this->value;
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'lookup_currency';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'value'], 'required'],
            [['id'], 'string', 'max' => 5],
            [['value'], 'string', 'max' => 64],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['currency_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return LookupCurrencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LookupCurrencyQuery(get_called_class());
    }
}