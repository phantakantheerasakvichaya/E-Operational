<?php

namespace frontend\modules\fixed\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Fix;

/**
 * FixSearch represents the model behind the search form of `common\models\Fix`.
 */
class FixSearch extends Fix
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fix_id', 'request_at', 'request_by', 'repair_by', 'repair_at', 'feedback', 'fix_status_id'], 'integer'],
            [['content', 'request_detail', 'fix_photo', 'equipment_department', 'location'], 'safe'],
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
        $query = Fix::find();

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
            'fix_id' => $this->fix_id,
            'request_at' => $this->request_at,
            'request_by' => $this->request_by,
            'repair_by' => $this->repair_by,
            'repair_at' => $this->repair_at,
            'feedback' => $this->feedback,
            'fix_status_id' => $this->fix_status_id,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'request_detail', $this->request_detail])
            ->andFilterWhere(['like', 'fix_photo', $this->fix_photo])
            ->andFilterWhere(['like', 'equipment_department', $this->equipment_department])
            ->andFilterWhere(['like', 'location', $this->location]);

        return $dataProvider;
    }
}
