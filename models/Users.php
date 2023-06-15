<?php

namespace app\models;

use Yii;

use yii\base\NotSupportedException;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string|null $firstName
 * @property string|null $lastName
 * @property string $username
 * @property string|null $password
 * @property string|null $authKey
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['firstName', 'lastName', 'username', 'password'], 'string', 'max' => 255],
            [['authKey'], 'string', 'max' => 1],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'username' => 'Username',
            'password' => 'Password',
            'authKey' => 'Auth Key',
        ];
    }
    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw  new NotSupportedException();
    }
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
    public static function findByUsername($username){
        return self::findOne(['username'=>$username]);
    }
    public function validatePassword($password){
        return $this->password === $password;
    }
}
