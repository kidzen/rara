<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\AccountReport */

$this->title = Yii::t('app', 'Create Account Report');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Account Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="account-report-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
