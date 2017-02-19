<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $firstName
 * @property string $lastName
 * @property integer $role
 */
class Users extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'firstName', 'lastName'], 'required'],
            [['password','user_image'], 'string'],
            [['role'], 'integer'],
            [['email'], 'email'],
            [['firstName', 'lastName'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['file'], 'file','extensions' => 'png, jpg,gif,jpeg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'firstName' => 'First Name',
            'lastName' => 'Last Name',
            'role' => 'Role',
            'file' => 'Upload avatar'
        ];
    }
	
		
 /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
       return static::findOne($id);
    }

    /**
     * @inheritdoc
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
    public static function findByUsername($username)
    {
       return self::findOne(['email'=>$username]);
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
		//throw new NotSupportedException();
    }

    /**
     * @inheritdoc
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
		
		if (Yii::$app->getSecurity()->validatePassword($password, $this->password)) {
			return true;
		}
    }
}
