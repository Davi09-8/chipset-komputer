<?php
/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = 'Registrasi Berhasil';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup-success">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('success')): ?>
        <div class="alert alert-success"><?= Yii::$app->session->getFlash('success') ?></div>
    <?php else: ?>
        <p>Pendaftaran berhasil. Silakan periksa email Anda untuk melakukan verifikasi akun.</p>
    <?php endif; ?>

    <p>Catatan untuk developer (environment dev): sistem berada pada konfigurasi <code>useFileTransport</code> untuk mailer. Email verifikasi disimpan sebagai file di folder <code>frontend/runtime/mail</code> atau lokasi setara. Untuk mengirim email sungguhan, ubah konfigurasi mailer di <code>environments/dev/common/config/main-local.php</code>.</p>

    <?php
    // Tampilkan file email terbaru jika ada (hanya untuk development / useFileTransport)
    $mailDir = \Yii::getAlias('@frontend/runtime/mail');
    if (is_dir($mailDir)) {
        $files = array_values(array_filter(glob($mailDir . DIRECTORY_SEPARATOR . '*')));
        usort($files, function($a, $b){ return filemtime($b) - filemtime($a); });
        $latest = count($files) ? $files[0] : null;
    } else {
        $latest = null;
    }
    ?>

    <?php if ($latest): ?>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Email verifikasi (file terbaru)</h5>
                <p><strong>File:</strong> <?= Html::encode(basename($latest)) ?>
                <br><strong>Terakhir diubah:</strong> <?= date('Y-m-d H:i:s', filemtime($latest)) ?></p>
                <p><strong>Preview:</strong></p>
                <pre style="max-height:200px;overflow:auto;"><?= Html::encode(substr(file_get_contents($latest), 0, 2000)) ?></pre>
            </div>
        </div>
    <?php else: ?>
        <p>Tidak ditemukan file email verifikasi di folder <code><?= Html::encode($mailDir) ?></code>.</p>
    <?php endif; ?>

    <p><?= Html::a('Kembali ke Beranda', ['site/index'], ['class' => 'btn btn-primary']) ?></p>
</div>
