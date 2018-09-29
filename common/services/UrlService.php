<?php

namespace app\common\services;

// 构建链接
use yii\helpers\Url;

class UrlService
{
    // 构建 web 所有的链接
    public static function buildWebUrl($path, $params = [])
    {
        $domain = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path], $params));
        return $domain['web'] . $path;
    }

    // 构建 会员端 链接
    public static function buildMUrl($path, $params = [])
    {
        $domain = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path], $params));
        return $domain['m'] . $path;
    }

    // 构建官网的链接
    public static function buildWwwUrl($path, $params = [])
    {
        $domain = \Yii::$app->params['domain'];
        $path = Url::toRoute(array_merge([$path], $params));
        return  $domain['www'] . $path;
    }

    // 空链接
    public static function buildNullUrl()
    {
        return 'javascript:void(0)';
    }
}