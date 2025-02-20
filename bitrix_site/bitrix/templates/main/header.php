<!DOCTYPE HTML>
<html xml:lang="ru" lang="ru">
<head>
<? $APPLICATION->ShowHead(); ?>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="robots" content="index, follow" />
<meta name="description" content="Интернет-магазин велосипедов, запчастей, аксессуаров, гироскутеров, самокатов, сноубордов и других спортивных товаров. Доставка по всей России." />
<link href="/bitrix/panel/main/popup.css?145667186522773" type="text/css"  rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/template_main_styles.css" type="text/css"  rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/page_main_styles.css" type="text/css"  data-template-style="true"  rel="stylesheet" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/colors.css" rel="stylesheet" type="text/css"  />

<link href='<?=SITE_TEMPLATE_PATH?>/css/google_fonts.css' rel='stylesheet' type='text/css'>
<link href="<?=SITE_TEMPLATE_PATH?>/css/allfont.css" rel="stylesheet" type="text/css" />

<link href="<?=SITE_TEMPLATE_PATH?>/css/normalize.css?14566718567346" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/owl.carousel.css?14566718561555" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.formstyler.css?14566718566232" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.fancybox.css?14566718564692" rel="stylesheet" type="text/css"/>
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery-ui-1.11.1.min.css?145667185630021" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.mCustomScrollbar_v2.css?145667185652425" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/jquery.jqzoom.css?14566718562336" rel="stylesheet" type="text/css"/>
<link href="<?=SITE_TEMPLATE_PATH?>/css/style.css?1489154290153707" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/icons.css?148783990810700" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/media.css?148913520754422" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/new_style.css?1234567890123" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/new_media.css?14651961862139" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/new_icons.css?148663390925167" rel="stylesheet" type="text/css" />
<link href="<?=SITE_TEMPLATE_PATH?>/css/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-1.11.1.min.js?145667186295786" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mousewheel.min.js?14633896232771" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-ui-1.11.1.min.js?1456671862238314" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.mCustomScrollbar.min.js?146338947739415" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/owl.carousel.js?148223498352860" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.maskedinput-1.3.min.js?14566718623574" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.formstyler.min.js?145667186213890" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.placeholder.js?14566718625291" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.fancybox.pack.js?145667186223135" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery.jqzoom-core.js?145667186231622" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/validate.min.js?145667186221068" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/masonry.pkgd.min.js?145667186225081" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/scripts.js?1487234630343945" type="text/javascript"></script>
<script src="<?=SITE_TEMPLATE_PATH?>/js/new_scripts.js?14566718621361" type="text/javascript"></script>


<script type="text/javascript">var ajaxMessages = {wait:"Загрузка..."}</script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/template_main_js.js"></script>
<script type="text/javascript" src="<?=SITE_TEMPLATE_PATH?>/js/page_main_js.js"></script>
<title><? $APPLICATION->showTItle();?></title>
<? 
/*
	<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
	<script type="<?=SITE_TEMPLATE_PATH?>/js/es5-shims.min.js" charset="utf-8"></script>
*/ 
?>


