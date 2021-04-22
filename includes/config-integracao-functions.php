<?php

class TTBookingIntegracaoAdmin extends TTBookingIntegracao {
	/**
	 * Setup backend functionality in WordPress
	 *
	 * @return none
	 * @since 0.1
	 */
	function __construct() {
		TTBookingIntegracao::__construct();
		// Load localizations if available
		load_plugin_textdomain( 'config_ttbookingintegracao' , false , 'config_ttbookingintegracao/languages' );

		// Activation hook
		register_activation_hook( $this->plugin_file, array( &$this, 'init' ) );

		// Hook into admin_init and register settings and potentially register an admin_notice
		add_action( 'admin_init', array( &$this, 'admin_init' ) );

		// Activate the options page
		add_filter( 'admin_menu', array( &$this , 'books_register_ref_page' ) ); 

		// Register an AJAX action for testing mail sending capabilities
		add_action( 'wp_ajax_config_ttbookingintegracao-test', array( &$this, 'ajax_send_test' ) );
	}

	/**
	 * Initialize the default options during plugin activation
	 *
	 * @return none
	 * @since 0.1
	 */
	function init() {
		$defaults = array( 
			'chechbox_preco' => '', 
			'codigo_trend_n' => '', 
			'usuario_trend_n' => '', 
			'senha_trend_n' => '',   
			'hotel_trend_nh0' => '', 
			'hotel_trend_nh1' => '', 
			'hotel_trend_nh2' => '', 
			'hotel_trend_nh3' => '', 
			'hotel_trend_nh4' => '', 
			'hotel_trend_nh5' => '', 
			'hotel_trend_nh6' => '', 
			'hotel_trend_nh7' => '', 
			'hotel_trend_nh8' => '', 
			'hotel_trend_nh9' => '', 
			'hotel_trend_nh10' => '', 
			'hotel_trend_nh11' => '', 
			'hotel_trend_nh12' => '', 
			'hotel_trend_nh13' => '', 
			'hotel_trend_nh14' => '', 
			'hotel_trend_nh15' => '', 
			'hotel_trend_nh16' => '', 
			'hotel_trend_nh17' => '', 
			'hotel_trend_nh18' => '', 
			'hotel_trend_nh19' => '', 
			'hotel_trend_nh20' => '',  
			'id_hotel_trend_nh0' => '', 
			'id_hotel_trend_nh1' => '', 
			'id_hotel_trend_nh2' => '', 
			'id_hotel_trend_nh3' => '', 
			'id_hotel_trend_nh4' => '', 
			'id_hotel_trend_nh5' => '', 
			'id_hotel_trend_nh6' => '', 
			'id_hotel_trend_nh7' => '', 
			'id_hotel_trend_nh8' => '', 
			'id_hotel_trend_nh9' => '', 
			'id_hotel_trend_nh10' => '', 
			'id_hotel_trend_nh11' => '', 
			'id_hotel_trend_nh12' => '', 
			'id_hotel_trend_nh13' => '', 
			'id_hotel_trend_nh14' => '', 
			'id_hotel_trend_nh15' => '', 
			'id_hotel_trend_nh16' => '', 
			'id_hotel_trend_nh17' => '', 
			'id_hotel_trend_nh18' => '', 
			'id_hotel_trend_nh19' => '', 
			'id_hotel_trend_nh20' => '',   
			'destination_hotel_trend_nh0' => '', 
			'destination_hotel_trend_nh1' => '', 
			'destination_hotel_trend_nh2' => '', 
			'destination_hotel_trend_nh3' => '', 
			'destination_hotel_trend_nh4' => '', 
			'destination_hotel_trend_nh5' => '', 
			'destination_hotel_trend_nh6' => '', 
			'destination_hotel_trend_nh7' => '', 
			'destination_hotel_trend_nh8' => '', 
			'destination_hotel_trend_nh9' => '', 
			'destination_hotel_trend_nh10' => '', 
			'destination_hotel_trend_nh11' => '', 
			'destination_hotel_trend_nh12' => '', 
			'destination_hotel_trend_nh13' => '', 
			'destination_hotel_trend_nh14' => '', 
			'destination_hotel_trend_nh15' => '', 
			'destination_hotel_trend_nh16' => '', 
			'destination_hotel_trend_nh17' => '', 
			'destination_hotel_trend_nh18' => '', 
			'destination_hotel_trend_nh19' => '', 
			'destination_hotel_trend_nh20' => '', 
			'codigo_hotel_trend_n' => '', 
			'usuario_ehtl' => '', 
			'senha_ehtl' => '', 
			'texto_motor0' => '',
			'texto_motor1' => '',
			'texto_motor2' => '',
			'texto_motor3' => '',
			'texto_motor4' => '',
			'texto_motor5' => '',
			'texto_motor6' => '',
			'texto_motor7' => '',
			'texto_motor8' => '',
			'texto_motor9' => '', 
			'chechbox_motor0' => '',
			'chechbox_motor1' => '',
			'chechbox_motor2' => '',
			'chechbox_motor3' => '',
			'chechbox_motor4' => '',
			'chechbox_motor5' => '',
			'chechbox_motor6' => '',
			'chechbox_motor7' => '',
			'chechbox_motor8' => '',
			'chechbox_motor9' => '',
		); 
			add_option( 'config_ttbookingintegracao', $defaults ); 
	}



