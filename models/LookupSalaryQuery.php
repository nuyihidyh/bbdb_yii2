<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LookupSalary]].
 *
 * @see LookupSalary
 */
class LookupSalaryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LookupSalary[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LookupSalary|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
