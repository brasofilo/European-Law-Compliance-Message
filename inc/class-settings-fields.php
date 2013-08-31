<?php
! defined( 'ABSPATH' ) AND exit;
/**
 * @package    WordPress
 * @subpackage EU Cookie Law Compliance Message
 */

class B5F_EULCM_Settings_Fields
{
	/**
	 * Grabs the whole option group and return the value of a specific key
	 * 
	 * @param string $value
	 * @return mixed
	 */
	private static function option( $value )
	{
		$get = B5F_EULCM_Cookie::get_instance()->option_value;
		return isset( $get[$value] ) ? $get[$value] : false;
	}

	private static function sub_option( $value )
	{
		return B5F_EULCM_Cookie::$option_name . "[$value]";
	}
	
	# MAIN SETTINGS TEXT 
	public function euc_section1_text()
	{
		printf(
			'<p>%s</p>',
			__( 'Change the settings below to alter how the Cookie message will be shown. You can select the light theme, the dark theme or create your own by selecting custom.', 'EUCLC' )
		);
	}

	# CUSTOM SETTINGS TEXT
	public function euc_section2_text()
	{
		printf(
			'<p>%s</p>',
			__( 'Use these options to customise the Cookie Message styles.', 'EUCLC' )
		);
	}

	public function submit_print()
	{
		submit_button();
	}

