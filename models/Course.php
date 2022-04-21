<?php

namespace app\models;

use Yii;

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
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['dificulty', 'trainer_id', 'created_by_id'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['desciption'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'desciption' => Yii::t('app', 'Desciption'),
            'dificulty' => Yii::t('app', 'Dificulty'),
            'trainer_id' => Yii::t('app', 'Trainer ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }
}
