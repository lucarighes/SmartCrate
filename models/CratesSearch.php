<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Crates;
use yii\data\ArrayDataProvider;
use yii\db\Query;

/**
 * CratesSearch represents the model behind the search form of `app\models\Crates`.
 */
class CratesSearch extends Crates
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_company'], 'integer'],
            [['content'], 'safe'],
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
        $query = (new Query())
            ->select('crates.id, crates.content, companies.company')
            ->from('crates')
            ->leftJoin('companies', '`companies`.`id` = `crates`.`id_company`')
            ->all();

        return new ArrayDataProvider(['allModels' => $query]);
    }

    public function searchUnion($params)
    {
        $query = Crates::find();


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
            //'id_company' => $this->id_company,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content]);

        return $dataProvider;
    }
}
