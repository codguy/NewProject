<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Course as CourseModel;

/**
 * Course represents the model behind the search form of `app\models\Course`.
 */
class Course extends CourseModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'dificulty', 'trainer_id', 'created_by_id'], 'integer'],
            [['name', 'desciption', 'created_on', 'updated_on', 'image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = CourseModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'dificulty' => $this->dificulty,
            'trainer_id' => $this->trainer_id,
            'created_on' => $this->created_on,
            'created_by_id' => $this->created_by_id,
            'updated_on' => $this->updated_on,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desciption', $this->desciption])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
