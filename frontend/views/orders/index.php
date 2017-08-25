<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\OrdersSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="orders-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_form', ['model' => $model, 'modelItems' => $modelItems]); ?>

<!--    <p>
    <?= Html::a(Yii::t('app', 'Create Orders'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>-->
    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'order_id',
//            'id',
            'order.type',
            'type',
//            'order.order_no',
            'order.order_by',
            'order.contact_refference',
            'order.order_date',
            'order.required_date',
            'item',
            'description:ntext',
            'quantity',
            'quantity_unit',
            'weight',
            'weight_unit',
            'size',
            'size_unit',
            'unit_price',
            'time_required',
            'notes:ntext',
            // 'status',
            // 'created_at',
            // 'updated_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
