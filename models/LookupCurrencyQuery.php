<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LookupCurrency]].
 *
 * @see LookupCurrency
 */
class LookupCurrencyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LookupCurrency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LookupCurrency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
