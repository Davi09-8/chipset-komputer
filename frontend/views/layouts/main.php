<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url; // <- Pastikan ini ada

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
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        /* Basic page behavior and spacing for fixed header */
        html { scroll-behavior: smooth; }
        @media screen and (prefers-reduced-motion: reduce) {
            html { scroll-behavior: auto; }
        }
        body { padding-top: 56px; }
    </style>
    
    <!-- Smooth Scroll Polyfill (load only if needed) -->
    <script>
    (function(){
        var supports = 'scrollBehavior' in document.documentElement.style;
        if (!supports) {
            var s = document.createElement('script');
            s.src = 'https://unpkg.com/smoothscroll-polyfill@0.4.4/dist/smoothscroll.min.js';
            s.crossOrigin = 'anonymous';
            s.onload = function(){
                try {
                    if (window.smoothscroll && typeof window.smoothscroll.polyfill === 'function') {
                        window.smoothscroll.polyfill();
                    } else if (window.SmoothScroll && typeof window.SmoothScroll.polyfill === 'function') {
                        window.SmoothScroll.polyfill();
                    }
                } catch(e){}
            };
            document.head.appendChild(s);
        }
    })();
    </script>
    
    <?php $this->head() ?>

    <!-- Force-hide old/topline promo elements (override cached/third-party CSS) -->
    <style>
        .sapphire-topline,
        .sapphire-topline-inner,
        .topline-highlight,
        .topline-badges {
            display: none !important;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<header>
    <?php
    NavBar::begin([
        'brandLabel' => 'Chipset Computer',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);

    // --- MENU KIRI ---
    $leftItems = [
        ['label' => 'Home', 'url' => ['/site/index']],
        ['label' => 'Katalog Produk', 'url' => ['/produk/index']],
        // Tambahkan menu Bantuan yang mengarah ke SiteController::actionBantuan
        ['label' => 'Bantuan', 'url' => ['/site/bantuan']],
    ];
    if (!Yii::$app->user->isGuest) {
         $leftItems[] = ['label' => 'Riwayat Pesanan', 'url' => ['/pesanan/index']];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $leftItems,
        'encodeLabels' => false,
    ]);

    // --- MENU KANAN (Dengan styling tombol "bagus") ---
    echo '<div class="navbar-nav ms-auto d-flex flex-row align-items-center">'; 

    // Small Help link on the right (before cart)
    echo Html::a('<i class="bi bi-question-circle"></i> Bantuan', ['/site/bantuan'], [
        'class' => 'nav-link text-light me-3 d-flex align-items-center',
        'style' => 'text-decoration:none;'
    ]);

    // Cart Button
    echo Html::a('<i class="bi-cart"></i> Keranjang', ['/keranjang/index'], [
        'class' => 'btn btn-outline-light me-2 position-relative'
    ]);

    // Tombol Login / Logout
    if (Yii::$app->user->isGuest) {
        echo Html::a('Signup', ['/site/signup'], ['class' => 'btn btn-outline-info me-2']);
        echo Html::a('Login', ['/site/login'], ['class' => 'btn btn-outline-success']);
    } else {
        /** @var \common\models\User $identity */
        $identity = Yii::$app->user->identity;
        $username = $identity ? $identity->username : '';

        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Html::encode($username) . ')',
                ['class' => 'btn btn-outline-danger']
            )
            . Html::endForm();
    }
    
    echo '</div>'; // Penutup tombol kanan

    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container-fluid" style="padding: 0;"> 
        
        <?php 
        if (!Yii::$app->user->isGuest && Yii::$app->controller->route !== 'site/index') {
            echo '<div class="container mt-3">'; 
            echo Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
            ]);
            echo '</div>';
        }
        ?>

        <div class="container">
            <?= Alert::widget() ?>
        </div>

        <?= $content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode('Chipset Computer') ?> <?= date('Y') ?></p>
        <p class="float-end"><?= \Yii::powered() ?></p>
    </div>
</footer>

<!-- Improved header scroll behavior + remove old template topline -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Hapus bar promo "Rakit workstation..." dari template lama jika masih ada
    var topline = document.querySelector('.sapphire-topline');
    if (topline) {
        topline.remove();
    }

    const header = document.querySelector('header');
    const navbar = document.querySelector('.navbar');
    if (!header || !navbar) return;

    let lastScroll = 0;
    const navbarHeight = navbar.offsetHeight || 56;

    // Set CSS variable so main content can use it
    document.documentElement.style.setProperty('--navbar-height', navbarHeight + 'px');

    // Toggle shadow based on scroll position
    function updateNavbarShadow() {
        if (window.scrollY > 10) {
            navbar.classList.add('shadow-sm');
        } else {
            navbar.classList.remove('shadow-sm');
        }
    }

    function handleScroll() {
        const currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        if (currentScroll > lastScroll && currentScroll > navbarHeight) {
            // scrolling down
            header.style.transform = 'translateY(-100%)';
        } else if (currentScroll < lastScroll) {
            // scrolling up
            header.style.transform = 'translateY(0)';
        }
        updateNavbarShadow();
        lastScroll = currentScroll;
    }

    // smooth transition
    header.style.transition = 'transform 0.3s ease-in-out';

    updateNavbarShadow();
    window.addEventListener('scroll', handleScroll, { passive: true });

    // Smooth-scroll for internal anchor links
    document.querySelectorAll('a[href^="#"]').forEach(function(anchor){
        anchor.addEventListener('click', function(e){
            var targetId = this.getAttribute('href');
            if (!targetId || targetId === '#') return;
            var target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
</script>

<!-- Tambahkan CSS untuk efek smooth -->
<style>
    header {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        background: white;
        transform: translateY(0);
        transition: transform 0.3s ease-in-out;
    }
    
    /* Pastikan konten tidak tertutup header */
    main {
        margin-top: var(--navbar-height, 60px);
    }
</style>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
