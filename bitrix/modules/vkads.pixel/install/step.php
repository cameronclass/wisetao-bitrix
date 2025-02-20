<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!check_bitrix_sessid()) {
    return;
}

if ($errorException = $APPLICATION->getException()) {
    CAdminMessage::showMessage(
        Loc::getMessage('VKPIXEL_INSTALL_FAILED') . ': ' . $errorException->getString()
    );
} else {
    CAdminMessage::showNote(
        Loc::getMessage('VKPIXEL_INSTALL_SUCCESS')
    );
}
?>

<form action="<?= $APPLICATION->getCurPage(); ?>">
    <input type="hidden" name="lang" value="<?= LANGUAGE_ID; ?>" />
    <input type="submit" value="<?= Loc::getMessage('VKPIXEL_RETURN_MODULES'); ?>">
</form>
