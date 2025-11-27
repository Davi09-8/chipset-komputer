<?php
/** @var yii\web\View $this */
/** @var backend\models\Produk $model */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->nama_produk; // Set judul halaman
?>

<div class="produk-view">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div>
            <?php
                if ($model->gambar) {
                echo Html::img(\Yii::getAlias('@web/uploads/produk/') . $model->gambar, [
                    'class' => 'w-full h-auto rounded-lg shadow-lg object-cover',
                    'alt' => $model->nama_produk
                ]);
            } else {
                echo '<div class="w-full h-96 bg-gray-300 flex items-center justify-center rounded-lg shadow-lg">';
                echo '<span class="text-gray-500">Gambar Tidak Tersedia</span>';
                echo '</div>';
            }
            ?>
        </div>

        <div>
            <h1 class="text-4xl font-bold mb-4"><?= Html::encode($model->nama_produk) ?></h1>

            <div class="text-3xl font-bold text-red-600 mb-6">
                Rp <?= number_format($model->harga, 0, ',', '.') ?>
            </div>

            <div class="mb-6">
                <span class="font-semibold">Stok:</span>
                <span class="text-lg"><?= $model->stok > 0 ? 'Tersedia' : 'Habis' ?> (<?= $model->stok ?>)</span>
            </div>

            <div class="prose max-w-none mb-8">
                <p class="font-semibold">Deskripsi:</p>
                <?= nl2br(Html::encode($model->deskripsi_panjang)) ?>
            </div>

            <a href="<?= Url::to(['/keranjang/tambah', 'id' => $model->id]) ?>" class="w-full text-center py-3 px-6 bg-green-600 text-white font-bold text-lg rounded-lg hover:bg-green-700" data-method="post">
                + Tambah ke Keranjang
            </a>
        </div>

    </div>
</div>