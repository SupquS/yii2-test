<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Zakaz */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created')->input('date') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'email')->input('email') ?>

    <div class="order-form col-sm-6">

        <?= $form->field($model, 'productItems[0][brand]')?>

        <?= $form->field($model, 'productItems[0][product]')->label('Product Name') ?>

        <?= $form->field($model, 'productItems[0][qty_item]')->input('number')->label('Quantity') ?>

        <?= $form->field($model, 'productItems[0][sum_item]')->input('double')->label('Sum per Item') ?>

    </div>
    <div class="order-form col-sm-6">
        <?= $form->field($model, 'productItems[1][brand]')?>

        <?= $form->field($model, 'productItems[1][product]')->label('Product Name') ?>

        <?= $form->field($model, 'productItems[1][qty_item]')->input('number')->label('Quantity') ?>

        <?= $form->field($model, 'productItems[1][sum_item]')->label('Sum per Item') ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
