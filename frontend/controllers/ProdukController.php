<?php

namespace frontend\controllers;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use backend\models\Produk; // Kita pakai model dari backend

class ProdukController extends Controller
{
    /**
     * Menampilkan detail satu produk.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        // 1. Cari produk di database berdasarkan ID
        $model = Produk::findOne($id);

        // 2. Jika produk tidak ditemukan, tampilkan error 404
        if ($model === null) {
            throw new NotFoundHttpException('Produk yang Anda cari tidak ditemukan.');
        }

        // 3. Kirim data produk ke view 'view.php'
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}