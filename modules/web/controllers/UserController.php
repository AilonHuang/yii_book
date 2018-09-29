<?php

namespace app\modules\web\controllers;

use app\common\services\UrlService;
use app\models\User;
use app\modules\web\controllers\common\BaseController;

class UserController extends BaseController
{
    public function __construct($id, $module, array $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->layout = 'main';
    }

    // 登陆页面
    public function actionLogin()
    {
        if (\Yii::$app->request->isGet) {
            $this->layout = 'user';
            return $this->render('login');
        }
        $login_name = trim($this->post('login_name', ''));
        $login_pwd = trim($this->post('login_pwd', ''));

        if (!$login_name || !$login_pwd) {
            return $this->renderJs('请输入正确的用户名和密码', UrlService::buildWebUrl('/user/login'));
        }

        $user_info = User::find()->where(['login_name' => $login_name])->one();
        if (!$user_info) {
            return $this->renderJs('请输入正确的用户名和密码', UrlService::buildWebUrl('/user/login'));
        }
        // 验证密码
        // 加密算法 md5(login_pad + md5(login_salt))
        $auth_pwd = md5($login_pwd . md5($user_info['login_salt']));
        if ($auth_pwd != $user_info['login_pwd']) {
            return $this->renderJs('请输入正确的用户名和密码', UrlService::buildWebUrl('/user/login'));
        }

        // 保存用户登陆状态
        // cookies 保存
        // 加密字符串 + # + uid, 加密字符串 = md5(login_name + login_pwd + login_salt)
        $this->setLoginStatus($user_info);
        return $this->redirect(UrlService::buildWebUrl('/dashboard/index'));

    }

    // 编辑当前登录人信息
    public function actionEdit()
    {
        return $this->render('edit');
    }

    // 重置当前登录人密码
    public function actionResetPwd()
    {
        return $this->render('reset_pwd');
    }

    // 退出登陆
    public function actionLogout()
    {
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl('/user/login'));
    }
}
