<?php
$facebook = get_field('facebook', 'options');
$instagram = get_field('instagram', 'options');
$pinterest = get_field('pinterest', 'options');
$google = get_field('google_plus', 'options');
$youtube = get_field('youtube', 'options');
$twitter = get_field('twitter', 'options');
$linkedin = get_field('linkedin_url', 'options');
?>
<ul>
    <?php if ($facebook): ?>
        <li>
            <a href="<?php echo $facebook; ?>">
                <i class="facebook"></i>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($instagram): ?>
        <li>
            <a href="<?php echo $instagram; ?>">
                <i class="instagram"></i>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($pinterest): ?>
        <li>
            <a href="<?php echo $pinterest; ?>">
                <i class="pinterest"></i>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($google): ?>
        <li>
            <a href="<?php echo $google; ?>">
                <i class="google"></i>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($youtube): ?>
        <li>
            <a href="<?php echo $youtube; ?>">
                <i class="youtube"></i>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($twitter): ?>
        <li>
            <a href="<?php echo $twitter; ?>">
                <i class="twitter"></i>
            </a>
        </li>
    <?php endif; ?>
    <?php if ($linkedin): ?>
        <li>
            <a href="<?php echo $linkedin; ?>">
                <i class="linkedin"></i>
            </a>
        </li>
    <?php endif; ?>        
</ul>