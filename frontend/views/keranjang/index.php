<?php
/** @var yii\web\View $this */
/** @var array $produkDiKeranjang */
/** @var float $totalHarga */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Keranjang Belanja';
?>

<div class="keranjang-index">
    <h1 class="text-3xl font-bold mb-6"><?= Html::encode($this->title) ?></h1>

    <?php if (empty($produkDiKeranjang)): ?>

        <p class="text-lg text-gray-600">Keranjang belanja Anda masih kosong.</p>
        <a href="<?= Url::to(['/site/index']) ?>" class="text-blue-600 hover:underline">Mulai Belanja</a>

    <?php else: ?>

        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="w-full text-sm text-left text-gray-700">
                <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                    <tr>
                        <th scope="col" class="py-3 px-6">Produk</th>
                        <th scope="col" class="py-3 px-6">Jumlah</th>
                        <th scope="col" class="py-3 px-6">Harga Satuan</th>
                        <th scope="col" class="py-3 px-6">Subtotal</th>
                        <th scope="col" class="py-3 px-6">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produkDiKeranjang as $item): ?>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="py-4 px-6 font-medium text-gray-900">
                                <?= Html::encode($item['model']->nama_produk) ?>
                            </td>
                            <td class="py-4 px-6">
                                <?= $item['jumlah'] ?>
                            </td>
                            <td class="py-4 px-6">
                                Rp <?= number_format($item['model']->harga, 0, ',', '.') ?>
                            </td>
                            <td class="py-4 px-6 font-semibold">
                                Rp <?= number_format($item['subtotal'], 0, ',', '.') ?>
                            </td>
                            <td class="py-4 px-6">
                                <!-- INI ADALAH BARIS YANG DIPERBAIKI -->
                                <a href="<?= Url::to(['/keranjang/hapus', 'id' => $item['model']->id]) ?>" class="text-red-600 hover:underline" data-method="post" data-confirm="Apakah Anda yakin ingin menghapus item ini?">
                                    Hapus
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-8">
            <div class="w-full md:w-1/3 p-6 bg-gray-100 rounded-lg shadow-md">
                <h2 class="text-2xl font-semibold mb-4">Total Belanja</h2>
                <div class="flex justify-between text-lg mb-6">
                    <span class="font-medium">Total:</span>
                    <span class="font-bold text-xl text-red-600">Rp <?= number_format($totalHarga, 0, ',', '.') ?></span>
                </div>

                <a href="<?= Url::to(['/checkout/index']) ?>" class="block w-full text-center py-3 px-6 bg-blue-600 text-white font-bold text-lg rounded-lg hover:bg-blue-700">
                    Lanjut ke Checkout
                </a>
            </div>
        </div>

    <?php endif; ?>
</div>