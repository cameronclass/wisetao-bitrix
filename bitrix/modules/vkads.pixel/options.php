<?php
declare(strict_types=1);

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\HttpApplication;
use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

$request = HttpApplication::getInstance()->getContext()->getRequest();

$module_id = htmlspecialchars($request['mid'] != '' ? $request['mid'] : $request['id']);

Loader::includeModule($module_id);

$arrayTabs = [
    [
        'DIV' => 'edit',
        'TAB' => Loc::getMessage('VKPIXEL_OPTIONS_TAB_NAME'),
        'TITLE' => Loc::getMessage('VKPIXEL_OPTIONS_TAB_NAME'),
        'OPTIONS' => [
            Loc::getMessage('VKPIXEL_OPTIONS_TAB_COMMON'),
            [
                'vkpixel_text',
                Loc::getMessage('VKPIXEL_OPTIONS_TAB_COUNTER_ID') . ': ',
                '',
                ['text', 40]
            ],
        ]
    ]
];

$tabControl = new CAdminTabControl(
    'tabControl',
    $arrayTabs
);

$tabControl->begin();
?>

<form action="<?= $APPLICATION->getCurPage(); ?>?mid=<?= htmlspecialchars($module_id); ?>&lang=<?= htmlspecialchars(LANGUAGE_ID); ?>" method="post">
    <?= bitrix_sessid_post(); ?>
    <?php
        foreach ($arrayTabs as $aTab) {
            if ($aTab['OPTIONS']) {
                $tabControl->BeginNextTab();
                __AdmSettingsDrawList($module_id, $aTab['OPTIONS']);
            }
        }

        $tabControl->buttons();
    ?>
    <input type="submit" name="apply" value="<?= Loc::GetMessage('VKPIXEL_OPTIONS_INPUT_APPLY'); ?>"
        class="adm-btn-save" />
    <input type="submit" name="default" value="<?php echo(Loc::GetMessage('VKPIXEL_OPTIONS_INPUT_DEFAULT')); ?>" />
</form>

<?php
    $tabControl->end();

if ($request->isPost() && check_bitrix_sessid()) {
    foreach ($arrayTabs as $aTab) {
        foreach ($aTab['OPTIONS'] as $arOption) {
            if (!is_array($arOption)) {
                continue;
            }
            if ($arOption['note']) {
                continue;
            }
            if ($request['apply']) {
                $optionValue = $request->getPost($arOption[0]);
                if ($arOption[0] == 'switch_on') {
                    if ($optionValue == '') {
                        $optionValue = 'N';
                    }
                }
                Option::set($module_id, $arOption[0], is_array($optionValue) ? implode(',', $optionValue) : $optionValue);
            } elseif ($request['default']) {
                Option::set($module_id, $arOption[0], $arOption[2]);
            }
        }
    }
    LocalRedirect($APPLICATION->GetCurPage() . '?mid=' . $module_id . '&lang=' . LANG);
}
?>
