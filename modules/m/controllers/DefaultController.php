<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    // 品牌首页
    public function actionIndex()
    {
        return $this->render('index');
    }
}
