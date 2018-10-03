<?php

namespace app\common\services\applog;


use app\common\services\UtilService;
use app\models\AppLog;

class AppLogService
{
    public static function addErrorLog($appname, $content)
    {
        $error = \Yii::$app->errorHandler->exception;

        $model_app_log = new AppLog();
        $model_app_log->app_name = $appname;
        $model_app_log->content = $content;
        // 获取ip

        $model_app_log->ip = UtilService::getIp();

        if (!empty($_SERVER['HTTP_USER_AGENT'])) {
            $model_app_log->ua = $_SERVER['HTTP_USER_AGENT'];
        }

        if ($error) {
            $model_app_log->err_code = $error->getCode();
            if (isset($error->statusCode)) {
                $model_app_log->http_code = $error->statusCode;
            }

            if (method_exists($error, 'getName')) {
                $model_app_log->err_name = $error->getName();
            }
        }

        $model_app_log->created_time = date('Y-m-d H:i:s');
        $model_app_log->save(0);
    }
}