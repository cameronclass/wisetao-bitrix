$(document).ready(function(){
    $('.subnav_filter_tab a').click(function(e){
        e.preventDefault();
        var $this = $(this);
    
        if(!$this.hasClass('active')){
            $('.subnav_filter_tab a').removeClass('active');
            $this.addClass('active');
    
            $('.subnav_filter_item').hide();
            $('.subnav_filter_item').eq($this.parent('li').index()).fadeIn();
        }
    });


    $('.sidebar_section__toggle_link').click(function(e){
        e.preventDefault();
        var $this = $(this);
        var block = $(this).prev('.sidebar_section__hidden_list');
    
        if (!block.is(':visible')) {
            block.slideDown();
            $this.attr('data-value', $this.text());
            $this.text('- Свернуть');
        } else {
            block.slideUp();
            $this.text($this.attr('data-value'));
        }
    });

    $('.toggle_link').click(function(e) {
        e.preventDefault();
        var $this = $(this);
        var block = $($(this).attr('href'));
    
        if (!block.is(':visible')) {
            block.slideDown();
            $this.attr('data-value', $this.find('span').text());
            $this.find('span').text('Скрыть');
        } else {
            block.slideUp();
            $this.find('span').text($this.attr('data-value'));
        }
    });
});
