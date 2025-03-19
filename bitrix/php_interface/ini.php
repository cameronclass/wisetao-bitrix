<?php
if ($_SERVER['SERVER_PORT'] == 80)
    LocalRedirect('https://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);



use Bitrix\Main\EventManager;

EventManager::getInstance()->addEventHandler("main", "OnFileSave", function (&$arFile) {
    $imagePath = $_SERVER["DOCUMENT_ROOT"] . "/" . $arFile["SUBDIR"] . "/" . $arFile["FILE_NAME"];
    compressImage($imagePath);
});

function compressImage($source, $quality = 85)
{
    $info = getimagesize($source);
    if ($info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        imagejpeg($image, $source, $quality);
    } elseif ($info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        imagepng($image, $source, 9);
    } else {
        return false;
    }
    imagedestroy($image);
}