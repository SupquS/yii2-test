<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\Zakaz */

$this->title = $model->getOrderName();
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zakaz-view col-sm-12">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Edit', ['update', 'id' => (string)$model->_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => (string)$model->_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('To Order List', ['index'], ['class' => 'btn btn-warning pull-right']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            '_id',
            'created',
            'first_name',
            'last_name',
            'email',
        ]
    ]) ?>
    <h3>Order Details:</h3>
</div>
    <div class="col-sm-6">
    <h4 class="alert-danger">Order Item 1:</h4>
    <?= DetailView::widget([
        'model' => $model['productItems'][0],
        'attributes' => [
            'brand',
            'product',
            'qty_item',
            'sum_item',
        ]
    ]) ?>
    </div>
    <div class="col-sm-6">
    <h4 class="alert-danger">Order Item 2:</h4>
    <?= DetailView::widget([
        'model' => $model['productItems'][1],
        'attributes' => [
            'brand',
            'product',
            'qty_item',
            'sum_item',
        ],
    ]) ?>
    </div>
<!--    <div class="col-sm-12">-->
<!--    <h4 class="alert-success">Total to be paid</h4>-->
<!--    </div>-->

