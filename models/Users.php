<?php
namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use phpDocumentor\Reflection\PseudoTypes\True_;

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

    const BEGINER = 0;

    const INTERMEDIATE = 1;

    const ADVANCED = 2;

    const ROLE_ADMIN = 1;

    const ROLE_MANAGER = 2;

    const ROLE_TRAINER = 3;

    const ROLE_STUDENT = 4;
    
    const STATE_ZERO = 0;

    const STATE_ACTIVE = 1;

    const STATE_INACTIVE = 2;

    const STATE_FREEZE = 3;

    const STATE_DELETED = 4;

    const STATE_UPCOMING = 5;

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     *
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'username',
                    'email',
                    'password'
                ],
                'required'
            ],
            [
                [
                    'roll_id',
                    'state_id',
                    'created_by_id'
                ],
                'integer'
            ],
            [
                [
                    'dob',
                    'created_on',
                    'updated_on'
                ],
                'safe'
            ],
            [
                [
                    'username',
                    'email'
                ],
                'string',
                'max' => 25
            ],
            [
                [
                    'password'
                ],
                'string',
                'max' => 30
            ],
            [
                [
                    'authKey',
                    'accessToken',
                    'gender'
                ],
                'string',
                'max' => 10
            ],

            [
                [
                    'profile_picture'
                ],
                'file',
                'skipOnEmpty' => true,
                'extensions' => 'jpg, png'
            ]
        ];
    }

    /**
     *
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
            'updated_on' => 'Updated On'
        ];
    }

    /**
     * Gets query for [[TblDepts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblDepts()
    {
        return $this->hasOne(Dept::className(), [
            'created_by_id' => 'id'
        ]);
    }

    /**
     *
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        $user = self::find()->where([
            "id" => $id
        ])->one();
        // if (!count($user)) {
        // return null;
        // }
        return new static($user);
    }

    /**
     *
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null)
    {
        $user = self::find()->where([
            "accessToken" => $token
        ])->one();
        if (! count($user)) {
            return null;
        }
        return new static($user);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByEmail($email)
    {
        $user = self::find()->where([
            "email" => $email
        ])->one();
        // if (empty($user)) {
        // return null;
        // }
        return new static($user);
    }

    /**
     *
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     *
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password
     *            password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }

    public function getImageUrl()
    {
        if (! empty($this->profile_picture)) {
            return Yii::$app->request->baseUrl . '/../uploads/' . $this->profile_picture;
        } else {
            return Yii::$app->request->baseUrl . '/images/user-icon.png';
        }
    }

    public function getImage()
    {
        $img = '<img src=' . $this->getImageUrl() . ' height="60px" width="60px" class="profile_pic">';
        return $img;
    }

    // public function imageName()
    // {
    // return str_replace(" ", "_", $this->profile_picture->baseName) . '.' . $this->profile_picture->extension;
    // }
    public function upload()
    {
        if ($this->validate(false)) {
            if (! empty($this->profile_picture)) {
                $name = substr($this->profile_picture->tempName, 16) . '.' . $this->profile_picture->extension;
                $this->profile_picture->saveAs('../uploads/' . $name);
                return $name;
            }
        } else {
            return false;
        }
    }

    public function getRoleOption()
    {
        if (\Yii::$app->controller->action->id == 'sign-up') {
            $list = array(
                Users::ROLE_TRAINER => 'Trainer',
                Users::ROLE_STUDENT => 'Student'
            );
        }
        else{
            $list = array(
                Users::ROLE_ADMIN => 'Admin',
                Users::ROLE_MANAGER => 'Manager',
                Users::ROLE_TRAINER => 'Trainer',
                Users::ROLE_STUDENT => 'Student'
            );
        }
        return $list;
    }

    public function getRole($id)
    {
        $list = $this->getRoleOption();
        return $list[$id];
    }

    public function getStateOption()
    {
        $list = array(
            Users::STATE_ACTIVE => 'Active',
            Users::STATE_INACTIVE => 'Inactive',
            Users::STATE_FREEZE => 'Freezed',
            Users::STATE_DELETED => 'Deleted',
            Users::STATE_UPCOMING => 'Upcoming'
        );
        return $list;
    }

    public function getState($id)
    {
        $list = $this->getStateOption();
        return $list[$id];
    }

    public function getTableProfile($model)
    {
        $profile = $model->getImage() . " " . $model->username;
        return $profile;
    }

    public function getName()
    {
        return $this->username;
    }

    public function getBadge($id)
    {
        $list = array(
            Users::STATE_ACTIVE => 'success',
            Users::STATE_INACTIVE => 'danger',
            Users::STATE_FREEZE => 'primary',
            Users::STATE_UPCOMING => 'info',
            Users::STATE_DELETED => 'dark'
        );
        return $list[$id];
    }

    public static function getSkillBadge($data, $color)
    {
        $colors = array(
            Users::BEGINER => 'secondary',
            Users::INTERMEDIATE => 'primary',
            Users::ADVANCED => 'success'
        );
        return '<span class="m-1 p-2 badge badge-' . $colors[$color] . '">' . $data . '</span>';
    }

    public static function isAdmin($id = false)
    {
        $user = self::findOne([
            'id' => ! empty($id) ? $id : \Yii::$app->user->identity->id
        ]);
        return ($user->roll_id == self::ROLE_ADMIN) ? true : false;
    }

    public static function isManager($id = false)
    {
        $user = self::findOne([
            'id' => ! empty($id) ? $id : \Yii::$app->user->identity->id
        ]);
        return ($user->roll_id == self::ROLE_MANAGER) ? true : false;
    }

    public static function isTrainer($id = false)
    {
        $user = self::findOne([
            'id' => ! empty($id) ? $id : \Yii::$app->user->identity->id
        ]);
        return ($user->roll_id == self::ROLE_TRAINER) ? true : false;
    }

    public static function isStudent($id = false)
    {
        $user = self::findOne([
            'id' => ! empty($id) ? $id : \Yii::$app->user->identity->id
        ]);
        return ($user->roll_id == self::ROLE_STUDENT) ? true : false;
    }

    public static function isSelf($id = false)
    {
        return ($id == \Yii::$app->user->identity->getId()) ? true : false;
    }
}
