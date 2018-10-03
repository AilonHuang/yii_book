<?php

namespace app\controllers;

use app\common\component\BaseWebController;
use app\common\services\applog\AppLogService;
use yii\log\FileTarget;

class ErrorController extends BaseWebController
{
    public function actionError()
    {
        // 记录错误信息到文件和数据库
        $error  =\Yii::$app->errorHandler->exception;
        $err_msg = '';
        if ($error) {
            $file = $error->getFile();
            $line = $error->getLine();
            $message = $error->getMessage();
            $code = $error->getCode();

            $log = new FileTarget();
            $log->logFile = \Yii::$app->getRuntimePath() . '/logs/error.log';

            $err_msg = $message . "[File:{$file}][line:{$line}][code:{$code}][url:{$_SERVER['REQUEST_URI']}][POST_DATA:". http_build_query($_POST) ."]";

            $log->messages[] = [
                $err_msg,
                1,
                'application',
                microtime(true)
            ];

            $log->export();

            AppLogService::addErrorLog(\Yii::$app->id, $err_msg);
        }

        return $this->render('error', compact('err_msg'));
    }
}
