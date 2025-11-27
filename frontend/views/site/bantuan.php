<?php

/** @var yii\web\View $this */
/** @var \frontend\models\ContactForm $model */

use yii\bootstrap5\Html;
use yii\helpers\Url;

$this->title = 'Bantuan';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm mb-4">
                <div class="card-body p-5">
                    <h1 class="text-center mb-4"><?= Html::encode($this->title) ?></h1>
                    <p class="lead text-center">Butuh bantuan? Berikut beberapa topik yang sering ditanyakan.</p>

                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    Pengiriman dan Ongkos Kirim
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami melayani pengiriman ke seluruh Indonesia. Ongkos kirim dihitung saat checkout berdasarkan alamat pengiriman.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    Garansi dan Pengembalian
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Semua produk resmi memiliki garansi sesuai ketentuan pabrikan. Untuk pengembalian, silakan hubungi kami melalui formulir kontak.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Metode Pembayaran
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami menerima transfer bank, virtual account, dan metode pembayaran daring yang populer. Pilih metode yang tersedia saat checkout.
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <?= Html::a('<i class="bi bi-envelope"></i> Hubungi Kami', ['/site/contact'], ['class' => 'btn btn-primary me-2']) ?>
                        <?= Html::a('<i class="bi bi-whatsapp"></i> Chat WhatsApp', 'https://wa.me/62812345678901', ['class' => 'btn btn-success', 'target' => '_blank']) ?>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3">Masih butuh bantuan?</h5>
                    <p>Silakan kirim pertanyaan melalui formulir kontak atau chat WhatsApp kami. Tim support siap membantu.</p>
                </div>
            </div>
        </div>
    </div>
</div>