	/**
	 * Add the options page
	 *
	 * @return none
	 * @since 0.1
	 */
	public function TESTE() { 
		require plugin_dir_path(dirname(__FILE__)) . 'includes/backend/submenu/configuracao.php';
}
	

	function books_register_ref_page() {
    add_submenu_page('edit.php?post_type=integracaohoteis', 'WP Travel Engine Admin Settings', 'Configurações', 'manage_options', 'config_ttbookingintegracao', array($this, 'TESTE'));
}
  

	/**
	 * Enqueue javascript required for the admin settings page
	 *
	 * @return none
	 * @since 0.1
	 */
	function admin_js() {
		wp_enqueue_script( 'jquery' );
	}

	/**
	 * Output JS to footer for enhanced admin page functionality
	 *
	 * @since 0.1
	 */
	function admin_footer_js() {
		?>
		<script type="text/javascript">
		/* <![CDATA[ */
			var formModified = false;
			jQuery().ready(function() {
				jQuery('#config_ttbookingintegracao-test').click(function(e) {
					e.preventDefault();
					if ( formModified ) {
						var doTest = confirm('<?php _e( 'The SmtpLocaweb plugin configuration has changed since you last saved. Do you wish to test anyway?\n\nClick "Cancel" and then "Save Changes" if you wish to save your changes.', 'config_ttbookingintegracao'); ?>');
						if ( ! doTest ) {
							return false;
						}
					}
					jQuery(this).val('<?php _e( 'Testing...', 'config_ttbookingintegracao' ); ?>');
					jQuery("#config_ttbookingintegracao-test-result").text('');
					jQuery.get(
						ajaxurl,
						{
							action: 'config_ttbookingintegracao-test',
							_wpnonce: '<?php echo wp_create_nonce(); ?>'
						}
					)
					.complete(function() {
						jQuery("#config_ttbookingintegracao-test").val('<?php _e( 'Test Configuration', 'config_ttbookingintegracao' ); ?>');
					})
					.success(function(data) {
						alert('SmtpLocaweb ' + data.method + ' Test ' + data.message);
					})
					.error(function() {
						alert('SmtpLocaweb Test <?php _e( 'Failure', 'config_ttbookingintegracao' ); ?>');
					});
				});
				jQuery("#config_ttbookingintegracao-form").change(function() {
					formModified = true;
				});
			});
		/* ]]> */
		</script>
		<?php
	}

	/**
	 * Output the options page
	 *
	 * @return none
	 * @since 0.1
	 */
	function options_page() {
		if ( ! @include( 'options-page.php' ) ) {
			printf( __( '<div id="message" class="updated fade"><p>The options page for the <strong>SmtpLocaweb</strong>'.
				'plugin cannot be displayed. The file <strong>%s</strong> is missing.  Please reinstall the plugin.'.
				'</p></div>', 'config_ttbookingintegracao'), dirname( __FILE__ ) . '/options-page.php' );
		}
	}

