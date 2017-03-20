<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\models\Elastic;

/* @var $this yii\web\View */
/* @var $model frontend\models\Elastic */

$this->title = $model->orderName();
$model->_id = $model->primaryKey;
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
            [
                'attribute' => 'created',
                'format' => 'date'
            ],
            'first_name',
            'last_name',
            'email',
        ]
    ]) ?>
    <h3>Order Details:</h3>
</div>
<div class="zakaz-view col-sm-12">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'brand',
            'product',
            'qty',
            [
                'attribute' => 'sum',
                'label' => 'Sum per Item',
                'format' => ['Currency','€']
////                'format' => ['decimal',2]
            ],
            [   'attribute' => 'ttlSum',
                'label' => 'To be Paid',
                'format' => ['Currency','€'],
                'value' => $model->ttlSum()
            ],
        ],
    ]) ?>
</div>
