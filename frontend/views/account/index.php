<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Accounts');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_form', ['model' => $model]); ?>

    <?php Pjax::begin(); ?>    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'date',
            'item',
//            'description:ntext',
            'cash_out',
            'cash_in',
            'notes:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
    <h2><?= Html::encode($this->title.' Daily Report') ?></h2>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataDaily,
        'filterModel' => $searchDaily,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'date',
            'daily_cash_out',
            'daily_cash_in',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
    <h2><?= Html::encode($this->title.' Monthly Report') ?></h2>
    <?php Pjax::begin(); ?>
    <?=
    GridView::widget([
        'dataProvider' => $dataMonthly,
        'filterModel' => $searchMonthly,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'year',
            'month',
            'monthly_cash_out',
            'monthly_cash_in',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <h2><?= Html::encode($this->title.' Yearly Report') ?></h2>
    <?=
    GridView::widget([
        'dataProvider' => $dataYearly,
        'filterModel' => $searchYearly,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'year',
            'yearly_cash_out',
            'yearly_cash_in',
//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php Pjax::end(); ?>
</div>
