<?php

namespace app\modules\web\controllers\common;


use app\common\component\BaseWebController;
use app\common\services\UrlService;
use app\models\User;

// web 统一控制器会做一些 web 独有的验证
// 1 指定特定的布局文件
// 2 进行登陆验证

class BaseController extends BaseWebController
{
    protected $auth_cookie_name = 'book';
    public $current_user = null; // 当前登陆人信息

    public $allowAllAction = [
        'web/user/login'
    ];

    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    // 统一登陆验证
    public function beforeAction($action)
    {
        // 验证是否登陆
        $is_login = $this->checkLoginStatus();
        if (in_array($action->getUniqueId(), $this->allowAllAction)) {
            return true;
        }
        if (!$is_login) {
            if (\Yii::$app->request->isAjax) {
                $this->renderJson([], '未登录, 请先登陆', -302);
            } else {
                $this->redirect(UrlService::buildWebUrl('/user/login'));
            }
            return false;
        }
        return true;
    }

    // 验证当前登陆是否有效
    public function checkLoginStatus()
    {
        $auth_cookie = $this->getCookie('book', '');
        if (!$auth_cookie) {
            return false;
        }

        list($auth_token, $uid) = explode('#', $auth_cookie);
        if (!$auth_token || !$uid) {
            return false;
        }

        if (!preg_match('/^\d$/', $uid)) {
            return false;
        }

        $user_info = User::find()->where(['uid' => $uid])->one();
        if (!$user_info) {
            return false;
        }

        if ($auth_token != $this->geneAuthToken($user_info)) {
            return false;
        }

        $this->current_user = $user_info;

        return true;
    }

    // 设置登陆态的方法
    public function setLoginStatus($user_info)
    {
        $auth_token = $this->geneAuthToken($user_info);
        $this->setCookie($this->auth_cookie_name, $auth_token.'#'.$user_info['uid']);
    }

    public function removeLoginStatus()
    {
        $this->removeCookie($this->auth_cookie_name);
    }

    // 统一生成加密字段
    // 加密字符串 + # + uid, 加密字符串 = md5(login_name + login_pwd + login_salt)
    public function geneAuthToken($user_info)
    {
        return md5($user_info['login_name'] . $user_info['login_pwd'] . $user_info['login_salt']);
    }
}
