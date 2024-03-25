<?php

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;

$pngIcons = [
    'insert-soft-hyphen' => 'shy.png',
];

foreach ($pngIcons as $identifier => $path) {
    $icons[$identifier] = [
        'provider' => BitmapIconProvider::class,
        'source' => 'EXT:shyguy/Resources/Public/Icons/' . $path
    ];
}
