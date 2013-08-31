<?php
/* Plugin Name: EU Cookie Law Compliance Message
 * Description: Revamp for http://azuliadesigns.com/wordpress-plugin-eu-cookie-law/
 * Plugin URI: https://github.com/brasofilo/European-Law-Compliance-Message
 * Version:     2013.08.31.2
 * Author:      Azulia Designs, Rodolfo Buaiz
 * Author URI:  http://rodbuaiz.com
 * Text Domain: EUCLC
 * Domain Path: /languages/
 * License: GPLv2 or later
 */

add_action(
		'plugins_loaded', array( B5F_EULCM_Cookie::get_instance(), 'plugin_setup' )
);

class B5F_EULCM_Cookie
{
	protected static $instance = NULL;
	public static $option_name = 'EUCookieLawCompliance';
	public $option_value = NULL;
	public $plugin_url = NULL;
	public $plugin_path = NULL;
	public $plugin_slug = NULL;

	public static function get_instance()
	{
		NULL === self::$instance and self::$instance = new self;
		return self::$instance;
	}


	public function plugin_setup()
	{
		$this->plugin_url = plugins_url( '/', __FILE__ );
		$this->plugin_path = plugin_dir_path( __FILE__ );
		$this->plugin_slug = dirname( plugin_basename( __FILE__ ) );

		# Workaround to translate the description in the plugin page
		$translate_description = __( 'Revamp for http://azuliadesigns.com/wordpress-plugin-eu-cookie-law/', 'EUCLC' );

		# AFAIK, there's no performance gain, but let's store this value localy
		$this->get_option();

		# Load translation files
		$this->plugin_locale( 'EUCLC' );

		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'wp_head', array( $this, 'print_style' ) );
		add_action( 'admin_menu', array( $this, 'create_admin_menu' ) );
		add_filter( 'plugin_action_links', array( $this, 'settings_plugin_link' ), 10, 2 );
	}


	/**
	 * Intentionally left empty
	 */
	public function __construct()
	{
		
	}


	/**
	 * Get option, if not exist create from defaults
	 */
	private function get_option()
	{
		$get = get_option( self::$option_name );

		# Option not set, initiate
		if( !$get )
		{
			# Default values
			$get = $this->defaults();
			# Check for old option name
			$get_old = get_option( 'EUCLC' );
			# Use old values
			if( $get_old )
			{
				$get = array_merge( $get, $get_old );
				delete_option( 'EUCLC' );
				update_option( self::$option_name, $get );
			}
			# Use default values
			else
				update_option( self::$option_name, $get );
		}
		$this->option_value = $get;
	}


	/**
	 * Print frontend CSS
	 * 
	 * @return string Inline Stylesheet
	 */
	public function print_style()
	{
		# Run only at index page
		if( !is_home() && !is_front_page() )
			return;

		$css = $this->get_css();
		include 'inc/print-styles.php';
	}


	/**
	 * Enqueue and localize frontend JS
	 * 
	 * @return void
	 */
	public function enqueue_scripts()
	{
		# Run only at index page
		if( !is_home() && !is_front_page() )
			return;

		wp_register_script(
				'eu-cookie'
				, $this->plugin_url . '/js/eu-cookie.js'
				, array( 'jquery' )
				, null
				, true
		);
		wp_enqueue_script( 'eu-cookie' );
		wp_localize_script(
				'eu-cookie'
				, 'eu_cookie'
				, $this->localized()
		);
	}


	/**
	 *  Admin submenu
	 */
	public function create_admin_menu()
	{
		# Submenu page
		$hook = add_submenu_page(
				'options-general.php', 
				__( 'EU Cookie Message', 'EUCLC' ), 
				__( 'EU Cookie Message', 'EUCLC' ), 
				'add_users', 
				'euc_settings', 
				array( $this, 'settings_page_callback' )
		);
		# Plugin page scripts
		add_action( "admin_print_scripts-$hook", array( $this, 'plugin_page_enqueue' ) );
		# Settings API
		add_action( 'admin_init', array( $this, 'init_register_settings' ) );
	}


	/**
	 * Enqueue plugin page JS
	 */
	public function plugin_page_enqueue()
	{
		wp_register_script(
				'eu-cookie-admin'
				, $this->plugin_url . '/js/eu-cookie-admin.js'
				, array( 'farbtastic' )
				, null
				, true
		);
		wp_enqueue_script( 'eu-cookie-admin' );
		wp_enqueue_style( 'farbtastic' );
	}


	/**
	 *  Output the admin option page
	 */
	public function settings_page_callback()
	{
		?>
		<div class="wrap">
			<h2><?php _e( 'EU Cookie Law Compliance Message', 'EUCLC' ); ?></h2>
			<form method="post" action="options.php">
			<?php settings_fields( 'EUCookieLawCompliance' ); ?>
			<?php do_settings_sections( 'euc_settings' ); ?>
			</form>
		</div>
		<?php
	}


	/**
	 * Tell WordPress what settings we are going to be using
	 */
	public function init_register_settings()
	{
		# Contains the callback functions
		include 'inc/class-settings-fields.php';
		register_setting( 'EUCookieLawCompliance', 'EUCookieLawCompliance', array( $this,
			'sanitize' ) );
		$helper_class = 'B5F_EULCM_Settings_Fields';
		# First settings block
		include 'inc/add-settings-main.php';
		# Second
		include 'inc/add-settings-custom.php';
	}


	/**
	 * Sanitize settings fields
	 * 
	 * @param array $input
	 * @return array
	 */
	public function sanitize( $input )
	{
		if( isset( $input['backgroundColour'] ) )
			$input['backgroundColour'] = esc_attr( $input['backgroundColour'] );

		if( isset( $input['backgroundTransparency'] ) )
			$input['backgroundTransparency'] = esc_attr( $input['backgroundTransparency'] );

		if( isset( $input['closeColour'] ) )
			$input['closeColour'] = esc_attr( $input['closeColour'] );

		if( isset( $input['closeFont'] ) )
			$input['closeFont'] = esc_attr( $input['closeFont'] );

		if( isset( $input['closeSize'] ) )
			$input['closeSize'] = esc_attr( $input['closeSize'] );

		if( isset( $input['messageColour'] ) )
			$input['messageColour'] = esc_attr( $input['messageColour'] );

		if( isset( $input['messageFont'] ) )
			$input['messageFont'] = esc_attr( $input['messageFont'] );

		if( isset( $input['messageSize'] ) )
			$input['messageSize'] = esc_attr( $input['messageSize'] );

		if( isset( $input['notificationClose'] ) )
			$input['notificationClose'] = esc_html( $input['notificationClose'] );

		if( isset( $input['notificationMaxWidth'] ) )
			$input['notificationMaxWidth'] = esc_attr( $input['notificationMaxWidth'] );

		if( isset( $input['notificationMessage'] ) )
			$input['notificationMessage'] = esc_html( $input['notificationMessage'] );

		if( isset( $input['notificationPadding'] ) )
			$input['notificationPadding'] = esc_attr( $input['notificationPadding'] );

		if( isset( $input['notificationStyle'] ) )
			$input['notificationStyle'] = esc_attr( $input['notificationStyle'] );

		if( isset( $input['notificationTitle'] ) )
			$input['notificationTitle'] = esc_html( $input['notificationTitle'] );

		if( isset( $input['titleColour'] ) )
			$input['titleColour'] = esc_attr( $input['titleColour'] );

		if( isset( $input['titleFont'] ) )
			$input['titleFont'] = esc_attr( $input['titleFont'] );

		if( isset( $input['titleSize'] ) )
			$input['titleSize'] = esc_attr( $input['titleSize'] );

		# Reset Settings
		if( isset( $input['chkReset'] ) )
			$input = $this->defaults();

		return $input;
	}


	/**
	 *  Configure the defaults and option resets
	 * 
	 * @return array
	 */
	public function defaults()
	{
		# Not translatable strings, it's up to the user to configure this
		return array(
			'notificationTitle'		 => 'Cookies on this website',
			'notificationMessage'	 => 'We use cookies to ensure that we give you the best experience on our website. If you continue without changing your settings, we\'ll assume that you are happy to receive all cookies from this website. If you would like to change your preferences you may do so by following the instructions <a href="http://www.aboutcookies.org/Default.aspx?page=1" rel="nofollow">here</a>.',
			'notificationClose'		 => 'Close',
			'notificationPadding'	 => '20px',
			'notificationStyle'		 => 'dark',
			'notificationMaxWidth'	 => '980px',
			'chkBlock'				 => '',
			'chkReset'				 => '',
			'chkDebug'				 => '',
			'backgroundColour'		 => '#000000',
			'backgroundTransparency' => '0.8',
			'titleColour'			 => '#ffffff',
			'titleSize'				 => '1.6em',
			'titleFont'				 => 'arial,sans-serif',
			'messageColour'			 => '#BEBEBE',
			'messageSize'			 => '1em',
			'messageFont'			 => 'arial,sans-serif',
			'closeColour'			 => '#ffffff',
			'closeSize'				 => '1.25em',
			'closeFont'				 => 'arial,sans-serif',
			'pluginVersion'			 => '3.0'
		);
	}


	/**
	 * Prepare values to be passed to JavaScript
	 * used in wp_localize_script
	 * 
	 * @return array
	 */
	private function localized()
	{
		$message = str_replace( "'", "\'", $this->option_value['notificationMessage'] );
		$message = str_replace( "\n", "<br/>", $message );
		$message = str_replace( "\r", "", $message );

		$base = array(
			'title'		 => str_replace( "'", "\'", $this->option_value['notificationTitle'] ),
			'message'	 => $message,
			'close'		 => str_replace( "'", "\'", $this->option_value['notificationClose'] ),
			'debug'		 => isset( $this->option_value['chkDebug'] )
		);
		return $base;
	}


	/**
	 * Prepare values to be printed as CSS
	 * used in wp_head
	 * 
	 * @return array
	 */
	private function get_css()
	{
		$base = array(
			'padding'		 => $this->option_value['notificationPadding'],
			'maxWidth'		 => $this->option_value['notificationMaxWidth'],
			'absPosition'	 => isset( $this->option_value['chkBlock'] ) ? '' : 'position:absolute,',
		);

		$style = $this->option_value['notificationStyle'];
		if( $style == 'dark' )
		{
			$theme = array(
				'backgroundColour'		 => '0,0,0',
				'backgroundTransparency' => '0.8',
				'titleColour'			 => '#ffffff',
				'titleSize'				 => '1.6em',
				'titleFont'				 => 'arial,sans-serif',
				'messageColour'			 => '#BEBEBE',
				'messageSize'			 => '1em',
				'messageFont'			 => 'arial,sans-serif',
				'closeColour'			 => '#ffffff',
				'closeSize'				 => '1.25em',
				'closeFont'				 => 'arial,sans-serif'
			);
		}
		else if( $style == 'light' )
		{
			$theme = array(
				'backgroundColour'		 => '255,255,255',
				'backgroundTransparency' => '0.8',
				'titleColour'			 => '#000000',
				'titleSize'				 => '1.6em',
				'titleFont'				 => 'arial,sans-serif',
				'messageColour'			 => '#444444',
				'messageSize'			 => '1em',
				'messageFont'			 => 'arial,sans-serif',
				'closeColour'			 => '#000000',
				'closeSize'				 => '1.25em',
				'closeFont'				 => 'arial,sans-serif'
			);
		}
		else
		{
			$theme = array(
				'backgroundColour'		 => $this->hex2rgb( $this->option_value['backgroundColour'] ),
				'backgroundTransparency' => $this->option_value['backgroundTransparency'],
				'titleColour'			 => $this->option_value['titleColour'],
				'titleSize'				 => $this->option_value['titleSize'],
				'titleFont'				 => $this->option_value['titleFont'],
				'messageColour'			 => $this->option_value['messageColour'],
				'messageSize'			 => $this->option_value['messageSize'],
				'messageFont'			 => $this->option_value['messageFont'],
				'closeColour'			 => $this->option_value['closeColour'],
				'closeSize'				 => $this->option_value['closeSize'],
				'closeFont'				 => $this->option_value['closeFont']
			);
		}
		return array_merge( $base, $theme );
	}


	/**
	 * Utility function to convert hex colour code to RGB
	 * Credit: http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
	 * 
	 * @param string $hex
	 * @return string
	 */
	private function hex2rgb( $hex )
	{
		$hex = str_replace( "#", "", $hex );

		if( strlen( $hex ) == 3 )
		{
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		}
		else
		{
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = array( $r, $g, $b );
		return implode( ",", $rgb ); # returns the rgb values separated by commas
		//return $rgb; # returns an array with the rgb values
	}


	/**
	 * Add link to settings in Plugins list page
	 * 
	 * @return Plugin link
	 */
	public function settings_plugin_link( $links, $file )
	{
		$plugin = plugin_basename( dirname( __FILE__ ) . '/' . $this->plugin_slug . '.php' );
		if( $file == $plugin )
		{
			$in = sprintf(
					'<a href="%s">%s</a>', 
					admin_url( 'options-general.php?page=euc_settings' ), 
					__( 'Settings', 'EUCLC' )
			);
			array_unshift( $links, $in );
		}
		return $links;
	}


	/**
	 * Translation
	 *
	 * @uses    load_plugin_textdomain, plugin_basename
	 * @since   2.0.0
	 * @return  void
	 */
	public function plugin_locale( $domain )
	{
		# Load only in plugin page
		global $pagenow;
		if( 'options-general' != $pagenow && (!isset( $_GET['page'] ) || 'euc_settings' != $_GET['page']) )
			return;

		# Prepare vars
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );
		$mo = sprintf(
				'%s/plugins/%s/%s', 
				WP_LANG_DIR, $this->plugin_slug, 
				$domain . '-' . $locale . '.mo'
		);

		# Load from /wp-content/languages/plugins/plugin-name/plug-xx_XX.mo'
		load_textdomain( $domain, $mo );

		# Load from /wp-content/plugins/plugin-name/languages/plug-xx_XX.mo'
		load_plugin_textdomain(
				$domain, FALSE, $this->plugin_slug . '/languages'
		);
	}


}

