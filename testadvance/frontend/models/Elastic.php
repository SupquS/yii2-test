<?php

namespace frontend\models;

use yii\base\Model;
use yii\elasticsearch\ActiveDataProvider;
use yii\elasticsearch\ActiveRecord;
use yii\elasticsearch\Query;
use yii\elasticsearch\QueryBuilder;

/**
 * This is the model class for collection "elastic".
 *
 * @property string $_id
 * @property mixed $created
 * @property mixed $first_name
 * @property mixed $last_name
 * @property mixed $email
 * @property mixed $brand
 * @property mixed $product
 * @property integer $qty
 * @property double $sum
 * @property double $ttl_sum
 */
class Elastic extends ActiveRecord
{

    public static function index()
    {
        return 'test';
    }

    public static function type()
    {
        return 'order';
    }

    public static function mapping()
    {
        return [
            static::type() => [
                '_id' => ['path' => '_id', 'store' => 'yes'],
                'properties' => [
                    'first_name' => ['type' => 'string', 'index' => 'analyzed', 'store' => 'yes'],
                    'last_name' => ['type' => 'string'],
                    'email' => ['type' => 'string'],
                    'brand' => ['type' => 'string'],
                    'product' => ['type' => 'string'],
                    'created' => ['type' => 'date'],
                    'qty' => ['type' => 'long'],
                    'sum' => ['type' => 'double'],
                ]
            ],
        ];
    }

    public function attributes()
    {
        return [
            '_id',
            'first_name',
            'last_name',
            'email',
            'created',
            'brand',
            'product',
            'qty',
            'sum'
        ];
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'created', 'brand', 'product'],
                'safe'],
            [['first_name', 'last_name', 'email', 'created',
                'brand', 'product', 'qty', 'sum'
            ],
                'required'],
            [['qty'], 'integer'],
            [['sum'], 'double'],
            ['email', 'email'],
        ];
    }

    /**
     * @return string
     */
    public function orderName()
    {
        return $this->created . ' by ' . $this->first_name . ' ' . $this->last_name;
    }

    /**
     * @return float
     */
    public function ttlSum()
    {
        return (float)$this->qty * $this->sum;
    }

}
