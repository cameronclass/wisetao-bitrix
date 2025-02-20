<?php
AddEventHandler("form", "onAfterResultAdd", "onAfterResultAddHandler");

function onAfterResultAddHandler($WEB_FORM_ID, $RESULT_ID) {
    if ($WEB_FORM_ID == "3") {

        CFormResult::GetDataByID($RESULT_ID, array(), $arAnswers, $arQuestions);

        // Получение файлов
        $fileIDOffer = $arQuestions["SIMPLE_QUESTION_673"][10]["USER_FILE_ID"];
        $fileArrayOffer = CFile::GetFileArray($fileIDOffer);

        if ($arQuestions["SIMPLE_QUESTION_780"][9]["USER_FILE_ID"]) {
            $fileIDRedeem = $arQuestions["SIMPLE_QUESTION_780"][9]["USER_FILE_ID"];
            $fileArrayRedeem = CFile::GetFileArray($fileIDRedeem);
        }

        // Отправка письма с вложением
        $arEventFields = array(
            "SIMPLE_QUESTION_673" => $arQuestions["SIMPLE_QUESTION_673"][10]["USER_TEXT"],
            "SIMPLE_QUESTION_768" => $arQuestions["SIMPLE_QUESTION_768"][12]["USER_TEXT"],
            "SIMPLE_QUESTION_960" => $arQuestions["SIMPLE_QUESTION_960"][13]["USER_TEXT"],
//            "FILE_PATH_OFFER" => $fileArrayOffer["SRC"],
        );
//        AddMessage2Log(print_r($arEventFields, true), true);
//        if (isset($fileIDRedeem)) {
//            $arEventFields["SIMPLE_QUESTION_780"] = $arQuestions["SIMPLE_QUESTION_780"][9]["USER_TEXT"];
////            $arEventFields["FILE_PATH_REDEEM"] = $fileArrayRedeem["SRC"];
//            CEvent::Send("FORM_FILLING_SIMPLE_FORM_3", SITE_ID, $arEventFields, "N", "", array($fileIDOffer, $fileIDRedeem));
//        }
//        else {
//            CEvent::Send("FORM_FILLING_SIMPLE_FORM_3", SITE_ID, $arEventFields, "N", "", array($fileIDOffer));
//        }
    }
}