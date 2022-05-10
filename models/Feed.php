<?php
namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "tbl_feed".
 *
 * @property int $id
 * @property string $title
 * @property string|null $desciption
 * @property string|null $created_on
 * @property int|null $created_by_id
 * @property string|null $updated_on
 * @property string|null $image
 * @property int $state_id
 */
class Feed extends \yii\db\ActiveRecord
{

    /**
     *
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_feed';
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
                    'title'
                ],
                'required'
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
                    'created_by_id',
                    'state_id'
                ],
                'integer'
            ],
            [
                [
                    'title'
                ],
                'string',
                'max' => 50
            ],
            [
                [
                    'desciption',
                    'image'
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
            'title' => Yii::t('app', 'Title'),
            'desciption' => Yii::t('app', 'Desciption'),
            'created_on' => Yii::t('app', 'Created On'),
            'created_by_id' => Yii::t('app', 'Created By ID'),
            'updated_on' => Yii::t('app', 'Updated On'),
            'image' => Yii::t('app', 'Image'),
            'state_id' => Yii::t('app', 'State ID')
        ];
    }
    
    public function search($params)
    {
        $query = Feed::find();
        
        // add conditions that should always apply here
        
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        $this->load($params);
        
        if (!$this->validate()) {
            return $dataProvider;
        }
         
        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'roll_id' => $this->roll_id,
            'state_id' => $this->state_id,
            'dob' => $this->dob,
            'created_on' => $this->created_on,
            'updated_on' => $this->updated_on,
        ]);
        
        $query->andFilterWhere(['like', 'username', $this->username])
        ->andFilterWhere(['like', 'email', $this->email])
        ->andFilterWhere(['like', 'password', $this->password])
        ->andFilterWhere(['like', 'authKey', $this->authKey])
        ->andFilterWhere(['like', 'accessToken', $this->accessToken])
        ->andFilterWhere(['like', 'gender', $this->gender])
        ->andFilterWhere(['like', 'profile_picture', $this->profile_picture])
        ->andFilterWhere(['like', 'created_by_id', $this->created_by_id]); 
        
        return $dataProvider;
    }
    
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
}
