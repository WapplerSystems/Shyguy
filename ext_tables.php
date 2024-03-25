<?php

use WapplerSystems\Shyguy\Hooks\TCEmainHook;

if (!defined('TYPO3')) {
    die('Access denied.');
}

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['processDatamapClass'][] = TCEmainHook::class;
