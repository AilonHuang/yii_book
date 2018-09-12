<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class FinanceController extends Controller
{
    // 账户列表
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }

    // 账户编辑或添加
    public function actionAccount()
    {
        $this->layout = false;
        return $this->render('account');
    }

    // 账户详情
    public function actionPay_info()
    {
        $this->layout = false;
        return $this->render('pay_info');
    }
}
