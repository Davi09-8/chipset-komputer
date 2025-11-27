<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Produk; // Kita pakai model dari backend
use yii\filters\VerbFilter; // <-- TAMBAHKAN BARIS INI

class KeranjangController extends Controller
{
    /**
     * Menampilkan halaman keranjang belanja.
     */
    /**
 * Menambahkan aturan keamanan (VerbFilter)
 * Memaksa 'hapus' untuk menggunakan method POST
 */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'hapus' => ['POST'], // Hanya izinkan HAPUS via POST
                ],
            ],
        ];
    }
    public function actionIndex()
    {
        // Ambil keranjang dari session
        $keranjang = Yii::$app->session->get('keranjang', []);

        $produkDiKeranjang = [];
        $totalHarga = 0;

        if (!empty($keranjang)) {
            // Ambil ID produk dari keranjang
            $produkIds = array_keys($keranjang);

            // Ambil data produk dari database berdasarkan ID
            $produks = Produk::find()->where(['id' => $produkIds])->all();

            // Siapkan data untuk ditampilkan di view
            foreach ($produks as $produk) {
                $jumlah = $keranjang[$produk->id];
                $subtotal = $produk->harga * $jumlah;
                $totalHarga += $subtotal;

                $produkDiKeranjang[] = [
                    'model' => $produk,
                    'jumlah' => $jumlah,
                    'subtotal' => $subtotal,
                ];
            }
        }

        return $this->render('index', [
            'produkDiKeranjang' => $produkDiKeranjang,
            'totalHarga' => $totalHarga,
        ]);
    }

    /**
     * Menambah produk ke keranjang.
     * @param int $id (ID Produk)
     */
    public function actionTambah($id)
    {
        // 1. Cari produk di database
        $produk = Produk::findOne($id);
        if (!$produk) {
            throw new NotFoundHttpException('Produk tidak ditemukan.');
        }

        // 2. Ambil keranjang dari session
        $keranjang = Yii::$app->session->get('keranjang', []);

        // 3. Tambahkan produk ke keranjang (atau update jumlahnya)
        if (isset($keranjang[$id])) {
            // Jika sudah ada, tambah jumlahnya
            $keranjang[$id]++;
        } else {
            // Jika belum ada, set jumlahnya 1
            $keranjang[$id] = 1;
        }

        // 4. Simpan keranjang kembali ke session
        Yii::$app->session->set('keranjang', $keranjang);

        // 5. Beri notifikasi sukses
        Yii::$app->session->setFlash('success', 'Produk berhasil ditambahkan ke keranjang.');

        // 6. Redirect ke halaman keranjang
        return $this->redirect(['index']);
    }
    /**
 * Menghapus produk dari keranjang.
 * @param int $id (ID Produk)
 */

    public function actionHapus($id)
    {
        // 1. Ambil keranjang dari session
        $keranjang = Yii::$app->session->get('keranjang', []);

        // 2. Periksa apakah produk ada di keranjang
        if (isset($keranjang[$id])) {
            // 3. Hapus produk dari array
            unset($keranjang[$id]);

            // 4. Simpan keranjang baru ke session
            Yii::$app->session->set('keranjang', $keranjang);

            // 5. Beri notifikasi sukses
            Yii::$app->session->setFlash('success', 'Produk berhasil dihapus dari keranjang.');
        }

        // 6. Redirect kembali ke halaman keranjang
        return $this->redirect(['index']);
    }
}