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

    // 我的页面
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }

    // 我的地址列表
    public function actionAddress()
    {
        $this->layout = false;
        return $this->render('address');
    }

    // 添加或编辑收货地址
    public function actionAddress_set()
    {
        $this->layout = false;
        return $this->render('address_set');
    }

    // 我的收藏
    public function actionFav()
    {
        $this->layout = false;
        return $this->render('fav');
    }

    // 我的评论列表
    public function actionComment()
    {
        $this->layout = false;
        return $this->render('comment');
    }

    // 我要评论
    public function actionComment_set()
    {
        $this->layout = false;
        return $this->render('comment_set');
    }
}
