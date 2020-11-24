<?php
namespace WapplerSystems\Shyguy\Hooks;

class TCEmainHook {

    /**
     *
     * @param array $fieldArray
     * @param string $table
     * @param int $id
     * @param $parentObject \TYPO3\CMS\Core\DataHandling\DataHandler
     */
    public function processDatamap_preProcessFieldArray(&$fieldArray, $table, $id, $parentObject){
        array_walk($fieldArray, array($this, 'makeRealSoftHyphens'));
    }

    public function makeRealSoftHyphens(&$value, $key){
        if(is_string($value)){
           $value = str_replace("↵","­", $value);
        }
    }
}