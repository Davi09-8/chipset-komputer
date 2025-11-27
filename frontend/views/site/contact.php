<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Hubungi Kami';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>
                    
                    <?php if (Yii::$app->session->hasFlash('success')): ?>
                        <div class="alert alert-success">
                            <?= Yii::$app->session->getFlash('success') ?>
                        </div>
                    <?php elseif (Yii::$app->session->hasFlash('error')): ?>
                        <div class="alert alert-danger">
                            <?= Yii::$app->session->getFlash('error') ?>
                        </div>
                    <?php endif; ?>

                    <p class="text-center mb-5">
                        Untuk pertanyaan, saran, atau informasi lebih lanjut, silakan isi formulir di bawah ini. 
                        Tim kami akan segera menghubungi Anda.
                    </p>

                    <?php $form = ActiveForm::begin([
                        'id' => 'contact-form',
                        'options' => ['class' => 'needs-validation'],
                        'enableClientValidation' => true,
                    ]); ?>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <?= $form->field($model, 'name', [
                                    'inputOptions' => [
                                        'class' => 'form-control',
                                        'placeholder' => 'Nama Lengkap'
                                    ]
                                ])->textInput(['autofocus' => true])->label(false) ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $form->field($model, 'email', [
                                    'inputOptions' => [
                                        'class' => 'form-control',
                                        'placeholder' => 'Alamat Email'
                                    ]
                                ])->label(false) ?>
                            </div>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($model, 'subject', [
                                'inputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Subjek'
                                ]
                            ])->label(false) ?>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($model, 'body', [
                                'inputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Pesan Anda',
                                    'rows' => 5
                                ]
                            ])->textarea()->label(false) ?>
                        </div>

                        <div class="mb-4">
                            <?= $form->field($model, 'verifyCode')->widget(Captcha::class, [
                                'template' => '<div class="row">
                                    <div class="col-md-4 mb-2">{image}</div>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-shield-lock"></i>
                                            </span>
                                            {input}
                                        </div>
                                    </div>
                                </div>',
                                'options' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Masukkan kode verifikasi'
                                ]
                            ])->label('Verifikasi bahwa Anda bukan robot')
                            ->hint('Klik pada gambar untuk memperbarui kode') ?>
                        </div>

                        <div class="d-grid">
                            <?= Html::submitButton('<i class="bi bi-send-fill me-2"></i> Kirim Pesan', [
                                'class' => 'btn btn-primary btn-lg', 
                                'name' => 'contact-button'
                            ]) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-body text-center">
                    <h5 class="card-title">Kontak Langsung</h5>
                    <p class="card-text mb-1">
                        <i class="bi bi-envelope me-2"></i> info@chipsetcomputer.com
                    </p>
                    <p class="card-text mb-1">
                        <i class="bi bi-telephone me-2"></i> +62 123 4567 8901
                    </p>
                    <p class="card-text">
                        <i class="bi bi-geo-alt me-2"></i> Jl. Contoh No. 123, Jakarta Selatan
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
