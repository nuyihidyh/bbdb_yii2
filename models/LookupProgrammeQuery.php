<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[LookupProgramme]].
 *
 * @see LookupProgramme
 */
class LookupProgrammeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return LookupProgramme[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return LookupProgramme|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
