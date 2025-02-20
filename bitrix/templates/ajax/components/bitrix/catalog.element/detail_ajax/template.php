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


 <div class="quick_view_window__image">
                    <div class="quick_view_gallery">
                        <div class="quick_view_gallery__image">
                                   <div class="product_gallery__image">
      <? 
      $img_348 = CFile::resizeImageGet($arResult['PREVIEW_PICTURE']['ID'],array('width'=>348,'height'=>304), BX_RESIZE_IMAGE_PROPORTIONAL, true);
      ?>
                      <img src="<?=$img_348['src']?>" alt="<?=$arResult['NAME']?>"/>                     </a>
                      </div>
                                                  
                           <!-- <a href="#" class="icon icon-like quick_view_like"></a>-->
                        </div>
                                    <div class="quick_view_gallery__thumbs_wrapper">
            
                            <div class="quick_view_gallery__thumbs">

  
          <?
        foreach($arResult['PROPERTIES']['IMAGES']['VALUE'] as $ad_images){
          $ad_images_min = CFile::resizeImageGet($ad_images,array('width'=>348,'height'=>304), BX_RESIZE_IMAGE_PROPORTIONAL, true);
          $ad_images_min2 = CFile::resizeImageGet($ad_images,array('width'=>68,'height'=>88), BX_RESIZE_IMAGE_PROPORTIONAL, true);
        ?>
          
          

          <a href="<?=$ad_images_min['src']?>"><img src="<?=$ad_images_min2['src']?>" alt=""></a>
          
              <? } ?>






                                            </div>
            
                        </div>
                                </div>
                </div>
                <div class="quick_view_window__description">
                    <div class="quick_view_window__section quick_view_window__section-title">
                        <div class="quick_view_window__title"><a href="/catalog/gornye/velosiped_kms_lite_md930_26/"><?=$arResult['NAME']?></a></div>
                        <div class="quick_view_window__subtitle"></div>
            
                      
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
                    
                      
                      $('#SIZE_SELECT_178826-styler div').click(function(){$('#SIZE_SELECT-styler .jq-selectbox__select').css('border-color', '#d7d7d7');});
                      $('#COLOR_SELECT_178826-styler div').click(function(){$('#COLOR_SELECT-styler .jq-selectbox__select').css('border-color', '#d7d7d7');});
                    
                      basket_offers = {"1":{"1":{"PRODUCT":{"ID":178827,"QUANTITY":24,"CAN_BUY":true,"REAL_PRICE":15865,"PRICE":"15 865","DISCOUNT_PRICE":15865,"DISCOUNT":0}},"COLORS":{"1":"\u0431\u0435\u043b\u043e-\u0440\u043e\u0437\u043e\u0432\u044b\u0439","0":"\u0426\u0432\u0435\u0442","2":"\u0437\u0435\u043b\u0435\u043d\u043e-\u043e\u0440\u0430\u043d\u0436\u0435\u0432\u044b\u0439","3":"\u0436\u0435\u043b\u0442\u043e-\u043e\u0440\u0430\u043d\u0436\u0435\u0432\u044b\u0439","4":"\u0436\u0435\u043b\u0442\u043e-\u0441\u0438\u043d\u0438\u0439"},"SIZES":{"1":"16.5&quot;","0":"\u0420\u0430\u0437\u043c\u0435\u0440"},"2":{"PRODUCT":{"ID":178828,"QUANTITY":6,"CAN_BUY":true,"REAL_PRICE":15865,"PRICE":"15 865","DISCOUNT_PRICE":15865,"DISCOUNT":0}},"3":{"PRODUCT":{"ID":178829,"QUANTITY":3,"CAN_BUY":true,"REAL_PRICE":15865,"PRICE":"15 865","DISCOUNT_PRICE":15865,"DISCOUNT":0}},"4":{"PRODUCT":{"ID":178830,"QUANTITY":6,"CAN_BUY":true,"REAL_PRICE":15865,"PRICE":"15 865","DISCOUNT_PRICE":15865,"DISCOUNT":0}}},"2":{"SIZES":{"1":"16.5&quot;","0":"\u0420\u0430\u0437\u043c\u0435\u0440"}},"3":{"SIZES":{"1":"16.5&quot;","0":"\u0420\u0430\u0437\u043c\u0435\u0440"}},"4":{"SIZES":{"1":"16.5&quot;","0":"\u0420\u0430\u0437\u043c\u0435\u0440"}}};

                      
                      
                      
                      
                                                function arrayObjectIndexOf(myArray, searchTerm) {
                            for(var key in myArray){
                              if (myArray[key] == searchTerm) return key;
                            }
                            return -1;
                          }
                          
                          
                          function ChangeColor(){
                            $('#COLOR_SELECT_178826-styler div').click(function(){$('#COLOR_SELECT_178826-styler .jq-selectbox__select').css('border-color', '#d7d7d7');});
                            var sel = $('#COLOR_SELECT_178826').val();
                            var size = 0;
                            if ($('#SIZE_SELECT_178826').val() != null){
                              size = $('#SIZE_SELECT_178826').val();
                                
                                if(typeof basket_offers[size][sel] == 'undefined'){
                                
                                  $('.product__price_c').hide();
                                  $('.product__price_t').hide();
                                  $('#buy_link').hide();                            
                                  $('.bx_notavalible').show();
                                  $('.check_sel').hide();
                                
                                }
                                else{
                                
                                  if (basket_offers[size][sel]['PRODUCT']['QUANTITY'] < 1){

                                    $('#buy_link').hide();                            
                                    $('.bx_notavalible').show();
                                    $('.check_sel').hide();
                                  }
                                  else{
                                    $('.bx_notavalible').hide();
                                    
                                    if ($('#SIZE_SELECT_178826').val() != null){
                                      $('.check_sel').hide();
                                      $('#buy_link').show();                            
                                    }
                                    $('#cur_price').val(basket_offers[size][sel]['PRODUCT']['DISCOUNT_PRICE']);
                                    $('#real_price').val(basket_offers[size][sel]['PRODUCT']['REAL_PRICE']);
                                    $('#PRODUCT_ID').val(basket_offers[size][sel]['PRODUCT']['ID']);
                                    $('#MAX_QUANTITY').val(basket_offers[size][sel]['PRODUCT']['QUANTITY']);
                                    $('#QUANTITY_FIELD').attr('data-max',basket_offers[size][sel]['PRODUCT']['QUANTITY']);
                                    
                                    if(basket_offers[size][sel]['PRODUCT']['DISCOUNT'] > 0){
                                      $('#full_price').show().html(basket_offers[size][sel]['PRODUCT']['PRICE'] + ' <span class="rub">p</span>');
                                      $('#discount_val').show().html("Экономия " + basket_offers[size][sel]['PRODUCT']['DISCOUNT']+ "%");
                                    }else{
                                      $('#full_price').hide();
                                      $('#discount_val').hide();
                                      
                                    }
                                  }
                                }
                            }
                            else{
                              
                              
                              $('.product__price_c').hide();
                              $('.product__price_t').hide();
                              $('#buy_link').hide();                            
                              $('.bx_notavalible').hide();
                              $('.check__control_col').show();
                              $('.check_sel').show();
                            }
                          }
                          function ChangeSize(){
                            $('#SIZE_SELECT_178826-styler div').click(function(){$('#SIZE_SELECT_178826-styler .jq-selectbox__select').css('border-color', '#d7d7d7');});
                            var sel = $('#SIZE_SELECT_178826').val();;
                            var col = 0;
                            
                            $('#COLOR_SELECT_178826').val('null').trigger('refresh');
                            $('#COLOR_SELECT_178826 option').each(function(){
                                
                                //alert(arrayObjectIndexOf(basket_offers[sel]['COLORS'], escapeHtml($(this).html())));
                                if( arrayObjectIndexOf( basket_offers[sel]['COLORS'], escapeHtml($(this).html())) == -1) 
                                    $(this).attr('disabled', 'disabled');
                                else
                                    $(this).removeAttr('disabled');

                            });
                            $('#COLOR_SELECT_178826 option:first').attr('selected', 'selected');
                            //$('#COLOR_SELECT option:first').attr('disabled', 'disabled');
                            $('#COLOR_SELECT_178826').val('null').trigger('refresh');
                            
                                  $('#buy_link').hide();                            
                                  $('.bx_notavalible').hide();
                                  $('.check__control_col').show();
                                  $('.check_sel').show();

                          }
                                                
                    
    
    </script>
              <div class="quick_view_window__price" >
