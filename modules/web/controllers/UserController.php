<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class UserController extends Controller
{
    // 登陆页面
    public function actionLogin()
    {
        $this->layout = false;
        return $this->render('login');
    }

    // 编辑当前登录人信息
    public function actionEdit()
    {
        $this->layout = false;
        return $this->render('edit');
    }

    // 重置当前登录人密码
    public function actionResetPwd()
    {
        $this->layout = false;
        return $this->render('reset_pwd');
    }
}
