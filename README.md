# Shy Guy - Soft Hyphen Managing

Adds visualisation and control over soft hyphens in content elements to TYPO3.

## What does it do

Ever wondered how to force very long words to break into the next line if space gets too narrow?
This Extension adds an "insert soft hyphen" Button into the button bar at the top (next to save, view, eg. in content editing view).

## How to install

Just install the extension manual or via composer.
No configuration is needed.

## How does it work

Within a content element, a soft hyphen is set at the caret position if you click the button.

## Found an issue?

Feel free to make a pull request, explain the issue on https://github.com/WapplerSystems/Shyguy or send an e-mail to info@wapplersystems.de .

## Changelog

<i>(Dates have [dd.mm.yy] format)</i>

<br><br>

<b><u>Version 1.0.6 beta:</u></b>

update 02.03.2022

- made the extension work with TYPO3 11 and composer
- reformatted and cleaned code
- made button position dynamic to prevent possible incompatibilities to other extensions


<b><u>Version 1.0.1 beta:</u></b>

update 26.03.2021
- merged a pull request from Albrecht Köhnlein, which fixes a bug that generated HTML instead of plain text.

___

update 02.12.2020
- fixed some flexform problems

___

update 27.11.2020
- added CKEditor support
- fix for multiple CKEditor instances
- added minified JavaScript
- added german translation


