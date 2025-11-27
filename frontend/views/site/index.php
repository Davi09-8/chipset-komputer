<?php
/** @var yii\web\View $this */
/** @var array $produkTerbaru */
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = 'Chipset Computer & CCTV';
?>

<div class="site-index">

    <div class="bg-gray-200 p-12 text-center mb-8 rounded-lg">
        <h1 class="text-4xl font-bold mb-4">Selamat Datang di Chipset Computer</h1>
        <p class="text-lg">Solusi Kebutuhan IT, Komputer, dan CCTV Anda</p>
    </div>

    <h2 class="text-3xl font-bold text-center mb-6">Produk Terbaru Kami</h2>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <?php foreach ($produkTerbaru as $produk): ?>

            <div class="border rounded-lg shadow-lg overflow-hidden">

                <?php
                if ($produk->gambar) {
                    // Jika ada gambar, tampilkan gambar dari folder uploads
                        echo Html::img(\Yii::getAlias('@web/uploads/produk/') . $produk->gambar, [
                        'class' => 'w-full h-48 object-cover', // Tailwind class
                        'alt' => $produk->nama_produk
                    ]);
                } else {
                    // Jika tidak ada gambar, tampilkan placeholder
                        echo '<div class="w-full h-48 bg-gray-300 flex items-center justify-center">';
                    echo '<span class="text-gray-500">Gambar Produk</span>';
                    echo '</div>';
                }
                ?>

                <div class="p-4">
                    <h3 class="text-lg font-semibold truncate">
                        <?= Html::encode($produk->nama_produk) ?>
                    </h3>

                    <p class="text-xl font-bold text-red-600 my-2">
                        Rp <?= number_format($produk->harga, 0, ',', '.') ?>
                    </p>

                    <a href="<?= Url::to(['/produk/view', 'id' => $produk->id]) ?>" class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php endforeach; ?>

    </div>
    </div>