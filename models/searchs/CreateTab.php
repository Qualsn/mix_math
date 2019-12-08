<?php

namespace app\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CreateTab as CreateTabModel;

/**
 * CreateTab represents the model behind the search form of `app\models\CreateTab`.
 */
class CreateTab extends CreateTabModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'tab_id', 'member_num', 'sum', 'create_time', 'update_time', 'is_del'], 'integer'],
            [['host', 'title', 'address', 'content_per1', 'content_per2', 'content_per3', 'content_per4', 'content_per5', 'content_per6', 'content_per7', 'content_per8', 'content_per9', 'content_per10', 'comment'], 'safe'],
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
        $query = CreateTabModel::find();

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
            'tab_id' => $this->tab_id,
            'member_num' => $this->member_num,
            'sum' => $this->sum,
            'create_time' => $this->create_time,
            'update_time' => $this->update_time,
            'is_del' => $this->is_del,
        ]);

        $query->andFilterWhere(['like', 'host', $this->host])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'content_per1', $this->content_per1])
            ->andFilterWhere(['like', 'content_per2', $this->content_per2])
            ->andFilterWhere(['like', 'content_per3', $this->content_per3])
            ->andFilterWhere(['like', 'content_per4', $this->content_per4])
            ->andFilterWhere(['like', 'content_per5', $this->content_per5])
            ->andFilterWhere(['like', 'content_per6', $this->content_per6])
            ->andFilterWhere(['like', 'content_per7', $this->content_per7])
            ->andFilterWhere(['like', 'content_per8', $this->content_per8])
            ->andFilterWhere(['like', 'content_per9', $this->content_per9])
            ->andFilterWhere(['like', 'content_per10', $this->content_per10])
            ->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}