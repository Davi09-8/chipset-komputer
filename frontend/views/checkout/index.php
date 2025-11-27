<?php
/** @var yii\web\View $this */
/** @var backend\models\Pesanan $modelPesanan */
/** @var array $metodePembayaran */
/** @var float $totalHarga */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper; // Untuk dropdown

$this->title = 'Checkout';
?>

<div class="checkout-index">
    <h1 class="text-3xl font-bold mb-6"><?= Html::encode($this->title) ?></h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="md:col-span-2">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4">Detail Pengiriman & Pembayaran</h2>

                <?php $form = ActiveForm::begin(); ?>

                <?= $form->field($modelPesanan, 'alamat_pengiriman', [
                    'labelOptions' => ['class' => 'block text-sm font-medium text-gray-700 mb-1']
                ])->textarea([
                    'rows' => 4,
                    'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm',
                    'placeholder' => 'Masukkan alamat lengkap Anda...'
                ]) ?>

                <?= $form->field($modelPesanan, 'metode_pembayaran_id', [ // Pastikan ada kolom ini di tabel 'pesanan'
                    'labelOptions' => ['class' => 'block text-sm font-medium text-gray-700 mb-1']
                ])->dropDownList(
                    ArrayHelper::map($metodePembayaran, 'id', 'nama_metode'),
                    [
                        'prompt' => 'Pilih Metode Pembayaran',
                        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm'
                    ]
                ) ?>

                <div class="form-group mt-6">
                    <?= Html::submitButton('Buat Pesanan Sekarang', [
                        'class' => 'w-full text-center py-3 px-6 bg-blue-600 text-white font-bold text-lg rounded-lg hover:bg-blue-700'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>

        <div class="md:col-span-1">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4">Ringkasan</h2>
                <div class="flex justify-between text-lg mb-6">
                    <span class="font-medium">Total Harga:</span>
                    <span class="font-bold text-xl text-red-600">Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>
                </div>
                <p class="text-sm text-gray-600">
                    Dengan menekan "Buat Pesanan", Anda setuju dengan Syarat & Ketentuan kami.
                </p>
            </div>
        </div>

    </div>
</div>