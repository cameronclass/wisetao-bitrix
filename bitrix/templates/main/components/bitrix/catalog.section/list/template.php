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

<div class="sidebar">
  <!-- menubaner -->
  <div class="slidedown-item">
    <div class="slidedown-link">Разделы</div>
    <div class="slidedown-content"> </div>
  </div>
  <div class="slidedown-item">
    <div class="slidedown-link">Фильтры</div>
    <div class="slidedown-content">
      <div class="sidebar_menu">
        <div class="h3">Вы выбрали</div>
        <ul class="filter_list">
        </ul>
      </div>
      <input type="hidden" name="SECTION_ID" value="1725"/>
      <form name="_form" action="/velosipedy/gornye/?SORT_METHOD=4&PAGE_ELEMENT_COUNT=24&VID=0" method="get" class="smartfilter" id="smartfilterID">
        <script>$(document).ready(function(){$(".sidebar_menu").hide();});</script>
        <a style='display:none' href="#" class="reset_filter reset_filter-b" onclick="$('#clear_filter').html('<input type=\'hidden\' id=\'del_filter\' name=\'del_filter\' value=\'Сбросить\' />');$('.smartfilter').submit(); return false;"><i class="icon icon-reset"></i>Сбросить все</a>
        <input
					type="hidden"
					name="SORT_METHOD"
					id="SORT_METHOD"
					value="4"
				/>
        <input
					type="hidden"
					name="PAGE_ELEMENT_COUNT"
					id="PAGE_ELEMENT_COUNT"
					value="24"
				/>
        <input
					type="hidden"
					name="VID"
					id="VID"
					value="0"
				/>
        <div class="sidebar_section  opened  big_sidebar_section" data_id="324">
          <div class="sidebar_section__title  opened ">Общий бренд </div>
          <div class="sidebar_section__content"  style="display:block;" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1504781854">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1504781854'
										id='arrFilter_324_1504781854'
										data_id='2343'
																				onclick="smartFilter.click(this)" />
                  <span>BERGAMONT</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_2495611582">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_2495611582'
										id='arrFilter_324_2495611582'
										data_id='2424'
																				onclick="smartFilter.click(this)" />
                  <span>FOCUS</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_2060346258">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_2060346258'
										id='arrFilter_324_2060346258'
										data_id='2426'
																				onclick="smartFilter.click(this)" />
                  <span>FORMAT</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1743827894">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1743827894'
										id='arrFilter_324_1743827894'
										data_id='6593'
																				onclick="smartFilter.click(this)" />
                  <span>GTX</span> </label>
                </li>
              </ul>
              <ul class="sidebar_section__hidden_list" style="display:block;">
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_2894505199">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_2894505199'
										id='arrFilter_324_2894505199'
										data_id='2455'
																				onclick="smartFilter.click(this)" />
                  <span>HARO</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_956031030">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_956031030'
										id='arrFilter_324_956031030'
										data_id='6518'
																				onclick="smartFilter.click(this)" />
                  <span>IZH-BIKE</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_3171965786">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_3171965786'
										id='arrFilter_324_3171965786'
										data_id='4175'
																				onclick="smartFilter.click(this)" />
                  <span>KMS</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_2656534080">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_2656534080'
										id='arrFilter_324_2656534080'
										data_id='2492'
																				onclick="smartFilter.click(this)" />
                  <span>KTM</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_656829168">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_656829168'
										id='arrFilter_324_656829168'
										data_id='2517'
																				onclick="smartFilter.click(this)" />
                  <span>MERIDA</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1128968180">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1128968180'
										id='arrFilter_324_1128968180'
										data_id='2557'
																				onclick="smartFilter.click(this)" />
                  <span>PEGASUS</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_3858960102">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_3858960102'
										id='arrFilter_324_3858960102'
										data_id='9256'
																				onclick="smartFilter.click(this)" />
                  <span>PLATIN</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1714608513">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1714608513'
										id='arrFilter_324_1714608513'
										data_id='6493'
																				onclick="smartFilter.click(this)" />
                  <span>PULSE</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_427837301">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_427837301'
										id='arrFilter_324_427837301'
										data_id='6320'
																				onclick="smartFilter.click(this)" />
                  <span>ROCKY MOUNTAIN</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_4026523896">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_4026523896'
										id='arrFilter_324_4026523896'
										data_id='2597'
																				onclick="smartFilter.click(this)" />
                  <span>SCOTT</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1014752744">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1014752744'
										id='arrFilter_324_1014752744'
										data_id='2607'
																				onclick="smartFilter.click(this)" />
                  <span>SILVERBACK</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1382540351">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1382540351'
										id='arrFilter_324_1382540351'
										data_id='2616'
																				onclick="smartFilter.click(this)" />
                  <span>SPECIALIZED</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_153109363">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_153109363'
										id='arrFilter_324_153109363'
										data_id='2623'
																				onclick="smartFilter.click(this)" />
                  <span>STELS</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_74606147">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_74606147'
										id='arrFilter_324_74606147'
										data_id='6134'
																				onclick="smartFilter.click(this)" />
                  <span>STINGER</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1601889525">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1601889525'
										id='arrFilter_324_1601889525'
										data_id='2643'
																				onclick="smartFilter.click(this)" />
                  <span>TECH TEAM</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_324_1660452458">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_324_1660452458'
										id='arrFilter_324_1660452458'
										data_id='9041'
																				onclick="smartFilter.click(this)" />
                  <span>WELT</span> </label>
                </li>
              </ul>
              <a href="#" id="toggle_link_show_324" data-value="+ Развернуть" class="sidebar_section__toggle_link">- Свернуть</a> </div>
          </div>
        </div>
        <div class="sidebar_section  opened  " data_id="673">
          <div class="sidebar_section__title  opened ">Размер</div>
          <div class="sidebar_section__content"  style="display:block;" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_644587598">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_644587598'
										id='arrFilter_673_644587598'
										data_id='15"'
																				onclick="smartFilter.click(this)" />
                  <span>15&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_3872348237">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_3872348237'
										id='arrFilter_673_3872348237'
										data_id='15.5"'
																				onclick="smartFilter.click(this)" />
                  <span>15.5&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_394509011">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_394509011'
										id='arrFilter_673_394509011'
										data_id='16"'
																				onclick="smartFilter.click(this)" />
                  <span>16&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_2985603431">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_2985603431'
										id='arrFilter_673_2985603431'
										data_id='17"'
																				onclick="smartFilter.click(this)" />
                  <span>17&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_2317121462">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_2317121462'
										id='arrFilter_673_2317121462'
										data_id='17,5"'
																				onclick="smartFilter.click(this)" />
                  <span>17,5&quot;</span> </label>
                </li>
              </ul>
              <ul class="sidebar_section__hidden_list" >
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_3359207627">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_3359207627'
										id='arrFilter_673_3359207627'
										data_id='17.5"'
																				onclick="smartFilter.click(this)" />
                  <span>17.5&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1203552654">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1203552654'
										id='arrFilter_673_1203552654'
										data_id='18"'
																				onclick="smartFilter.click(this)" />
                  <span>18&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_394313498">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_394313498'
										id='arrFilter_673_394313498'
										data_id='18.5"'
																				onclick="smartFilter.click(this)" />
                  <span>18.5&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_3788229178">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_3788229178'
										id='arrFilter_673_3788229178'
										data_id='19"'
																				onclick="smartFilter.click(this)" />
                  <span>19&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1121889316">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1121889316'
										id='arrFilter_673_1121889316'
										data_id='19,5"'
																				onclick="smartFilter.click(this)" />
                  <span>19,5&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_16493401">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_16493401'
										id='arrFilter_673_16493401'
										data_id='19.5"'
																				onclick="smartFilter.click(this)" />
                  <span>19.5&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_4208756746">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_4208756746'
										id='arrFilter_673_4208756746'
										data_id='20"'
																				onclick="smartFilter.click(this)" />
                  <span>20&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1554744254">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1554744254'
										id='arrFilter_673_1554744254'
										data_id='21"'
																				onclick="smartFilter.click(this)" />
                  <span>21&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1343533634">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1343533634'
										id='arrFilter_673_1343533634'
										data_id='21.5"'
																				onclick="smartFilter.click(this)" />
                  <span>21.5&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_3409220247">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_3409220247'
										id='arrFilter_673_3409220247'
										data_id='23"'
																				onclick="smartFilter.click(this)" />
                  <span>23&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_187811608">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_187811608'
										id='arrFilter_673_187811608'
										data_id='38 cм'
																				onclick="smartFilter.click(this)" />
                  <span>38 cм</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_2728042867">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_2728042867'
										id='arrFilter_673_2728042867'
										data_id='44 см'
																				onclick="smartFilter.click(this)" />
                  <span>44 см</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_604951517">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_604951517'
										id='arrFilter_673_604951517'
										data_id='47 см'
																				onclick="smartFilter.click(this)" />
                  <span>47 см</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1411398516">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1411398516'
										id='arrFilter_673_1411398516'
										data_id='51 см'
																				onclick="smartFilter.click(this)" />
                  <span>51 см</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_3535030746">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_3535030746'
										id='arrFilter_673_3535030746'
										data_id='52 см'
																				onclick="smartFilter.click(this)" />
                  <span>52 см</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1227164620">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1227164620'
										id='arrFilter_673_1227164620'
										data_id='56 см'
																				onclick="smartFilter.click(this)" />
                  <span>56 см</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1707614697">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1707614697'
										id='arrFilter_673_1707614697'
										data_id='61 см'
																				onclick="smartFilter.click(this)" />
                  <span>61 см</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_2909332022">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_2909332022'
										id='arrFilter_673_2909332022'
										data_id='L'
																				onclick="smartFilter.click(this)" />
                  <span>L</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_3664761504">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_3664761504'
										id='arrFilter_673_3664761504'
										data_id='M'
																				onclick="smartFilter.click(this)" />
                  <span>M</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_4162588765">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_4162588765'
										id='arrFilter_673_4162588765'
										data_id='one size'
																				onclick="smartFilter.click(this)" />
                  <span>one size</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_543223747">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_543223747'
										id='arrFilter_673_543223747'
										data_id='S'
																				onclick="smartFilter.click(this)" />
                  <span>S</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_673_1288816664">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_673_1288816664'
										id='arrFilter_673_1288816664'
										data_id='XL'
																				onclick="smartFilter.click(this)" />
                  <span>XL</span> </label>
                </li>
              </ul>
              <a href="#" id="toggle_link_show_673" data-value="- Свернуть" class="sidebar_section__toggle_link">+ Развернуть</a> </div>
          </div>
        </div>
        <div class="sidebar_section" data_id="300">
          <div class="sidebar_section__title opened">Цена</div>
          <div class="sidebar_section__content" style="display:block">
            <div class="sidebar_section__content_c">
              <div class="range_block">
                <div class="range" id="filter_price_range"></div>
              </div>
              <div class="inline_line price_line"> <span class="inline_line_input price_line_input_1">
                <input type="text" data_id="XL" id="arrFilter_300_MIN" name="arrFilter_300_MIN"
										value="9500"/>
                </span> <span class="inline_line_label price_line_label_1">—</span> <span class="inline_line_input price_line_input_2">
                <input type="text" data_id="XL" name="arrFilter_300_MAX"
										id="arrFilter_300_MAX"
										value="584935" />
                </span> <span class="inline_line_label price_line_label_2"><span class="rub">p</span></span> </div>
            </div>
          </div>
        </div>
        <script>
						$(document).ready(function() {
							
							/* Filter price */
							var filter_price_range = $("#filter_price_range");
							var filter_price_range_min = $("#arrFilter_300_MIN");
							var filter_price_range_max = $("#arrFilter_300_MAX");
							if(filter_price_range.length > 0){
								
								filter_price_range.slider({
									change: function(event, ui) {
										
										/*$( "input[NAME=arrFilter_P2_MAX]" ).on( "click", function() {
											smartFilter.click(this);
										});
										$( "input[NAME=arrFilter_P2_MAX]" ).trigger( "click" );
										
										$( "input[NAME=arrFilter_P2_MIN]" ).on( "click", function() {
										  smartFilter.click(this);
										});
										$( "input[NAME=arrFilter_P2_MIN]" ).trigger( "click" );
										var row = $('.range_block');
										filter_label2(row);
										function filter_label2(row2){ 
											//$('.js-filter-label').remove();
											var topPos = row2.offset().top - 10;
											var leftPos = row2.offset().left + row2.outerWidth() + 26;
															//topPos=topPos + 8;
											$(".filter_labelright").css("position","absolute");
											$(".filter_labelright").css("left",leftPos +"px");
											$(".filter_labelright").css("top",topPos +"px");
										};*/
									},
									range: true,
									min:  parseFloat(9500),
									max: parseFloat(584935),
									values: [parseFloat(9500), parseFloat(584935)],
									step: 1,
									slide: function(event, ui) {
										filter_price_range_min.val(ui.values[0]);
										filter_price_range_max.val(ui.values[1]);
									},
									change: function(event, ui) {
										filter_price_range_min.val(ui.values[0]);
										filter_price_range_max.val(ui.values[1]);
										//дубль нижней функцииconsole
										var row = $(this).parents('.range_block');//кроме этого
										var block = $(this).parents('.sidebar_section').attr("data_id");
										var count = 0;
										var all="";
										$(".smartfilter input").each(function (i) {
											if($(this).parent("div.jq-checkbox").hasClass("checked")){
												var val = "Y";
											}else{
												var val = "N";
											}
											var a = $(this).attr("data_id");
											var b = $(this).attr("name");
											if(val=="Y"){
												all += $(this).attr("name") + "=" + $(this).attr("data_id") + "&";
											}
											
										  });
										var str = "/ajax/smartfilter_popup.php?" + "SECTION_ID=" + $("input[NAME=SECTION_ID]").val() + "&" +$(".smartfilter").serialize() + "&destroy=Y&" + all;
										$.ajax({ 
												url: str,
												type: "GET",
												success: function(data){
														var num = data;
														var itog="";
														var status= {'0': '', '1': 'а', '2': 'ов'};
														var id = num%100;
														var arEnds = {'0': 'ов', '1': 'ов', '2': 'ов', '3': 'а' };
														 if (num.lenght>1 && parseInt(num.substr(num.lenght-2, 1)=='1')) {
															 itog=arEnds[0];
														  } else {
															 var c = parseInt(num.substr(num.lenght-1, 1));
															 if (c==0 || (c>=5 && c<=9)) {
																itog=arEnds[1];
															 } else if (c==1) {
																itog=arEnds[2];
															 } else {
																itog=arEnds[3];
															 }
														  }
//														console.log(row);
//														console.log(data);
//														console.log(block);
														filter_label(row,data,block);
														function filter_label(row, data, block){
															$('.js-filter-label').remove();
															var topPos = row.offset().top;
															var leftPos = row.offset().left + row.outerWidth() + 10;
															//topPos=topPos + 8;							
															$('body').append('<div data_id="'+ block +'"  onclick="document._form.submit();" class="filter_label js-filter-label" style="position:absolute;left:'+ leftPos +'px;top:'+ topPos +'px;"><span>Показать '+ data +' товар'+itog+'</span></div>');
														};
												},
												error: function(data){
													// Функция при ошибочном запросе
												}
											});
										
									}
								});
								filter_price_range_min.val(filter_price_range.slider("values", 0));
								filter_price_range_max.val(filter_price_range.slider("values", 1));
								$("#filter_price_range_min, #filter_price_range_max").change(function() {
									filter_price_range.slider("values", 0, filter_price_range_min.val());
									filter_price_range.slider("values", 1, filter_price_range_max.val());
								});
							}
						});
						</script>
        <div class="sidebar_section  " data_id="342">
          <div class="sidebar_section__title ">Год выпуска </div>
          <div class="sidebar_section__content" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_342_2214881917">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_342_2214881917'
										id='arrFilter_342_2214881917'
										data_id='6523'
																				onclick="smartFilter.click(this)" />
                  <span>2017</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_342_1302093482">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_342_1302093482'
										id='arrFilter_342_1302093482'
										data_id='6040'
																				onclick="smartFilter.click(this)" />
                  <span>2016</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_342_1914675509">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_342_1914675509'
										id='arrFilter_342_1914675509'
										data_id='2790'
																				onclick="smartFilter.click(this)" />
                  <span>2015</span> </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="sidebar_section  opened  " data_id="321">
          <div class="sidebar_section__title  opened ">Размер колес </div>
          <div class="sidebar_section__content"  style="display:block;" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_321_753858580">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_321_753858580'
										id='arrFilter_321_753858580'
										data_id='4499'
																				onclick="smartFilter.click(this)" />
                  <span>29&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_321_1542047874">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_321_1542047874'
										id='arrFilter_321_1542047874'
										data_id='4498'
																				onclick="smartFilter.click(this)" />
                  <span>28&quot; (700С)</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_321_3411465491">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_321_3411465491'
										id='arrFilter_321_3411465491'
										data_id='4497'
																				onclick="smartFilter.click(this)" />
                  <span>27,5&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_321_3159483781">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_321_3159483781'
										id='arrFilter_321_3159483781'
										data_id='4496'
																				onclick="smartFilter.click(this)" />
                  <span>26&quot;</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_321_626570303">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_321_626570303'
										id='arrFilter_321_626570303'
										data_id='4495'
																				onclick="smartFilter.click(this)" />
                  <span>24&quot;</span> </label>
                </li>
              </ul>
              <ul class="sidebar_section__hidden_list" >
              </ul>
              <a href="#" id="toggle_link_show_321" data-value="- Свернуть" class="sidebar_section__toggle_link">+ Развернуть</a> </div>
          </div>
        </div>
        <div class="sidebar_section  " data_id="320">
          <div class="sidebar_section__title ">Материал рамы </div>
          <div class="sidebar_section__content" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_320_72953724">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_320_72953724'
										id='arrFilter_320_72953724'
										data_id='2272'
																				onclick="smartFilter.click(this)" />
                  <span>Алюминий</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_320_1935548394">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_320_1935548394'
										id='arrFilter_320_1935548394'
										data_id='2273'
																				onclick="smartFilter.click(this)" />
                  <span>Карбон</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_320_3980036681">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_320_3980036681'
										id='arrFilter_320_3980036681'
										data_id='2274'
																				onclick="smartFilter.click(this)" />
                  <span>Сталь</span> </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="sidebar_section  opened  " data_id="322">
          <div class="sidebar_section__title  opened ">Тип тормозов </div>
          <div class="sidebar_section__content"  style="display:block;" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_322_1662311085">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_322_1662311085'
										id='arrFilter_322_1662311085'
										data_id='2288'
																				onclick="smartFilter.click(this)" />
                  <span>Дисковые гидравлические</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_322_336849467">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_322_336849467'
										id='arrFilter_322_336849467'
										data_id='2289'
																				onclick="smartFilter.click(this)" />
                  <span>Дисковые механические</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_322_4088121148">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_322_4088121148'
										id='arrFilter_322_4088121148'
										data_id='2287'
																				onclick="smartFilter.click(this)" />
                  <span>V-brake</span> </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="sidebar_section  " data_id="323">
          <div class="sidebar_section__title ">Ход вилки </div>
          <div class="sidebar_section__content" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_1303844757">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_1303844757'
										id='arrFilter_323_1303844757'
										data_id='2306'
																				onclick="smartFilter.click(this)" />
                  <span>50</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_984622851">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_984622851'
										id='arrFilter_323_984622851'
										data_id='2307'
																				onclick="smartFilter.click(this)" />
                  <span>60</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_4203947667">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_4203947667'
										id='arrFilter_323_4203947667'
										data_id='6377'
																				onclick="smartFilter.click(this)" />
                  <span>65</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_2853124754">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_2853124754'
										id='arrFilter_323_2853124754'
										data_id='2308'
																				onclick="smartFilter.click(this)" />
                  <span>75</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_3708291588">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_3708291588'
										id='arrFilter_323_3708291588'
										data_id='2309'
																				onclick="smartFilter.click(this)" />
                  <span>80</span> </label>
                </li>
              </ul>
              <ul class="sidebar_section__hidden_list" >
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_2646066923">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_2646066923'
										id='arrFilter_323_2646066923'
										data_id='2296'
																				onclick="smartFilter.click(this)" />
                  <span>100</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_3937465981">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_3937465981'
										id='arrFilter_323_3937465981'
										data_id='2297'
																				onclick="smartFilter.click(this)" />
                  <span>120</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_323_1378402757">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_323_1378402757'
										id='arrFilter_323_1378402757'
										data_id='6154'
																				onclick="smartFilter.click(this)" />
                  <span>Ригид</span> </label>
                </li>
              </ul>
              <a href="#" id="toggle_link_show_323" data-value="- Свернуть" class="sidebar_section__toggle_link">+ Развернуть</a> </div>
          </div>
        </div>
        <div class="sidebar_section  " data_id="671">
          <div class="sidebar_section__title ">Возраст </div>
          <div class="sidebar_section__content" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_671_2181951281">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_671_2181951281'
										id='arrFilter_671_2181951281'
										data_id='8821'
																				onclick="smartFilter.click(this)" />
                  <span>Взрослый</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_671_453295755">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_671_453295755'
										id='arrFilter_671_453295755'
										data_id='8822'
																				onclick="smartFilter.click(this)" />
                  <span>Детский</span> </label>
                </li>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_671_2601967216">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_671_2601967216'
										id='arrFilter_671_2601967216'
										data_id='8831'
																				onclick="smartFilter.click(this)" />
                  <span>Подростковый</span> </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="sidebar_section  " data_id="672">
          <div class="sidebar_section__title ">Пол </div>
          <div class="sidebar_section__content" >
            <div class="sidebar_section__content_c">
              <ul>
                <li class="js-filter-label-row">
                  <label onclick="smartFilter.click($(this).find('input'))" for="arrFilter_672_2625313385">
                  <input
										type="checkbox" class="styler"
										value='Y'
										name='arrFilter_672_2625313385'
										id='arrFilter_672_2625313385'
										data_id='8835'
																				onclick="smartFilter.click(this)" />
                  <span>Мужской</span> </label>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <input type="hidden" id="set_filter" name="set_filter" value="Показать" />
        <div style="clear: both;"></div>
        <div class="bx_filter_control_section" id="modef" > <a style='display:none' href="#" class="reset_filter reset_filter-b" onclick="$('#clear_filter').html('<input type=\'hidden\' id=\'del_filter\' name=\'del_filter\' value=\'Сбросить\' />');$('.smartfilter').submit(); return false;"><i class="icon icon-reset"></i>Сбросить все</a> <span class="icon"></span>
          <input style="margin:0 auto;" class="bx_filter_search_button btn btn-middle" type="submit" id="set_filter" name="set_filter" value="Показать" />
          <p id="clear_filter" style="display:none;"></p>
          <!--<input style="display:none;" type="hidden" id="del_filter" name="del_filter" value="Сбросить" />-->
          <!--<div class="bx_filter_popup_result left" id="modef" style="display:none" style="display: inline-block;">
					Выбрано: <span id="modef_num">0</span>					<span class="arrow"></span>
					<a href="">Показать</a>
				</div>-->
        </div>
      </form>
      <script>
	var smartFilter = new JCSmartFilter('/velosipedy/gornye/?SORT_METHOD=4&PAGE_ELEMENT_COUNT=24&VID=0');
	$('.smartfilter .price_line input').change(function(){
		
	});
	$(".filter_label span").click(function(){
			//_form.submit();
			$('#set_filter').attr("type","hidden");
			//$(".smartfilter").submit();
       });
	$(".sidebar_section__title").click(function(){
		//console.log(this);
		var idd=$(".filter_label").attr("data_id");
		if($(this).hasClass("opened")){
			if($(this).parents(".sidebar_section").attr("data_id")==idd){
				$(".filter_label").css("display","none");
			}
		}else{
			if($(this).parents(".sidebar_section").attr("data_id")==idd){
				$(".filter_label").css("display","block");
			}else{
				
			}
		}
	});
	
	$(".range_block span").click(function() {
			//console.log($("#arrFilter_300_MIN").val());
//			console.log("!");
		//document.getElementById('result').innerHTML = input.value;
	  });
	  
	$('.smartfilter input').change(function(){
//		console.log(this);
		var row = $(this).parents('.js-filter-label-row');
		var block = $(this).parents('.sidebar_section').attr("data_id");
		var count = 0;
		var all="";
		$(".smartfilter input").each(function (i) {
			if($(this).parent("div.jq-checkbox").hasClass("checked")){
				var val = "Y";
			}else{
				var val = "N";
			}
			var a = $(this).attr("data_id");
			var b = $(this).attr("name");
			if(val=="Y"){
				all += $(this).attr("name") + "=" + $(this).attr("data_id") + "&";
			}
			
		  });
		var str = "/ajax/smartfilter_popup.php?" + "SECTION_ID=" + $("input[NAME=SECTION_ID]").val() + "&" +$(".smartfilter").serialize() + "&destroy=Y&" + all;
		$.ajax({ 
				url: str,
				type: "GET",
				success: function(data){
						var num = data;
						var itog="";
						var status= {'0': '', '1': 'а', '2': 'ов'};
						var id = num%100;
						var arEnds = {'0': 'ов', '1': 'ов', '2': 'ов', '3': 'а' };
						 if (num.lenght>1 && parseInt(num.substr(num.lenght-2, 1)=='1')) {
							 itog=arEnds[0];
						  } else {
							 var c = parseInt(num.substr(num.lenght-1, 1));
							 if (c==0 || (c>=5 && c<=9)) {
								itog=arEnds[1];
							 } else if (c==1) {
								itog=arEnds[2];
							 } else {
								itog=arEnds[3];
							 }
						  }
//						console.log(row);
//						console.log(data);
//						console.log(block);
						filter_label(row,data,block);
						function filter_label(row, data, block){
							$('.js-filter-label').remove();
							var topPos = row.offset().top;
							var leftPos = row.offset().left + row.outerWidth() + 10;
							//topPos=topPos + 8;							
							$('body').append('<div data_id="'+ block +'"  onclick="document._form.submit();" class="filter_label js-filter-label" style="position:absolute;left:'+ leftPos +'px;top:'+ topPos +'px;"><span>Показать '+ data +' товар'+itog+'</span></div>');
						};
				},
				error: function(data){
					// Функция при ошибочном запросе
				}
			});
	});
