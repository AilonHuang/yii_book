<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

class PayController extends Controller
{
    // 购买支付页面
    public function actionBuy()
    {
        $this->layout = false;
        return $this->render('buy');
    }
}
