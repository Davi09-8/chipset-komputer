<?php
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

use yii\helpers\Html;
use yii\grid\GridView; // Kita akan gunakan GridView Yii

$this->title = 'Riwayat Pesanan Saya';
?>

<div class="pesanan-index">
    <h1 class="text-3xl font-bold mb-6"><?= Html::encode($this->title) ?></h1>

    <div class="overflow-x-auto shadow-md rounded-lg">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'w-full text-sm text-left text-gray-700'],
            'headerRowOptions' => ['class' => 'text-xs text-gray-700 uppercase bg-gray-100'],
            'rowOptions' => ['class' => 'bg-white border-b hover:bg-gray-50'],
            'columns' => [
                [
                    'attribute' => 'id',
                    'label' => 'No. Pesanan',
                    'headerOptions' => ['class' => 'py-3 px-6'],
                    'contentOptions' => ['class' => 'py-4 px-6 font-medium'],
                ],
                [
                    'attribute' => 'tanggal_pesanan',
                    'format' => ['datetime', 'php:d M Y, H:i'], // Format tanggal
                    'headerOptions' => ['class' => 'py-3 px-6'],
                    'contentOptions' => ['class' => 'py-4 px-6'],
                ],
                [
                    'attribute' => 'total_harga',
                    'format' => 'raw', // Agar bisa diformat
                    'value' => function ($model) {
                        // Format sebagai Rupiah
                        return '<span class="font-bold">Rp ' . number_format($model->total_harga, 0, ',', '.') . '</span>';
                    },
                    'headerOptions' => ['class' => 'py-3 px-6'],
                    'contentOptions' => ['class' => 'py-4 px-6'],
                ],
                [
                    'attribute' => 'status_pesanan',
                    'format' => 'raw',
                    'value' => function ($model) {
                        // Beri warna status
                        $badgeClass = 'bg-yellow-200 text-yellow-800'; // Default
                        if ($model->status_pesanan == 'Selesai') {
                            $badgeClass = 'bg-green-200 text-green-800';
                        } elseif ($model->status_pesanan == 'Dibatalkan') {
                            $badgeClass = 'bg-red-200 text-red-800';
                        }
                        return '<span class="text-xs font-semibold mr-2 px-2.5 py-0.5 rounded ' . $badgeClass . '">' 
                            . Html::encode($model->status_pesanan) 
                            . '</span>';
                    },
                    'headerOptions' => ['class' => 'py-3 px-6'],
                    'contentOptions' => ['class' => 'py-4 px-6'],
                ],
            ],
            'summary' => '', // Sembunyikan "Showing 1-1 of 1 items."
        ]); ?>
    </div>
</div>