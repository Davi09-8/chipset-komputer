<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\MetodePembayaran $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="metode-pembayaran-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_metode')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nomor_rekening')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
