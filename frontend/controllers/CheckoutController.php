<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl; // Untuk membatasi akses
use backend\models\Produk;
use backend\models\Pesanan; // Kita pakai model Pesanan
use backend\models\DetailPesanan; // Kita pakai model DetailPesanan
use backend\models\MetodePembayaran; // Kita pakai model MetodePembayaran

class CheckoutController extends Controller
{
    /**
     * Batasi akses hanya untuk pengguna yang sudah login
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // '@' berarti pengguna yang sudah login
                    ],
                ],
            ],
        ];
    }

    /**
     * Menampilkan halaman checkout dan memproses pesanan
     */
    public function actionIndex()
    {
        // Ambil keranjang dari session
        $keranjang = Yii::$app->session->get('keranjang', []);
        if (empty($keranjang)) {
            // Jika keranjang kosong, kembalikan ke homepage
            Yii::$app->session->setFlash('warning', 'Keranjang Anda kosong. Silakan belanja dulu.');
            return $this->goHome();
        }

        // Ambil data produk dan hitung total
        $produks = Produk::find()->where(['id' => array_keys($keranjang)])->all();
        $totalHarga = 0;
        foreach ($produks as $produk) {
            $totalHarga += $produk->harga * $keranjang[$produk->id];
        }

        // Ambil metode pembayaran dari database
        $metodePembayaran = MetodePembayaran::find()->all();

        // Siapkan model Pesanan baru
        $modelPesanan = new Pesanan();

        // --- PROSES SAAT TOMBOL 'BUAT PESANAN' DITEKAN ---
        if ($modelPesanan->load($this->request->post())) {

            // Isi data untuk tabel 'pesanan'
            $modelPesanan->user_id = Yii::$app->user->id;
            $modelPesanan->tanggal_pesanan = date('Y-m-d H:i:s');
            $modelPesanan->total_harga = $totalHarga;
            $modelPesanan->status_pesanan = 'Menunggu Pembayaran';
            // 'alamat_pengiriman' dan 'metode_pembayaran_id' sudah diisi dari form

            // Mulai Transaksi Database
            $transaction = Yii::$app->db->beginTransaction();
            try {
                if ($modelPesanan->save()) {
                    // Simpan detail pesanan (isi keranjang)
                    foreach ($produks as $produk) {
                        $modelDetail = new DetailPesanan();
                        $modelDetail->pesanan_id = $modelPesanan->id;
                        $modelDetail->produk_id = $produk->id;
                        $modelDetail->jumlah = $keranjang[$produk->id];
                        $modelDetail->harga_saat_beli = $produk->harga;
                        $modelDetail->save();
                    }

                    // Commit transaksi jika semua berhasil
                    $transaction->commit();

                    // Kosongkan keranjang
                    Yii::$app->session->remove('keranjang');

                    // Tampilkan halaman sukses
                    Yii::$app->session->setFlash('success', 'Pesanan Anda berhasil dibuat!');
                    return $this->render('sukses', [
                        'modelPesanan' => $modelPesanan,
                    ]);
                }
            } catch (\Exception $e) {
                // Rollback jika ada error
                $transaction->rollBack();
                Yii::$app->session->setFlash('error', 'Terjadi kesalahan saat memproses pesanan Anda.');
            }
        }
        // --- AKHIR PROSES ---

        // Tampilkan halaman form checkout
        return $this->render('index', [
            'modelPesanan' => $modelPesanan,
            'metodePembayaran' => $metodePembayaran,
            'totalHarga' => $totalHarga,
        ]);
    }
}