</head>
<body>
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<div class="page_w">
  <div class="page_c">
  	<!-- CITY BLOCK -->
    <div class="select_city_block">
      <div class="wrapper">
        <div class="select_city__title">Выберите ваш город </div>
        <div class="select_city__subtitle">Мы осуществляем доставку товаров по всей России <a href="/pomoshch/dostavka/">узнать подробнее о доставке</a></div>
        <div class="select_city__content">
          <div class="select_city__section">
            <form method="post" id="select_city" >
              <div class="select_city__section_title">
                <div class="letter_menu" id="select_city_letters"
									> <a href="#city_letter_2">А</a> <a href="#city_letter_8">В</a> <a href="#city_letter_6">Е</a> <a href="#city_letter_3">К</a> <a href="#city_letter_0">М</a> <a href="#city_letter_4">Н</a> <a href="#city_letter_10">Р</a> <a href="#city_letter_5">С</a> <a href="#city_letter_7">Т</a> <a href="#city_letter_9">Х</a> <a href="#city_letter_1">Я</a> </div>
              </div>
              <div class="select_city__section_content">
                <div class="city_letter_group" id="city_letter_2"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="184" 												>
                      <span>Абакан</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="226" 												>
                      <span>Анапа</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="220" 												>
                      <span>Армавир</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="263" 												>
                      <span>Артемовск</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_8"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="810" 												>
                      <span>Великий Новгород</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="270" 												>
                      <span>Владивосток</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="372" 												>
                      <span>Владимир</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="396" 												>
                      <span>Волгоград</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="924" 												>
                      <span>Волгодонск</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="416" 												>
                      <span>Вологда</span></label>
                    </div>
                    <div class="select_city__row" style="display:none;">
                      <label>
                      <input type="radio" class="styler" name="city" value="432" 												>
                      <span>Воронеж</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_6"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="231" 												>
                      <span>Ейск</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="1009" 												>
                      <span>Екатеринбург</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_3"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="550" 												>
                      <span>Кемерово</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="1240" 												>
                      <span>Керчь</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="219" 												>
                      <span>Краснодар</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="234" 												>
                      <span>Крымск</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="596" 												>
                      <span>Курган</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_0"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="21" 												>
                      <span>Майкоп</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="671" 												>
                      <span>Москва</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_4"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="781" 												>
                      <span>Нижний Новгород</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="223" 												>
                      <span>Новороссийск</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="822" 												>
                      <span>Новосибирск</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_10"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="922" 												>
                      <span>Ростов-на-Дону</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_5"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="959" 												>
                      <span>Самара</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="617" 												>
                      <span>Санкт-Петербург</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="1239" 												>
                      <span>Севастополь</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="1238" 												>
                      <span>Симферополь</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="224" 												>
                      <span>Сочи</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="283" 												>
                      <span>Ставрополь</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_7"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="931" 												>
                      <span>Таганрог</span></label>
                    </div>
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="1107" 												>
                      <span>Томск</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="243" 												>
                      <span>Туапсе</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_9"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="303" 												>
                      <span>Хабаровск</span></label>
                    </div>
                  </div>
                </div>
                <div class="city_letter_group" id="city_letter_1"
									>
                  <div class="select_city__col">
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="128" 												>
                      <span>Якутск</span></label>
                    </div>
                  </div>
                  <div class="select_city__col" >
                    <div class="select_city__row" >
                      <label>
                      <input type="radio" class="styler" name="city" value="1242" 												>
                      <span>Ялта</span></label>
                    </div>
                  </div>
                </div>
              </div>
            </form>
            <div class="city-search-form">
              <p class="white_text">Введите название вашего города</p>
              <div class="form-row">
                <input size="" name="USER_LOCATION_val" id="USER_LOCATION_val" value=""	type="text"	autocomplete="off" 	onfocus="loc_sug_CheckThis(this, this.id);"	/>
                <input type="hidden" name="USER_LOCATION" id="USER_LOCATION" value="0">
              </div>
              <div class="form-btn">
                <input type="submit" value="Сохранить" onClick=" sel_city($('#USER_LOCATION').val()); return false;" class="btn">
              </div>
            </div>
          </div>
          <div class="select_city__section">
            <div class="select_city__section_title"><strong>Адреса продаж</strong></div>
            <div class="select_city__section_content">
              <div class="select_city__address"><i class="icon icon-location_w"></i><b>Россия — 8 800 200 64 65</b></div>
              <? /*
              <div class="select_city__address"><i class="icon icon-location_w"></i>Краснодар - ул. Сормовская 2А, +7 (861) 210-35-10</div>
              <div class="select_city__address"><i class="icon icon-location_w"></i>Краснодар - ул. Дорожная 1Ж, +7 (861) 200-10-80</div>
              <div class="select_city__address"><i class="icon icon-location_w"></i>Краснодар - ул. Красных Партизан, 239, +7 (861) 298-10-80</div>
              <div class="select_city__address"><i class="icon icon-location_w"></i>Сочи - ул. Транспортная 1, +7 (862) 296-08-96</div>
              <div class="select_city__address"><i class="icon icon-location_w"></i>Ростов-на-Дону - ул. Красноармейская, 178, +7 (863) 204-09-01</div>
              <div class="select_city__address"><i class="icon icon-location_w"></i>Ставрополь, проспект Кулакова, 35А, +7 (865) 239-00-80</div>
              <div class="select_city__address"><i class="icon icon-location_w"></i>Новороссийск, ул. Исаева, 19, 8 800 500 03 20</div>
              */ ?>
            </div>
          </div>
        </div>
      </div>
      <div class="select_city_block__close"><i class="icon icon-close_w"></i></div>
      <script>
				$(document).ready(function() {
					$('#select_city_letters a').click(function(e) {
						e.preventDefault();
						var $this = $(this);
						if(!$this.hasClass('active')){
							$('#select_city_letters a').removeClass('active');
							$this.addClass('active');

							$('.select_city__section_content').find('.city_letter_group').hide();
							$($this.attr('href')).fadeIn();
						}
					});

					 $('.select_city__section_content .styler').styler();

					 $('.select_city_block__close').click(function(e) {
							$('.select_city_block').slideUp();
						});

						$('.select_city__row input:radio').change(function(){

							var city_id = $('#select_city input:checked').val();
							sel_city(city_id);
						});



				});

				function sel_city(city){
							$('.select_city_block').slideUp();
							var city_id = city;
							$.post( "/ajax/cookie.php",
									{CITY_ID: city_id},
									function(data){
										$('.location_select__target').html(data);
										$('.city_popup strong span').html(data);
										$('.accept_city_btn').attr('city-id', city_id);
										if ($.inArray(parseInt(city_id), [219, 224, 922, 283]) == -1)
											$('.location_phone_1').text('8 (800) 200-64-65');

										//console.log(data);
									}
								);
				}

				</script>
    </div>
    
    <!-- HEADER -->
    <div class="header">
      <div class="wrapper">
      <? /*
        <div class="header_top">
          <div class="header_top__l">
            <ul class="header_menu">
              <li><a href="/about/">О нас</a></li>
              <li><a href="/pomoshch/oplata/">Оплата</a></li>
              <li><a href="/pomoshch/dostavka/">Доставка</a></li>
              <li><a href="/pomoshch/">Помощь</a></li>
              <li><a href="/contacts/">Контакты</a></li>
            </ul>
          </div>
          <div class="header_top__r">
            <ul class="top_links">
              <li><a href="/uslugi/"><i class="icon icon-rent"></i>Прокат</a></li>
              <li><a href="/servis/"><i class="icon icon-repair"></i>Сервисный центр</a></li>
            </ul>
          </div>
        </div>
        */ ?>
        <div class="header_content">
          <div class="header__logo"> <a href="/" class="logo"> <img class="big" src="<?=SITE_TEMPLATE_PATH?>/images/velik_newlogo.png" width="218" height="43" alt="Вип Велик"> <img class="small" src="<?=SITE_TEMPLATE_PATH?>/images/logo_mobile.png" alt="Вип Велик"> </a>
            <ul class="location_phone">
              <li class="location_phone__location"> <i class="icon icon-location"></i> Город:
                <div class="location_select">
                  <div class="location_select__target"></div>
                  <div class="tooltip_popup city_popup" > <i class="icon icon-tooltip_location"></i> <strong>Ваш город — <span>?</span></strong>
                    <div class="city_popup__btns"> <a href="#" city-id=""  class="btn accept_city_btn">ДА</a> <a href="#" class="btn btn-white change_city_btn">Выбрать другой город</a> </div>
                    <small>От выбранного города зависят цены, наличие товара и способы доставки</small> </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="header__contacts">
            <ul class="location_phone">
              <li class="location_phone__location"> <i class="icon icon-location"></i> Город:
                <div class="location_select">
                  <div class="location_select__target"></div>
                  <div class="tooltip_popup city_popup" > <i class="icon icon-tooltip_location"></i> <strong>Ваш город — <span>?</span></strong>
                    <div class="city_popup__btns"> <a href="#" city-id=""  class="btn accept_city_btn">ДА</a> <a href="#" class="btn btn-white change_city_btn">Выбрать другой город</a> </div>
                    <small>От выбранного города зависят цены, наличие товара и способы доставки</small> </div>
                </div>
              </li>
              <li class="location_phone__phone"> <i class="icon icon-phone"></i> <strong> <span class="location_phone_1" style="display:block;"> 8 (800) 200-64-65 </span> </strong> <a href="#order_call_window" class="order_call_link">ОБРАТНЫЙ ЗВОНОК</a> </li>
            </ul>
          </div>
          <div class="header__control">
            <ul class="header__control_links">
              <li class="header_basket"> <a href="/personal/cart/"><i class="icon icon-basket"></i> <em id="order_count">0</em></a> <span id="small_basket_box"> </span> </li>
              <li class="header_favorites"> <a href="/personal/favorites/"><i class="icon icon-favorites"></i> <em id="favorite_count">0</em></a> </li>
              <li class="header_compare"> <a href="/compare/"><i class="icon2 icon-compare-main"></i> <em id="compare_count">0</em></a> </li>
            </ul>
            <? /*
            <span id="login-line">
            <div class="header__control_login"> <a href="/login/?backurl=%2F" class="bx_login_top_inline_link"><i class="icon icon-login"></i>ВХОД</a> </div>
            </span>
            <div id="bx_auth_popup_form" style="display:none;" class="bx_login_popup_form">
              <div class="login_page">
                <h2>Войти на сайт</h2>
                <div class="bx-auth">
                  <form method="post" name="bx_auth_servicesLFJQwNn5" target="_top" action="/">
                    <div class="bx-auth-service-form social_links" id="bx_auth_servLFJQwNn5">
                      <div id="bx_auth_serv_LFJQwNn5					VKontakte" class="social_link social_link-vk"> <a href="javascript:void(0)" onClick="BX.util.popup('https://oauth.vk.com/authorize?client_id=4843804&amp;redirect_uri=http://vip-velik.ru/index.php?auth_service_id=VKontakte&amp;scope=friends,video,offline&amp;response_type=code&amp;state=site_id%253Ds1%2526backurl%253D%25252F%25253Fcheck_key%25253Dd53d83f4a18371863a2a92ff0759a46d', 580, 400)" class="bx-ss-button vkontakte-button"></a><span class="bx-spacer"></span><span>Используйте вашу учетную запись VKontakte для входа на сайт.</span> </div>
                      <div id="bx_auth_serv_LFJQwNn5					Twitter" class="social_link social_link-tw"> <a href="javascript:void(0)" onClick="BX.util.popup('/?auth_service_id=Twitter&amp;check_key=d53d83f4a18371863a2a92ff0759a46d', 800, 450)" class="bx-ss-button twitter-button"></a><span class="bx-spacer"></span><span>Используйте вашу учетную запись на Twitter.com для входа на сайт.</span> </div>
                      <div id="bx_auth_serv_LFJQwNn5					Facebook" class="social_link social_link-fb"> <a href="javascript:void(0)" onClick="BX.util.popup('https://www.facebook.com/dialog/oauth?client_id=1416770661962149&amp;redirect_uri=http%3A%2F%2Fvip-velik.ru%2F%3Fauth_service_id%3DFacebook%26check_key%3Dd53d83f4a18371863a2a92ff0759a46d&amp;scope=email,user_birthday,publish_stream&amp;display=popup', 580, 400)" class="bx-ss-button facebook-button"></a><span class="bx-spacer"></span><span>Используйте вашу учетную запись на Facebook.com для входа на сайт.</span> </div>
                    </div>
                    <input type="hidden" name="auth_service_id" value="" />
                  </form>
                </div>
                <form name="system_auth_formPqgS8z" method="post" target="_top" action="/auth/" class="bx_auth_form">
                  <input type="hidden" name="AUTH_FORM" value="Y" />
                  <input type="hidden" name="TYPE" value="AUTH" />
                  <input type="hidden" name="backurl" value="/" />
                  <strong>Логин:</strong><br>
                  <input class="input_text_style" type="text" name="USER_LOGIN" maxlength="255" value="" />
                  <br>
                  <br>
                  <strong>Пароль:</strong><br>
                  <input class="input_text_style" type="password" name="USER_PASSWORD" maxlength="255" />
                  <br>
                  <span style="display:block;height:7px;"></span> <span class="rememberme">
                  <input type="checkbox" id="USER_REMEMBER" name="USER_REMEMBER" value="Y" checked/>
                  Запомнить меня</span>
                  <noindex> <span class="forgotpassword" style="padding-left:75px;"><a href="/auth?forgot_password=yes" rel="nofollow">Забыли пароль?</a></span> </noindex>
                  <br>
                  <br>
                  <input type="submit" name="Login" class="bt_blue big shadow" value="Войти" />
                </form>
              </div>
              <script type="text/javascript">
try{document.form_auth.USER_LOGIN.focus();}catch(e){}
</script>
            </div>
            <script>
		function openAuthorizePopup()
		{
			var authPopup = BX.PopupWindowManager.create("AuthorizePopup", null, {
				autoHide: true,
				//	zIndex: 0,
				offsetLeft: 0,
				offsetTop: 0,
				overlay : true,
				draggable: {restrict:true},
				closeByEsc: true,
				closeIcon: { right : "12px", top : "10px"},
				content: '<div style="width:400px;height:400px; text-align: center;"><span style="position:absolute;left:50%; top:50%"><img src="/bitrix/templates/.default/components/bitrix/system.auth.form/top_login/images/wait.gif"/></span></div>',
				events: {
					onAfterPopupShow: function()
					{
						this.setContent(BX("bx_auth_popup_form"));
					}
				}
			});

			authPopup.show();
		}
	</script>
	        */ ?>
          </div>
        </div>
      </div>
    </div>
    <!-- NAV BLOCK -->
    <div class="nav_block">
      <div class="wrapper">
        <div class="nav">
          <ul>
          	
            <li class="delimiter"></li>
            <li class="with_submenu for_more" style="position: relative">
              <a class="for_more" href="/uslugi-v-kitae/">УСЛУГИ В КИТАЕ</a>
              <div class="subnav for_more" style="width:280px">
                <div class="subnav_more" style="min-width:250px">
                  <ul>
                    <li><a href="/uslugi-v-kitae/poisk-postavshchika-v-kitae/">Поиск поставщика в Китае</a></li>
                    <li><a href="/uslugi-v-kitae/proizvodstvo-tovarov-v-kitae/">Производство товаров в Китае</a></li>
                    <li><a href="/uslugi-v-kitae/vykup-s-kitayskikh-ploshchadok/">Выкуп с китайских площадок</a></li>
                    <li><a href="/uslugi-v-kitae/perevodchiki-i-gidy-v-kitae/">Переводчики и гиды в Китае</a></li>
                    <li><a href="/uslugi-v-kitae/distribyutsiya-v-kitae/">Дистрибьюция в Китае</a></li>
                    <li><a href="/uslugi-v-kitae/tamozhennoe-oformlenie/">Таможенное оформление</a></li>
                    <li><a href="/uslugi-v-kitae/otkrytie-kompaniy/">Открытие компаний</a></li>
                    <li><a href="/uslugi-v-kitae/perevod-sredstv-v-kitay/">Перевод средств в Китай</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="delimiter"></li>
            <li class="with_submenu for_more" style="position: relative">
              <a class="for_more" href="/dostavka-i-oplata/">ДОСТАВКА И ОПЛАТА</a>
              <div class="subnav for_more">
                <div class="subnav_more">
                  <ul>
                    <li><a href="/dostavka-i-oplata/kak-zakazat/">Как заказать</a></li>
                    <li><a href="/dostavka-i-oplata/oplata/">Оплата</a></li>
                    <li><a href="/dostavka-i-oplata/dostavka/">Доставка</a></li>
                    <li><a href="/dostavka-i-oplata/chast-foto-otchetov/">Часть фото отчетов</a></li>
                  </ul>
                </div>
              </div>
            </li>
            <li class="delimiter"></li>
            <li class="with_submenu for_more" style="position: relative">
              <a class="for_more" href="/pomoshch/">ПОМОЩЬ</a>
              <div class="subnav for_more">
                <div class="subnav_more">
                  <ul>
                    <li><a href="/pomoshch/zhizn-kompanii/">Жизнь компании</a></li>
                    <li><a href="/pomoshch/o-nas/">О нас</a></li>
                    <li><a href="/pomoshch/kontakty/">Контакты</a></li>
                    <li><a href="/pomoshch/novosti/">Новости</a></li>
                    <li><a href="/pomoshch/dokumenty/">Документы</a></li>
                    <li><a href="/pomoshch/garantii/">Гарантии</a></li>
                    <li><a href="/pomoshch/faq/">FAQ</a></li>
                  </ul>
                </div>
              </div>
            </li>

            <li class="delimiter"></li>
          </ul>
        </div>
        <div class="nav_mobile_target" id="nav_mobile_target"></div>
        <div id="search" class="search_block">
          <form action="/search/" class="search_form" novalidate="novalidate">
            <input name="q"	id="qplSKIW" value="" class="search_input" type="text" 	autocomplete="off" />
            <input name="s" type="submit" value="" class="search_btn">
          </form>
        </div>
      </div>
    </div>
    

