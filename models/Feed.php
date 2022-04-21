<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_feed".
 *
 * @property int $id
 * @property string $title
 * @property string|null $desciption
 * @property string|null $created_on
 * @property int|null $created_by_id
 * @property string|null $updated_on
 */
class Feed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_feed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['created_on', 'updated_on'], 'safe'],
            [['created_by_id'], 'integer'],
            [['title'], 'string', 'max' => 50],
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
            'title' => Yii::t('app', 'Title'),
            'desciption' => Yii::t('app', 'Desciption'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }
}
