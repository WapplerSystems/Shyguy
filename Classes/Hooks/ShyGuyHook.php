<?php

namespace WapplerSystems\Shyguy\Hooks;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Adds visualisation and control over soft hyphens in content elements.
 *
 * Class ShyGuyHook
 * @package WapplerSystems\Shyguy\Hooks
 */
class ShyGuyHook
{
    /**
     * @param array $params
     * @param $buttonBar
     * @return array
     */
    public function addSoftHyphenInitial($params, &$buttonBar): array
    {
        $buttons = $params['buttons'];
        $saveButton = $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][0];

        if ($saveButton instanceof InputButton && $saveButton->getName() === '_savedok') {
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);

            $insertSoftHyphen = $buttonBar->makeLinkButton()
                ->setHref('#insertSoftHyphen')
                ->setTitle($this->getLanguageService()->sL('LLL:EXT:shyguy/Resources/Private/Language/locallang.xlf:set_hyphen'))
                ->setIcon($iconFactory->getIcon('insert-soft-hyphen', Icon::SIZE_SMALL))
                ->setShowLabelText(true);

            $pos = max(array_keys($buttons[ButtonBar::BUTTON_POSITION_LEFT])) + 1;
            $buttons[ButtonBar::BUTTON_POSITION_LEFT][$pos][] = $insertSoftHyphen;

        }

        return $buttons;
    }

    /**
     * Returns the language service
     * @return LanguageService
     */
    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
