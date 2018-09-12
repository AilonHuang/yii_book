<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class DashboardController extends Controller
{
    // 仪表盘
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }
}
