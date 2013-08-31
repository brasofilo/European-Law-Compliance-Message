<?php
! defined( 'ABSPATH' ) AND exit;
/**
 * @package    WordPress
 * @subpackage EU Cookie Law Compliance Message
 */

add_settings_section( 
	'euc_section1', 
	__( 'Main Settings', 'EUCLC' ), 
	array( $helper_class, 'euc_section1_text' ), 
	'euc_settings' 
);

add_settings_field( 
	'notificationTitle', 
	__( 'Notification Title', 'EUCLC' ), 
	array( $helper_class, 'notification_title_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'notificationMessage', 
	__( 'Message', 'EUCLC' ), 
	array( $helper_class, 'notification_message_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'notificationClose', 
	__( 'Close Link Text', 'EUCLC' ), 
	array( $helper_class, 'notification_close_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'notificationPadding', 
	__( 'Content Padding', 'EUCLC' ), 
	array( $helper_class, 'notification_padding_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'notificationMaxWidth', 
	__( 'Message Maximum Width', 'EUCLC' ), 
	array( $helper_class, 'notification_max_width_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'chkBlock', 
	__( 'Message hovers over content', 'EUCLC' ), 
	array( $helper_class, 'chk_block_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'notificationStyle', 
	__( 'Visual Style', 'EUCLC' ), 
	array( $helper_class, 'notification_style_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'chkDebug', 
	__( 'Debug Mode', 'EUCLC' ), 
	array( $helper_class, 'chk_debug_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'chkReset', 
	__( 'Reset Options', 'EUCLC' ), 
	array( $helper_class, 'chk_reset_print' ), 
	'euc_settings', 
	'euc_section1' 
);

add_settings_field( 
	'submit', 
	'', 
	array( $helper_class, 'submit_print' ), 
	'euc_settings', 
	'euc_section1' 
);

