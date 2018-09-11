<?php

namespace app\modules\web\controllers;

use yii\web\Controller;

class BookController extends Controller
{
    // 图书列表
    public function actionIndex()
    {
        $this->layout = false;
        return $this->render('index');
    }

    // 图书编辑或添加
    public function actionSet()
    {
        $this->layout = false;
        return $this->render('set');
    }

    // 图书详情
    public function actionInfo()
    {
        $this->layout = false;
        return $this->render('info');
    }

    // 图书图片资源
    public function actionImages()
    {
        $this->layout = false;
        return $this->render('images');
    }
}
