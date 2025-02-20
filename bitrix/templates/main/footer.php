<? $dir = $APPLICATION->GetCurDir();
if ($dir=="/"){
}
else{
?>

    </div>

</div>
<? }?>    
    <!-- SUBSCRIBE -->
    <div class="subscribe_block">
      <div class="wrapper">
        <div class="subscribe_block__l"><i class="icon icon-subscribe"></i> <span>ПОДПИШИТЕСЬ ЧТОБЫ УЗНАВАТЬ ОДНИМ ИЗ ПЕРВЫХ!</span></div>
        <div class="subscribe_block__r">
          <form action="/" method="post" onSubmit="if($('#subcribe_email').val() == '') $('#update_subscribe_input').val('');" class="subscribe_form" novalidate="novalidate">
            <input type="hidden" name="sessid" id="sessid" value="526afd77ee3163f0dbba952c14247136" />
            <input type="text" name="EMAIL" id="subcribe_email"  placeholder="Введите свой E-mail" class="required email" value=""  />
            <p style="display:none;">Рубрики подписки<span class="starrequired">*</span><br />
              <label>
              <input type="checkbox" name="RUB_ID[]" value="2" checked  />
              Основная рассылка</label>
              <br />
            </p>
            <p style="display:none;">Предпочтительный формат<br />
              <label>
              <input type="radio" name="FORMAT" value="html" checked />
              HTML</label>
            </p>
            <input type="submit" name="Save" value="ПОДПИСАТЬСЯ" class="btn btn-large btn-red">
            <input type="hidden" name="PostAction" value="Add" />
            <input type="hidden" name="ID" value="" />
          </form>
          <script>
$(document).ready(function(){
  $('#settings_subscribe').on
});
</script>
        </div>
      </div>
    </div>
    
    
    
    <!-- FOOTER -->
    <div class="footer">
      <div class="footer_main">
        <div class="wrapper">
          <div class="footer_sidebar">
            <div class="h3">КАТАЛОГ</div>
            <div class="scrollbar scrollbar-w">
              <ul>
                <li><a  href="/velosipedy/"> Велосипеды</a></li>
                <li><a  href="/girobordy/">Гироскутеры</a></li>
                <li><a  href="/samokaty/">Самокаты</a></li>
                <li><a  href="/skeytbordy/">Скейтборды</a></li>
                <li><a  href="/kolyaski/">Коляски</a></li>
              </ul>
            </div>
          </div>
          <div class="footer_content">
            <div class="footer_col">
              <div class="h3">ПОМОЩЬ</div>
              <ul>
                <li><a  href="/pomoshch/oplata">Оплата</a></li>
                <li><a  href="/pomoshch/dostavka">Доставка</a></li>
                <li><a  href="/pomoshch/kak-sdelat-zakaz">Как сделать заказ</a></li>
                <li><a  href="/pomoshch/polzovatelskoe-soglashenie">Пользовательское соглашение</a></li>
                <li><a  href="/pomoshch/vozvrat-i-obmen">Возврат и обмен</a></li>

              </ul>
            </div>
            <div class="footer_col">
              <div class="h3">О НАС</div>
              <ul>
                <li><a  href="/about">Наша история</a></li>
                <li><a  href="/rekvizity">Реквизиты</a></li>
                <li><a  href="/contacts">Контакты</a></li>
              </ul>
            </div>
            <div class="footer_socail">
              <div style="font-size:17px;" class="h3">МЫ В СОЦИАЛЬНЫХ СЕТЯХ</div>
              <div class="social_links"> <a target="_blank" rel="nofollow" href="https://twitter.com/" class="social_link social_link-tw"></a> <a target="_blank" rel="nofollow" href="https://www.facebook.com/" class="social_link social_link-fb"></a> <a target="_blank" rel="nofollow" href="http://instagram.com/" class="social_link social_link-in"></a> <a  target="_blank" rel="nofollow"  href="https://vk.com/" class="social_link social_link-vk"></a> <a target="_blank" rel="nofollow" href="http://www.youtube.com/user/" class="social_link social_link-yt"></a>
                
              </div>
            </div>
            
          </div>
          <!-- For Web version -->
          <div class="footer_widgets"> </div>
        </div>
      </div>
      <div class="footer_bottom">
        <div class="wrapper">
          <!-- For Mobile version -->
          <div align="center" class="footer_widgets footer_widgets_bottom" style="padding-top: 0px !important; padding-bottom: 30px !important;">
            <div class="social_widget widget_safeonline" style="padding-left:5px;"> </div>
          </div>
          <div class="copyright">©2014-2017 Интернет-магазин www.vip-velik.ru</div>
          <div style="text-align: center;">
            <div class="footer_phone"> <span class="location_phone_1" style="display:block;">
              <div class="icon icon-phone"></div>
              8-800-200-6465 </span> </div>
          </div>
          <div class="footer_pay"> <a href="/pomoshch/kak-oplatit/"><img src="<?=SITE_TEMPLATE_PATH?>/images/visa.png" width="36" height="22" alt=""></a> <a href="/pomoshch/kak-oplatit/"><img src="<?=SITE_TEMPLATE_PATH?>/images/master.png" width="36" height="22" alt=""></a> </div>
          <div class="footer_tinkoff"><a href="/pomoshch/kak-oplatit/"><img src="<?=SITE_TEMPLATE_PATH?>/images/tinkoff.png" width="169" height="38" alt=""></a></div>

