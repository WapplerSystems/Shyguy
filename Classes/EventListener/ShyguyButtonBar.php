<?php

namespace WapplerSystems\Shyguy\EventListener;

use TYPO3\CMS\Backend\Template\Components\ButtonBar;
use TYPO3\CMS\Backend\Template\Components\Buttons\InputButton;
use TYPO3\CMS\Backend\Template\Components\ModifyButtonBarEvent;
use TYPO3\CMS\Core\Imaging\Icon;
use TYPO3\CMS\Core\Imaging\IconFactory;
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ShyguyButtonBar {
    public function __invoke(ModifyButtonBarEvent $event): void
    {
        /** @var PageRenderer $pageRenderer */
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);
        $pageRenderer->loadJavaScriptModule('@wapplersystems/shyguy/Shyguy.js');

        $buttons = $event->getButtons();
        $saveButton = $buttons[ButtonBar::BUTTON_POSITION_LEFT][2][0] ?? null;

        if ($saveButton instanceof InputButton && $saveButton->getName() === '_savedok') {
            $iconFactory = GeneralUtility::makeInstance(IconFactory::class);

            $insertSoftHyphen = $event->getButtonBar()->makeLinkButton()
                ->setHref('#insertSoftHyphen')
                ->setTitle(
                    $GLOBALS['LANG']->sL(
                        'LLL:EXT:shyguy/Resources/Private/Language/locallang.xlf:set_hyphen'
                    )
                )
                ->setIcon($iconFactory->getIcon('insert-soft-hyphen', Icon::SIZE_SMALL))
                ->setShowLabelText(true);

            $pos = max(array_keys($buttons[ButtonBar::BUTTON_POSITION_LEFT])) + 1;
            $buttons[ButtonBar::BUTTON_POSITION_LEFT][$pos][] = $insertSoftHyphen;
        }

        $event->setButtons($buttons);
    }
}
