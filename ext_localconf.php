<?php
if (!defined ('TYPO3_MODE')) {
    die ('Access denied.');
}

if (TYPO3_MODE=="BE" )   {
    $pageRenderer = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Page\PageRenderer::class);
//    $pageRenderer->loadRequireJsModule(
//        'TYPO3/CMS/Shyguy/Shyguy',
//        'function() { console.log("Yeah!!!");}'
//    );
//    $pageRenderer->addJsFile('EXT:shyguy/Resources/Public/Javascript/Shyguy.js', 'text/javascript', true, false, '', true,  '|', false, '');
    $pageRenderer->addJsFile('EXT:shyguy/Resources/Public/Javascript/Shyguy.js', 'text/javascript');
}

$pngIcons = [
    'insert-soft-hyphen' => 'shy.png',
];
/** @var \TYPO3\CMS\Core\Imaging\IconRegistry $iconRegistry */
$iconRegistry = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\TYPO3\CMS\Core\Imaging\IconRegistry::class);
foreach ($pngIcons as $identifier => $path) {
    $iconRegistry->registerIcon(
        $identifier,
        \TYPO3\CMS\Core\Imaging\IconProvider\BitmapIconProvider::class,
        ['source' => 'EXT:shyguy/Resources/Public/Icons/' . $path]
    );
}