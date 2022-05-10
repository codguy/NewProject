<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_chapter".
 *
 * @property int $id
 * @property string $title
 * @property string|null $desciption
 * @property int|null $dificulty
 * @property int|null $course_id
 * @property string|null $created_on
 * @property int|null $created_by_id
 * @property string|null $updated_on
 */
class Chapter extends \yii\db\ActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_chapter';
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
                    'title',
                    'desciption',
                    'dificulty'
                ],
                'required'
            ],
            [
                [
                    'dificulty',
                    'course_id',
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
                    'title'
                ],
                'string',
                'max' => 50
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
            'title' => Yii::t('app', 'Title'),
            'desciption' => Yii::t('app', 'Desciption'),
            'dificulty' => Yii::t('app', 'Dificulty'),
            'course_id' => Yii::t('app', 'Course ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID'),
            'updated_on' => Yii::t('app', 'Updated On')
        ];
    }
}
