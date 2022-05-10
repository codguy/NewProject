<?php
namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_discussion".
 *
 * @property int $id
 * @property string|null $model
 * @property int $model_id
 * @property int|null $user_id
 * @property int|null $replied_to
 * @property string $message
 * @property string|null $created_on
 * @property int|null $created_by_id
 * @property string|null $updated_on
 */
class Discussion extends \yii\db\ActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_discussion';
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
                    'model_id',
                    'message'
                ],
                'required'
            ],
            [
                [
                    'model_id',
                    'user_id',
                    'replied_to',
                    'created_by_id'
                ],
                'integer'
            ],
            [
                [
                    'created_on',
                    'replied_to',
                    'updated_on'
                ],
                'safe'
            ],
            [
                [
                    'model',
                    'message'
                ],
                'string',
                'max' => 255
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
            'model' => Yii::t('app', 'Model'),
            'model_id' => Yii::t('app', 'Model ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'replied_to' => Yii::t('app', 'Replied To'),
            'message' => Yii::t('app', 'Message'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }
}
