<?php
/**
 * Company Testimonials
 *
 * Use category "company" with Testimonials by WooThemes
 *
 * @since Jobify 1.0
 */
class Jobify_Widget_Companies extends Jobify_Widget {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		$this->widget_cssclass    = 'jobify_widget_companies';
		$this->widget_description = __( 'Display a slider of company logos used.', 'jobify' );
		$this->widget_id          = 'jobify_widget_companies';
		$this->widget_name        = __( 'Companies Used', 'jobify' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => __( 'Companies  Used', 'jobify' ),
				'label' => __( 'Title', 'jobify' )
			),
			'description' => array(
				'type'  => 'textarea',
				'rows'  => 4,
				'std'   => 'Some of the companies who supply commercial laundry equipment.',
				'label' => __( 'Description', 'jobify' ),
			),
			'number' => array(
				'type'  => 'number',
				'step'  => 1,
				'min'   => 1,
				'max'   => '',
				'std'   => 12,
				'label' => __( 'Number of companies to show.', 'jobify' )
			)
		);
		parent::__construct();
	}

	/**
	 * widget function.
	 *
	 * @see WP_Widget
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		if ( $this->get_cached_widget( $args ) )
			return;

		ob_start();

		extract( $args );

		$title       = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		$number      = $instance[ 'number' ];
		$description = $instance[ 'description' ];
		
		echo $before_widget;
		?>

		<div class="container">

			<?php if ( $title ) echo $before_title . $title . $after_title; ?>

			<?php if ( $description ) : ?>
				<p class="homepage-widget-description"><?php echo $description; ?></p>
			<?php endif; ?>
			
			<div class="company-slider-wrap">
				<div class="company-slider">
					<?php	
						do_action( 'woothemes_testimonials', array( 
							'category' => 'company', 
							'limit'    => $number,
							'size'     => array( 300, 200 ),
							'before'   => '',
							'after'    => ''
						) );
					?>
				</div>
			</div>

		</div>

		<?php
		echo $after_widget;

		$content = ob_get_clean();

		echo $content;

		$this->cache_widget( $args, $content );
	}
}