<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $role
 * @property string $username
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property string $pass
 */
class User extends \yii\db\ActiveRecord
{

    public $pass;

    /**
     * @return array
     */
    public static function listStatus(){
        return [
            \common\models\User::STATUS_ACTIVE => Yii::t('app', 'Активный'),
            \common\models\User::STATUS_BANNED => Yii::t('app', 'Забанен'),
        ];
    }

    /**
     * @return string
     */
    public function getStatusName(){
        $r = self::listStatus();
        return isset($r[$this->status]) ? $r[$this->status] : $r[\common\models\User::STATUS_ACTIVE];
    }

    /**
     * @return array
     */
    public static function listRole(){
        return [
            \common\models\User::ROLE_USER => Yii::t('app', 'Пользователь'),
            \common\models\User::ROLE_MANAGER => Yii::t('app', 'Менеджер'),
            \common\models\User::ROLE_ADMIN => Yii::t('app', 'Админ'),
        ];
    }

    /**
     * @return string
     */
    public function getRoleName(){
        $r = self::listRole();
        return isset($r[$this->role]) ? $r[$this->role] : $r[\common\models\User::ROLE_USER];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'string'],
            [['username', 'email', 'password_hash'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['pass'], 'string', 'min' => 6, 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'role' => Yii::t('app', 'Role'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'pass' => Yii::t('app', 'Password'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
