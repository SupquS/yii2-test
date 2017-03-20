<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Elastic */

$this->title = 'Update Order: ' . $model->primaryKey;
$this->params['breadcrumbs'][] = ['label' => 'Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->primaryKey, 'url' => ['view', 'id' => (string)$model->primaryKey]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="zakaz-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
