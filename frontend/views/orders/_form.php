<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;
use bajadev\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model common\models\Orders */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="orders-form">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form' ]); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'type')->dropDownList(['ONLINE' => 'ONLINE', 'WALK IN' => 'WALK IN']) ?>
            <?= $form->field($model, 'order_no')->textInput(['maxlength' => true, 'readOnly' => true]) ?>
            <?= $form->field($model, 'order_by')->textInput(['maxlength' => true, 'autofocus' => true]) ?>
            <?= $form->field($model, 'contact_refference')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($model, 'order_date')->widget(DatePicker::className(), [
//        'convertFormat' => true,
                'type' => DatePicker::TYPE_INLINE,
                'options' => ['placeholder' => 'Enter order date ...', 'value' => isset(Yii::$app->session['date']) ? Yii::$app->session['date'] : date('Y-m-d'),],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true
                ]
            ])
            ?>
        </div>
        <div class="col-sm-3">
            <?=
            $form->field($model, 'required_date')->widget(DatePicker::className(), [
//        'convertFormat' => true,
                'type' => DatePicker::TYPE_INLINE,
                'options' => ['placeholder' => 'Enter required date ...',],
                'pluginOptions' => [
                    'format' => 'yyyy-mm-dd',
                    'autoclose' => true
                ]
            ])
            ?>
        </div>

    </div>
    <?php
    DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
//                    'limit' => 4, // the maximum times, an element can be cloned (default 999)
        'min' => 1, // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelItems[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'ID',
            'INVENTORY_ID',
            'RQ_QUANTITY',
        ],
    ]);

//            var_dump($transaction->APPROVED);die();
    ?>
    <div class="container-items"><!-- widgetContainer -->
        <?php foreach ($modelItems as $i => $modelItem): ?>
            <div class="item panel panel-default"><!-- widgetBody -->
                <div class="panel-heading">
                    <h3 class="panel-title pull-left">Items</h3>
                    <div class="pull-right">
                        <button type = "button" class = "add-item btn btn-success btn-xs"><i class = "glyphicon glyphicon-plus"></i></button>
                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <?php
                    // necessary for update action.
                    if (!$modelItem->isNewRecord) {
                        echo Html::activeHiddenInput($modelItem, "[{$i}]ID");
                    }
                    ?>
                    <div class="row">
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]type")->dropDownList(['CAKE' => 'CAKE', 'DESERT' => 'DESERT']) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]item")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]description")->textarea(['rows' => 3]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]quantity")->textInput() ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]quantity_unit")->dropDownList(['PCS' => 'PCS', 'UNIT' => 'UNIT']) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]weight")->textInput(['maxlength' => true]) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]weight_unit")->dropDownList(['KG' => 'KG', 'GRAM' => 'GRAM']) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]size")->textInput() ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]size_unit")->dropDownList(['INCH' => 'INCH', 'CM' => 'CM']) ?>
                        </div>
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]unit_price")->textInput() ?>
                        </div>
                        <div class="col-sm-3">
                            <?=
                            $form->field($modelItem, "[{$i}]time_required")->widget(kartik\widgets\TimePicker::className(), [
                                'pluginOptions' => [
                                    'showSeconds' => false,
                                    'showMeridian' => false,
                                    'minuteStep' => 10,
                                ]
                            ])
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?= $form->field($modelItem, "[{$i}]notes")->textarea(['rows' => 3]) ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php DynamicFormWidget::end(); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Kemaskini'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

</div>

<!--<div class="form-group">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>-->

<?php ActiveForm::end(); ?>

</div>
