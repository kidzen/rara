<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\AccountReportSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-report-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'YEAR') ?>

    <?= $form->field($model, 'MONTH') ?>

    <?= $form->field($model, 'item') ?>

    <?php // echo $form->field($model, 'cash_in') ?>

    <?php // echo $form->field($model, 'cash_out') ?>

    <?php // echo $form->field($model, 'margin_income') ?>

    <?php // echo $form->field($model, 'daily_cash_in') ?>

    <?php // echo $form->field($model, 'daily_cash_out') ?>

    <?php // echo $form->field($model, 'monthly_cash_in') ?>

    <?php // echo $form->field($model, 'monthly_cash_out') ?>

    <?php // echo $form->field($model, 'yearly_cash_in') ?>

    <?php // echo $form->field($model, 'yearly_cash_out') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
