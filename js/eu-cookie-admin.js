/**
 * @package    WordPress
 * @subpackage EU Cookie Law Compliance Message
 */
jQuery(document).ready(function($) 
{    
    /**
     * Show/Hide the Custom Settings block
     * @param boolean how
     */
    function b5f_eu_show_hide( how )
    {
        if( how )
        {
            $('#eu-custom-hide').parent().next().next().show();
            $('#eu-custom-hide').parent().next().show();
            $('#eu-custom-hide').parent().show();            
        }
        else
        {
            $('#eu-custom-hide').parent().next().next().hide();
            $('#eu-custom-hide').parent().next().hide();
            $('#eu-custom-hide').parent().hide();            
        }
    }
    
    /**
     * Start up Custom Settings visibility
     */
    if( $('#eu-notificationStyle').val() != 'custom' )
        b5f_eu_show_hide( false );
    
    /**
     * Show/Hide Custom Settings live changes 
     */
    $('#eu-notificationStyle').live('change', function(e) {
        if( e.target.options[e.target.selectedIndex].value == 'custom' )
            b5f_eu_show_hide( true );
        else
            b5f_eu_show_hide( false );
    });
    
    /** 
     * Farbtastic Color Picker
     * https://gist.github.com/brasofilo/6398219 
     */
    // Colorize input boxes on startup
    $('.pickcolor').each(function(){
        input = jQuery(this).prev('input');
        $(input).css("background-color", $(input).val() );        
    });
    // Select color click action
    $('.pickcolor').click( function(e) {
        e.preventDefault();
        colorPicker = $(this).next('div');
        input = $(this).prev('input');
        var farb = $.farbtastic(colorPicker,function(color) {
            $(input).css("background-color",color);
            $(input).val(color);
        });
        farb.setColor($(input).val());
        colorPicker.show();
        $(document).mousedown( function() {
            $(colorPicker).hide();
    	});
    });
});   