	public function notification_title_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/>',
			self::sub_option( 'notificationTitle' ),
			esc_attr( self::option( 'notificationTitle' ) )
		);
	}

	public function notification_message_print()
	{
		printf(
			'<textarea name="%s" class="large-text" rows="5">%s</textarea>',
			self::sub_option( 'notificationMessage' ),
			esc_attr( self::option( 'notificationMessage' ) )
		);
	}

	public function notification_close_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/>',
			self::sub_option( 'notificationClose' ),
			esc_attr( self::option( 'notificationClose' ) )
		);
	}

	public function notification_padding_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/>',
			self::sub_option( 'notificationPadding' ),
			esc_attr( self::option( 'notificationPadding' ) )
		);
	}

	public function notification_max_width_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/>',
			self::sub_option( 'notificationMaxWidth' ),
			esc_attr( self::option( 'notificationMaxWidth' ) )
		);
	}

	public function notification_style_print()
	{
		$select_options = array(
			'dark' => __( 'Dark - Black Background, White Text', 'EUCLC' ),
			'light' => __( 'Light - White Background, Dark Grey Text', 'EUCLC' ),
			'custom' => __( 'Custom - Enter Your Own Values Below', 'EUCLC' )
		);
		echo '<select name="' . self::sub_option( 'notificationStyle' ) . '" id="eu-notificationStyle">';	
		foreach ( $select_options as $key=>$value ) 
		{
			printf(
				'<option value="%s" %s>%s</option>',
				$key,
				selected( self::option( 'notificationStyle' ), $key, false ),
				$value
			);
		}	
		echo '</select>';
	}

	public function chk_reset_print()
	{
		printf(
			'<input type="checkbox" name="%s" id="chkReset" %s /> <label for="chkReset"> %s </label>',
			self::sub_option( 'chkReset' ),
			'', // TODO: THIS DON'T NEED TO BE CHECKED, DOES IT?
			__( 'Tick this and click save changes to reset back to default.', 'EUCLC' )
		);
	}

	public function chk_block_print()
	{
		printf(
			'<input type="checkbox" name="%s" id="chkBlock" %s /> <label for="chkBlock"> %s </label>',
			self::sub_option( 'chkBlock' ),
			checked( self::option( 'chkBlock' ), 'on', false),
			__( 'If enabled, cookie message will hover over the page content. If disabled, message will push down the page content.', 'EUCLC' )
		);
	}

	public function chk_debug_print()
	{
		printf(
			'<input type="checkbox" name="%s" id="chkDebug" %s /> <label for="chkDebug"> %s </label>',
			self::sub_option( 'chkDebug' ),
			checked( self::option( 'chkDebug' ), 'on', false),
			__( 'If enabled the cookie will not be set, so you can reload the page many times and still view the message. Remember to disable thie when you put your site live!', 'EUCLC' )
		);
	}

	public function background_colour_print()
	{
		printf(
				'<input type="text" name="%s"  value="%s" class="regular-text" />
<input type="button" class="pickcolor button-secondary" value="%s" >
<div  style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div><br />%s',
			self::sub_option( 'backgroundColour' ),
			esc_attr( self::option( 'backgroundColour' ) ),
			__( 'Select color', 'EUCLC' ),
			__( 'Hexadecimal colour code to use for the background of the message bar.', 'EUCLC' )
		);
	}

	public function background_transparency_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/><br /><small>%s</small>',
			self::sub_option( 'backgroundTransparency' ),
			esc_attr( self::option( 'backgroundTransparency' ) ),
			__( 'Enter the transparency for the message background. 0 is invisible and 1 is solid colour. Default is 0.8.', 'EUCLC' )
		);
	}

	public function title_colour_print()
	{
		printf(
				'<input type="text" name="%s"  value="%s" class="regular-text" />
<input type="button" class="pickcolor button-secondary" value="%s" >
<div  style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div><br />%s',
			self::sub_option( 'titleColour' ),
			esc_attr( self::option( 'titleColour' ) ),
			__( 'Select color', 'EUCLC' ),
			__( 'Hexadecimal colour code to use for the message title.', 'EUCLC' )
		);
	}

	public function title_size_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/><br /><small>%s</small>',
			self::sub_option( 'titleSize' ),
			esc_attr( self::option( 'titleSize' ) ),
			__( 'Font size for the message title. Can be in pixels (px), ems (em), points (pt) or percent (%).', 'EUCLC' )
		);
	}

	public function title_font_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/><br /><small>%s</small>',
			self::sub_option( 'titleFont' ),
			esc_attr( self::option( 'titleFont' ) ),
			__( 'The HTML font family to use for the message title. You can use any valid font-family declarations.', 'EUCLC' )
		);
	}

	public function message_colour_print()
	{
		printf(
				'<input type="text" name="%s"  value="%s" class="regular-text" />
<input type="button" class="pickcolor button-secondary" value="%s" >
<div  style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div><br />%s',
			self::sub_option( 'messageColour' ),
			esc_attr( self::option( 'messageColour' ) ),
			__( 'Select color', 'EUCLC' ),
			__( 'Hexadecimal colour code to use for the message body text.', 'EUCLC' )
		);
	}

	public function message_size_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/><br /><small>%s</small>',
			self::sub_option( 'messageSize' ),
			esc_attr( self::option( 'messageSize' ) ),
			__( 'Font size for the message body text.', 'EUCLC' )
		);
	}

	public function message_font_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/><br /><small>%s</small>',
			self::sub_option( 'messageFont' ),
			esc_attr( self::option( 'messageFont' ) ),
			__( 'The HTML font family to use for the message title.', 'EUCLC' )
		);
	}

	public function close_colour_print()
	{
		printf(
				'<input type="text" name="%s"  value="%s" class="regular-text" />
<input type="button" class="pickcolor button-secondary" value="%s" >
<div  style="z-index: 100; background:#eee; border:1px solid #ccc; position:absolute; display:none;"></div><br />%s',
			self::sub_option( 'closeColour' ),
			esc_attr( self::option( 'closeColour' ) ),
			__( 'Select color', 'EUCLC' ),
			__( 'Hexadecimal colour code to use for the close message link.', 'EUCLC' )
		);
	}

	public function close_size_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/><br /><small>%s</small>',
			self::sub_option( 'closeSize' ),
			esc_attr( self::option( 'closeSize' ) ),
			__( 'Font size for the close message link.', 'EUCLC' )
		);
	}

	public function close_font_print()
	{
		printf(
			'<input type="text" name="%s" value="%s" class="regular-text"/><br /><small>%s</small>',
			self::sub_option( 'closeFont' ),
			esc_attr( self::option( 'closeFont' ) ),
			__( 'The HTML font family to use for the close message link.', 'EUCLC' )
		);
	}

}