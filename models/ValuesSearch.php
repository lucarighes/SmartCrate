<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Values;
use yii\data\ArrayDataProvider;
use yii\db\Query;
/**
 * ValuesSearch represents the model behind the search form of `app\models\Values`.
 */
class ValuesSearch extends Values
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_crate', 'humidity', 'hydrogen', 'oxigen'], 'integer'],
            [['date'], 'safe'],
            [['temperature', 'latitude', 'longitude'], 'number'],
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
    public function search($params, $id)
    {
        $query = Values::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query->where(['id_crate' => $id]),

        ]);
        
      /* return new ArrayDataProvider([
            'allModels' => $query->where(['id_crate' => $id]),         
            'key' => 'Review_ID',
        ]);
*/
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_crate' => $this->id_crate,
            'date' => $this->date,
            'temperature' => $this->temperature,
            'humidity' => $this->humidity,
            'hydrogen' => $this->hydrogen,
            'oxigen' => $this->oxigen,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ]);

        return $dataProvider;
    }
}
