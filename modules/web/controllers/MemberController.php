<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class MemberController extends Controller
{
    // 会员列表
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }

    // 会员编辑或添加
    public function actionSet()
    {
        $this->layout = false;
        return $this->render('set');
    }

    // 会员详情
    public function actionInfo()
    {
        $this->layout = false;
        return $this->render('info');
    }
}
