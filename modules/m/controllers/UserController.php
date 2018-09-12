<?php

namespace app\modules\m\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    // 账号绑定
    public function actionBind()
    {
        $this->layout = false;
        return $this->render('bind');
    }

    // 我的购物车
    public function actionCart()
    {
        $this->layout = false;
        return $this->render('cart');
    }

    // 我的订单列表
    public function actionOrder()
    {
        $this->layout = false;
        return $this->render('order');
    }
}
