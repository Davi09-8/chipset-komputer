<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var backend\models\MetodePembayaran $model */

$this->title = 'Update Metode Pembayaran: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Metode Pembayarans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="metode-pembayaran-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