<div style="font-size: 11px;line-height: 11px;clear: both;padding-top: 45px;">
<? $APPLICATION->IncludeComponent("bitrix:main.include","", Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/inc/inc_footer_terms.php")); ?>
</div>

        </div>
      </div>
    </div>
    
    <!-- POPUPS -->
    <div class="popup_window popup_window-black order_call_window" id="online_window">
      <div class="popup_window__c">
        <div class="popup_window__content">
          <p><font class="errortext">Веб-форма не найдена.</font></p>
        </div>
      </div>
    </div>
    <script>
    $(document).ready(function(){
      /* Мне не нравится цена*/
      $('.new_price_link').click(function(e) {
        e.preventDefault();
        $.fancybox.open('#new_price',{
          padding : 0,
          wrapCSS : 'fancy_popup'
        });
      });
    });
  </script>
    <div class="popup_window popup_window-black order_call_window" id="new_price">
      <div class="popup_window__c">
        <div class="popup_window__header">
          <div class="popup_window__title">Хочу скидку!</div>
          <span class="popup_close"></span> </div>
        <div class="popup_window__content">
          <form name="SIMPLE_FORM_4" action="/" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="sessid" id="sessid_1" value="526afd77ee3163f0dbba952c14247136" />
            <input type="hidden" name="WEB_FORM_ID" value="4" />
            <div class="form_row">
              <input type="text"  class="required name-inp" placeholder="Ваше ФИО" name="form_text_10" >
            </div>
            <div class="form_row">
              <input type="text" class="required" placeholder="E-mail" name="form_text_11" >
            </div>
            <div class="form_row">
              <input type="text"  class="required name-inp" placeholder="Ссылка на товар в другом интернет-магазине" name="form_text_13" >
            </div>
            <div class="form_row">
              <input type="text"  class="required" placeholder="Цена товара в другом интернет-магазине" name="form_text_14" >
            </div>
            <div class="form_row">
              <div style="float:left; width:40%;">
                <input type="hidden" name="captcha_sid" value="00a03a30218a5cbefb5484ca0cdd0d04" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=00a03a30218a5cbefb5484ca0cdd0d04" width="180" height="40" /> </div>
              <div style="width:60%; float:right;">
                <input type="text" name="captcha_word" class="required" placeholder="Защитный код" />
              </div>
            </div>
            <input type="hidden" name="form_text_12" value="http://vip-velik.ru/">
            <div class="clear box-pos error-box" >
              <div style="float:left;">
                <input  name="UF_SOGL" type="checkbox" class="styler" value=""/>
              </div>
              <div style="float:left;">Я согласен с условиями <a href="/promo/#myprice">акции</a></div>
              <div class="for_error_2"><span style="display: none;" class="grom_tup error_label2">Примите условия акции</span></div>
            </div>
            <div class="form_submit_row">
              <div class="align-center">
                <input type="submit" name="web_form_submit" value="Отправить" class="btn btn-full">
              </div>
            </div>
          </form>
          <script>
      $(document).ready(function() {
        $('form:not(.subscribe_form)').each(function() {
          $(this).validate({
            errorElement: 'div'
          });
        });
      }); 
      </script>
        </div>
      </div>
    </div>
    <div class="popup_window popup_window-black one_click_window" id="one_click_window">
      <div class="popup_window__header">
        <div class="popup_window__title">Купить в 1 клик</div>
        <span class="popup_close" ></span> </div>
      <div class="popup_window__content"> </div>
    </div>
    <div class="popup_window popup_window-black one_click_window" id="auth_secure">
      <div class="popup_window__header">
        <div class="popup_window__title">Введите код для регистрации</div>
        <span class="popup_close" ></span> </div>
      <div class="popup_window__content">
        <p>Введите код отправленный вам в смс сообщении</p>
        <form id="secure_form">
          <input type="hidden" name="user_id" value="" />
          <div class="form_row">
            <input type="text" id="secure_code" class="required" placeholder="Код" name="code">
            <p class="error-text" style="display:none;"></p>
          </div>
          <div class="form_submit_row">
            <div class="align-center">
              <input type="submit" onClick="check_user();return false;" value="Отправить" class="btn btn-full">
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="popup_window popup_window-black order_call_window order_call_window-call" id="order_call_window">
      <div class="popup_window__c">
        <div class="popup_window__header">
          <div class="popup_window__title">Заказать обратный звонок</div>
          <span class="popup_close"></span> </div>
        <div class="popup_window__content">
          <form name="SIMPLE_FORM_1" action="/" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="sessid" id="sessid_2" value="526afd77ee3163f0dbba952c14247136" />
            <input type="hidden" name="WEB_FORM_ID" value="1" />
            <div class="form_row">
              <input type="text"  class="required name-inp" placeholder="Ваше имя" name="form_text_1" >
            </div>
            <div class="form_row">
              <input type="text" class="required phone-inp" placeholder="E-mail / Номер телефона"name="form_text_2" >
            </div>
            <div class="form_row">
              <div style="float:left; width:50%;">
                <input type="hidden" name="captcha_sid" value="079e6cd520cd50d48ad8cd2505a16a7b" />
                <img src="/bitrix/tools/captcha.php?captcha_sid=079e6cd520cd50d48ad8cd2505a16a7b" width="180" height="40" /> </div>
              <div style="width:40%; float:right;">
                <input type="text" name="captcha_word" class="required" placeholder="Защитный код" />
              </div>
            </div>
            <div class="form_submit_row">
              <div class="align-center">
                <input type="submit" name="web_form_submit" value="Отправить" class="btn btn-full">
              </div>
            </div>
          </form>
          <script>
$(document).ready(function() {
  $('form:not(.subscribe_form)').each(function() {
        $(this).validate({
            errorElement: 'div'
        });
    });
}); 
</script>
        </div>
      </div>
    </div>
    <div class="popup_window quick_view_window" id="quick_view_window"> </div>
    <img id="waiting" style="display:none;" src="<?=SITE_TEMPLATE_PATH?>/images/loading.gif" alt="Подождите" />
    <div class="popup_window popup_window-white size_table_window" id="size_table_window">
      <div class="popup_window__header" style="border-bottom: none;">
        <div class="popup_window__title">Таблица размеров</div>
      </div>
      <div class="popup_window__content" style="padding-top: 0;"> </div>
    </div>
    
    
    <a href="#online_window" class="order_call_link_side"></a>
    
    
    <!-- MOBILE VERSION -->
    <div class="nav_mobile_block">
      <div class="nav_mobile" id="nav_mobile">
        <ul class="location_phone">
          <li class="location_phone__phone"> <i class="icon icon-phone"></i> <strong> <span class="location_phone_1" style="display:block;"> 8-800-200-6465 </span> </strong> <a href="#order_call_window" class="order_call_link" style="color: #fff;">ОБРАТНЫЙ ЗВОНОК</a> </li>
        </ul>
        <ul class="nav_mobile_menu">
          <li><a href="/contacts/">Контакты</a></li>
          
<? /*
          <li  class="with_submenu"> <a href="/velosipedy/"><i class="icon icon-nav_mobile icon-nav_mobile-velosipedi"></i> <span> Велосипеды</span></a>
            <ul>
              <li  class="with_submenu"><a href="/velosipedy/gornye/"> Горные</a>
                <ul>
                  <li><a href="/velosipedy/gornye/kross_kantri/"> Кросс-кантри</a></li>
                </ul>
              </li>
              <li  class="with_submenu"><a href="/velosipedy/dvukhpodvesy/"> Двухподвесы</a>
                <ul>
                  <li><a href="/velosipedy/dvukhpodvesy/kross_kantri/"> Кросс-кантри</a></li>
                  <li><a href="/velosipedy/dvukhpodvesy/treyl_enduro/"> Трейл Эндуро</a></li>
                  <li><a href="/velosipedy/dvukhpodvesy/frirayd_daunkhil/"> Фрирайд Даунхил</a></li>
                </ul>
              </li>
              <li  class="with_submenu"><a href="/velosipedy/shosseynye_i_tsiklokrossy/"> Шоссейные и циклокроссы</a>
                <ul>
                  <li><a href="/velosipedy/shosseynye_i_tsiklokrossy/tsiklokrossy/"> Циклокроссы</a></li>
                  <li><a href="/velosipedy/shosseynye_i_tsiklokrossy/shosseynye/"> Шоссейные</a></li>
                </ul>
              </li>
              <li  ><a href="/velosipedy/strit_dert/"> Стрит Дерт</a> </li>
              <li  ><a href="/velosipedy/detskie/"> Детские</a> </li>
              <li  ><a href="/velosipedy/trekhkolesnye/"> Трехколесные</a> </li>
              <li  class="with_submenu"><a href="/velosipedy/begovely/"> Беговелы</a>
                <ul>
                  <li><a href="/velosipedy/begovely/dlya_malchikov/"> Для мальчиков</a></li>
                  <li><a href="/velosipedy/begovely/dlya_devochek/"> Для девочек</a></li>
                </ul>
              </li>
              <li  ><a href="/velosipedy/fiks/"> Фикс</a> </li>
              <li  ><a href="/velosipedy/skladnye/"> Складные</a> </li>
              <li  class="with_submenu"><a href="/velosipedy/zhenskie/"> Женские</a>
                <ul>
                  <li><a href="/velosipedy/zhenskie/gornye/"> Горные</a></li>
                  <li><a href="/velosipedy/zhenskie/gorodskie_komfortnye/"> Городские комфортные</a></li>
                  <li><a href="/velosipedy/zhenskie/kruizery/"> Круизеры</a></li>
                </ul>
              </li>
              <li  class="with_submenu"><a href="/velosipedy/gorodskie_i_dorozhnye/"> Городские и дорожные</a>
                <ul>
                  <li><a href="/velosipedy/gorodskie_i_dorozhnye/komfortnye_i_kruizery/"> Комфортные и круизеры</a></li>
                  <li><a href="/velosipedy/gorodskie_i_dorozhnye/gorodskie_i_turisticheskie/"> Городские и туристические</a></li>
                </ul>
              </li>
              <li  ><a href="/velosipedy/elektrovelosipedy/"> Электровелосипеды</a> </li>
              <li  ><a href="/velosipedy/bmx/"> BMX</a> </li>
              <li  ><a href="/velosipedy/fetbayki/"> Фэтбайки</a> </li>
            </ul>
          </li>











*/ ?>


<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree_mobile", Array(
  "ADD_SECTIONS_CHAIN" => "N",  
    "CACHE_GROUPS" => "Y",  
    "CACHE_TIME" => "36000000", 
    "CACHE_TYPE" => "A",  
    "COUNT_ELEMENTS" => "N",  
    "IBLOCK_ID" => "2", 
    "IBLOCK_TYPE" => "catalog", 
    "SECTION_CODE" => "", 
    "SECTION_FIELDS" => array(  
      0 => "ID",
      1 => "NAME",
      2 => "PICTURE",
      3 => "",
    ),
    "SECTION_ID" => $_REQUEST["SECTION_ID"],  
    "SECTION_URL" => "",  
    "SECTION_USER_FIELDS" => array( 
      0 => "UF_TYPES",
      1 => "",
    ),
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "3", 
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "tree"
  ),
  false
);?>

