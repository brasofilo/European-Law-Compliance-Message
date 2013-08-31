<?php
! defined( 'ABSPATH' ) AND exit;
/**
 * @package    WordPress
 * @subpackage EU Cookie Law Compliance Message
 */

# The <span> is a workaround to target elements bellow this point with jQuery
add_settings_section( 
	'euc_section2', 
	sprintf(
			'<span id="eu-custom-hide"></span>%s',
			__( 'Custom Styles (advanced)', 'EUCLC' )
	),
	array( $helper_class, 'euc_section2_text' ), 
	'euc_settings' 
);

add_settings_field( 
	'backgroundColour', 
	__( 'Message Background Colour', 'EUCLC' ), 
	array( $helper_class, 'background_colour_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'backgroundTransparency', 
	__( 'Message Transparency', 'EUCLC' ), 
	array( $helper_class, 'background_transparency_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'titleColour', 
	__( 'Title Heading Colour', 'EUCLC' ), 
	array( $helper_class, 'title_colour_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'titleSize', 
	__( 'Title Heading Font Size', 'EUCLC' ), 
	array( $helper_class, 'title_size_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'titleFont', 
	__( 'Title Heading Font Family', 'EUCLC' ), 
	array( $helper_class, 'title_font_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'messageColour', 
	__( 'Message Colour', 'EUCLC' ), 
	array( $helper_class, 'message_colour_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'messageSize', 
	__( 'Message Font Size', 'EUCLC' ), 
	array( $helper_class, 'message_size_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'messageFont', 
	__( 'Message Font Family', 'EUCLC' ), 
	array( $helper_class, 'message_font_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'closeColour', 
	__( 'Close Link Colour', 'EUCLC' ), 
	array( $helper_class, 'close_colour_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'closeSize', 
	__( 'Close Link Font Size', 'EUCLC' ), 
	array( $helper_class, 'close_size_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'closeFont', 
	__( 'Close Link Font Family', 'EUCLC' ), 
	array( $helper_class, 'close_font_print' ), 
	'euc_settings', 
	'euc_section2' 
);

add_settings_field( 
	'submit', 
	'', 
	array( $helper_class, 'submit_print' ), 
	'euc_settings', 
	'euc_section2' 
);