function getPrintPrice(price){
		if(getDecimal(price) > 0)
			return price.toFixed(2).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ").replace('.',',');
		else
			return price.toFixed(0).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1 ").replace('.',',');
	}
	
$.validator.addMethod('name-inp', function(value) {
	return ( value.search(/[А-яЁёA-z]/) !== -1 );
});	
	
$(document).ready(function() {
	
	//убираем заголовок на карточках товар

    $('.slidedown-item .slidedown-link').click(function() {
        if ($(this).hasClass('opened')) $(this).removeClass('opened'); else $(this).addClass('opened');
        $(this).siblings('.slidedown-content').slideToggle(300);
    });

	$(".phone-inp").mask("+7 999 999 9999",{
		autoclear: false
	});
	
	$('iframe').load(function(){
		$(this).height($(this).contents().find('html').height());
	});

    $('input, textarea').placeholder();
    
    $('.styler').styler({
        filePlaceholder : '',
        fileBrowse : 'Загрузить'
    });
	$('.account_av__file input').change(function(){
		$('.account_av__title p').html($('.jq-file__name').html());
	});
    
    $('.phone_input').mask("+7 ( 999 ) 999 - 99 - 99");
    
    $('.card_num_input').mask("9999 9999 9999 9999");

    $('.card_date_input').mask("99");

    $('.card_cvc_input').mask("999");

    $('#calendar').datepicker({
        showOtherMonths: true,
        selectOtherMonths: true,
        onSelect: function () {
            updateDatePickerCells();
        },
        onChangeMonthYear: function() {
            updateDatePickerCells();
        }
    });

    updateDatePickerCells();

    function updateDatePickerCells() {
        setTimeout(function () {
            $('#calendar .ui-datepicker-calendar td[data-month=11][data-year=2014]').each(function(i){
                if(i == 4){
                    $(this).addClass('received');
                }
            });

            $('#calendar .ui-datepicker-calendar td[data-month=11][data-year=2014]').each(function(i){
                if(i == 11){
                    $(this).addClass('active');
                }
            });

            $('#calendar .ui-datepicker-calendar td[data-month=11][data-year=2014]').each(function(i){
                if(i == 3){
                    $(this).addClass('hover');
                }
            });

            $('#calendar .ui-datepicker-calendar td[data-month=11][data-year=2014]').each(function(i){
                if(i == 5){
                    $(this).addClass('highlight');
                }
            });
        }, 0);
    }
	
	$('.video_link').click(function(e){
        e.preventDefault();
		
		//autoIframe($('#3d_view_window iframe'));
		
		/*$.fancybox.open('#video_window',{
			padding: 0,
			wrapCSS: 'fancy_window'
		});*/
		$.fancybox.open('#video_window');
    });
	
	$('.3d_view_link').click(function(e){
        e.preventDefault();
		
		//autoIframe($('#3d_view_window iframe'));
		
		$.fancybox.open('#3d_view_window',{
			padding: 0,
			wrapCSS: 'fancy_window'
		});
    });
	
    $('.popup_link').fancybox({
        padding: 0,
		wrapCSS: 'fancy_window'
    });
	
	$('.fancybox-product-detail').fancybox({
        padding: 0,
        wrapCSS: 'fancy_product_detail',
        afterLoad: function () {
            $('.fancybox-wrap').addClass('popup_gallery');
        }
    });

    $('.quick_view_link').click(function(e){
        e.preventDefault();
		$.post( "/ajax/pop_up_element.php",
				{ELEMENT_ID: $(this).attr('element_id')},
				function(data){
					$("#quick_view_window").html(data);
					$('.quick_view_gallery__thumbs').owlCarousel({
						items : 3,
						itemsMobile : [760,2],
						navigation : true
					});
					 /* Quick View Gallery */
					$('.quick_view_gallery__thumbs a').click(function(e) {
						e.preventDefault();
						var $this = $(this);
						var gallery = $this.parents('.quick_view_gallery');

						gallery.find('.quick_view_gallery__thumbs a').removeClass('active');
						$this.addClass('active');
						gallery.find('.quick_view_gallery__image img').attr('src',$this.attr('href'));
					});
					
					$('.styler').styler();
					
					 $.fancybox.open('#quick_view_window',{
						padding: 0,
						wrapCSS : 'fancy_quick'
					});

				}
		);
       
    });
    
    $('#main_slider').owlCarousel({
        singleItem : true,
        navigation : true,
        autoPlay : 10000
    });

    $('.th_carousel').owlCarousel({
        items : 5,
        itemsDesktop : [1200,4],
        itemsDesktopSmall: [1000,3],
        itemsTablet :  [760,3],
        itemsTabletSmall :  [550,2],
        itemsMobile :  [450,1],
        navigation : true
    });

    $('#banners_carousel').owlCarousel({
        singleItem : true
    });

     var owl = $('#brands_carousel').owlCarousel({
        items : 5,
        itemsDesktop : [1200,4],
        itemsTablet : [1000,3],
        itemsMobile : [760,1],
        navigation : true,
    });
	
	  $(".owl-next").on("click",function(){
	  var ww = $(window).width();
	  if(ww > 760){
		owl.trigger('owl.next');
			 if(ww > 1000){
				owl.trigger('owl.next');
				if(ww > 1200){
					owl.trigger('owl.next');
				}
			}
		}
	  })
	  $(".owl-prev").on("click",function(){
		var ww = $(window).width();
		if(ww > 760){
		owl.trigger('owl.prev');
			if(ww > 1000){
				owl.trigger('owl.prev');
				if(ww > 1200){
					owl.trigger('owl.prev');
				}
			}
		}
	  })

    $('.quick_view_gallery__thumbs').owlCarousel({
        items : 3,
        itemsMobile : [760,2],
        navigation : true
    });

    $('.product_gallery__thumbs').owlCarousel({
        items : 3,
        itemsMobile : [480,2],
        navigation : true
    });

    $('.product_gallery').show();
/*    $('.product_gallery__image a').jqzoom({
        zoomWidth: 610,
        zoomHeight: 610
    });
*/
//        $('.product_gallery__image a').spritezoom();

    $('.product_gallery').hide();
	
	/*&$("product__image_control a.fancybox").fancybox({
		 autoScale : false,
		 type       :'iframe',
		 beforeLoad : function(){
		  var url= $(this.element).attr("id");
		  this.href = url
		 }
	}); */
	
	$('.product_gallery__thumbs a').click(function(){
		$('.product__image_control a.fancybox').attr('href', $(this).attr('data-largeimage')).fancybox();
	});
	
    $('form').each(function() {
        $(this).validate({
            errorElement: 'div'
        });
    });

    /* Location Phone */
    $('.location_select > div').click(function(e) {
        e.preventDefault();
        $(this).next('ul').slideToggle();
    });

    $('.location_select ul a').click(function(e) {
        e.preventDefault();
        var select = $(this).parents('.location_select');
        $('.location_select > div').text($(this).text());
        $('.location_phone__phone strong span').hide();
        $('.footer_phone span').hide();
        $($(this).attr('href')).show();
        select.find('ul').slideUp();
    });

    $(document).click(function(e) {
        if($(e.target).parents('.location_select').length == 0 && $('.location_select ul').is(':visible')){
            $('.location_select ul').slideUp();
        }
    });

    /* Basket Popup */
    function basketWindowClose() {
        if (!isBasketWindowAnimating) {
            isBasketWindowAnimating = true;
            $('#basket_window').stop(true,false).slideUp(300, function() {
                isBasketWindowAnimating = false;
            });
        }
    }

    var isMouseOnHeaderBasket = false;
    var isMouseOnHeaderBasketWindow = false;
    var isBasketWindowAnimating = false;

    $('.header_basket').mouseenter(function(event) {
        if (!isBasketWindowAnimating) {
            isBasketWindowAnimating = true;
            $('#basket_window').stop(true,false).slideDown(300, function() {
                isBasketWindowAnimating = false;
            });
        }
    });

    $('#basket_window .popup_close').click(function(e) {
        e.preventDefault();
        basketWindowClose();
    });

    $('.header_basket .icon-basket').mouseenter(function() {
        isMouseOnHeaderBasket = true;
    });
    $('.header_basket .icon-basket').mouseleave(function() {
        isMouseOnHeaderBasket = false;
    });
    $('#basket_window').mouseenter(function() {
        isMouseOnHeaderBasketWindow = true;
    });
    $('#basket_window').mouseleave(function() {
        isMouseOnHeaderBasketWindow = false;
    });

    $(document).mousemove(function() {
        if (!isBasketWindowAnimating) {
            setTimeout(function(){
                if (!isMouseOnHeaderBasket && !isMouseOnHeaderBasketWindow) basketWindowClose();
            }, 50);
        }
    });

    /* Обратный звонок */
    $('.order_call_link, .open_order_call').click(function(e) {
        e.preventDefault();
        $.fancybox.open('#order_call_window',{
            padding : 0,
            wrapCSS : 'fancy_popup'
        });
    });

    $('.order_call_link_side').click(function(e) {
        e.preventDefault();
        $.fancybox.open('#online_window',{
            padding : 0,
            wrapCSS : 'fancy_popup'
        });
    });
	
	$('#3d_view_window_link').click(function(e) {
        e.preventDefault();
        $.fancybox.open('#3d_view_window',{
            padding : 0,
            wrapCSS : 'fancy_popup'
        });
    });

    $(document).on('click','.fancy_popup .popup_close',function(e) {
        e.preventDefault();
        $(this).parents('.fancy_popup').find('.fancybox-close').trigger('click');
    });

    /* Submenu */
    $('.subnav_menu a').mouseenter(function(event) {
        $this = $(this);
        if(!$this.hasClass('active')){
            var block = $this.parents('.subnav');

            block.find('.subnav_menu a').removeClass('active');
            $this.addClass('active');

            block.find('.subnav_content').hide();
            block.find('.subnav_content.' + $(this).data('submenu')).fadeIn();
        }
    });
$(".thumb").hover(
		function(){
					var link = $(this).find('.thumb_title a');
					var txt = link.attr('descr');
					var txt2 = link.html();
					link.html(txt);
					link.attr('descr', txt2);
					$(this).find('.thumb_title').css('overflow','visible');
					$(this).find('.thumb_title').css('height','auto');
					$(this).find('.thumb_title_bg_wh').css('display','none');
					},
					function(){ //out
					  var link = $(this).find('.thumb_title a');
						var txt = link.attr('descr');
						var txt2 = link.html();
						link.html(txt);
						link.attr('descr', txt2);
						$(this).find('.thumb_title').css('overflow','hidden');
						$(this).find('.thumb_title').css('height','42px');
						$(this).find('.thumb_title_bg_wh').css('display','block');
					}
	);
/**/	
    var mouseOnMenuCatalog = false;
    var mouseOnMenuCatalogButton = false;

    var menuCatalogBlock = false;
    var menuAnimateTime = 400;

    var mouseOnMenuMore = false;
    var mouseOnMenuMoreButton = false;
    var menuMoreBlock = false;

    function CatalogMenuShow() {
        if (!menuCatalogBlock) {
            menuCatalogBlock = true;
            $('.subnav').not('.for_more').slideDown(menuAnimateTime);
            $('#menu_overlay').fadeIn(menuAnimateTime);
            $('#menu_overlay_header').fadeIn(menuAnimateTime, function(){
                menuCatalogBlock = false;
            });
        }
    }

    function CatalogMenuHide() {
        if (!menuCatalogBlock) {
            menuCatalogBlock = true;
            $('.subnav').not('.for_more').slideUp(menuAnimateTime);
            $('#menu_overlay').fadeOut(menuAnimateTime);
            $('#menu_overlay_header').fadeOut(menuAnimateTime, function(){
                menuCatalogBlock = false;
            });
        }
    }

    //menu More
    function MoreMenuShow() {
        if (!menuMoreBlock) {
            menuMoreBlock = true;
            $('.subnav.for_more').slideDown(menuAnimateTime);
            //$('#menu_overlay').fadeIn(menuAnimateTime);
            //$('#menu_overlay_header').fadeIn(menuAnimateTime, function(){
            //    menuMoreBlock = false;
            //});
        }
    }

    function MoreMenuHide() {
        if (!menuMoreBlock) {
            menuMoreBlock = true;
            $('.subnav.for_more').slideUp(menuAnimateTime);
            //$('#menu_overlay').fadeOut(menuAnimateTime);
            //$('#menu_overlay_header').fadeOut(menuAnimateTime, function(){
            //    menuMoreBlock = false;
            //});
        }
    }   

    $('#menu_overlay_header, #menu_overlay').mouseenter(function(){
        CatalogMenuHide();
    });
    $(".with_submenu > a").not('.for_more').mouseenter(function(){
        mouseOnMenuCatalogButton = true;
    });

    $(".with_submenu > a").not('.for_more').mouseleave(function(){
        mouseOnMenuCatalogButton = false;
    });




    $(".subnav_c").mouseenter(function(){
        mouseOnMenuCatalog = true;
    });

    $(".subnav_c").mouseleave(function(){
        mouseOnMenuCatalog = false;
    });




$('.with_submenu.for_more').hover(
    function(){$(this).find('.subnav.for_more').slideDown(menuAnimateTime);},
    function(){$(this).find('.subnav.for_more').slideUp(menuAnimateTime);}
);

//
//    $(".with_submenu > a").mouseleave(function(){
    $(document).mousemove(function(){
        if (!menuCatalogBlock) {
        setTimeout(function(){
            bigwindow = ($("html").width() > 1030);
            if (bigwindow) {
                if (mouseOnMenuCatalogButton) {
                    CatalogMenuShow();                   
                } 
                if (!mouseOnMenuCatalog && !mouseOnMenuCatalogButton) {
                    CatalogMenuHide();
                } 
            }            
        }, 50);
        }


    });




/**/
/*
	$(".subnav .wrapper").hover(
		function(){
		},
					function(){ //out
						$('#menu_overlay').hide();
						$('#menu_overlay_header').hide();
					}
	);
	$(".with_submenu > a").hover(
		function(){
			$('.subnav').show();
			//27122015
			if($("html").width()>1030){
				if($('#menu_overlay').is(':visible') ){
					
				}else{
					$('#menu_overlay').show();
					
				}
				if($('#menu_overlay_header').is(':visible') ){
					
				}else{
					$('#menu_overlay_header').show();
						
				}
			}
			
		},
					function(){ //out

							if($('.subnav').is(':visible') ){
								$('#menu_overlay').hide();
								$('#menu_overlay_header').hide();
							
						}else{
							
							$('#menu_overlay').hide();
							$('#menu_overlay_header').hide();
							
						}
						
					}
	);
*/	
    /* Mobile Menu */
    $('#nav_mobile a').click(function(e) {
        var $this = $(this);
        if($this.next('ul').length > 0){
            e.preventDefault();
            if($this.next('ul').is(':visible')){
                $this.next('ul').slideUp();
            }else{
                $(this).parent('li').siblings('li').find('ul').slideUp();
                $this.next('ul').slideDown();
            }
        }
    });

    $('#nav_mobile_target, #btn_close_nav_mobile').click(function(e) {
        e.preventDefault();
        $('body').toggleClass('opened_nav');
    });

    $(document).click(function(e) {
        if(isTab() && $(e.target).parents('.nav_mobile_block').length == 0 && !$(e.target).hasClass('nav_mobile_target')){
            $('body').removeClass('opened_nav');
        }
    });

    /* Thumb */
    $('.thumb_image__thubms a').mouseenter(function(e) {
        $(this).parents('.thumb').find('.thumb_image img').attr('src',$(this).attr('data-href'));
    });

    /* Tabs */
    $('.tabs_menu a').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var tabs = $this.parents('.tabs');
        var index = $this.parent('li').index(); 

        tabs.find('.tabs_menu a').removeClass('active');
        $this.addClass('active');

        tabs.find('.tabs_content').children('div').hide();
        tabs.find('.tabs_content').children('div').eq(index).fadeIn();
    });

    /* Quick View Gallery */
    $('.quick_view_gallery__thumbs a').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        var gallery = $this.parents('.quick_view_gallery');

        gallery.find('.quick_view_gallery__thumbs a').removeClass('active');
        $this.addClass('active');
        gallery.find('.quick_view_gallery__image img').attr('src',$this.attr('href'));
    });

    /* Events */
