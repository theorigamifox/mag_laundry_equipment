<?php
/**
 * Job Manager supplemental functionality.
 *
 * @since Jobify 1.0
 */

function jobify_is_job_board() {
	return class_exists( 'WP_Job_Manager' );
}

/** Post Type ------------------------------------------------------------------------ */



/** Shortcodes ------------------------------------------------------------------------ */

/**
 * Login Form Shortcode
 *
 * @since Jobify 1.0
 *
 * @return $form HTML form.
 */
function jobify_shortcode_login_form() {
	ob_start();

	wp_login_form( apply_filters( 'jobify_shortcode_login_form', array(
		'label_log_in' => _x( 'Sign In', 'login for submit label', 'jobify' ),
		'value_remember' => true,
		'redirect' => home_url()
	) ) );

	$form = ob_get_clean();

	return $form;
}
add_shortcode( 'jobify_login_form', 'jobify_shortcode_login_form' );

/**
 * Add a "Forgot Password" link to the login form
 *
 * @since Jobify 1.0
 *
 * @return $output HTML output
 */

/**
 * Register Form Shortcode
 *
 * @since Jobify 1.0
 *
 * @return $form HTML form.
 */
function jobify_shortcode_register_form() {
	if ( ! class_exists( 'WP_Job_Manager_Form' ) )
		include_once( JOB_MANAGER_PLUGIN_DIR . '/includes/abstracts/abstract-wp-job-manager-form.php' );

	include_once( get_template_directory() . '/inc/job-manager-form-register.php' );

	ob_start();

	WP_Job_Manager_Form_Register::output();

	$form = ob_get_clean();
	
	return $form;
}
add_shortcode( 'jobify_register_form', 'jobify_shortcode_register_form' );

/**
 * Posted Register Form
 *
 * @since Jobify 1.0
 *
 * @return $form HTML form.
 */
function jobify_load_posted_form() {
	if ( ! empty( $_POST['job_manager_form'] ) ) {
		$form        = esc_attr( $_POST['job_manager_form'] );

		$form_class  = 'WP_Job_Manager_Form_' . str_replace( '-', '_', $form );
		$form_file   = get_template_directory() . '/inc/job-manager-form-' . $form . '.php';

		if ( class_exists( $form_class ) )
			return $form_class;

		if ( ! file_exists( $form_file ) )
			return false;

		if ( ! class_exists( $form_class ) )
			include $form_file;

		return $form_class;
	}
}
add_action( 'init', 'jobify_load_posted_form' );

/**
 * Find pages that contain shortcodes.
 *
 * To avoid options, try to find pages for them.
 *
 * @since Jobify 1.0
 *
 * @return $_page
 */
function jobify_find_page_with_shortcode( $shortcodes ) {
	if ( ! is_array( $shortcodes ) )
		$shortcode = array( $shortcodes );

	$_page = 0;

	foreach ( $shortcodes as $shortcode ) {
		if ( ! get_option( 'job_manager_page_' . $shortcode ) ) {
			$pages = new WP_Query( array(
				'post_type'              => 'page',
				'post_status'            => 'publish',
				'ignore_sticky_posts'    => 1,
				'no_found_rows'          => true,
				'nopaging'               => true,
				'update_post_meta_cache' => false,
				'update_post_term_cache' => false
			) );

			while ( $pages->have_posts() ) {
				$pages->the_post();

				if ( has_shortcode( get_post()->post_content, $shortcode ) ) {
					$_page = get_post()->ID;

					break;
				}
			}

			add_option( 'job_manager_page_' . $shortcode, $_page );
		} else {
			$_page = get_option( 'job_manager_page_' . $shortcode );
		}

		if ( $_page > 0 )
			break;
	}

	return $_page;
}

/**
 * Clear shortcode options when a post is saved.
 *
 * @since Jobify 1.0
 *
 * @return void
 */
function jobify_clear_page_shortcode() {
	$shortcodes = array(
		'login_form',
		'register_form',
		'jobify_login_form',
		'jobify_register_form'
	);

	foreach ( $shortcodes as $shortcode ) {
		delete_option( 'job_manager_page_' . $shortcode );
	}
}
add_action( 'save_post', 'jobify_clear_page_shortcode' );

function jobify_job_manager_job_filters_after() {
?>
	<input type="submit" name="submit" value="<?php echo esc_attr_e( 'Search', 'jobify' ); ?>" />
<?php
}
add_action( 'job_manager_job_filters_search_jobs_end', 'jobify_job_manager_job_filters_after', 9 );

function jobify_submit_job_form_logout_url( $url ) {
	$page = jobify_find_page_with_shortcode( array( 'jobify_login_form', 'login_form' ) );
	
	return get_permalink( $page );
}
add_filter( 'submit_job_form_login_url', 'jobify_submit_job_form_logout_url' );