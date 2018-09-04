<?php
$fullheader = get_field('fullscreen_header', 'options');
$headertext = get_field('header_text', 'options');
$headersub = get_field('header_sub_text', 'options');
$iheadertext = get_field('header_text');
$iheadersub = get_field('header_sub_text');
$fullheader2 = get_field('header_image');
if ($fullheader2):
    $fullheader = $fullheader2;
endif;
?>
<header id="masthead" data-stellar-background-ratio="0.5" style="background-image: url('<?php echo $fullheader['url']; ?>')">
    <?php
    if ($fullheader):
        ?>
        <div class="banner-text hide-for-small">
            <?php if (is_front_page()): ?>
                <h1><?php echo $headertext; ?></h1>
                <?php
            else:
                if ($iheadertext):
                    ?>
                    <h1><?php echo $iheadertext; ?></h1>
                <?php else: ?>
                    <div class="header-main-text"><?php echo $headertext; ?></div>
                <?php endif; ?>
            <?php endif; ?>
            <div class="header-sub-text">
                <?php
                if ($iheadersub):
                    echo $iheadersub;
                else:
                    echo $headersub;
                endif
                ?>
            </div>
        </div>
    <div id="mag-group-logo">
        <img src="<?php echo get_template_directory_uri();?>/images/mag-group-logo-banner.png" alt="MAG Laundry Group">
    </div>
    <?php endif; ?>
    <div class="row hide-for-medium-up">
        <div class="large-12 columns">
            <?php
            $mobileheader = get_field('mobile_header', 'options');
            if ($mobileheader):
                ?>
                <img src="<?php echo $mobileheader['url']; ?>" alt="<?php echo $mobileheader['alt']; ?>">
            <?php endif; ?>
        </div>
    </div>
</header>