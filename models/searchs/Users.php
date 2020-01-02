<?php

namespace app\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Users as UsersModel;

/**
 * Users represents the model behind the search form of `app\models\Users`.
 */
class Users extends UsersModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'age', 'create_time', 'update_time'], 'integer'],
            [['nick_name', 'open_id', 'country', 'province', 'city', 'sex', 'avatar_url'], 'safe'],
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
        $query = UsersModel::find();

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
            'age' => $this->age,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'nick_name', $this->nick_name])
            ->andFilterWhere(['like', 'open_id', $this->open_id])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'province', $this->province])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'sex', $this->sex])
            ->andFilterWhere(['like', 'avatar_url', $this->avatar_url]);

        return $dataProvider;
    }
}