$(window).load(function(){
    var $events = $('#events');    
    if($events.length > 0){
        $events.masonry({
            transitionDuration: 0
        });

        $('.more_events').click(function(e){
            e.preventDefault();
            var btn = $(this);
            if(!$(this).hasClass('more_events-hide'))  {
                $('.event-hidden').each(function(i){
                    if(i < btn.data('more_count')){
                        $(this).removeClass('event-hidden').addClass('event-visible');
                        if($('.event-hidden').length == 0){
                            btn.addClass('more_events-hide').text('Скрыть');
                        }
                    }
                }); 
            }else{
                $('.event-visible').addClass('event-hidden').removeClass('event-visible');
                btn.removeClass('more_events-hide').text('Еще события');
            }    
            $events.masonry();
        });
    }    
});

    /* Sidebar toggle section */
    $('.sidebar_section__title').click(function(e) {
        e.preventDefault();
        $(this).toggleClass('opened');
        $(this).next('.sidebar_section__content').stop(true,false).slideToggle();
    });

    /* Filter price 
    var filter_price_range = $("#filter_price_range");
    var filter_price_range_min = $("#filter_price_range_min");
    var filter_price_range_max = $("#filter_price_range_max");
    if(filter_price_range.length > 0){
        filter_price_range.slider({
            range: true,
            min: 0,
            max: 20000,
            values: [2000, 18000],
            step: 1000,
            slide: function(event, ui) {
                filter_price_range_min.val(ui.values[0]);
                filter_price_range_max.val(ui.values[1]);
            },
            change: function(event, ui) {
                filter_price_range_min.val(ui.values[0]);
                filter_price_range_max.val(ui.values[1]);
            }
        });
        filter_price_range_min.val(filter_price_range.slider("values", 0));
        filter_price_range_max.val(filter_price_range.slider("values", 1));
        $("#filter_price_range_min, #filter_price_range_max").change(function() {
            filter_price_range.slider("values", 0, filter_price_range_min.val());
            filter_price_range.slider("values", 1, filter_price_range_max.val());
        });
    }*/

    /* Grid / List */
    $('.view_control_link-list').click(function(e) {
        e.preventDefault();
        $('.catalog').addClass('catalog-list');
        $('.view_control_link').removeClass('active');
        $(this).addClass('active');
    });

    $('.view_control_link-grid').click(function(e) {
        e.preventDefault();
        $('.catalog').removeClass('catalog-list');
        $('.view_control_link').removeClass('active');
        $(this).addClass('active');
    });

    /* Count Field */
    $('.count_field__arrow').click(function(e) {
        e.preventDefault();
        var field = $(this).parents('.count_field');
        var input = field.find('.count_field__val');
		var max = 0;
		max = input.attr('data-max');
        var val = parseInt(input.val());
        if (($(this).hasClass('count_field__arrow-up') && max==0) || ($(this).hasClass('count_field__arrow-up') && val < max)) {
            input.val(val + 1);
        } else if ($(this).hasClass('count_field__arrow-down')) {
            if (val - 1 > 0)
                input.val(val - 1);
        }
    });
    $(".count_field__val").keypress(function(e) {
        if (e.which !== 8 && e.which !== 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });

    /* Buyer type */
    $('.buyer_type_btn').click(function(e) {
        e.preventDefault();
        $('.buyer_type_btn').addClass('btn-white');
        $(this).removeClass('btn-white');

        if($(this).hasClass('buyer_type_btn-new')){
            $('.new_buyer_row').show();
        }else{
            $('.new_buyer_row').hide();
        }
    });

    /* News */
    var $news = $('#news');
    if($news.length > 0){
        $news.masonry({
            transitionDuration: 0,
            columnWidth: 1,
            gutter: 0
        });
    }

    $('.more_excerpts').click(function(e){
        e.preventDefault();
        var btn = $(this);
        if(!$(this).hasClass('more_excerpts-hide'))  {
            $('.excerpt-hidden').each(function(i){
                if(i < btn.data('more_count')){
                    $(this).removeClass('excerpt-hidden').addClass('excerpt-visible');
                    if($('.excerpt-hidden').length == 0){
                        btn.addClass('more_excerpts-hide').text('Скрыть');
                    }
                }
            }); 
        }else{
            $('.excerpt-visible').addClass('excerpt-hidden').removeClass('excerpt-visible');
            btn.removeClass('more_excerpts-hide').text('Еще новости');
        }    
        if($news.length > 0){
            $news.masonry();
        }
    });
	
	$('.add_comment_link').click(function(e) {
        e.preventDefault();
        $('.add_comments').slideToggle();
		$('html, body').animate({
         scrollTop: $('.add_comments').offset().top
			}, 1000);
    });
	
	$('.add_vopros_link').click(function(e) {
        e.preventDefault();
        $('.add_vopros').slideToggle();
		$('html, body').animate({
         scrollTop: $('.add_vopros').offset().top
			}, 1000);
    });

    $('.product__color a').click(function(e) {
        e.preventDefault();
        $('.product__color a').removeClass('active');
        $(this).addClass('active');
        $('.product_gallery').hide();
        $($(this).attr('href')).fadeIn();
    });

    if($('.product__color a.active').length > 0){
        $('.product_gallery').hide();
        $($('.product__color a.active').attr('href')).show();
    }else{
        $('.product_gallery').eq(0).show();
    }

    $('.sidebar_fixed .sidebar_menu ul a').on('click', function(e) {
		var attr = $(this).attr('outer_link');
		if (typeof attr == typeof undefined || attr == false) {
			e.preventDefault();
			$('body,html').animate({'scrollTop': $($(this).attr('href')).offset().top});
		}
    });
	
	 $('.btn-more').click(function(e){
		if($(this).hasClass('go_to')) return true;
        e.preventDefault();
        var $this = $(this);
        var block = $(this).prev('.hidden_block');
        var preview = $(this).parent().find('.hidden_onshow');
        
        block.slideToggle();
        $this.toggleClass('opened');
		if($(this).hasClass('opened')){ 
			preview.slideUp();
		}else{
			preview.slideDown();
		}
    });

    $('.gallery_popup_link').fancybox({
        padding: 0,
        wrapCSS: 'popup_gallery'
    });
	
	/* Location City */
    $('.location_select__target').click(function(e) {
        e.preventDefault();
        $('.city_popup').fadeToggle('fast');
    });

    $(document).click(function(e) {
        if($(e.target).parents('.location_select').length == 0 && $('.city_popup').is(':visible')){
            $('.city_popup').fadeOut();
        }
    });

    $('.accept_city_btn').click(function(e) {
        e.preventDefault();
        $('.city_popup').fadeOut('fast');
		$.post( "/ajax/cookie.php",
				{CITY_ID: $(this).attr('city-id')},
				function(data){
					console.log(data);
				}
			);
    });
	
	AjaxLoader();
	
    $('.change_city_btn, .city_popup strong span').click(function(e) {
        e.preventDefault();
      /*  $('.city_popup').fadeOut('fast');
		$('#loadingDivWrap').show();
		$.post( "/ajax/city_list.php",
				{city: $('.location_select__target').val()},
				function(data){
					$('.select_city_block').html(data);
					$('.select_city_block').slideDown();
					$('#loadingDivWrap').hide();
				}
			);*/
		$('.select_city_block').slideDown();
    });

    $('.select_city_block__close').click(function(e) {
        $('.select_city_block').slideUp();
    }); 

    /*$('.select_city__row input:radio').change(function(){
        $('.select_city_block').slideUp(); 
		$.post( "/ajax/cookie.php",
				{CITY_ID: $('#select_city input:checked').val()},
				function(data){
					console.log(data);
				}
			);
    });*/
	
    /* Header Account */
    $('.header_account__content').click(function(e) {
        e.preventDefault();
        $('.header_account__popup').fadeToggle('fast');
    });

    $(document).click(function(e) {
        if($(e.target).parents('.header_account').length == 0 && $('.header_account__popup').is(':visible')){
            $('.header_account__popup').fadeOut();
        }
    });

	
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
	
	$('.subnav_filter input').change(function(){
			var filter_menu = new Array();
			$('.subnav_filter input:checked').each(function(){
				filter_menu.push($(this).val());
			});
			$.post( "/ajax/session_filter_menu.php", { MENU_FILTER: filter_menu });
			//var Fparent = $(this).parent().parent().parent().parent().parent().parent();
			var Fparent = $(".subnav_sidebar");
			var Sparent = $(".subnav_content_wrapper");
			if( filter_menu.length > 0){
				
				Fparent.find('a').each(function(i){
						$(this).addClass(' disabled ');
					});
				
				var index;
				
				for (index = 0; index < filter_menu.length; ++index) {
					Fparent.find('.type' + filter_menu[index]).each(function(i){
						$(this).removeClass(' disabled ');
					});
				}
				
				Sparent.find('a').each(function(i){
						$(this).addClass(' disabled ');
					});
				
				var index;
				
				for (index = 0; index < filter_menu.length; ++index) {
					Sparent.find('.type' + filter_menu[index]).each(function(i){
						$(this).removeClass(' disabled ');
					});
				}
			}else{
			
				Fparent.find('a').each(function(i){
						$(this).removeClass(' disabled ');
					});
					
				Sparent.find('a').each(function(i){
						$(this).removeClass(' disabled ');
					});
			}
	})
	
	/* Brands filter popup */
    $('.shop_filter_target').click(function(e) {
        e.preventDefault();
        $('.shop_filter_popup').fadeToggle('fast');
    });

    $(document).click(function(e) {
        if($(e.target).parents('.shop_filter_block').length == 0 && $('.shop_filter_popup').is(':visible')){
            $('.shop_filter_popup').fadeOut();
        }
    });

    $('.tooltip_popup__close').click(function(e) {
        $('.tooltip_popup').fadeOut();
    });
	
	/* Available popup */
    $('.product__control_available_target').click(function(e) {
        e.preventDefault();
        $('.available_location_popup').fadeToggle('fast');
    });

    $(document).click(function(e) {
        if($(e.target).parents('.product__control_available').length == 0 && $('.available_location_popup').is(':visible')){
            $('.available_location_popup').fadeOut();
        }
    });

    $('input:reset').click(function(){
        $(this).parents('form').get(0).reset();
        $(this).parents('form').find('input').removeAttr('checked').trigger('refresh');
    });

    $('input.check_all_checkbox').change(function(){
        $(this).parents('form').find('input:checkbox').prop('checked', $(this).is(':checked')).trigger('refresh');
    });
	
	$('.main_his_tabs').click(function(){
		$('.main_hits .hits_tabs_content').hide();
		$('.main_hits ' + $(this).attr('href')).show();
		$('.main_hits a.active').removeClass('active');	
		$(this).addClass(' active');	
		return false;
	});
	
	$('.address_block__gallery__more_link').click(function(e){
        if(!$(this).hasClass('active')){
            e.preventDefault();
            $(this).parents('.address_block__gallery').find('img.hidden').fadeIn();;
            //$(this).addClass('active');
        }
    });

});

