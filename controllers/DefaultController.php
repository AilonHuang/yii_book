<?php

namespace app\controllers;

use app\common\component\BaseWebController;

class DefaultController extends BaseWebController
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
