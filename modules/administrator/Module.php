<?php

namespace app\modules\administrator;

use yii\web\ForbiddenHttpException;

/**
 * administrator module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'app\modules\administrator\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if(\Yii::$app->user->isGuest){
            \Yii::$app->response->redirect(['/user/login']);
            \Yii::$app->response->send();
        }else {

            if (!\Yii::$app->user->can('admin')) {
                throw new ForbiddenHttpException('You are not admin');
            }
             //custom initialization code goes here
        }
    }
}