<?
      $price = $arResult['PRICES']['BASE']['PRINT_VALUE_NOVAT'];
      $price = substr($price,0,strlen($price)-4); 
      
        $skidka = $arResult['PROPERTIES']['DISCOUNT']['VALUE'];
      if ($skidka){
        $old_price = ($arResult['PRICES']['BASE']['VALUE_NOVAT'])*($skidka/100);
      }
?>


          <span id="real_price" style="display:none;"><?=$price?></span>
      <? if($skidka){ ?><del id="full_price" ><?=$old_price?> <span class="rub">p</span></del><? }?>
         <strong  ><span id="cur_price"><?=$price?></span><span class="rub">p</span></strong>
      </div>
      <? if($skidka){ ?><div class="quick_view_window__note" id="discount_val"  >Экономия <?=$skidka?>%</div><? }?>
      </div>
          

          <div class="quick_view_window__section quick_view_window__section-select">


                  <form>
                  <? if($arResult['PROPERTIES']['RAZMER']['VALUE']){ ?>
                      <div class="form_row">
                        <select class="styler " onchange="ChangeSize();" id="SIZE_SELECT_178826">
                            <option selected="selected" disabled>Размер</option>
                            <? foreach($arResult['PROPERTIES']['RAZMER']['VALUE'] as $razm){ ?>
                            <option value="<?=htmlspecialcharsex($razm)?>"><?=htmlspecialcharsex($razm)?></option>
                            <? } ?>
                        </select>
                        <!-- <a href="#" class="note_link"><span>Как выбрать размер?</span></a>-->
                      </div>
                  <? }?>

                  <? if($arResult['PROPERTIES']['COLOR']['VALUE']){ ?>
                      <div class="form_row">
                          <select id="COLOR_SELECT_178826" onchange="ChangeColor();" class="styler">
                              <option selected="selected " disabled>Цвет</option>
                              <? foreach($arResult['PROPERTIES']['COLOR']['VALUE'] as $col){ ?>
                              <option value="<?=htmlspecialcharsex($col)?>"><?=htmlspecialcharsex($col)?></option>
                              <? } ?>
                          </select>
                          <!-- <a href="#" class="note_link"><span>Как выбрать размер?</span></a>-->
                      </div>
                  <? }?>
                </form>

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
  if ($('#SIZE_SELECT_178826').val() == "Размер" || $('#SIZE_SELECT_178826').val() == null)
    $('#SIZE_SELECT_178826-styler .jq-selectbox__select').css('border-color', 'red');

  if ($('#COLOR_SELECT_178826').val() == "Цвет" || $('#COLOR_SELECT_178826').val() == null)
    $('#COLOR_SELECT_178826-styler .jq-selectbox__select').css('border-color', 'red');
    */                
} 
 </script>
  
                    
                    
                    <div class="quick_view_window__section quick_view_window__section-btn" style="text-align:center;">
                        <a   onclick="CheckSel();" href="<?=$arResult['DETAIL_PAGE_URL']?>" class="btn btn-full btn-middle check__control_col check_sel"><i class="icon icon-basket"></i>Купить</a>

                                            
                        <input type="hidden" id="PRODUCT_ID" name="PRODUCT_ID" value="" />
                        <input type="hidden" id="MAX_QUANTITY" name="MAX_QUANTITY" value="" />
                         <a  style="display:none;" onclick='$.post("/ajax/element.php",
                         { PRODUCT_ID: $("#PRODUCT_ID").val(), 
                        QUANTITY: 1,
                        MAX_QUANTITY: $("#MAX_QUANTITY").val(),
                        ACTION: "ADD2BASKET"
                         }, function( data ){ window.location.replace("/personal/cart/");}); return false;' id="buy_link" class="btn btn-full btn-middle"><i class="icon icon-basket"></i>Купить</a> 
                                           
            <p class="bx_notavalible btn-full btn-middle"  style="display:none;">
                        Нет в наличии
                      </p>
                        <a href="<?=$arResult['DETAIL_PAGE_URL']?>" class="btn btn-full btn-middle btn-white">ПОДРОБНЕЕ</a>
                    </div>   <script type="text/javascript">
BX.ready(
  BX.defer(function(){
    if (!!window.obbx_117848907_178826)
    {
      window.obbx_117848907_178826.allowViewedCount(true);
    }
  })
);
</script>

