<?php

namespace frontend\models;

use frontend\models\Elastic;
use yii\base\Model;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\Query;
use yii\elasticsearch\QueryBuilder;

class Search extends Elastic
{

    public function SearchAny($value)
    {
        $searches = $value['search'];
        $query = new Query();
        $db = Elastic::getDb();
        $queryBuilder = new QueryBuilder($db);
        $match = ['wildcard' => ['_all' => ['value' => '*' . $searches . '*']]];
        $query->query = $match;
        $build = $queryBuilder->build($query);
        $re = $query->search($db, $build);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 50],
        ]);

        return $dataProvider;
    }
}