<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_skill".
 *
 * @property int $id
 * @property string|null $model
 * @property int $model_id
 * @property string $skill
 * @property string|null $created_on
 * @property string|null $updated_on
 * @property int $level
 */
class Skill extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_skill';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['model_id', 'skill'], 'required'],
            [['model_id', 'level'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['model'], 'string', 'max' => 255],
            [['skill'], 'string', 'max' => 25],
            ['skill', 'unique']
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
            'skill' => Yii::t('app', 'Skill'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'level' => Yii::t('app', 'Level'),
        ];
    }
}
