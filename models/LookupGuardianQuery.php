<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LookupGuardian]].
 *
 * @see LookupGuardian
 */
class LookupGuardianQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LookupGuardian[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LookupGuardian|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
