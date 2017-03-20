<?php

use yii\grid\SerialColumn;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\ElasticSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders List in ElasticSearch';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="zakaz-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin() ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => SerialColumn::class],
//            [
//                'attribute' => '_id',
//                'value' => 'primaryKey'],
            'first_name',
            'last_name',
            'email',
            [
                'attribute' => 'created',
                'format' => 'date',
            ],
            'brand',
            'product',
            'qty',
            'sum',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, $model) {
                    return [$action, 'id' => $model->primaryKey];
                }
            ],
        ],
    ]); ?>
    <?php \yii\widgets\Pjax::end() ?>
</div>
