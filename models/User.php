<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $uid 用户uid
 * @property string $nickname 用户名
 * @property string $mobile 手机号码
 * @property string $email 邮箱地址
 * @property int $sex 性别 1-男 2-女 0-未填写
 * @property string $avatar 头像
 * @property string $login_name 登陆用户名
 * @property string $login_pwd 登陆密码
 * @property string $login_salt 登陆密码的随机密钥
 * @property int $status 1-有效 0-无效
 * @property string $updated_time 最后一次更新时间
 * @property string $created_time 创建时间
 */
class User extends \yii\db\ActiveRecord
{

    // 设置密码
    public function setPassword($password) {
        $this->login_pwd = $this->getSaltPassword($password);
    }

    // 生成加密密码
    public function getSaltPassword($password)
    {
        return md5($password . md5($this->login_salt));
    }

    // 校验密码是否一志
    public function verifyPassword($password)
    {
        return $this->getSaltPassword($password) == $this->login_pwd;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sex', 'status'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['nickname', 'email'], 'string', 'max' => 100],
            [['mobile', 'login_name'], 'string', 'max' => 20],
            [['avatar'], 'string', 'max' => 64],
            [['login_pwd', 'login_salt'], 'string', 'max' => 32],
            [['login_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'uid' => 'Uid',
            'nickname' => 'Nickname',
            'mobile' => 'Mobile',
            'email' => 'Email',
            'sex' => 'Sex',
            'avatar' => 'Avatar',
            'login_name' => 'Login Name',
            'login_pwd' => 'Login Pwd',
            'login_salt' => 'Login Salt',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