	/**
	 * Wrapper function hooked into admin_init to register settings
	 * and potentially register an admin notice if the plugin hasn't
	 * been configured yet
	 *
	 * @return none
	 * @since 0.1
	 */
	function admin_init() {
		$this->register_settings();
		 
	}

	/**
	 * Whitelist the config_ttbookingintegracao options
	 *
	 * @since 0.1
	 * @return none
	 */
	function register_settings() {
		register_setting( 'config_ttbookingintegracao', 'config_ttbookingintegracao', array( &$this, 'validation' ) );
	}

	/**
	 * Data validation callback function for options
	 *
	 * @param array $options An array of options posted from the options page
	 * @return array
	 * @since 0.1
	 */
	function validation( $options ) {
		$id_conta = trim( $options['id_conta'] );

		if ( ! empty( $id_conta ) ) {
			$id_conta = preg_replace( '/@.+$/', '', $id_conta );
			$options['id_conta'] = $id_conta;
		}

		foreach ( $options as $key => $value )
			$options[$key] = trim( $value );

		$this->options = $options;
		return $options;
	}

	/**
	 * Function to output an admin notice when the plugin has not
	 * been configured yet
	 *
	 * @return none
	 * @since 0.1
	 */
	function admin_notices() {
		$screen = get_current_screen();
		if ( $screen->id == $this->hook_suffix )
			return;
?>
		<div id='config_ttbookingintegracao-warning' class='updated fade'><p><strong><?php _e( 'SmtpLocaweb is almost ready. ', 'config_ttbookingintegracao' ); ?></strong><?php printf( __( 'You must <a href="%1$s">configure SmtpLocaweb</a> for it to work.', 'config_ttbookingintegracao' ), menu_page_url( 'config_ttbookingintegracao' , false ) ); ?></p></div>
<?php
	}

	/**
	 * Add a settings link to the plugin actions
	 *
	 * @param array $links Array of the plugin action links
	 * @return array
	 * @since 0.1
	 */
	function filter_plugin_actions( $links ) {
		$settings_link = '<a href="' . menu_page_url( 'config_ttbookingintegracao', false ) . '">' . __( 'Settings', 'config_ttbookingintegracao' ) . '</a>';
		array_unshift( $links, $settings_link );
		return $links;
	}

	/**
	 * AJAX callback function to test mail sending functionality
	 *
	 * @return string
	 * @since 0.1
	 */
	function ajax_send_test() {
		nocache_headers();
		header( 'Content-Type: application/json' );

		if ( ! current_user_can( 'manage_options' ) || ! wp_verify_nonce( $_GET[ '_wpnonce' ] ) ) {
			die(
				json_encode(
					array(
						'message' => __( 'Unauthorized', 'config_ttbookingintegracao' ),
						'method' => null
					)
				)
			);
		}

		$secure = ( defined( 'config_ttbookingintegracao_SECURE' ) && config_ttbookingintegracao_SECURE ) ? config_ttbookingintegracao_SECURE : $this->get_option( 'secure' );
		$method = ( (bool) $secure ) ? __( 'Secure SMTP', 'config_ttbookingintegracao' ) : __( 'SMTP', 'config_ttbookingintegracao' );

		$admin_email = get_option( 'admin_email' );
		ob_start();
		$GLOBALS['smtp_debug'] = true;
		$result = wp_mail(
			$admin_email,
			__( 'SmtpLocaweb WordPress Plugin Test', 'config_ttbookingintegracao' ),
			sprintf( __( "This is a test email generated by the SmtpLocaweb WordPress plugin.\n\nIf you have received this message, the requested test has succeeded.\n\nThe method used to send this email was: %s.", 'config_ttbookingintegracao' ), $method )
		);
		$GLOBALS['phpmailer']->smtpClose();
		$output = ob_get_clean();

		if ( $result ) {
			die(
				json_encode(
					array(
						'message' => __( 'Success', 'config_ttbookingintegracao' ),
						'method'  => $method
					)
				)
			);
		} else {
			die(
				json_encode(
					array(
						'message' => __( 'Failure', 'config_ttbookingintegracao' ) .", debug: ".  $output,
						'method'  => $method
					)
				)
			);
		}
	}
}
