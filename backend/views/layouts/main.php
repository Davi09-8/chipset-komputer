<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
    ];

    if (Yii::$app->user->isGuest) {
        // Menu untuk Tamu (Guest)
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        // Menu untuk Admin yang SUDAH LOGIN
        $menuItems[] = ['label' => 'Kategori', 'url' => ['/kategori']];
        $menuItems[] = ['label' => 'Produk', 'url' => ['/produk']];
        $menuItems[] = ['label' => 'Pesanan', 'url' => ['/pesanan']];
        $menuItems[] = ['label' => 'Metode Pembayaran', 'url' => ['/metode-pembayaran']];
        
        /** @var \common\models\User $identity */
        $identity = Yii::$app->user->identity;
        $username = $identity ? $identity->username : '';

        // Tombol Logout (ini kita pindah ke sini)
        $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Html::encode($username) . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm()
            . '</li>';
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
        'encodeLabels' => false, // <-- INI PENTING: agar tombol Logout dirender
    ]);
    
    // KITA HAPUS BLOK LOGIN/LOGOUT LAMA DARI SINI KARENA SUDAH DIPINDAH KE ATAS
    
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();