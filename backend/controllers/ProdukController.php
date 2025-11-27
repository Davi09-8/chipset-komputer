<?php

namespace backend\controllers;

use backend\models\Produk;
use backend\models\ProdukSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile; // <-- Pastikan ini ada
use yii\helpers\FileHelper; // <-- Pastikan ini ada
use Yii; // <-- Pastikan ini ada

/**
 * ProdukController implements the CRUD actions for Produk model.
 */
class ProdukController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Produk models.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Produk model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Produk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Produk();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                // --- KODE UPLOAD DIMULAI DI SINI ---
                $model->gambar = UploadedFile::getInstance($model, 'gambar');

                if ($model->gambar) {
                    // Tentukan folder penyimpanan
                    $folderTujuan = \Yii::getAlias('@frontend/web/uploads/produk/');
                    FileHelper::createDirectory($folderTujuan); // Buat folder jika belum ada
                    
                    // Buat nama file yang unik
                    $namaFile = \Yii::$app->security->generateRandomString() . '.' . $model->gambar->extension;
                    
                    // Simpan file
                    if ($model->gambar->saveAs($folderTujuan . $namaFile)) {
                        // Simpan NAMA FILE ke database
                        $model->gambar = $namaFile;
                    }
                }
                // --- KODE UPLOAD SELESAI ---

                // Simpan model (baik dengan atau tanpa gambar)
                if ($model->save(false)) { // 'false' untuk menonaktifkan validasi model, karena kita sudah validasi di form
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Produk model.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        // Simpan nama gambar lama
        $gambarLama = $model->gambar;

        if ($this->request->isPost && $model->load($this->request->post())) {
            
            // --- KODE UPLOAD BARU UNTUK UPDATE ---
            $fileGambar = UploadedFile::getInstance($model, 'gambar');
            
            // Periksa apakah ada gambar baru yang di-upload
                if ($fileGambar) {
                // Tentukan folder penyimpanan
                $folderTujuan = \Yii::getAlias('@frontend/web/uploads/produk/');
                FileHelper::createDirectory($folderTujuan); // Buat folder jika belum ada
                
                // Buat nama file yang unik
                $namaFile = Yii::$app->security->generateRandomString() . '.' . $fileGambar->extension;
                
                // Simpan file baru
                if ($fileGambar->saveAs($folderTujuan . $namaFile)) {
                    // Simpan NAMA FILE BARU ke database
                    $model->gambar = $namaFile;
                    
                    // Hapus gambar lama jika ada
                    if ($gambarLama && file_exists($folderTujuan . $gambarLama)) {
                        unlink($folderTujuan . $gambarLama);
                    }
                }
            } else {
                // Jika tidak ada gambar baru, pertahankan gambar lama
                $model->gambar = $gambarLama;
            }
            // --- KODE UPLOAD SELESAI ---

            if ($model->save(false)) { // Simpan model
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Produk model.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        
        // --- TAMBAHAN: HAPUS FILE GAMBAR SAAT PRODUK DIHAPUS ---
        $folderTujuan = \Yii::getAlias('@frontend/web/uploads/produk/');
        if ($model->gambar && file_exists($folderTujuan . $model->gambar)) {
            unlink($folderTujuan . $model->gambar);
        }
        
        $model->delete();
        // --- SELESAI ---

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produk model based on its primary key value.
     * @param int $id ID
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produk::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}