</script>
    </div>
  </div>
  <div class="catalog_banner_bottomleft">
    <? /*
				<a href="/pomoshch/kak-poluchit/#courier">
					<img class="image" src="/upload/uf/195/195ec025e2903a6dd5fc1b35ef8b1df8.jpg" />
				</a>
				*/ ?>
  </div>
</div>
<div class="main_content main_content-with_sidebar">
  <div class="main_content__c">
    <div class="h1">
      <h1>
        <?=$arResult['NAME']?>
      </h1>
    </div>
    <div class="catalog_control">
      <div class="catalog_control__sort">
        <div class="catalog_control_label">сортировать по</div>
        <div class="catalog_control_select">
          <form id="element_sort_form" method="get"  >
            <input
											type="hidden"
											name="PAGE_ELEMENT_COUNT"
											id="PAGE_ELEMENT_COUNT"
											value="24"
										/>
            <input
											type="hidden"
											name="VID"
											id="VID"
											value="0"
										/>
            <select class="styler" onchange="$('#element_sort_form').submit();" name="SORT_METHOD">
              <option  value="2">По цене &#8593;</option>
              <option  value="3">По цене &#8595;</option>
              <option  value="5">По размеру скидки</option>
              <option  value="6">По рейтингу</option>
              <option  value="1">По названию</option>
              <option selected="selected" value="4">По новизне</option>
            </select>
          </form>
        </div>
      </div>
      <div class="catalog_control__view">
        <div class="catalog_control_label">Показать</div>
        <div class="catalog_control_select">
          <form id="element_count_form" method="get" >
            <input
													type="hidden"
													name="SORT_METHOD"
													id="SORT_METHOD"
													value="4"
												/>
            <input
													type="hidden"
													name="VID"
													id="VID"
													value="0"
												/>
            <select onchange="$('#element_count_form').submit();"  name="PAGE_ELEMENT_COUNT" class="styler">
              <option  value="12">12</option>
              <option selected="selected"  value="24">24</option>
              <option   value="48">48</option>
            </select>
          </form>
        </div>
      </div>
      <div class="catalog_control__grid">
        <form id="element_vid_form" method="get" >
          <input
													type="hidden"
													name="SORT_METHOD"
													id="SORT_METHOD"
													value="4"
												/>
          <input
													type="hidden"
													name="PAGE_ELEMENT_COUNT"
													id="PAGE_ELEMENT_COUNT"
													value="24"
												/>
          <input type="hidden" name="VID" id="catalog_vid" value="0">
        </form>
        <div class="catalog_control_label">ВИД</div>
        <a href="#"  onclick="$('#catalog_vid').val(0);" class="view_control_link view_control_link-grid active"></a> <a href="#" onclick="$('#catalog_vid').val(1);"  class="view_control_link view_control_link-list "></a> </div>
    </div>
    
    <div class="catalog 0  ">
	<? foreach ($arResult['ITEMS'] as $key => $arItem){
	
	
	
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], $strElementEdit);
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], $strElementDelete, $arElementDeleteParams);
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$arItemIDs = array(
		'ID' => $strMainID,
		'PICT' => $strMainID.'_pict',
		'SECOND_PICT' => $strMainID.'_secondpict',
		'STICKER_ID' => $strMainID.'_sticker',
		'SECOND_STICKER_ID' => $strMainID.'_secondsticker',
		'QUANTITY' => $strMainID.'_quantity',
		'QUANTITY_DOWN' => $strMainID.'_quant_down',
		'QUANTITY_UP' => $strMainID.'_quant_up',
		'QUANTITY_MEASURE' => $strMainID.'_quant_measure',
		'BUY_LINK' => $strMainID.'_buy_link',
		'BASKET_ACTIONS' => $strMainID.'_basket_actions',
		'NOT_AVAILABLE_MESS' => $strMainID.'_not_avail',
		'SUBSCRIBE_LINK' => $strMainID.'_subscribe',
		'COMPARE_LINK' => $strMainID.'_compare_link',

		'PRICE' => $strMainID.'_price',
		'DSC_PERC' => $strMainID.'_dsc_perc',
		'SECOND_DSC_PERC' => $strMainID.'_second_dsc_perc',
		'PROP_DIV' => $strMainID.'_sku_tree',
		'PROP' => $strMainID.'_prop_',
		'DISPLAY_PROP_DIV' => $strMainID.'_sku_prop',
		'BASKET_PROP_DIV' => $strMainID.'_basket_prop',
	);
	
	
	$price = $arItem['PRICES']['BASE']['PRINT_VALUE_NOVAT'];
	$price = substr($price,0,strlen($price)-4); 
	
	
	$skidka = $arItem['PROPERTIES']['DISCOUNT']['VALUE'];
	if ($skidka){
		$old_price = ($arItem['PRICES']['BASE']['VALUE_NOVAT'])*($skidka/100);
	}

		$img_174 = CFile::resizeImageGet($arItem['PREVIEW_PICTURE']['ID'],array('width'=>174,'height'=>180), BX_RESIZE_IMAGE_PROPORTIONAL, true);

	?>
      <div class="catalog_item">
        <div class="thumb ">
          <div class="thumb_c">
            <div class="thumb_image_block">
            <div class="thumb_image"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><img src="<?=$img_174['src']?>" width="155" height="180" alt=""></a></div>
            <div class="thumb_image__thubms">
            	<? 
				if (count($arItem['PROPERTIES']['IMAGES']['VALUE'])){ ?>
                <a href="<?=$arItem['DETAIL_PAGE_URL']?>" data-href="<?=$img_174['src']?>"><img src="<?=$img_174['src']?>" alt="<?=$arItem['NAME']?>"></a>
                <?
				foreach($arItem['PROPERTIES']['IMAGES']['VALUE'] as $ad_images){
					$ad_images_min = CFile::resizeImageGet($ad_images,array('width'=>174,'height'=>180), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				?>
            	<a href="<?=$arItem['DETAIL_PAGE_URL']?>" data-href="<?=$ad_images_min['src']?>"><img src="<?=$ad_images_min['src']?>" alt="<?=$arItem['NAME']?>"></a>
                <? } 
				}?>
            </div>
          </div>
            <div class="thumb_info">
              <div class="thumb_title">
                <div class="thumb_title_bg_wh"> </div>
                <a descr="<?=$arItem['NAME']?>" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a> </div>
              <div class="thumb_price"> <? if($old_price){ ?><del ><?=$old_price?> <span class="rub">p</span></del><? }?> <strong><?=$price?> <span class="rub">p</span></strong> </div>
            </div>
            <div class="thumb_btns"> <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="btn" style=""><i class="icon icon-basket"></i>Купить</a>
              <div class="btn btn-white quick_view_link" element_id="<?=$arItem['ID']?>">Быстрый просмотр</div>
            </div>
            <div class="product_list_icons"> </div>
            <a href="#" class="docompare" title="В сравнение" data-id="<?=$arItem['ID']?>" data-iid="5"></a>
            <div class="thumb_footer"> </div>
          </div>
        </div>
      </div>
	<? }?>

    </div>
    
    <div class="catalog_control catalog_control-bottom">
      <div class="catalog_control__info"> Товары от <b>1</b> до <b>24</b> из <b>280</b> </div>
      <div class="catalog_control__view">
        <div class="catalog_control_label">Показать</div>
        <div class="catalog_control_select">
          <form id="element_count_form2" method="get" >
            <input
													type="hidden"
													name="SORT_METHOD"
													id="SORT_METHOD"
													value="4"
												/>
            <input
													type="hidden"
													name="VID"
													id="VID"
													value="0"
												/>
            <select onchange="$('#element_count_form2').submit();"  name="PAGE_ELEMENT_COUNT" class="styler">
              <option  value="12">12</option>
              <option selected="selected"  value="24">24</option>
              <option   value="48">48</option>
            </select>
          </form>
        </div>
      </div>
      <div class="catalog_control__pagination">
		  <? /*
        <div class="pagination"> <a class="active">1</a> <a href="/velosipedy/gornye/?SORT_METHOD=4&PAGE_ELEMENT_COUNT=24&VID=0&page=2">2</a> <a href="/velosipedy/gornye/?SORT_METHOD=4&PAGE_ELEMENT_COUNT=24&VID=0&page=3">3</a> <a href="/velosipedy/gornye/?SORT_METHOD=4&PAGE_ELEMENT_COUNT=24&VID=0&page=11">11</a> <a href="/velosipedy/gornye/?SORT_METHOD=4&PAGE_ELEMENT_COUNT=24&VID=0&page=12">12</a> <a href="/velosipedy/gornye/?SORT_METHOD=4&PAGE_ELEMENT_COUNT=24&VID=0&page=2" id="navigation_2_next_page"class="pagination_next"><i class="icon icon-rarr"></i></a> </div>
*/ ?>
<?=$arResult['NAV_STRING']?>
      </div>
    </div>
    <script type="text/javascript">
	BX.bind(document, "keydown", function (event) {

		event = event || window.event;
		if (!event.ctrlKey)
			return;

		var target = event.target || event.srcElement;
		if (target && target.nodeName && (target.nodeName.toUpperCase() == "INPUT" || target.nodeName.toUpperCase() == "TEXTAREA"))
			return;

		var key = (event.keyCode ? event.keyCode : (event.which ? event.which : null));
		if (!key)
			return;

		var link = null;
		if (key == 39)
			link = BX('navigation_2_next_page');
		else if (key == 37)
			link = BX('navigation_2_previous_page');

		if (link && link.href)
			document.location = link.href;
	});
