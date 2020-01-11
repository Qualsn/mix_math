<?php

namespace app\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserTab;

/**
 * UserTabSearch represents the model behind the search form of `app\models\UserTab`.
 */
class UserTabSearch extends UserTab
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'create_tab_id', 'team_id', 'score1', 'score2', 'score3', 'score4', 'score5', 'score6', 'score7', 'score8', 'score9', 'score10', 'create_time', 'update_time'], 'integer'],
            [['evaluate'], 'safe'],
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
        $query = UserTab::find();

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
            'user_id' => $this->user_id,
            'create_tab_id' => $this->create_tab_id,
            'team_id' => $this->team_id,
            'score1' => $this->score1,
            'score2' => $this->score2,
            'score3' => $this->score3,
            'score4' => $this->score4,
            'score5' => $this->score5,
            'score6' => $this->score6,
            'score7' => $this->score7,
            'score8' => $this->score8,
            'score9' => $this->score9,
            'score10' => $this->score10,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
        ]);

        $query->andFilterWhere(['like', 'evaluate', $this->evaluate]);

        return $dataProvider;
    }
}
