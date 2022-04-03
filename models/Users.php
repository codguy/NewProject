<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property int $roll_id
 * @property int $state_id
 * @property string|null $dob
 * @property string $authKey
 * @property string $accessToken
 * @property string|null $gender
 * @property string|null $profile_picture
 * @property string|null $created_on
 * @property string|null $created_by_id
 * @property string|null $updated_on
 *
 * @property TblDept[] $tblDepts
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'roll_id', 'state_id', 'authKey', 'accessToken'], 'required'],
            [['roll_id', 'state_id'], 'integer'],
            [['dob', 'created_on', 'updated_on'], 'safe'],
            [['created_by_id'], 'string'],
            [['username', 'email'], 'string', 'max' => 25],
            [['password'], 'string', 'max' => 30],
            [['authKey', 'accessToken', 'gender'], 'string', 'max' => 10],
            [['profile_picture'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'roll_id' => 'Roll ID',
            'state_id' => 'State ID',
            'dob' => 'Dob',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'gender' => 'Gender',
            'profile_picture' => 'Profile Picture',
            'created_on' => 'Created On',
            'created_by_id' => 'Created By ID',
            'updated_on' => 'Updated On',
        ];
    }

    /**
     * Gets query for [[TblDepts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblDepts()
    {
        return $this->hasOne(TblDept::className(), ['created_by_id' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        $user = self::find()
        ->where([
            "id" => $id
        ])
        ->one();
//         if (!count($user)) {
//             return null;
//         }
        return new static($user);
    }
    
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) {
        
        $user = self::find()
        ->where(["accessToken" => $token])
        ->one();
        if (!count($user)) {
            return null;
        }
        return new static($user);
    }
    
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByEmail($email) {
        $user = self::find()
        ->where([
            "email" => $email
        ])
        ->one();
//         if (empty($user)) {
//             return null;
//         }
        return new static($user);
    }
    
    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }
    
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }
    
    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }
}
