<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\ActiveQuery;
use frontend\models\Elastic;

/**
 * ElasticSearch represents the model behind the search form about `frontend\models\Elastic`.
 */
class ElasticSearch extends Elastic
{

    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'created', 'first_name', 'last_name',
                'email', 'brand', 'product', 'qty',
                'sum', 'globalSearch',
            ], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Elastic::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->query = ['wildcard' => ['_all' => ['value' => '*' . $this->globalSearch . '*']]];

        return $dataProvider;
    }
}
