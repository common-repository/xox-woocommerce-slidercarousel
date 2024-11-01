(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-specific JavaScript source
	 * should reside in this file.
	 *
	 * Note that this assume you're going to use jQuery, so it prepares
	 * the $ function reference to be used within the scope of this
	 * function.
	 *
	 * From here, you're able to define handlers for when the DOM is
	 * ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * Or when the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and so on.
	 *
	 * Remember that ideally, we should not attach any more than a single DOM-ready or window-load handler
	 * for any particular page. Though other scripts in WordPress core, other plugins, and other themes may
	 * be doing this, we should try to minimize doing that in our own work.
	 */

    function startUp(){
        $('#_xoxslider_slider_box').hide();
        $('#_xoxcarousel_carousel_box').hide();
        $('.cmb2-id--xox-group-taxonomy-pcat').hide();
        $('.cmb2-id--xox-group-single').hide();
        $('#_xox_group_custom_repeat').hide();
        $('#minor-publishing').hide();
    }
    function showOption(val){
        if(val == 'slider'){
            //slider chosen
            $('#_xoxslider_slider_box').slideDown();
            $('#_xoxcarousel_carousel_box').slideUp();
        }else if(val == 'carousel'){
            //carousel chosen
            $('#_xoxslider_slider_box').slideUp();
            $('#_xoxcarousel_carousel_box').slideDown();
        }else{
            //empty chosen
            $('#_xoxslider_slider_box').slideUp();
            $('#_xoxcarousel_carousel_box').slideUp();
        }
    }
    
    function showSourceFields(val){
        if(val == 'products'){
            $('.cmb2-id--xox-group-taxonomy-pcat').slideDown();
            $('#_xox_group_custom_repeat').hide();
            $('.cmb2-id--xox-group-single').hide();
        }else if(val == 'custom'){
            $('.cmb2-id--xox-group-taxonomy-pcat').hide();
            $('#_xox_group_custom_repeat').slideDown();
            $('.cmb2-id--xox-group-single').hide();
        }else if(val == 'single'){
            $('.cmb2-id--xox-group-taxonomy-pcat').hide();
            $('#_xox_group_custom_repeat').hide();
            $('.cmb2-id--xox-group-single').slideDown();
        }else{
            $('.cmb2-id--xox-group-taxonomy-pcat').hide();
            $('#_xox_group_custom_repeat').hide();
            $('.cmb2-id--xox-group-single').hide();
        }
    }

    $(function(){
        startUp();
        var $stype = $('input:radio[name="_xoxcs_radio_cs"]');
        var $sel = $('input:radio[name="_xoxcs_radio_cs"]:checked').val();
        console.log($sel);
        var $source = $('input:radio[name="_xox_group_source"]'), $val = $('input:radio[name="_xox_group_source"]:checked').val();
        showOption($sel);
        showSourceFields($val);
                
        $stype.change(function(){
            console.log($(this).val());
            
            var $nsel = $(this).val();
            showOption($nsel);
            
        });
        
        $source.change(function(){
            var $nval = $(this).val();
            showSourceFields($nval);
        });
        
        var $pub = $('#postbox-container-1');
        if (!!$pub.offset()) {
            
            var stickyTop = $pub.offset().top; // returns number
            $(window).scroll(function(){ // scroll event
                var windowTop = $(window).scrollTop();
                if (stickyTop < windowTop){
                    /*$pub.fadeIn('fast');
                    $pub.css({ position: 'fixed', top: 50 });
                    $('#ads-xox').css({position: 'fixed', top: 145});*/
                    $('#postbox-container-1').css({ position: 'fixed', top: 50 , right: 315});
                }
                else {
                    /*$pub.fadeOut('fast');
                    $pub.css('position','static');
                    $('#ads-xox').removeAttr('style');*/
                    $('#postbox-container-1').removeAttr('style');
                }
            });
        }
        var $ads = $('#ads-xox');
        $ads.find('.handlediv').remove();
        $ads.find('.hndle').remove();

    });
    
})( jQuery );
