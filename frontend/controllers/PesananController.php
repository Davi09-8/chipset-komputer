<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use backend\models\Pesanan; // Kita pakai model Pesanan
use yii\data\ActiveDataProvider; // Untuk menampilkan daftar

class PesananController extends Controller
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
                        'roles' => ['@'], // Hanya untuk pengguna login
                    ],
                ],
            ],
        ];
    }

    /**
     * Menampilkan daftar riwayat pesanan pengguna.
     */
    public function actionIndex()
    {
        // Buat query untuk mengambil pesanan HANYA
        // milik pengguna yang sedang login
        $query = Pesanan::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['id' => SORT_DESC]); // Tampilkan yang terbaru

        // Buat DataProvider untuk pagination
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        // Kirim data ke view
        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}