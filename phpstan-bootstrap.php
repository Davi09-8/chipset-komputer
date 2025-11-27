<?php
if (!defined('YII_ENV')) {
    define('YII_ENV', 'test');
}
if (!defined('YII_ENV_TEST')) {
    define('YII_ENV_TEST', true);
}
require __DIR__ . '/vendor/autoload.php';
// Load Yii if available so PHPStan can discover Yii symbols
if (file_exists(__DIR__ . '/vendor/yiisoft/yii2/Yii.php')) {
    require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';
    // set common aliases to help static analysis resolve paths
    if (class_exists('\\Yii')) {
        try {
            \Yii::setAlias('@common', __DIR__ . '/common');
            \Yii::setAlias('@backend', __DIR__ . '/backend');
            \Yii::setAlias('@frontend', __DIR__ . '/frontend');
            \Yii::setAlias('@console', __DIR__ . '/console');
        } catch (\Throwable $e) {
            // ignore any runtime issues while static analysing
        }
    }
}
