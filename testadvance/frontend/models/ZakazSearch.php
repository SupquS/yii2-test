<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Zakaz;

/**
 * ZakazSearch represents the model behind the search form about `frontend\models\Zakaz`.
 */
class ZakazSearch extends Zakaz
{

    public $globalSearch;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['_id', 'created', 'first_name', 'last_name',
                'email', 'brand', 'product', 'qty_item',
                'sum_item', 'globalSearch',
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
        $query = Zakaz::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->orFilterWhere(['like', '_id', $this->globalSearch])
            ->orFilterWhere(['like', 'created', $this->globalSearch])
            ->orFilterWhere(['like', 'first_name', $this->globalSearch])
            ->orFilterWhere(['like', 'last_name', $this->globalSearch])
            ->orFilterWhere(['like', 'email', $this->globalSearch])
            ->orFilterWhere(['like', 'brand', $this->globalSearch])
            ->orFilterWhere(['like', 'product', $this->globalSearch]);

        return $dataProvider;
    }
}
