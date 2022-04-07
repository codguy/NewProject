<?php

namespace app\models;

use Yii;

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
class TblUser extends \yii\db\ActiveRecord
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
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'roll_id' => Yii::t('app', 'Roll ID'),
            'state_id' => Yii::t('app', 'State ID'),
            'dob' => Yii::t('app', 'Dob'),
            'authKey' => Yii::t('app', 'Auth Key'),
            'accessToken' => Yii::t('app', 'Access Token'),
            'gender' => Yii::t('app', 'Gender'),
            'profile_picture' => Yii::t('app', 'Profile Picture'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }

    /**
     * Gets query for [[TblDepts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblDepts()
    {
        return $this->hasMany(TblDept::className(), ['created_by_id' => 'id']);
    }
}