function bc_resize() {
    var excerpts_width = 0;
    $('.excerpts > .excerpt, .excerpts > .excerpts_group').each(function() {
        excerpts_width += $(this).width();
        excerpts_width += parseInt($(this).css('margin-left'));
        excerpts_width += parseInt($(this).css('margin-right'));
    });
    $('.excerpts').width(excerpts_width);   
}

$(window).resize(function() {
    bc_resize();    
});

$(document).ready(function(){
    bc_resize();
    $(".scrollbar").mCustomScrollbar();
    $(".scrollbar-x").mCustomScrollbar({
        axis:"x",
        advanced:{autoExpandHorizontalScroll:true},
        scrollButtons:{enable:true}
    });


    $('.thumb .docompare').click(function() {
        docompare = $(this);
        if (docompare.data('compare-block')) {
            return false;
        }
        docompare.data('compare-block', true);
        id = docompare.data('id');
        iid = docompare.data('iid');
        if (!docompare.hasClass('active')) {
            docompare.addClass('active');
            action = 'ADD_TO_COMPARE_RESULT';
            q = 'action='+action+'&id='+id; 
        } else { 
            docompare.removeClass('active');
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
            docompare.data('compare-block', false);
        });
        return false;
    });


});

$(window).scroll(function(){
    sidaberPos();

    if ($('.sidebar_fixed').length > 0) {
        var scroll_top = $(document).scrollTop();
        var w_height = $(window).height();

        $('.sidebar_fixed .sidebar_menu ul a').each(function() {
			var attr = $(this).attr('outer_link');
			if (typeof attr == typeof undefined || attr == false) {
				var block = $($(this).attr('href'));
				
				if (block.length > 0) {
					var top_pos = block.offset().top;
					if (top_pos <= scroll_top + w_height / 3  &&  top_pos + block.outerHeight() > scroll_top + w_height / 3  &&  block.is(':visible')) {
						$(this).addClass('active');
					} else {
						$(this).removeClass('active');
					}
				}
			}
        });
    }
});

