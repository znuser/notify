<?php

namespace ZnUser\Notify\Yii2\Admin;

use yii\base\Module as YiiModule;

class Module extends YiiModule
{

//    public $layout = '/../../../Packages/Bootstrap4/layouts/main.php';
    public $defaultRoute = 'history';
    public $controllerNamespace = __NAMESPACE__ . '\Controllers';

}
