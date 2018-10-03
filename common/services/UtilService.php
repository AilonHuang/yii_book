<?php

namespace app\common\services;

// 只封装通用方法
class UtilService
{
    public static function getIp()
    {
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }
        return $_SERVER['REMOTE_ADDR'];
    }
}