</script>
    <script>
	var cmpid = [];
	for (i = 0; i < cmpid.length; i++) {
		$('.thumb .docompare[data-id="'+cmpid[i]+'"]').addClass('active');
	}
</script>

<? /*
    <div class="additional_catalog">
      <div class="additional_catalog__header">
        <div class="h1 line_title"><span>Вам также может понравиться</span></div>
      </div>
      <div class="catalog">
        <div class="catalog_item">
          <div class="thumb ">
            <div class="thumb_c">
              <div class="thumb_image_block">
                <div class="thumb_image"><a href="/velosipedy/gornye/velosiped_welt_rubicon_1_0_2017/"><img src="/upload/resize_cache/iblock/ef6/174_180_0/ef6cbcc015c56bd901dc1f6e054cd7c2.jpg" width="174" height="180" alt=""></a></div>
              </div>
              <div class="thumb_info">
                <div class="thumb_rating" style="height: 15px;"> </div>
                <div class="thumb_title">
                  <div class="thumb_title_bg_wh"> </div>
                  <a descr="Велосипед WELT RUBICON 1.0 (2017)" href="/velosipedy/gornye/velosiped_welt_rubicon_1_0_2017/"> Велосипед WELT RUBICON 1.0 (2017) </a> </div>
                <div class="thumb_price"> <del style="display:none;">55 800 <span class="rub">p</span></del> <strong>55 800 <span class="rub">p</span></strong> </div>
              </div>
              <div class="thumb_btns"> <a href="/velosipedy/gornye/velosiped_welt_rubicon_1_0_2017/" class="btn"><i class="icon icon-basket"></i>Заказать</a>
                <div class="btn btn-white quick_view_link" element_id="171420">Быстрый просмотр</div>
              </div>
              <a href="#" class="docompare" title="В сравнение" data-id="171420" data-iid="5"></a>
              <div class="thumb_footer"> </div>
            </div>
          </div>
        </div>
        <div class="catalog_item">
          <div class="thumb ">
            <div class="thumb_c">
              <div class="thumb_image_block">
                <div class="thumb_image"><a href="/velosipedy/gornye/velosiped_ktm_ultra_flite_29_2017/"><img src="/upload/resize_cache/iblock/9f4/174_180_0/9f419c8f99076944fdbd26614e7fba69.jpg" width="174" height="180" alt=""></a></div>
              </div>
              <div class="thumb_info">
                <div class="thumb_rating" style="height: 15px;"> </div>
                <div class="thumb_title">
                  <div class="thumb_title_bg_wh"> </div>
                  <a descr="Велосипед KTM ULTRA FLITE 29 (2017)" href="/velosipedy/gornye/velosiped_ktm_ultra_flite_29_2017/"> Велосипед KTM ULTRA FLITE 29 (2017) </a> </div>
                <div class="thumb_price"> <del style="display:none;">62 000 <span class="rub">p</span></del> <strong>62 000 <span class="rub">p</span></strong> </div>
              </div>
              <div class="thumb_btns"> <a href="/velosipedy/gornye/velosiped_ktm_ultra_flite_29_2017/" class="btn"><i class="icon icon-basket"></i>Купить</a>
                <div class="btn btn-white quick_view_link" element_id="172817">Быстрый просмотр</div>
              </div>
              <a href="#" class="docompare" title="В сравнение" data-id="172817" data-iid="5"></a>
              <div class="thumb_footer"> </div>
            </div>
          </div>
        </div>
        <div class="catalog_item">
          <div class="thumb ">
            <div class="thumb_c">
              <div class="thumb_image_block">
                <div class="thumb_image"><a href="/velosipedy/gornye/velosiped_stels_navigator_500_v_29_2017/"><img src="/upload/resize_cache/iblock/bec/174_180_0/becb96a93195af56f3f1da494376008c.jpg" width="174" height="180" alt=""></a></div>
              </div>
              <div class="thumb_info">
                <div class="thumb_rating" style="height: 15px;"> </div>
                <div class="thumb_title">
                  <div class="thumb_title_bg_wh"> </div>
                  <a descr="Велосипед Stels Navigator 500 V 29 (2017)" href="/velosipedy/gornye/velosiped_stels_navigator_500_v_29_2017/"> Велосипед Stels Navigator 500 V 29 (2017) </a> </div>
                <div class="thumb_price"> <del style="display:none;">12 899 <span class="rub">p</span></del> <strong>12 899 <span class="rub">p</span></strong> </div>
              </div>
              <div class="thumb_btns"> <a href="/velosipedy/gornye/velosiped_stels_navigator_500_v_29_2017/" class="btn"><i class="icon icon-basket"></i>Купить</a>
                <div class="btn btn-white quick_view_link" element_id="169563">Быстрый просмотр</div>
              </div>
              <a href="#" class="docompare" title="В сравнение" data-id="169563" data-iid="5"></a>
              <div class="thumb_footer"> Мощный хардтейл на 29&quot; колесах Stels Navigator 500 V позволит вам добраться в любое место по любой местности. </div>
            </div>
          </div>
        </div>
        <div class="catalog_item">
          <div class="thumb ">
            <div class="thumb_c">
              <div class="thumb_image_block">
                <div class="thumb_image"><a href="/velosipedy/gornye/velosiped_format_26_1413_15/"><img src="/upload/resize_cache/iblock/1c0/174_180_0/1c0d7a793b3cbe4f82a9456471569485.jpg" width="174" height="180" alt=""></a></div>
              </div>
              <div class="thumb_info">
                <div class="thumb_rating" style="height: 15px;"> </div>
                <div class="thumb_title">
                  <div class="thumb_title_bg_wh"> </div>
                  <a descr="Велосипед FORMAT 1413 26 (2015)" href="/velosipedy/gornye/velosiped_format_26_1413_15/"> Велосипед FORMAT 1413 26 (2015) </a> </div>
                <div class="thumb_price"> <del >33 444 <span class="rub">p</span></del> <strong>26 755 <span class="rub">p</span></strong> </div>
              </div>
              <div class="thumb_btns"> <a href="/velosipedy/gornye/velosiped_format_26_1413_15/" class="btn"><i class="icon icon-basket"></i>Купить</a>
                <div class="btn btn-white quick_view_link" element_id="83291">Быстрый просмотр</div>
              </div>
              <div class="discountperc"><span>-21</span></div>
              <a href="#" class="docompare" title="В сравнение" data-id="83291" data-iid="5"></a>
              <div class="thumb_footer"> Отличный горный велосипед подойдет как для города, так и для лесных приключений. </div>
            </div>
          </div>
        </div>
        <script type="text/javascript">
BX.message({
	MESS_BTN_BUY: 'Купить',
	MESS_BTN_ADD_TO_BASKET: 'В корзину',
	MESS_NOT_AVAILABLE: 'Нет в наличии',
	BTN_MESSAGE_BASKET_REDIRECT: 'Перейти в корзину',
	BASKET_URL: '/personal/cart/',
	ADD_TO_BASKET_OK: 'Товар добавлен в корзину',
	TITLE_ERROR: 'Ошибка',
	TITLE_BASKET_PROPS: 'Свойства товара, добавляемые в корзину',
	TITLE_SUCCESSFUL: 'Товар добавлен в корзину',
	BASKET_UNKNOWN_ERROR: 'Неизвестная ошибка при добавлении товара в корзину',
	BTN_MESSAGE_SEND_PROPS: 'Выбрать',
	BTN_MESSAGE_CLOSE: 'Закрыть'
});
</script>
      </div>
    </div>
    */ ?>
    
    <script>
	var cmpid = [];
	for (i = 0; i < cmpid.length; i++) {
		$('.thumb .docompare[data-id="'+cmpid[i]+'"]').addClass('active');
	}
</script>
    <div class="main_content__inner text-l" style="margin-top:21px;">
      <?=$arResult['~DESCRIPTION']?>
    </div>
  </div>
</div>
