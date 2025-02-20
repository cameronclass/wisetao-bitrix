<?php
declare(strict_types=1);

namespace Vkpixel;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Page\Asset;

class Main
{
    public static function appendScriptsToPage()
    {
        if (!defined('ADMIN_SECTION') && $ADMIN_SECTION !== true) {
            $module_id = 'vkads.pixel';
            $counterId = (string) Option::get($module_id, 'vkpixel_text', 'N');

            if ($counterId !== 'N') {
                Asset::getInstance()->addString('<!-- Top.Mail.Ru counter --><script type="text/javascript"> var _tmr = window._tmr || (window._tmr = []); _tmr.push({id: "' . $counterId . '", type: "pageView", start: (new Date()).getTime()}); (function (d, w, id) { if (d.getElementById(id)) return; var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id; ts.src = "https://top-fwz1.mail.ru/js/code.js"; var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);}; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "tmr-code");</script><noscript><div><img src="https://top-fwz1.mail.ru/counter?id=' . $counterId . ';js=na" style="position:absolute;left:-9999px;" alt="Top.Mail.Ru" /></div></noscript><!-- /Top.Mail.Ru counter -->');
            }
        }

        return false;
    }
}
