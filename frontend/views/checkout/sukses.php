<?php
/** @var yii\web\View $this */
/** @var backend\models\Pesanan $modelPesanan */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Pesanan Berhasil';
?>
<div class="checkout-sukses text-center">
    <h1 class="text-3xl font-bold text-green-600 mb-4">🎉 Pesanan Anda Berhasil Dibuat!</h1>
    <p class="text-lg mb-4">Nomor Pesanan Anda adalah: 
        <strong class="text-xl">#<?= Html::encode((string)$modelPesanan->id) ?></strong>
    </p>
    <p class="text-gray-700 mb-6">
        Total tagihan Anda adalah 
        <strong class="text-red-600">Rp <?= number_format($modelPesanan->total_harga, 0, ',', '.') ?></strong>.
        Silakan lakukan pembayaran sesuai metode yang Anda pilih.
    </p>
    <a href="<?= Url::to(['/site/index']) ?>" class="text-blue-600 hover:underline">Kembali ke Homepage</a>
</div>