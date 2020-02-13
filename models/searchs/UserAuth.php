<?php

namespace app\models\searchs;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserAuth as UserAuthModel;

/**
 * UserAuth represents the model behind the search form of `app\models\UserAuth`.
 */
class UserAuth extends UserAuthModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'auth_id', 'create_time', 'is_del'], 'integer'],
            [['user_id'], 'safe'],
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
        $query = UserAuthModel::find();

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
            'auth_id' => $this->auth_id,
            'create_time' => $this->create_time,
            'is_del' => $this->is_del,
        ]);

        $query->andFilterWhere(['like', 'user_id', $this->user_id]);

        return $dataProvider;
    }
}
