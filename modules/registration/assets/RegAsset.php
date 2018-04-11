<?php

namespace app\modules\registration\assets;

use yii\web\AssetBundle;

/**
 * Created by PhpStorm.
 * User: user
 * Date: 08-Dec-17
 * Time: 2:48 PM
 */

class RegAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/registration.css',
    ];
    public $js = [
    ];
    public $depends = [
        'app\assets\AppAsset'
    ];
}
