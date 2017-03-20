<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Elastic */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="zakaz-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'created')->widget(\yii\widgets\MaskedInput::className(),[
            'mask' => '9999-99-99',
    ]) ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'email')->input('email') ?>

        <div class="order-form col-sm-6 col-sm-offset-3">
        <?= $form->field($model, 'brand')->dropDownList([
            'Apple' => 'Apple',
            'Samsung' => 'Samsung',
            'Nokia' => 'Nokia',
        ],
            ['prompt' => 'Select Brand']
        ) ?>

        <?= $form->field($model, 'product')->label('Product Name')->dropDownList([
            'iPhone' => 'iPhone',
            'iPad' => 'iPad',
            'Galaxy' => 'Galaxy',
            '3310' => '3310'
        ],
            ['prompt' => 'Select Product']
            ) ?>

        <?= $form->field($model, 'qty')->input('number')->label('Quantity') ?>

        <?= $form->field($model, 'sum')->input('integer')->label('Sum per Item') ?>
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
            </div>
        </div>


    <?php ActiveForm::end(); ?>
</div>

