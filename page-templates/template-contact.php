<?php
/**
 * Template Name: Mag Contact
 */
?>
<?php get_header(); ?>
<?php while (have_posts()) : the_post(); ?>
    <div id="primary">
        <div class="row">
            <div class="medium-4 columns">
                <?php
                $telephone = get_field('telephone');
                $email = get_field('email');
                $address = get_field('address');
                ?>
                <ul class="contact-icons">
                    <li>
                        <div class="info-container address-info">
                            <span class="icon icon-map"></span>
                            <div class="info-text">
                                <span class="info-title">
                                    Address
                                </span>
                                <span class="info-description">
                                    <?php echo $address; ?>
                                </span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="info-container phone-info">
                            <span class="icon icon-phone"></span>
                            <div class="info-text">
                                <span class="info-title">
                                    Phone
                                </span>
                                <span class="info-description">
                                    <?php echo $telephone; ?>
                                </span>
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="info-container email-info">
                            <span class="icon icon-monitor"></span>
                            <div class="info-text">
                                <span class="info-title">
                                    Email
                                </span>
                                <span class="info-description">
                                    <?php echo $email; ?>
                                </span>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="medium-8 columns">
                <?php echo do_shortcode('[gravityform id=11 title=false description=false ajax=true tabindex=49]');?>
            </div>
            <?php the_content(); ?>
        </div><!-- #content -->
    <?php endwhile; ?>
    </div>
    <div id="callout-container">
        <div class="row">
            <div class="large-12 columns">
                <?php dynamic_sidebar('widget-area-front-page'); ?>
            </div>
        </div>
    </div>

    <?php get_footer(); ?>