<? $dir = $APPLICATION->GetCurDir();
if ($dir=="/"){
?>
    <!-- MAIN SLIDER -->
<?$APPLICATION->IncludeComponent("bitrix:news.list", "main_slider", Array(
  "ACTIVE_DATE_FORMAT" => "d.m.Y",  
    "ADD_SECTIONS_CHAIN" => "N",  
    "AJAX_MODE" => "N", 
    "AJAX_OPTION_ADDITIONAL" => "", 
    "AJAX_OPTION_HISTORY" => "N", 
    "AJAX_OPTION_JUMP" => "N",  
    "AJAX_OPTION_STYLE" => "Y", 
    "CACHE_FILTER" => "N",  
    "CACHE_GROUPS" => "Y",  
    "CACHE_TIME" => "36000000", 
    "CACHE_TYPE" => "A",  
    "CHECK_DATES" => "Y", 
    "DETAIL_URL" => "", 
    "DISPLAY_BOTTOM_PAGER" => "N",  
    "DISPLAY_DATE" => "N",  
    "DISPLAY_NAME" => "N",  
    "DISPLAY_PICTURE" => "Y", 
    "DISPLAY_PREVIEW_TEXT" => "N",  
    "DISPLAY_TOP_PAGER" => "N", 
    "FIELD_CODE" => array(  
      0 => "ID",
      1 => "CODE",
      2 => "NAME",
      3 => "PREVIEW_PICTURE",
      4 => "",
    ),
    "FILE_404" => "",
    "FILTER_NAME" => "",  
    "HIDE_LINK_WHEN_NO_DETAIL" => "N",  
    "IBLOCK_ID" => "6", 
    "IBLOCK_TYPE" => "content", 
    "INCLUDE_IBLOCK_INTO_CHAIN" => "N", 
    "INCLUDE_SUBSECTIONS" => "N", 
    "MESSAGE_404" => "",  
    "NEWS_COUNT" => "20", 
    "PAGER_BASE_LINK_ENABLE" => "N",  
    "PAGER_DESC_NUMBERING" => "N",  
    "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000", 
    "PAGER_SHOW_ALL" => "N",  
    "PAGER_SHOW_ALWAYS" => "N", 
    "PAGER_TEMPLATE" => ".default", 
    "PAGER_TITLE" => "Новости", 
    "PARENT_SECTION" => "", 
    "PARENT_SECTION_CODE" => "",  
    "PREVIEW_TRUNCATE_LEN" => "", 
    "PROPERTY_CODE" => array( 
      0 => "LINK",
      1 => "",
    ),
    "SET_BROWSER_TITLE" => "N", 
    "SET_LAST_MODIFIED" => "N", 
    "SET_META_DESCRIPTION" => "N",  
    "SET_META_KEYWORDS" => "N", 
    "SET_STATUS_404" => "N",  
    "SET_TITLE" => "N", 
    "SHOW_404" => "N",  
    "SORT_BY1" => "SORT", 
    "SORT_BY2" => "SORT", 
    "SORT_ORDER1" => "ASC", 
    "SORT_ORDER2" => "ASC", 
  ),
  false
);?>


<?
}
else{
?>
<div class="content">

    <div class="wrapper">
      <div class="page_header">
        <div class="page_title"> </div>
        <?$APPLICATION->IncludeComponent("bitrix:breadcrumb", "bread", Array("START_FROM" => "0","PATH" => "","SITE_ID" => "-",),false);?>
      </div>
      

<? }?>
    