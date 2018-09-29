<?php

namespace app\common\component;

use yii\web\Controller;

/**
 * Class BaseWebController
 * @package app\common\component
 * 集成常用公共方法, 提供给所有 Controller 使用
 * get post setCookie getCookie removeCookie renderJson
 */
class BaseWebController extends Controller
{
    public $enableCsrfValidation = false; // 关闭 csrf

    // 获取 http get 参数
    public function get($key, $default_val = '')
    {
        return \Yii::$app->request->get($key, $default_val);
    }

    // 获取 http post 参数
    public function post($key, $default_val = '')
    {
        return \Yii::$app->request->get($key, $default_val);
    }

    // 设置 Cookie 值
    public function setCookie($name, $value, $expire = 0)
    {
        $cookies = \Yii::$app->response->cookies;
        $cookies->add(new \Yii\web\Cookie(
            [
                'name' => $name,
                'value' => $value,
                'expire' => $expire,
            ]
        ));
    }

    // 获取 Cookie
    public function getCookie($name, $default_val = '')
    {
        $cookie = \Yii::$app->request->cookies;
        return $cookie->getValue($name, $default_val);
    }

    // 删除 Cookie
    public function removeCookie($name)
    {
        $cookie = \Yii::$app->response->cookies;
        $cookie->remove($name);
    }

    // api 统一返回 json 格式
    public function renderJson($data = [], $msg = 'ok', $code = 200)
    {
        header('Content-type: application/json');
        echo json_encode([
            'code' => $code,
            'msg' => $msg,
            'data' => $data,
            'req_id' => uniqid()
        ], JSON_UNESCAPED_UNICODE);
    }
}