<?php

use TYPO3\CMS\Core\Imaging\IconRegistry;

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}

if (TYPO3_MODE == "BE") {
    $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
    $pageRenderer->addJsFile('EXT:shyguy/Resources/Public/Javascript/Shyguy.min.js', 'text/javascript');
}

$pngIcons = [
    'insert-soft-hyphen' => 'shy.png',
];
/** @var IconRegistry $iconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(IconRegistry::class);
foreach ($pngIcons as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:shyguy/Resources/Public/Icons/' . $path]
    );
}
