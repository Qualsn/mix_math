<?php

namespace app\models;

class User extends \yii\base\BaseObject implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    public $nickName;
    public static $users = [];


    public static function setUser($username,$password){
        $list = [];
        $where = [
//            'id'=>$id
            'and',
            ['email' => $username],
            ['password' => $password]
        ];
        $result = Users::find()->select(['id','nick_name','email','password'])->where($where)->asArray()->all();

        foreach ($result as $item) {
            $list[$item['id']] = ['id'=>$item['id'],'username'=>$item['email'],'nickName'=>$item['nick_name'],'password'=>$item['password'],'authKey' => 'test101key', 'accessToken' => '101-token',];

        }
        self::$users = $list;
        return self::$users;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {

        $session = \Yii::$app->session;
//var_dump($session['user']);die();

        return isset($session['user']['id'])&&($session['user']['id'] == $id) ? new static($session['user']) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }



        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username,$password)
    {
//        var_dump($password);die();
        self::setUser($username,$password);
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {

                return new static($user);
            }
        }


        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
