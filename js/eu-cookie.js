/**
 * @package    WordPress
 * @subpackage EU Cookie Law Compliance Message
 */

/**
 * Create, Read and Erase functions from
 * From http://www.quirksmode.org/js/cookies.html
 */ 
function createCookie( name, value, days ) 
{
    if (days) 
    {
        var date = new Date();
        date.setTime( date.getTime() + ( days*24*60*60*1000 ) );
        var expires = "; expires=" + date.toGMTString();
    }
    else 
        var expires = "";
    document.cookie = name + "=" + value + expires + "; path=/";
}
function readCookie( name ) 
{
    var nameEQ = name + "=";
    var ca = document.cookie.split( ';' );
    for( var i=0; i < ca.length; i++ ) 
    {
        var c = ca[i];
        while ( c.charAt(0)==' ' ) 
            c = c.substring( 1, c.length );
        if ( c.indexOf( nameEQ ) == 0 ) 
            return c.substring( nameEQ.length, c.length );
    }
    return null;
}
function eraseCookie( name ) 
{
    createCookie( name, "", -1 );
}

/**
 * Front end cookie and message handling
 */
jQuery(document).ready(function($) 
{    
    var cookie_name = 'european-law-compliance';
    if ( navigator.cookieEnabled === true )
    {
        // Originally:
        // document.cookie="visited4=yes; expires=Thu, 31 Dec 2020 23:59:59 UTC; path=/";
        if ( eu_cookie.debug )
            eraseCookie( cookie_name );

        // Originally:
        // if (document.cookie.indexOf("visited4") == -1)
        if ( !readCookie( cookie_name ) )
        {
            // Cookie DIV
            $( 'body').prepend( '<div id="cookie" style="display:none"><div id="wrapper"><h2>' 
                + eu_cookie.title 
                + '</h2><p>' 
                + eu_cookie.message 
                + '</p><div id="close"><a href="#" id="closecookie">' 
                + eu_cookie.close 
                + '</a></div><div style="clear:both"></div></div></div>' );
          
            $( '#cookie').show("slow");
            
            $( '#closecookie').click(function() {
                createCookie( cookie_name, 'yes', 1825 );
                $( '#cookie').hide("fast");
            });
        }
    }
});   