<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_social_link".
 *
 * @property int $id
 * @property string $platform
 * @property string $link
 * @property int $user_id
 * @property string|null $created_on
 * @property string|null $updated_on
 */
class SocialLink extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_social_link';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['platform', 'link', 'user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['platform', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'platform' => Yii::t('app', 'Platform'),
            'link' => Yii::t('app', 'Link'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }
}
