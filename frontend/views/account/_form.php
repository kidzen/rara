<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

//use kartik\widgets\DatePicker;
//use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model common\models\Account */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="account-form">
	<?php $form = ActiveForm::begin(); ?>
	<div class="row">
		<div class="col-sm-3">
			<?=
			$form->field($model, 'type')
			->dropdownlist([
				'ONLINE TRANSFER' => 'ONLINE TRANSFER',
				'CASH' => 'CASH',
				'ORDER CAKE' => 'ORDER CAKE',
				'CASH OUT TO BANK' => 'CASH OUT TO BANK',
				])
				?>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<?=
				$form->field($model, 'date')->widget(DatePicker::className(), [
//        'convertFormat' => true,
//                'type' => DatePicker::TYPE_INLINE,
					'options' => ['placeholder' => 'Enter order date ...', 'value' => isset(Yii::$app->session['date']) ? Yii::$app->session['date'] : date('Y-m-d'),],
					'pluginOptions' => [
					'format' => 'yyyy-mm-dd',
					'autoclose' => true
					]
					])
					?>
				</div>
				<div class="col-sm-4">
					<?=
					$form->field($model, 'item')
                    // ->textinput(['maxlength' => true,'autofocus'=>true
					->dropdownlist([
                        // 'PAKAI BUANG' => 'PAKAI BUANG',
						'ONLINE PAYMENT ORDER' => 'ONLINE PAYMENT ORDER',
						'ONLINE PAYMENT TRAINING' => 'ONLINE PAYMENT TRAINING',
						'ORDER CAKE' => 'ORDER CAKE',
						'BALANCE CAKE' => 'BALANCE CAKE',
						'AMBILAN' => 'AMBILAN',
						'STOK' => 'STOK',
						'CHILLER CAKE' => 'CHILLER CAKE',
						'BANK' => 'BANK',
						'DECO' => 'DECO',
                        // 'CHILLER DESERT' => 'CHILLER DESERT',
                        // 'ORDER DESERT' => 'ORDER DESERT',
						], ['autofocus' => true])
						?>
					</div>
        <!--        <div class="col-sm-4">
        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
    </div>-->
</div>
<!--     <div class="row">
        <div class="col-sm-4">
            <?= $form->field($model, 'cash')->textInput() ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'balance')->textInput(['readOnly' => true]) ?>
        </div>
    </div> -->
    <div class="row">
    	<div id="field_cashin" class="col-sm-3">
    		<?= $form->field($model, 'cash_in')->textInput() ?>
    	</div>
    	<div id="field_cashout" class="col-sm-3">
    		<?= $form->field($model, 'cash_out')->textInput() ?>
    	</div>
    </div>
    <div class="row">
    	<div class="col-sm-4">
    		<?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>
    	</div>
    </div>
    <div class="form-group">
    	<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<< JS
$('#account-cash_in').change(function () {
	var price = $('#account-cash_in').val();
	var paid = $('#account-cash').val();
	if (price && paid) {
		$('#account-balance').val(paid - price);
	}
});
$('#account-cash').change(function () {
	var price = $('#account-cash_in').val();
	var paid = $('#account-cash').val();
	if (price && paid) {
		$('#account-balance').val(paid - price);
	}
});
$('#account-item').change(function () {
	var item = $('#account-item').val();
	if (
		item == 'BALANCE CAKE' 
	|| item == 'BALANCE CAKE' 
	|| item == 'ORDER CAKE' 
	|| item == 'CHILLER CAKE' 
	) {
		$('#field_cashin').show();
		$('#field_cashout').hide();
	} else if (
	item == 'AMBILAN' 
	|| item == 'STOK'
	) {
		$('#field_cashin').hide();
		$('#field_cashout').show();
	}
});

JS;
$this->registerJs($js);
