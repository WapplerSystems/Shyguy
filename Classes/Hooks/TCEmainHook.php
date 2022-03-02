<?php

namespace WapplerSystems\Shyguy\Hooks;

use TYPO3\CMS\Core\DataHandling\DataHandler;

class TCEmainHook
{

    /**
     *
     * @param array $fieldArray
     * @param string $table
     * @param int $id
     * @param $parentObject DataHandler
     */
    public function processDatamap_preProcessFieldArray(&$fieldArray, $table, $id, $parentObject)
    {
        array_walk_recursive($fieldArray, [$this, 'makeRealSoftHyphens']);
    }

    public function makeRealSoftHyphens(&$value, $key)
    {
        if (is_string($value)) {
            $value = str_replace("↵", "­", $value);
        }
    }
}
