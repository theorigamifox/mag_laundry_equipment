<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package Jobify
 * @since Jobify 1.0
 */
?>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'jobify' ), admin_url( 'post-new.php' ) ); ?></p>

<?php elseif ( is_search() ) : ?>

<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'jobify' ); ?></p>
<?php get_search_form( true, 'html5' ); ?>

<?php else : ?>
<div class="large-6 columns large-centered">
<h3>Sorry, there are no matching results</h3>
<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'jobify' ); ?></p>
<?php get_search_form( true, 'html5' ); ?>
</div>

<?php endif; ?>
