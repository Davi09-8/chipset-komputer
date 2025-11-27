<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\Pesanan $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="pesanan-form">

    <?php $form = ActiveForm::begin(); ?>

    <!-- Kita tampilkan info pesanan agar admin tahu -->
    <div class="alert alert-info">
        <p><strong>Nomor Pesanan:</strong> #<?= $model->id ?></p>
        <p><strong>User ID:</strong> <?= $model->user_id ?></p>
        <p><strong>Total:</strong> Rp <?= number_format($model->total_harga, 0, ',', '.') ?></p>
        <p><strong>Alamat:</strong> <?= Html::encode($model->alamat_pengiriman) ?></p>
    </div>

    <hr>
    <h3 class="mt-4">Update Status Pesanan</h3>

    <?php 
    // HANYA tampilkan dropdown untuk status_pesanan
    // Semua textInput lainnya (user_id, total_harga, dll) kita sembunyikan
    ?>

    <?= $form->field($model, 'status_pesanan')->dropDownList(
        [
            // Daftar ini HARUS SAMA dengan 'range' di rules Model
            'Menunggu Pembayaran' => 'Menunggu Pembayaran',
            'Diproses' => 'Diproses',
            'Dikirim' => 'Dikirim',
            'Selesai' => 'Selesai',
            'Dibatalkan' => 'Dibatalkan',
        ],
        ['prompt' => 'Pilih Status Baru...']
    ) ?>

    <div class="form-group mt-4">
        <?= Html::submitButton('Simpan Status', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>