<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CampusProgramme]].
 *
 * @see CampusProgramme
 */
class CampusProgrammeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return CampusProgramme[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return CampusProgramme|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
