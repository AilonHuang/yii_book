<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class DashboardController extends Controller
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    // 仪表盘
    public function actionIndex()
    {
        return $this->render('index');
    }
}