function isTab(){
    if($('#nav_mobile_target').is(':visible'))
        return true;
    return false;
}

function sidaberPos(){
    if($('.sidebar_fixed').length){
        var sidebar = $('.sidebar_fixed'),
        sH = sidebar.outerHeight(),
        sT = $('.sidebar_fixed_w').offset().top;
        dT = $(document).scrollTop();
        
        if(dT >= sT){
            if(dT + sH <= $('.main_content').offset().top + $('.main_content').outerHeight()){
                sidebar.removeClass('absolute').addClass('fixed').css('margin-top', 0);
            }else{
                sidebar.addClass('absolute').removeClass('fixed').css('margin-top', $('.main_content').outerHeight() - sH);
            }
        }else{
            sidebar.removeClass('fixed').removeClass('absolute').css('margin-top', 0);
        }
    }
}

jQuery.extend(jQuery.validator.messages, {
	required: "Это поле необходимо заполнить",
	remote: "Исправьте это поле чтобы продолжить",
	email: "Введите правильный email адрес.",
	url: "Введите верный URL.",
	date: "Введите правильную дату.",
	dateISO: "Введите правильную дату (ISO).",
	number: "Введите число.",
	digits: "Введите только цифры.",
	creditcard: "Введите правильный номер вашей кредитной карты.",
	equalTo: "Повторите ввод значения еще раз.",
	accept: "Пожалуйста, введите значение с правильным расширением.",
	maxlength: jQuery.format("Нельзя вводить более {0} символов."),
	minlength: jQuery.format("Должно быть не менее {0} символов."),
	rangelength: jQuery.format("Введите от {0} до {1} символов."),
	range: jQuery.format("Введите число от {0} до {1}."),
	max: jQuery.format("Введите число меньше или равное {0}."),
	min: jQuery.format("Введите число больше или равное {0}.")
});

