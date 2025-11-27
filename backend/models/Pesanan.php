<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pesanan".
 *
 * @property int $id
 * @property int $user_id
 * @property string $tanggal_pesanan
 * @property float $total_harga
 * @property string $status_pesanan
 * @property string $alamat_pengiriman
 */
class Pesanan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pesanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'tanggal_pesanan', 'total_harga', 'status_pesanan', 'alamat_pengiriman'], 'required'],
            [['user_id'], 'integer'],
            [['tanggal_pesanan'], 'safe'],
            [['total_harga'], 'number'],
            [['alamat_pengiriman'], 'string'],
            // Ganti aturan 'string' yang lama dengan 'in' (pilihan)
[['status_pesanan'], 'in', 'range' => [
    'Menunggu Pembayaran', 
    'Diproses', 
    'Dikirim', 
    'Selesai', 
    'Dibatalkan'
]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'tanggal_pesanan' => 'Tanggal Pesanan',
            'total_harga' => 'Total Harga',
            'status_pesanan' => 'Status Pesanan',
            'alamat_pengiriman' => 'Alamat Pengiriman',
        ];
    }

}
