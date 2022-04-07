<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_dept".
 *
 * @property int $id
 * @property string $name
 * @property string|null $field
 * @property string|null $school_name
 * @property int|null $hod_id
 * @property string|null $created_on
 * @property int|null $created_by_id
 * @property string|null $updated_on
 *
 * @property TblUser $createdBy
 */
class Dept extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_dept';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['hod_id', 'created_by_id'], 'integer'],
            [['created_on', 'updated_on'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['field', 'school_name'], 'string', 'max' => 25],
            [['created_by_id'], 'exist', 'skipOnError' => true, 'targetClass' => TblUser::className(), 'targetAttribute' => ['created_by_id' => 'id']],
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
            'field' => Yii::t('app', 'Field'),
            'school_name' => Yii::t('app', 'School Name'),
            'hod_id' => Yii::t('app', 'Hod ID'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID'),
            'updated_on' => Yii::t('app', 'Updated On'),
        ];
    }

    /**
     * Gets query for [[CreatedBy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'created_by_id']);
    }
}
