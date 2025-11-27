<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "detail_pesanan".
 *
 * @property int $id
 * @property int $pesanan_id
 * @property int $produk_id
 * @property int $jumlah
 * @property float $harga_saat_beli
 */
class DetailPesanan extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'detail_pesanan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pesanan_id', 'produk_id', 'jumlah', 'harga_saat_beli'], 'required'],
            [['pesanan_id', 'produk_id', 'jumlah'], 'integer'],
            [['harga_saat_beli'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'pesanan_id' => 'Pesanan ID',
            'produk_id' => 'Produk ID',
            'jumlah' => 'Jumlah',
            'harga_saat_beli' => 'Harga Saat Beli',
        ];
    }

}
