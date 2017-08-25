<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AccountReport */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-report-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'date')->textInput() ?>

    <?= $form->field($model, 'YEAR')->textInput() ?>

    <?= $form->field($model, 'MONTH')->textInput() ?>

    <?= $form->field($model, 'item')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cash_in')->textInput() ?>

    <?= $form->field($model, 'cash_out')->textInput() ?>

    <?= $form->field($model, 'margin_income')->textInput() ?>

    <?= $form->field($model, 'daily_cash_in')->textInput() ?>

    <?= $form->field($model, 'daily_cash_out')->textInput() ?>

    <?= $form->field($model, 'monthly_cash_in')->textInput() ?>

    <?= $form->field($model, 'monthly_cash_out')->textInput() ?>

    <?= $form->field($model, 'yearly_cash_in')->textInput() ?>

    <?= $form->field($model, 'yearly_cash_out')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
