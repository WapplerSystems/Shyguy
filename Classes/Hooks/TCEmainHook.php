<?php

namespace WapplerSystems\Shyguy\Hooks;

class TCEmainHook
{
    public function processDatamap_preProcessFieldArray(array &$fieldArray): void {
        array_walk_recursive($fieldArray, $this->makeRealSoftHyphens(...));
    }

    public function makeRealSoftHyphens(&$value): void
    {
        if (is_string($value)) {
            $value = str_replace("↵", "­", $value);
        }
    }
}
