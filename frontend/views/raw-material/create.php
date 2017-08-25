<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\RawMaterial */

$this->title = Yii::t('app', 'Create Raw Material');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Raw Materials'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="raw-material-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
