<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_like".
 *
 * @property int $id
 * @property string|null $model
 * @property int $model_id
 * @property int $user_id
 * @property string|null $created_on
 * @property string|null $updated_on
 */
class Like extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_like';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_id', 'user_id'], 'required'],
            [['model_id', 'user_id'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['model'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'model' => Yii::t('app', 'Model'),
            'model_id' => Yii::t('app', 'Model ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }
}
