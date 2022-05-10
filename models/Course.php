<?php
namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "tbl_course".
 *
 * @property int $id
 * @property string $name
 * @property string|null $desciption
 * @property int|null $dificulty
 * @property int|null $trainer_id
 * @property string|null $created_on
 * @property int|null $created_by_id
 * @property string|null $updated_on
 * @property string|null $image
 *
 * @property TblUser $createdBy
 */
class Course extends \yii\db\ActiveRecord
{
    const DIFF_EASY = 1;
    
    const DIFF_NORMAL = 2;
    
    const DIFF_HARD = 3;

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_course';
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
                    'name',
                    'desciption',
                    'dificulty'
                ],
                'required'
            ],
            [
                [
                    'trainer_id',
                    'created_by_id'
                ],
                'integer'
            ],
            [
                [
                    'created_on',
                    'updated_on'
                ],
                'safe'
            ],
            [
                [
                    'name'
                ],
                'string',
                'max' => 50
            ],
            [
                [
                    'desciption'
                ],
                'string',
                'max' => 255
            ],
            [
                [
                    'image'
                ],
                'string',
                'max' => 150
            ],
            [
                [
                    'created_by_id'
                ],
                'exist',
                'skipOnError' => true,
                'targetClass' => TblUser::className(),
                'targetAttribute' => [
                    'created_by_id' => 'id'
                ]
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
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'desciption' => Yii::t('app', 'Description'),
            'dificulty' => Yii::t('app', 'Dificulty'),
            'trainer_id' => Yii::t('app', 'Trainer'),
            'created_on' => Yii::t('app', 'Created'),
            'created_by_id' => Yii::t('app', 'Created By'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'image' => Yii::t('app', 'Image')
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(TblUser::className(), [
            'id' => 'created_by_id'
        ]);
    }

    public function getTrainerOption()
    {
        $trainers = Users::find()->where([
            'roll_id' => Users::ROLE_TRAINER
        ]);
        $list = [];
        foreach ($trainers->each() as $trainer) {
            $list[$trainer->id] = $trainer->username;
        }
        return $list;
    }

    public function getRole($id)
    {
        $list = $this->getTrainerOption();
        return $list[$id];
    }

    /*
     * public function getImageUrl($image)
     * {
     * return \Yii::$app->getUrlManager()->createAbsoluteUrl($image);
     * }
     */
    public function getImageUrl()
    {
        if (! empty($this->image)) {
            return Yii::$app->request->baseUrl . '/../uploads/' . $this->image;
        } else {
            return 'https://dummyimage.com/900x400/ced4da/6c757d.jpg';
        }
    }

    public function getImage()
    {
        if (! empty($this->image)) {
            $img = '<img src=' . $this->getImageUrl() . ' height="400" width="900" class="img-fluid rounded">';
        } else {
            $img = '<img src="https://dummyimage.com/900x400/ced4da/6c757d.jpg" height="400px" width="900px" class="img-fluid rounded">';
        }
        return $img;
    }

    public function upload()
    {
        if ($this->validate(false)) {
            if (! empty($this->image)) {
                $name = substr($this->image->tempName, 16) . '.' . $this->image->extension;
                $this->image->saveAs('../uploads/' . $name);
                return $name;
            }
        } else {
            return false;
        }
    }

    public function getDificulty($diff)
    {
        $list = [
            self::DIFF_EASY => '<span class="badge badge-success">Easy</span>',
            self::DIFF_NORMAL => '<span class="badge badge-primary">Normal</span>',
            self::DIFF_HARD => '<span class="badge badge-danger">Hard</span>',
        ];
        return !empty($diff) ? $list[$diff] : $list;
    }
    
    public function getTrainer(){
        $trainer = Users::findOne($this->trainer_id);
        return $trainer->username;
    }
}