<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree_mobile", Array(
  "ADD_SECTIONS_CHAIN" => "N",  
    "CACHE_GROUPS" => "Y",  
    "CACHE_TIME" => "36000000", 
    "CACHE_TYPE" => "A",  
    "COUNT_ELEMENTS" => "N",  
    "IBLOCK_ID" => "3", 
    "IBLOCK_TYPE" => "catalog", 
    "SECTION_CODE" => "", 
    "SECTION_FIELDS" => array(  
      0 => "ID",
      1 => "NAME",
      2 => "PICTURE",
      3 => "",
    ),
    "SECTION_ID" => $_REQUEST["SECTION_ID"],  
    "SECTION_URL" => "",  
    "SECTION_USER_FIELDS" => array( 
      0 => "UF_TYPES",
      1 => "",
    ),
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "3", 
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "tree"
  ),
  false
);?>


<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree_mobile", Array(
  "ADD_SECTIONS_CHAIN" => "N",  
    "CACHE_GROUPS" => "Y",  
    "CACHE_TIME" => "36000000", 
    "CACHE_TYPE" => "A",  
    "COUNT_ELEMENTS" => "N",  
    "IBLOCK_ID" => "10", 
    "IBLOCK_TYPE" => "catalog", 
    "SECTION_CODE" => "", 
    "SECTION_FIELDS" => array(  
      0 => "ID",
      1 => "NAME",
      2 => "PICTURE",
      3 => "",
    ),
    "SECTION_ID" => $_REQUEST["SECTION_ID"],  
    "SECTION_URL" => "",  
    "SECTION_USER_FIELDS" => array( 
      0 => "UF_TYPES",
      1 => "",
    ),
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "3", 
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "tree"
  ),
  false
);?>

