<?php
namespace Telegram\Document\Controller;

use Bitrix\Main\Context;
use Bitrix\Main\Engine\ActionFilter\Csrf;
use Bitrix\Main\Engine\Controller;
use Telegram\Document\ContactHandling;

class ContactHandlingController extends Controller {

    public function configureActions(): array
    {
        return [
            'handle_phone' => [
                'prefilters' => [
                    new Csrf(bitrix_sessid()),
                ]
            ],
        ];
    }
    public static function handle_phoneAction()
    {
        $request = Context::getCurrent()->getRequest();
        return ContactHandling::handlePhone($request->getPost("PHONE"));
    }
}