<?php

namespace app\modules\registration\models;

/**
 * This is the ActiveQuery class for [[Application]].
 *
 * @see Application
 */
class ApplicationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Application[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Application|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
