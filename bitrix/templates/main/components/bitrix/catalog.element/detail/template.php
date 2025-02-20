<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<style>
	.col_info.dddd img{
		max-width:100%;
	}
</style>

<div class="main_content">
<div class="main_content__c">
  <div class="product">
    <div class="product__image">
      <div class="product_gallery" id="product_gallery_1" >
        <div class="images">
        <? 
      $img_174 = CFile::resizeImageGet($arResult['PREVIEW_PICTURE']['ID'],array('width'=>410,'height'=>410), BX_RESIZE_IMAGE_PROPORTIONAL, true);
      ?>
          <div class="product_gallery__image"> <a href="<?=$arResult['PREVIEW_PICTURE']['SRC']?>" class="fancybox-product-detail" rel="gal"> <img src="<?=$img_174['src']?>" alt="<?=$arResult['NAME']?>" class="middle-image"> </a> </div>
          
          <?
        foreach($arResult['PROPERTIES']['IMAGES']['VALUE'] as $ad_images){
          $ad_images_min = CFile::resizeImageGet($ad_images,array('width'=>410,'height'=>410), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        ?>
          
          <div class="product_gallery__image"> <a href="<?=CFile::getPath($ad_images)?>" class="fancybox-product-detail" rel="gal"> <img src="<?=$ad_images_min['src']?>" alt="<?=$arResult['NAME']?>" class="middle-image"> </a> </div>
          
              <? } ?>
        </div>
        <div class="product_gallery__thumbs_wrapper">
          <div class="product_gallery__thumbs thumbs">
          <? 
      $img_68 = CFile::resizeImageGet($arResult['PREVIEW_PICTURE']['ID'],array('width'=>68,'height'=>88), BX_RESIZE_IMAGE_EXACT, true);
      ?>
            <a href="#" class="zoomThumbActive"><img src="<?=$img_68['src']?>" alt="<?=$arResult['NAME']?>"></a>
            
           <?
          foreach($arResult['PROPERTIES']['IMAGES']['VALUE'] as $ad_images){
        $ad_images_min2 = CFile::resizeImageGet($ad_images,array('width'=>68,'height'=>88), BX_RESIZE_IMAGE_EXACT, true);
      ?>  
            <a href="#" class=""><img src="<?=$ad_images_min2['src']?>" alt="<?=$arResult['NAME']?>"></a>
        <? }?>
          </div>
        </div>
      </div>
<style>
.product_gallery .images .product_gallery__image {
    display: none;
}
.product_gallery .images .product_gallery__image:first-child {
    display: block;
}
.product_gallery .zoomWrapper {
    width: 610px !important;
    height: 610px !important;
    overflow: hidden;
}
img {
    max-width: none;
}
</style>
<script>
$(document).ready(function() {
firstim = $('.product_gallery .images .product_gallery__image a:first')
firstim.jqzoom({
    zoomWidth: 613,
    zoomHeight: 613,
    preloadText: 'Загрузка...',
});
img = firstim.find('img:first');
img.load(function(){
    w = img.width();
    x = Math.floor((410-w)/2);
    firstim.find('.zoomPup').css('margin-left', x+'px');
    firstim.find('.zoomPreload').css('margin-left', x+'px');
});
w = img.width();
x = Math.floor((410-w)/2);
firstim.find('.zoomPup').css('margin-left', x+'px');
firstim.find('.zoomPreload').css('margin-left', x+'px');


$('.show_detail_params > a').click(
  function(){
    $('.content_block .tabs_menu li:eq(1) a').click();
    return false;
  }
);


$('.product_gallery .thumbs a').click(function() {
    $(this).parents('.thumbs').find('a').removeClass('zoomThumbActive');
    $(this).addClass('zoomThumbActive');
    $(this).parents('.product_gallery').find('.images .product_gallery__image').hide();
    im = $(this).parents('.product_gallery').find('.images .product_gallery__image:eq('+$(this).parent().index()+')');

    im.fadeIn(400);
    im.find('a').jqzoom({
        zoomWidth: 613,
        zoomHeight: 613,
        preloadText: 'Загрузка...',
    });
    img = im.find('img:first');
    w = img.width();
    x = Math.floor((410-w)/2);
    im.find('.zoomPup').css('margin-left', x+'px');
    im.find('.zoomPreload').css('margin-left', x+'px');

    $('.product__image_control a').attr('href', im.find('a').attr('href'));
    return false;
});
});
</script>

<? /*
      <a href="/personal/favorites/" class="dofavorite"></a>
     */ ?> 
      <div class="product_detail_icons"> </div>
      <a href="#" class="docompare" title="В сравнение" data-id="" data-iid="5"></a>
      <div class="product__image_control"> <a class="fancybox-product-detail" rel="gal" href="/upload/iblock/cc9/cc95e29dd272955bec9fa30f804ae02d.jpg"><i class="icon icon-c_zoom"></i></a> </div>
      <div class="product__social_share">
        <div class="social_share">
          <div class="ya-share2" data-services="vkontakte,facebook,twitter" data-counter=""></div>
        </div>
      </div>
    </div>
    <div class="product__description">
      <div class="product__description_c">
        <div class="product__header">
        <? if($arResult['PROPERTIES']['BRAND']['VALUE']){?>
        <? $img_135 = CFile::resizeImageGet($arResult['DISPLAY_PROPERTIES']['BRAND']['FULL']['PREVIEW_PICTURE'],array('width'=>135,'height'=>50), BX_RESIZE_IMAGE_PROPORTIONAL, true); ?>
        <div class="product__brand"><a href="<?=$arResult['DISPLAY_PROPERTIES']['BRAND']['FULL']['DETAIL_PAGE_URL']?>"><img src="<?=$img_135['src']?>" alt="<?=$arResult['DISPLAY_PROPERTIES']['BRAND']['FULL']['NAME']?>" /></a></div>
        <? }?> 
      <div class="product__title" >
            <h1><?=$arResult['NAME']?></h1>
          </div>
          <div class="product__subtitle">
          <? /*
            <div class="product__rating"> <a href="javascript:void(0);" onclick="$('html, body').stop().animate({ scrollTop: $('#reviews_block').offset().top}, 1000); $('.add_comment_link').click();" style="text-decoration:none;" >
            
              <div class="rating">
                <table align="center" class="bx_item_detail_rating">
                  <tr>
                    <td><div class="bx_item_rating">
                        <div class="bx_stars_container">
                          <div id="bx_vo_5_175748_3ePA7J_stars" class="bx_stars_bg"></div>
                          <div id="bx_vo_5_175748_3ePA7J_progr" class="bx_stars_progres"></div>
                        </div>
                      </div></td>
                  </tr>
                </table>
              </div>
              
              <!--<span id="-->
              <!--" class="bx_stars_rating_votes rating_label">(0)</span>-->
              <script type="text/javascript">
BX.ready(function(){
window.bx_vo_5_175748_3ePA7J = new JCIblockVoteStars({'progressId':'bx_vo_5_175748_3ePA7J_progr','ratingId':'bx_vo_5_175748_3ePA7J_rating','starsId':'bx_vo_5_175748_3ePA7J_stars','ajaxUrl':'/bitrix/components/bikecenter/iblock.vote/component.php','voteId':'175748'});

window.bx_vo_5_175748_3ePA7J.ajaxParams = {'SESSION_PARAMS':'a76a7613446fbe3c97d7f92ad0eec3cb','PAGE_PARAMS':{'ELEMENT_ID':'175748'},'sessid':'1bcfe07c9d0c1b8205a2aa860a276a0b','AJAX_CALL':'Y'};
window.bx_vo_5_175748_3ePA7J.setValue("80");
//  window.//.setVotes("//");
});
</script>
              </a> </div >
              */ ?>
            <div class="product__articule">Артикул: 000-<?=$arResult['ID']?></div>
          </div>
        </div>
        <script>
                                    var basket_offers = Array();
                                    function escapeHtml(text) {
                                          return text
                                              .replace(/&/g, "&amp;")
                                              .replace(/</g, "&lt;")
                                              .replace(/>/g, "&gt;")
                                              .replace(/"/g, "&quot;")
                                              .replace(/'/g, "&#039;");
                                        }
                                    $(document).ready(function(){

                                        $('#SIZE_SELECT-styler div.jq-selectbox__select').click(function(){
                                            $('#SIZE_SELECT-styler').removeClass('error');
                                            console.log("1");
                                            $('.size_error').hide();
                                        });

                                        $('.coloredik').click(function(){
                                            $('#COLOR_SELECT-styler').removeClass('error');
                                            console.log("2");
                                            $('span.color_error').hide();
                                        });

                                        basket_offers = {"1":{"1":{"PRODUCT":{"ID":175749,"QUANTITY":3,"CAN_BUY":true,"STATUS_BUY":"BUY","REAL_PRICE":34775,"PRICE":"34 775","DISCOUNT_PRICE":34775,"DISCOUNT":0}},"COLORS":{"1":"Anthracite-Orange-Black","0":"\u0426\u0432\u0435\u0442","2":"Black-Green"},"SIZES":{"1":"19&quot;","0":"\u0420\u0430\u0437\u043c\u0435\u0440","2":"21&quot;","3":"23&quot;"},"2":{"PRODUCT":{"ID":175750,"QUANTITY":3,"CAN_BUY":true,"STATUS_BUY":"BUY","REAL_PRICE":34775,"PRICE":"34 775","DISCOUNT_PRICE":34775,"DISCOUNT":0}}},"2":{"SIZES":{"1":"19&quot;","0":"\u0420\u0430\u0437\u043c\u0435\u0440","2":"21&quot;","3":"23&quot;"},"1":{"PRODUCT":{"ID":175751,"QUANTITY":2,"CAN_BUY":true,"STATUS_BUY":"BUY","REAL_PRICE":34775,"PRICE":"34 775","DISCOUNT_PRICE":34775,"DISCOUNT":0}},"COLORS":{"1":"Anthracite-Orange-Black","0":"\u0426\u0432\u0435\u0442","2":"Black-Green"},"2":{"PRODUCT":{"ID":175752,"QUANTITY":2,"CAN_BUY":true,"STATUS_BUY":"BUY","REAL_PRICE":34775,"PRICE":"34 775","DISCOUNT_PRICE":34775,"DISCOUNT":0}}},"3":{"1":{"PRODUCT":{"ID":175753,"QUANTITY":1,"CAN_BUY":true,"STATUS_BUY":"BUY","REAL_PRICE":34775,"PRICE":"34 775","DISCOUNT_PRICE":34775,"DISCOUNT":0}},"COLORS":{"1":"Anthracite-Orange-Black","0":"\u0426\u0432\u0435\u0442","2":"Black-Green"},"2":{"PRODUCT":{"ID":175754,"QUANTITY":1,"CAN_BUY":true,"STATUS_BUY":"BUY","REAL_PRICE":34775,"PRICE":"34 775","DISCOUNT_PRICE":34775,"DISCOUNT":0}}}};

                                        });



                                                                                            function arrayObjectIndexOf(myArray, searchTerm) {
                                                    for(var key in myArray){
                                                        //console.log(myArray[key] + " = " + searchTerm)
                                                        if (myArray[key] == searchTerm) return key;
                                                    }
                                                    //alert(myArray);
                                                    return -1;
                                                }


                                                function ChangeColor(){
                                                    var sel = $('#COLOR_SELECT').val();
                                                    var size = 0;
                                                    $('#COLOR_SELECT-styler .jq-selectbox__select').css('border-color', '#d7d7d7');
                                                    if ($('#SIZE_SELECT').val() != null){
                                                        size = $('#SIZE_SELECT').val();
                                                            if(typeof basket_offers[size][sel] == 'undefined'){

                                                                $('.product__price_c').hide();
                                                                $('.product__price_t').hide();
                                                                $('.product_n1__2').hide();
                                                                $('#favorite').hide();
                                                                $('#favorite_mask').show();
                                                                $('#buy1click').hide();
                                                                $('#buy1click_mask').show();
                                                                $('.bx_notavalible').show();
                                                                $('#check_sel').hide();
                                                            }
                                                            else{

                                                                if(basket_offers[size][sel]['PRODUCT']["STATUS_BUY"]=="ORDER")
                                                                {
                                                                    $(".product_n__buy_btn span").text("Под заказ");
                                                                }else
                                                                {
                                                                    $(".product_n__buy_btn span").text("Купить");
                                                                }

                                                                //$(".product_n__buy_btn").show();

                                                                if (basket_offers[size][sel]['PRODUCT']['QUANTITY'] < 1){
                                                                    $('.product__price_c').hide();
                                                                    $('.product__price_t').hide();
                                                                    $('.product_n1__2').hide();
                                                                    $('#favorite').hide();
                                                                    $('#favorite_mask').show();
                                                                    $('#buy1click').hide();
                                                                    $('#buy1click_mask').show();

                                                                    $('.bx_notavalible').show();
                                                                    $('#check_sel').hide();
                                                                }
                                                                else{
                                                                    $('.bx_notavalible').hide();


                                                                    $('.product__price_c').show();
                                                                    $('.product__price_t').show();

                                                                    if ($('#SIZE_SELECT').val() != null){
                                                                        $('#check_sel').hide();
                                                                        $('.product_n1__2').show();
                                                                        $('#favorite').show();
                                                                        $('#favorite_mask').hide();
                                                                        $('#buy1click').show();
                                                                        $('#buy1click_mask').hide();
                                                                    }
                                                                    $('#cur_price').html(basket_offers[size][sel]['PRODUCT']['DISCOUNT_PRICE']);
                                                                    $('#total_price').html(basket_offers[size][sel]['PRODUCT']['DISCOUNT_PRICE']);
                                                                    $('#real_price').html(basket_offers[size][sel]['PRODUCT']['REAL_PRICE']);
                                                                    $('#PRODUCT_ID').val(basket_offers[size][sel]['PRODUCT']['ID']);
                                                                    $('#MAX_QUANTITY').val(basket_offers[size][sel]['PRODUCT']['QUANTITY']);
                                                                    $('#QUANTITY_FIELD').attr('data-max',basket_offers[size][sel]['PRODUCT']['QUANTITY']);

                                                                    if(basket_offers[size][sel]['PRODUCT']['DISCOUNT'] > 0){
                                                                        $('#full_price').show().html(basket_offers[size][sel]['PRODUCT']['PRICE'] + ' <span class="rub">p</span>');
                                                                        $('#discount_val').show().html("Экономия " + basket_offers[size][sel]['PRODUCT']['DISCOUNT']+ "%");
                                                                        $('.product__price_p').css('width', '230px');
                                                                    }else{
                                                                        $('#full_price').hide();
                                                                        $('#discount_val').hide();
                                                                        $('.product__price_p').css('width', 'auto');
                                                                    }
                                                                }
                                                            }
                                                    }
                                                    else{

                                                        $('.product__price_c').hide();
                                                        $('.product__price_t').hide();
                                                        $('.product_n1__2').hide();
                                                        $('#favorite').hide();
                                                        $('#favorite_mask').show();
                                                        $('#buy1click').hide();
                                                        $('#buy1click_mask').show();

                                                        $('.bx_notavalible').hide();
                                                        $('.check__control_col').show();
                                                        $('#check_sel').show();
                                                    }
                                                }
                                                function ChangeSize(){
                                                    var sel = $('#SIZE_SELECT').val();;
                                                    var col = 0;

                                                    $('#COLOR_SELECT option').each(function(){

                                                            if( arrayObjectIndexOf( basket_offers[sel]['COLORS'], escapeHtml($(this).html())) == -1)
                                                                    $(this).attr('disabled', 'disabled');
                                                            else
                                                                    $(this).removeAttr('disabled');

                                                    });
                                                    //$('#COLOR_SELECT option:first').attr('disabled', 'disabled');
                                                    $('#COLOR_SELECT option:first').attr('selected', 'selected');
                                                    $('#COLOR_SELECT').val('null').trigger('refresh');


                                                                $('.product__price_c').hide();
                                                                $('.product__price_t').hide();
                                                                $('.product_n1__2').hide();
                                                                $('#favorite').hide();
                                                                $('#favorite_mask').show();
                                                                $('#buy1click').hide();
                                                                $('#buy1click_mask').show();
                                                                $('.bx_notavalible').hide();
                                                                $('.check__control_col').show();
                                                                $('#check_sel').show();


                                                }
                                                


    </script>
        <form>
          <div class="product__size_block">
            <? if($arResult['PROPERTIES']['RAZMER']['VALUE']){ ?>
            <div class="input_wrapper">
              <select class="styler requied" onchange="ChangeSize();" id="SIZE_SELECT">
                <option selected="selected" disabled>Размер</option>
                <? foreach($arResult['PROPERTIES']['RAZMER']['VALUE'] as $razm){ ?>
                <option value="<?=htmlspecialcharsex($razm)?>"><?=htmlspecialcharsex($razm)?></option>
                <? } ?>
              </select>
              <span style="display:none;" class="error_label size_error">Выберите размер</span>
            </div>
            <? } ?>

          </div>
          <div class="product__size_block">
            <? if($arResult['PROPERTIES']['COLOR']['VALUE']){ ?>
            <div class="input_wrapper coloredik">
              <select id="COLOR_SELECT" onchange="ChangeColor();" class="styler">
                <option selected="selected requied" disabled>Цвет</option>
                <? foreach($arResult['PROPERTIES']['COLOR']['VALUE'] as $col){ ?>
                <option value="<?=htmlspecialcharsex($col)?>"><?=htmlspecialcharsex($col)?></option>
                <? } ?>
              </select>
              <span style="display:none;" class="error_label color_error">Выберите цвет</span>
            </div>
            <? } ?>
          </div>
        </form>
        <!--<div class="product__color_block">
                                        <div class="h5">Цвет:</div>
                                        <div class="product__color">
                                            <a href="#product_gallery_1" class="active"><img src="/bitrix/templates/bikecenter_main/images/product_1_small.jpg" alt=""></a>
                                            <a href="#product_gallery_2"><img src="/bitrix/templates/bikecenter_main/images/product_y_1_small.jpg" alt=""></a>
                                            <a href="#product_gallery_3"><img src="/bitrix/templates/bikecenter_main/images/product_g_1_small.jpg" alt=""></a>
                                        </div>
                                    </div>-->
        <div class="item_price">
          <div class="product__price_block">
          <?
        $price = $arResult['PRICES']['BASE']['PRINT_VALUE_NOVAT'];
      $price = substr($price,0,strlen($price)-4); 
      
        $skidka = $arResult['PROPERTIES']['DISCOUNT']['VALUE'];
      if ($skidka){
        $old_price = ($arResult['PRICES']['BASE']['VALUE_NOVAT'])*($skidka/100);
      }
      ?>
          
            <div class="product__price_p">
             <? if($skidka){ ?><span id="real_price"></span> <del id="full_price"><?=$old_price?> <span class="rub">p</span></del> <? }?>
             <strong ><span id="cur_price"><?=$price?></span><span class="rub">p</span></strong> <? if($skidka){ ?><em id="discount_val" style="display:none;" >Экономия <?=$skidka?>%</em><? }?> 
            </div>
            <script>
function getPrintPriceKart(price){
    if((parseFloat(price)% 1) > 0)
        return price.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ").replace('.',',');
    else
        return price.toFixed(0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ").replace('.',',');
}

function CheckSel(){

/*
ret = true;
if ($('#SIZE_SELECT').val() == "Размер" || $('#SIZE_SELECT').val() == null){
    $('#SIZE_SELECT-styler').addClass(' error');
    $('.size_error').show();
    ret = false;
}
if ($('#COLOR_SELECT').val() == "Цвет" || $('#COLOR_SELECT').val() == null){
    $('#COLOR_SELECT-styler').addClass(' error');
    $('.color_error').show();
    ret = false;
}

return ret;
*/

/*if(typeof $('.product__size_block .jq-radio.checked') == 'undefined'){
    $('.product__size_block .jq-radio').css('border-color:red;');
}*/

jQuery.post(
  "/ajax/add2basket.php",
  {'action':'ADD2BASKET','id':<?=$arResult['ID']?>},
  function(data){if(data) window.location.href='/personal/cart'}
);


}
</script>
<?
/*
            <div class="product__price_c" style="display:none;"> <i class="icon icon-count"></i>
              <div class="count_field">
                <input id="QUANTITY_FIELD" type="text" class="count_field__val" onchange="if(parseInt($(this).val()) > parseInt($(this).attr('data-max'))) {$(this).val($(this).attr('data-max')); alert('Сейчас максимально доступное количество товара ' + $(this).attr('data-max') + '!');}else{$('#total_price').html(getPrintPriceKart(parseFloat($('#real_price').html())*parseInt($(this).val())));}" data-max="" value="1">
                <span onclick="if(parseInt($('#QUANTITY_FIELD').val())+1 > parseInt($('#QUANTITY_FIELD').attr('data-max'))) {$('#QUANTITY_FIELD').val($('#QUANTITY_FIELD').attr('data-max')); alert('Сейчас максимально доступное количество товара ' + $('#QUANTITY_FIELD').attr('data-max') + '!');}else{$('#total_price').html(getPrintPriceKart(parseFloat($('#real_price').html())*(parseInt($('#QUANTITY_FIELD').val())+1)));}"  class="count_field__arrow count_field__arrow-up"></span> <span onclick="if($('#QUANTITY_FIELD').val()-1 != 0 ){$('#total_price').html(getPrintPriceKart(parseFloat($('#real_price').html())*(parseInt($('#QUANTITY_FIELD').val())-1)));}" class="count_field__arrow count_field__arrow-down"></span> </div>
            </div>
*/
?>

<? /*
            <div class="product__price_t"  style="display:none;"> <i class="icon icon-equal"></i> <strong><span id="total_price">34 775</span> <span class="rub">p</span></strong> </div>
*/ ?>

          </div>
          <div class="product__price_block bx_notavalible"  style="display:none;"> Нет в наличии </div>
          <div class="product_n1">
            <div class="product_n1__2 check__control_col" > <a
                                                                                            href="javascript:void(0)"
                                            id="check_sel"
                                            onclick="CheckSel();"
                                            class="btn btn-full product_n__buy_btn"> <i class="icon icon-basket"></i> <span>Купить</span> </a> </div>
            <div class="product_n1__2"  style="display:none;">
              <input type="hidden" id="PRODUCT_ID" name="PRODUCT_ID" value="" />
              <input type="hidden" id="MAX_QUANTITY" name="MAX_QUANTITY" value="" />
              <a
                                                                                       href="javascript:void(0)"
                                           onclick='$.post("/ajax/element.php",
                                           { PRODUCT_ID: $("#PRODUCT_ID").val(),
                                            QUANTITY: $("#QUANTITY_FIELD").val(),
                                            MAX_QUANTITY: $("#MAX_QUANTITY").val(),
                                            ACTION: "ADD2BASKET"
                                           }, function( data ){ window.location.replace("/personal/cart/");});'  class="btn btn-full product_n__buy_btn"><i class="icon icon-basket"></i> <span>Купить</span></a> </div>
            <div class="product_n1__2a">
              <div class="product__control_col product__control_col-1">
                <? /*
                <label class="compare">
                <input type="checkbox" class="docompare" data-id="175748" data-iid="5">
                <span class="note_link"><span>В сравнение</span></span> </label>
                */ ?>

                <? /*
                <a href="#" class="note_link product__control_available product__control_available_target"><i class="icon icon-loc_s"></i> <span>Где есть в наличии</span></a> 
                */ ?>

                </div>
                <? /*
              <div class="tooltip_popup available_location_popup"> <span class="tooltip_popup__close"><i class="icon icon-close"></i></span>
                <div class="tooltip_popup__header">
                  <div class="letter_menu"> <a >К</a> <a >Н</a> <a >Р</a> <a >С</a> <a >Т</a> </div>
                </div>
                <div class="location_list">
                  <div class="location_list__col">
                    <div class="location_list__section">
                      <div class="location_section__title">К</div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span class="active"></span> <span ></span> </span> <span class="location_item__title">Краснодар, ул. Дорожная 1Ж</span>
                        <p> </p>
                      </div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span class="active"></span> <span ></span> </span> <span class="location_item__title">Краснодар, ул. Красных Партизан 239</span>
                        <p> </p>
                      </div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span class="active"></span> <span ></span> </span> <span class="location_item__title">Краснодар, ул. Сормовская 2А</span>
                        <p> </p>
                      </div>
                    </div>
                    <div class="location_list__section">
                      <div class="location_section__title">Н</div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span class="active"></span> <span ></span> </span> <span class="location_item__title">Новороссийск, ул. Исаева 19</span>
                        <p> </p>
                      </div>
                    </div>
                  </div>
                  <div class="location_list__col">
                    <div class="location_list__section">
                      <div class="location_section__title">Р</div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span ></span> <span ></span> </span> <span class="location_item__title">Ростов-на-Дону, ул. Красноармейская 178</span>
                        <p> </p>
                      </div>
                    </div>
                    <div class="location_list__section">
                      <div class="location_section__title">С</div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span ></span> <span ></span> </span> <span class="location_item__title">Сочи, ул. Транспортная 1</span>
                        <p> </p>
                      </div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span ></span> <span ></span> </span> <span class="location_item__title">Ставрополь,  проспект Кулакова 35А</span>
                        <p> </p>
                      </div>
                    </div>
                    <div class="location_list__section">
                      <div class="location_section__title">Т</div>
                      <div class="location_item"> <span class="location_item__status"> <span class="active"></span> <span ></span> <span ></span> </span> <span class="location_item__title">Транзитный склад</span>
                        <p> </p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="location_list__footer">Вы можете узнать о нужном товаре, подписавшись на нашу рассылку</div>
              </div>
              */ ?>
            </div>
          </div>
          <div class="product_n2" style="font-weight: normal; font-size: 11px; line-height: 12px;">Нажимая на кнопку, Вы соглашаетесь с условиями <a href="/pomoshch/polzovatelskoe-soglashenie/" target="_blank">пользовательского соглашения</a> по обработке персональных данных</div>
          <div class="product__info_block">
            <div class="product__info_col product__info_col-1"> <?=$arResult['~PREVIEW_TEXT']?>          </div>
            <div class="product__info_col product__info_col-2">
              <div class="kara_wrap">
              <? /*
                <div class="karta_item"> <img src="/bitrix/templates/main/images/icons/icon_war.svg" width="69" height="69" /> <span>
                  <p>Пожизненная гарантия на раму</p>
                  </span> </div>
                  */ ?>
                <div class="karta_item"> <a href="/pomoshch/oplata"><img src="/bitrix/templates/main/images/icon_pay.svg" width="69" height="69" /></a> <span>
                  <p><a href="/pomoshch/oplata">Плати онлайн: никаких комиссий и сборов</a></p>
                  </span> </div>
                <div class="karta_item"> <a href="/pomoshch/dostavka"><img src="/bitrix/templates/main/images/icon_del.svg" width="69" height="69" /></a> <span>
                  <p><a href="/pomoshch/dostavka">Доставка по всей России</a></p>
                  </span> </div>
                <div class="clear"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="content_block">
    <div class="tabs tabs_block">
      <ul class="tabs_menu">
        <li><a href="#" class="active">Подробное описание</a></li>
        <li><a href="#">Характеристики</a></li>
        <li><a href="#">О бренде</a></li>
      </ul>
      <div class="tabs_content">
        <div style="display:block;">
        <? $class_col = "col_info-1"; ?>
        <? if ($arResult['SECTION']['PATH'][0]['CODE']=='na_litykh_diskakh') $class_col = ""; ?>
        <? $class_col = ""; ?>
          <div class="col_info <?=$class_col?> dddd">
            <?=$arResult['~DETAIL_TEXT']?>
            <? 
            if ($arResult['SECTION']['PATH'][0]['CODE']=='na_litykh_diskakh') {
                $APPLICATION->IncludeComponent("bitrix:main.include","", Array("AREA_FILE_SHOW" => "file","AREA_FILE_SUFFIX" => "inc","EDIT_TEMPLATE" => "","PATH" => "/inc/inc_litie.php"));
            }
            ?>
          </div>
<? /*
<? if ($arResult['SECTION']['PATH'][0]['CODE']!='na_litykh_diskakh') { ?>
          <div class="col_info col_info-2">
            <table class="data_table">
              <tr>
                <th>Краткие характеристики</th>
                <th>&nbsp;</th>
              </tr>
<? if($arResult['PROPERTIES']['YEAR']['VALUE']){ ?>
            <tr>
              <td>Год выпуска</td>
              <td><?=$arResult['PROPERTIES']['YEAR']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['MATERIAL_RAMI']['VALUE']){ ?>
            <tr>
              <td>Материал рамы</td>
              <td><?=$arResult['PROPERTIES']['MATERIAL_RAMI']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['RAZMER_KOLES']['VALUE']){ ?>
            <tr>
              <td>Размер колес</td>
              <td><?=$arResult['PROPERTIES']['RAZMER_KOLES']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['TIP_TORMOZOV']['VALUE']){ ?>
            <tr>
              <td>Тип тормозов</td>
              <td><?=$arResult['PROPERTIES']['TIP_TORMOZOV']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['HOD_VILKI']['VALUE']){ ?>
            <tr>
              <td>Ход вилки</td>
              <td><?=$arResult['PROPERTIES']['HOD_VILKI']['VALUE']?></td>
            </tr>
<? }?>
            </table>
            <div class="show_detail_params"> <a href="#">Подробные характеристики</a> </div>
          </div>
<? } ?>
*/ ?>

        </div>
        <div >
          <table class="data_table">
            <tr>
              <th>Параметры</th>
              <th>&nbsp;</th>
            </tr>
<? if($arResult['PROPERTIES']['RAMA']['VALUE']){ ?>
            <tr>
              <td>Рама</td>
              <td><?=$arResult['PROPERTIES']['RAMA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['VILKA']['VALUE']){ ?>
            <tr>
              <td>Вилка</td>
              <td><?=$arResult['PROPERTIES']['VILKA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['MANETKI']['VALUE']){ ?>
            <tr>
              <td>Манетки</td>
              <td><?=$arResult['PROPERTIES']['MANETKI']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['ZADNII_PEREKLYUCHATEL']['VALUE']){ ?>
            <tr>
              <td>Задний переключатель</td>
              <td><?=$arResult['PROPERTIES']['ZADNII_PEREKLYUCHATEL']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['PEREDNII_PEREKLUCHATEL']['VALUE']){ ?>
            <tr>
              <td>Передний переключатель</td>
              <td><?=$arResult['PROPERTIES']['PEREDNII_PEREKLUCHATEL']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['KASSETA']['VALUE']){ ?>
            <tr>
              <td>Касета</td>
              <td><?=$arResult['PROPERTIES']['KASSETA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['SISTEMA']['VALUE']){ ?>
            <tr>
              <td>Система</td>
              <td><?=$arResult['PROPERTIES']['SISTEMA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['BRAND']['VALUE']){ ?>
            <tr>
              <td>Общий бренд</td>
              <td><?=$arResult['DISPLAY_PROPERTIES']['BRAND']['FULL']['NAME']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['RAZMER']['VALUE']){ ?>
            <tr>
              <td>Размер</td>
              <td><?=$arResult['PROPERTIES']['RAZMER']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['TORMOZA']['VALUE']){ ?>
            <tr>
              <td>Тормоза</td>
              <td><?=$arResult['PROPERTIES']['TORMOZA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['PEREDNYAYA_VTULKA']['VALUE']){ ?>
            <tr>
              <td>Передняя втулка</td>
              <td><?=$arResult['PROPERTIES']['PEREDNYAYA_VTULKA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['ZADNYAYA_VTULKA']['VALUE']){ ?>
            <tr>
              <td>Задняя втулка</td>
              <td><?=$arResult['PROPERTIES']['ZADNYAYA_VTULKA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['YEAR']['VALUE']){ ?>
            <tr>
              <td>Год выпуска</td>
              <td><?=$arResult['PROPERTIES']['YEAR']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['OBODA']['VALUE']){ ?>
            <tr>
              <td>Обода</td>
              <td><?=$arResult['PROPERTIES']['OBODA']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['POKRISHKI']['VALUE']){ ?>
            <tr>
              <td>Покрышки</td>
              <td><?=$arResult['PROPERTIES']['POKRISHKI']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['RUL']['VALUE']){ ?>
            <tr>
              <td>Руль</td>
              <td><?=$arResult['PROPERTIES']['RUL']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['SEDLO']['VALUE']){ ?>
            <tr>
              <td>Седло</td>
              <td><?=$arResult['PROPERTIES']['SEDLO']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['PODSEDELNIY_SHTIR']['VALUE']){ ?>
            <tr>
              <td>Подседельный штырь</td>
              <td><?=$arResult['PROPERTIES']['PODSEDELNIY_SHTIR']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['RAZMER_KOLES']['VALUE']){ ?>
            <tr>
              <td>Размер колес</td>
              <td><?=$arResult['PROPERTIES']['RAZMER_KOLES']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['VOZRAST']['VALUE']){ ?>
            <tr>
              <td>Возраст</td>
              <td><?=$arResult['PROPERTIES']['VOZRAST']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['MATERIAL_RAMI']['VALUE']){ ?>
            <tr>
              <td>Материал рамы</td>
              <td><?=$arResult['PROPERTIES']['MATERIAL_RAMI']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['POL']['VALUE']){ ?>
            <tr>
              <td>Пол</td>
              <td><?=$arResult['PROPERTIES']['POL']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['TIP_TORMOZOV']['VALUE']){ ?>
            <tr>
              <td>Тип тормозов</td>
              <td><?=$arResult['PROPERTIES']['TIP_TORMOZOV']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['HOD_VILKI']['VALUE']){ ?>
            <tr>
              <td>Ход вилки</td>
              <td><?=$arResult['PROPERTIES']['HOD_VILKI']['VALUE']?></td>
            </tr>
<? }?>
<? if($arResult['PROPERTIES']['PEDALI']['VALUE']){ ?>
            <tr>
              <td>Педали</td>
              <td><?=$arResult['PROPERTIES']['PEDALI']['VALUE']?></td>
            </tr>
<? }?>
          </table>
        </div>
        <? if($arResult['PROPERTIES']['BRAND']['VALUE']){?>
        <div class="brend">
          <h5>О фирме в целом</h5>
          <?=$arResult['DISPLAY_PROPERTIES']['BRAND']['FULL']['~PREVIEW_TEXT']?>... <br><br class="clearfix">
          <div class="read-more"> <a href="<?=$arResult['DISPLAY_PROPERTIES']['BRAND']['FULL']['DETAIL_PAGE_URL']?>">Читать подробнее</a> </div>
        </div>
        <? }?>
      </div>
    </div>
    
    <script>
var compare_block = false;
$('.docompare').change(function() {
if (!$(this).prop('checked')) {
    location.href = '/compare/';
    return false;
}
if (compare_block) {
    $(this).prop('checked', !$(this).prop('checked'));
    return false;
}
compare_block = true;
id = $(this).data('id');
iid =$(this).data('iid');
if ($(this).prop('checked')) {
    $(this).parent().find('.note_link').addClass('active');
    action = 'ADD_TO_COMPARE_RESULT';
    q = 'action='+action+'&id='+id;
} else {
    $(this).parent().find('.note_link').removeClass('active');
    action = 'DELETE_FROM_COMPARE_RESULT';
    q = 'action='+action+'&ID[]='+id+'&IBLOCK_ID='+iid;
}
$.ajax({
    url: '/compare/',
    data: q,
    method: 'GET',
}).success(function(){
    c = parseInt($('#compare_count').text());
    if (action == 'ADD_TO_COMPARE_RESULT') c += 1;
    if (action == 'DELETE_FROM_COMPARE_RESULT') c -= 1;
    if (c < 0) c = 0;
    $('#compare_count').text(c);
}).done(function(){
    compare_block = false;
});
});

$('.dofavorite').click(function(){
if (!$(this).hasClass('active')) {
    if($("#PRODUCT_ID").val() == "") (CheckSel()); else {
        $.post("/ajax/element.php",
        {
            PRODUCT_ID: $("#PRODUCT_ID").val(),
            ACTION: "ADD2FAVORITES",
        }, function( data ) {
        });
        $.post( "/ajax/basket_count.php",
        {
            mode: "delay"
        },  function(data) {
                $("#favorite_count").html(data);
        });
        $(this).addClass('active');
    }
return false;
}
});
</script>
  </div>
  <script type="text/javascript">
BX.ready(
BX.defer(function(){
    if (!!window.obbx_117848907_175748)
    {
        window.obbx_117848907_175748.allowViewedCount(true);
    }
})
);
</script>
  

  <script type="text/javascript">
    BX.message({
        MESS_BTN_BUY: 'Купить',
        MESS_BTN_ADD_TO_BASKET: '',

        MESS_BTN_DETAIL: 'Подробнее',

        MESS_NOT_AVAILABLE: 'Подробнее',
        BTN_MESSAGE_BASKET_REDIRECT: '',
        BASKET_URL: '/personal/cart/',
        ADD_TO_BASKET_OK: '',
        TITLE_ERROR: '',
        TITLE_BASKET_PROPS: '',
        TITLE_SUCCESSFUL: '',
        BASKET_UNKNOWN_ERROR: '',
        BTN_MESSAGE_SEND_PROPS: '',
        BTN_MESSAGE_CLOSE: ''
    });
</script>



</div>