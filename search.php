<?php
/**
 * Search
 *
 * @package Jobify
 * @since Jobify 1.0
 */

get_header(); ?>

	<header class="page-header">
		<h1 class="page-title">
			Search: <?php echo get_search_query(); ?>
		</h1>
	</header>
    <div id="search" class="row">
        <div class="medium-6 columns">
            <h3>Search by Part Number or Description</h3>
            <p>If you do not know your part number please contact us to speak to a member of the team.</p>
        </div>
        <div class="medium-6 columns">
            <form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
                <div><label class="screen-reader-text" for="s">Search for:</label>
                    <input class="hidden" type="text" value="" name="s" id="s" placeholder="Insert your part number or description here"/>
                    <button type="submit" id="searchsubmit"><i class="icon-search"></i></button>
                </div>
            </form>
        </div>
    </div>
	<div id="primary" class="row">
<div id="parts-selector" class="large-3 columns">
            <h3 class="heading-center-custom">Types</h3>

            <ul id="part-types">
                <?php
                $taxonomy = 'part-type';
                $orderby = 'name';
                $show_count = 0;      // 1 for yes, 0 for no
                $pad_counts = 0;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no  
                $title = '';
                $empty = 0;

                $args = array(
                    'taxonomy' => $taxonomy,
                    'orderby' => $orderby,
                    'order' => 'DESC',
                    'show_count' => $show_count,
                    'pad_counts' => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li' => $title,
                    'hide_empty' => $empty
                );
                $all_categories = get_categories($args);

                $filter_flag = false;
                ?>
                <?php foreach ($all_categories as $cat): ?>
                    <?php if ($cat): ?>
                        <?php $category_name = $cat->name; ?>
                        <?php $category_slug = $cat->slug; ?>
                        <?php $category_term = seoUrl($category_slug); ?>
                        <li>
                            <a href="<?php bloginfo('url');?>/part-type/<?php echo $category_term; ?>">
                                <span class="cat-img"><img src="<?php the_field('category_image', $cat); ?>" alt="<?php echo $category_name; ?>"></span>
                                <div><?php echo $category_name; ?></div></a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <h3 class="heading-center-custom">Brands</h3>
            <ul id="parts-brands">
                <?php
                $taxonomy2 = 'part-brand';
                $orderby = 'name';
                $show_count = 0;      // 1 for yes, 0 for no
                $pad_counts = 0;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no  
                $title = '';
                $empty = 0;

                $args2 = array(
                    'taxonomy' => $taxonomy2,
                    'orderby' => $orderby,
                    'show_count' => $show_count,
                    'pad_counts' => $pad_counts,
                    'hierarchical' => $hierarchical,
                    'title_li' => $title,
                    'hide_empty' => $empty
                );
                $all_categories2 = get_categories($args2);

                $filter_flag = false;
                ?>
                <?php foreach ($all_categories2 as $cat2): ?>
                    <?php if ($cat2): ?>
                        <?php $category_name2 = $cat2->name; ?>
                        <?php $category_slug2 = $cat2->slug; ?>
                        <?php $category_term2 = seoUrl($category_slug2); ?>
                        <?php if (get_field('category_image', $cat2) != "") { ?>
                            <li>
                                <a href="<?php bloginfo('url');?>/part-brand/<?php echo $category_term2; ?>">
                                    <span class="cat-img">
                                        <img src="<?php the_field('category_image', $cat2); ?>" alt="<?php echo $category_name2; ?>"></span>
                                </a>
                            </li>
                        <?php }; ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>            
        </div>
			<div class="large-9 columns">
				<?php if ( have_posts() ) : ?>
                            <ul class="parts row">
					<?php while ( have_posts() ) : the_post(); ?>
                        <?php get_template_part( 'content', 'parts'); ?>

					<?php endwhile; ?>
                            </ul>
				<?php else : ?>
					<?php get_template_part( 'content', 'none' ); ?>
				<?php endif; ?>
			</div>
			
		</div><!-- #content -->

		<?php do_action( 'jobify_loop_after' ); ?>

<?php get_footer(); ?>