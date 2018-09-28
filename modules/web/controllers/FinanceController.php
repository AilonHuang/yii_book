<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class FinanceController extends Controller
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    // 账户列表
    public function actionIndex()
    {
        return $this->render('index');
    }

    // 账户编辑或添加
    public function actionAccount()
    {
        return $this->render('account');
    }

    // 账户详情
    public function actionPay_info()
    {
        return $this->render('pay_info');
    }
}
