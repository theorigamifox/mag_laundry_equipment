<?php/** * Template Name: Mag Team */get_header();?><header class="page-header">    <h1 class="page-title"><?php the_title(); ?></h1></header><div id="primary" class="about">    <div class="row">        <?php while (have_posts()) : the_post(); ?>            <div id="header-intro" class="large-12 columns">                <div class="row">                    <div id="header-pic" class="large-7 columns">                        <?php                        if (get_field('enable_slideshow') == "True") {                            $images = get_field('header_slidershow');                            ?>                            <div class="flexslider">                                 <ul class="slides">                                    <?php                                    if ($images):                                        ?>                                        <?php foreach ($images as $image): ?>                                            <li><img src="<?php echo $image['sizes']['large']; ?>"></li>                                        <?php endforeach; ?>                                    <?php endif;                                    ?>                                </ul>                            </div>                            <script type="text/javascript">                                jQuery(window).load(function () {                                    jQuery('.flexslider').flexslider({                                        move: 1,                                        slideshow: true,                                        controlNav: false,                                        animation: 'slide',                                        prevText: '<i class="icon-left-open"></i>',                                        nextText: '<i class="icon-right-open"></i>',                                    });                                });                            </script>                            <?php                        }else {                            the_post_thumbnail();                        }                        ?>                    </div>                    <div id="header-introduction" class="large-5 columns">                        <div class="innerwrapper">    <?php the_field('introduction_text'); ?>                        </div>                    </div>                </div>            </div><?php endwhile; ?>    </div>    <div class="row">            <?php while (have_posts()) : the_post(); ?>            <div id="content" class="large-7 columns">            <?php the_content(); ?>            </div>             <?php endwhile; ?>    </div>    <div class="row">         <?php        // WP_Query arguments        $args = array(            'post_type' => 'team',            'posts_per_page' => '-1',            'order' => 'ASC',            'orderby' => 'date',        );        $query = new WP_Query($args);        if ($query->have_posts()) {            while ($query->have_posts()) {                $query->the_post();                ?>                <div class="team-item medium-3 small-6  columns">                    <?php the_post_thumbnail('medium');?>                </div>                <?php            }        };        wp_reset_postdata();        ?>       </div></div><!-- #primary --><?php require_once( trailingslashit(get_template_directory()) . 'sidebar-testimonials-bar.php' ); ?><?php get_footer(); ?>