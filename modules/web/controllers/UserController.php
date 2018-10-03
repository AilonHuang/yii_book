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
        if (\Yii::$app->request->isGet) {
            // 获取当前登陆人的信息
            return $this->render('edit', ['user_info' => $this->current_user]);
        }

        $nickname = trim($this->post('nickname', ''));
        $email = trim($this->post('email', ''));

        if (mb_strlen($nickname) < 1) {
            return $this->renderJson([], '请输入合法的姓名', -1);
        }

        if (mb_strlen($email) < 1) {
            return $this->renderJson([], '请输入合法的邮箱', -1);
        }

        $user_info = $this->current_user;
        $user_info->nickname = $nickname;
        $user_info->email = $email;
        $user_info->update(0);
        return $this->renderJson([], '编辑成功');
    }

    // 重置当前登录人密码
    public function actionResetPwd()
    {
        if (\Yii::$app->request->isGet) {
            return $this->render('reset_pwd', ['user_info' => $this->current_user]);
        }

        $old_password = trim($this->post('old_password', ''));
        $new_password = trim($this->post('new_password', ''));

        if (mb_strlen($old_password) < 1) {
            return $this->renderJson([], '请输入原密码', -1);
        }

        if (mb_strlen($new_password) < 6) {
            return $this->renderJson([], '请输入不小于6个字符的新密码', -1);
        }

        if ($old_password == $new_password) {
            return  $this->renderJson([], '请重新输入, 新密码和原密码不能一样', -1);
        }

        // 判断原密码是否证确
        $user_info = $this->current_user;
        $auth_pwd = md5($old_password . md5($user_info['login_salt']));
        if ($auth_pwd != $user_info['login_pwd']) {
            return $this->renderJson([], '原密码不正确', -1);
        }

        $user_info->login_pwd = md5($new_password . md5($user_info['login_salt']));
        $user_info->update(0);

        $this->setLoginStatus($user_info);

        return $this->renderJson([], '重置密码成功');

    }

    // 退出登陆
    public function actionLogout()
    {
        $this->removeLoginStatus();
        return $this->redirect(UrlService::buildWebUrl('/user/login'));
    }
}