$.datepicker.regional['ru'] = {
    closeText: 'Закрыть',
    prevText: '&#x3c;Пред',
    nextText: 'След&#x3e;',
    currentText: 'Сегодня',
    monthNames: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'],
    monthNamesShort: ['Янв', 'Фев', 'Мар', 'Апр', 'Май', 'Июн',
    'Июл', 'Авг', 'Сен', 'Окт', 'Ноя', 'Дек'],
    dayNames: ['воскресенье', 'понедельник', 'вторник', 'среда', 'четверг', 'пятница', 'суббота'],
    dayNamesShort: ['вск', 'пнд', 'втр', 'срд', 'чтв', 'птн', 'сбт'],
    dayNamesMin: ['Вс', 'Пн', 'Вт', 'Ср', 'Чт', 'Пт', 'Сб'],
    weekHeader: 'Не',
    dateFormat: 'dd.mm.yy',
    firstDay: 1,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional[ "ru" ]);
	
	
function AjaxLoader() {
    $('body').append('<div id="loadingDivWrap" class="fancybox-overlay fancybox-overlay-fixed" style="width: auto; height: auto; display: none;"><div id="loadingDiv"></div></div>');

    $('#loadingDiv')
        .css('background', 'url(/bitrix/templates/bikecenter_main/images/loading.gif) no-repeat center center')
        .css('background-color', '#fff')
        .css('border', 'none')
        .css('height', '100px')
        .css('width', '100px')
        .css('z-index', '2000')
        .css("position", "absolute")
        .css("top", (($(window).height() - 100) / 2) + $(window).scrollTop() + "px")
        .css("left", (($(window).width() - 100) / 2) + $(window).scrollLeft() + "px")
}
function check_user(){
	$.post( "/ajax/check_user.php", $( "#secure_form" ).serialize(), function( data ) {
				console.log(data);
				console.log(data.type);
				console.log(data.value);
				if(data.type == 'success'){
					$('#auth_secure .popup_window__content').html('<p><b>' + data.value + '</b></p>');
					setTimeout(function() {	location.reload();}, 2000);
				}else{
					$('#secure_form .form_row .error-text').html(data.value).show();
					$('#secure_code').addClass(' error');
				}
			}, "json");	
			
}
function logout(){
	$.post( "/?logout=yes");
	setTimeout(function() {	location.reload();}, 1000);
}