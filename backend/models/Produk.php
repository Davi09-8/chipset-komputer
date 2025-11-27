<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "produk".
 *
 * @property int $id
 * @property int $kategori_id
 * @property string $nama_produk
 * @property float $harga
 * @property int $stok
 * @property string $gambar
 * @property string $deskripsi_panjang
 *
 * @property Kategori $kategori // Kita tambahkan relasi
 */
class Produk extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // 1. 'gambar' dan 'deskripsi_panjang' DIHAPUS dari 'required'
            [['kategori_id', 'nama_produk', 'harga', 'stok'], 'required'],
            
            [['kategori_id', 'stok'], 'integer'],
            [['harga'], 'number'],
            
            // 2. 'deskripsi_panjang' dibuat opsional
            [['deskripsi_panjang'], 'string'],
            
            // 3. Aturan 'gambar' sebagai string dihapus dari sini
            [['nama_produk'], 'string', 'max' => 255],

            // 4. ATURAN BARU: 'gambar' adalah file, boleh kosong (skipOnEmpty),
            //    dan harus berekstensi png, jpg, atau jpeg.
            [['gambar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kategori_id' => 'Kategori ID',
            'nama_produk' => 'Nama Produk',
            'harga' => 'Harga',
            'stok' => 'Stok',
            'gambar' => 'Gambar',
            'deskripsi_panjang' => 'Deskripsi Panjang',
        ];
    }

    /**
     * 5. TAMBAHAN PENTING: Menambahkan relasi ke tabel Kategori.
     * Ini akan berguna agar kita bisa menampilkan Nama Kategori,
     * bukan hanya Kategori ID.
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        // 'kategori_id' di tabel 'produk' terhubung ke 'id' di tabel 'kategori'
        return $this->hasOne(Kategori::class, ['id' => 'kategori_id']);
    }
}