<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree_mobile", Array(
  "ADD_SECTIONS_CHAIN" => "N",  
    "CACHE_GROUPS" => "Y",  
    "CACHE_TIME" => "36000000", 
    "CACHE_TYPE" => "A",  
    "COUNT_ELEMENTS" => "N",  
    "IBLOCK_ID" => "12", 
    "IBLOCK_TYPE" => "catalog", 
    "SECTION_CODE" => "", 
    "SECTION_FIELDS" => array(  
      0 => "ID",
      1 => "NAME",
      2 => "PICTURE",
      3 => "",
    ),
    "SECTION_ID" => $_REQUEST["SECTION_ID"],  
    "SECTION_URL" => "",  
    "SECTION_USER_FIELDS" => array( 
      0 => "UF_TYPES",
      1 => "",
    ),
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "3", 
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "tree"
  ),
  false
);?>

<?$APPLICATION->IncludeComponent("bitrix:catalog.section.list", "tree_mobile", Array(
  "ADD_SECTIONS_CHAIN" => "N",  
    "CACHE_GROUPS" => "Y",  
    "CACHE_TIME" => "36000000", 
    "CACHE_TYPE" => "A",  
    "COUNT_ELEMENTS" => "N",  
    "IBLOCK_ID" => "11", 
    "IBLOCK_TYPE" => "catalog", 
    "SECTION_CODE" => "", 
    "SECTION_FIELDS" => array(  
      0 => "ID",
      1 => "NAME",
      2 => "PICTURE",
      3 => "",
    ),
    "SECTION_ID" => $_REQUEST["SECTION_ID"],  
    "SECTION_URL" => "",  
    "SECTION_USER_FIELDS" => array( 
      0 => "UF_TYPES",
      1 => "",
    ),
    "SHOW_PARENT_NAME" => "Y",
    "TOP_DEPTH" => "3", 
    "VIEW_MODE" => "LINE",
    "COMPONENT_TEMPLATE" => "tree"
  ),
  false
);?>



          <li><a href="/about/"><span>О нас</span></a></li>
          <li><a href="/pomoshch/oplata/">Оплата</a></li>
          <li><a href="/pomoshch/dostavka/">Доставка товара </a></li>
          <li class="list_close_nav_mobile"> <a href="javascript:void(0);" id="btn_close_nav_mobile">
            <div> ЗАКРЫТЬ</div>
            </a> </li>
        </ul>
      </div>
    </div>
  </div>
  
</div>


<a href="#" id="up"></a>
<div id="menu_overlay" style="display:none;"></div>
<div id="menu_overlay_header" style="display:none;"></div>
<script>
var top_show = 300; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
  var delay = 1000; // Задержка прокрутки
  $(document).ready(function() {
  var pause = false;
  var tt = false;
    $(window).scroll(function () {
      if ($(this).scrollTop() > top_show && !pause)
      $('#up').fadeIn();
      else
      $('#up').fadeOut();
    });
    $('#up').click(function () {
      $('body, html').animate({
        scrollTop: 0
      }, delay);
    pause = true;
    setTimeout(function(){
    pause = false;
    }, 2000);
    });
  });
  $(document).ready(function(){
  if ($('#panel').length) $('#menu_overlay_header').css('top', $('#panel').innerHeight()+'px');
  });
</script>
</body>
</html>