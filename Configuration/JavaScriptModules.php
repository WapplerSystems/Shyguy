<?php

return [
    // required import configurations of other extensions,
    // in case a module imports from another package
    'dependencies' => ['backend', 'rte_ckeditor'],
    'imports' => [
        // recursive definition, all *.js files in this folder are import-mapped
        // trailing slash is required per importmap-specification
        '@wapplersystems/shyguy/' => 'EXT:shyguy/Resources/Public/Javascript/',
    ],
];
