<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Alerts;

/**
 * AlertsSearch represents the model behind the search form of `app\models\Alerts`.
 */
class AlertsSearch extends Alerts
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_values'], 'integer'],
            [['severity', 'domain', 'note', 'date'], 'safe'],
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
        $query = Alerts::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['attributes' => ['date','severity','domain', 'id']]
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
            'id_values' => $this->id_values,
        ]);

        $query->andFilterWhere(['like', 'severity', $this->severity])
            ->andFilterWhere(['like', 'domain', $this->domain])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
