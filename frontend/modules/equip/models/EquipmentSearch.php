<?php

namespace frontend\modules\equip\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Equipment;

/**
 * EquipmentSearch represents the model behind the search form of `common\models\Equipment`.
 */
class EquipmentSearch extends Equipment
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['equipment_department', 'type_name', 'brand_electric_device', 'spec_electric_device', 'year_electric_device', 'rooms_name', 'status_name', 'check_status_name'], 'safe'],
            [['warranty'], 'integer'],
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
        $query = Equipment::find();

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
            'warranty' => $this->warranty,
        ]);

        $query->andFilterWhere(['like', 'equipment_department', $this->equipment_department])
            ->andFilterWhere(['like', 'type_name', $this->type_name])
            ->andFilterWhere(['like', 'brand_electric_device', $this->brand_electric_device])
            ->andFilterWhere(['like', 'spec_electric_device', $this->spec_electric_device])
            ->andFilterWhere(['like', 'year_electric_device', $this->year_electric_device])
            ->andFilterWhere(['like', 'rooms_name', $this->rooms_name])
            ->andFilterWhere(['like', 'status_name', $this->status_name])
            ->andFilterWhere(['like', 'check_status_name', $this->check_status_name]);

        return $dataProvider;
    }
}
