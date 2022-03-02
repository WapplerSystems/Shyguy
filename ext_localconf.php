<?php

use TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider;
use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

if (TYPO3_MODE == "BE") {
    $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
    $pageRenderer->addJsFile('EXT:shyguy/Resources/Public/Javascript/Shyguy.min.js', 'text/javascript');
}

$pngIcons = [
    'insert-soft-hyphen' => 'shy.png',
];
/** @var IconRegistry $iconRegistry */
$iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
foreach ($pngIcons as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        BitmapIconProvider::class,
        ['source' => 'EXT:shyguy/Resources/Public/Icons/' . $path]
    );
}
