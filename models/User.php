<?php

namespace app\models;

use PHPUnit\Util\PHP\AbstractPhpProcess;
use Yii;
use yii\web\IdentityInterface;
use yii\web\UploadedFile;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $first_last_name
 * @property string $birthday
 * @property string $avatar
 * @property string $role
 * @property string $avatarUrl
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    public $newpassword;
    public $avatarfile;

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
            [['birthday'], 'safe'],
            [['login', 'avatar', 'password', 'first_last_name', 'role'], 'string', 'max' => 255],
            [['login'], 'unique', 'on' => 'default'],
            [['login'], 'unique', 'on' => 'signup'],
            ['role', 'default', 'value' => 'user'],
            [['login', 'password', 'first_last_name'], 'trim'],
            [['login', 'password', 'first_last_name'], 'required', 'on' => 'signup'],
            [['first_last_name'], 'validateFirstLastNames', 'on' => 'signup'],
            [['login', 'password'], 'required', 'on' => 'signin'],
            [['newpassword'], 'string'],
            [['avatarfile'], 'file', 'extensions' => ['jpg', 'png', 'jpeg']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'first_last_name' => 'Фамилия и Имя',
            'birthday' => 'Дата рождения',
            'avatar' => 'Аватар',
            'role' => 'Роль',
        ];
    }

    public function validateFirstLastNames($attr, $params, $validator)
    {
        if (count(explode(' ', $this->$attr)) != 2) {
            $this->addError($attr, 'Фамилия и Имя должны быть написаны через пробел');
        }
    }

    public function signup()
    {
        $this->scenario = 'signup';
        if ($this->validate()) {
            $this->password = md5($this->password);
            Yii::$app->session->setFlash('success', 'Вы успешно создали аккаунт');
        }
        return $this->save();
    }

    public function signin()
    {
        $this->scenario = 'signin';

        if ($this->validate()) {
            $user = User::find()->where(['login' => $this->login, 'password' => md5($this->password)])->one();
            if ($user) {
                Yii::$app->session->setFlash('success', 'Вы успешно вошли');
                Yii::$app->user->login($user);
                return $user;
            }
            $this->addError('login', 'Неверный логин или пароль');
        }
        return false;
    }

    public function updateData()
    {
        if ($this->newpassword) {
            $this->password = md5($this->newpassword);
        }
        $file = UploadedFile::getInstance($this, 'avatarfile');
        if ($file) {

            $filename = uniqid() . '.' . $file->extension;
            $file->saveAs('avatars/'.$filename);
            $this->avatar = $filename;
        }

        $this->scenario = 'signup';
        if ($this->validate()) {
            Yii::$app->session->setFlash('success', 'Вы успешно изменили данные');
        }
        return $this->save();
    }

    public function getAvatarUrl(){

        if($this->avatar) {
            return '/avatars/'.$this->avatar;
        }
        return null;
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }
}
