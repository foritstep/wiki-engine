<?php

namespace app\models;

use app\models\Editor;
use Yii;

class User extends \yii\base\Object implements \yii\web\IdentityInterface
{
    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $e = Editor::findOne(['nick' => $id]);
        if($e != null) {
            $u = new static();
            $u->id = $u->username = $e->nick;
            $u->password = $e->password;
            return $u;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        die;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        $e = Editor::findOne(['nick' => $username]);
        if($e != null) {
            $u = new static();
            $u->id = $u->username = $e->nick;
            $u->password = $e->password;
            return $u;
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        die;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        die;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }
}
