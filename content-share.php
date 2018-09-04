<?php
/**
 * Share Post/Page/Job
 *
 * @package Jobify
 * @since Jobify 1.0
 */
global $post;

$message = apply_filters('jobify_share_message', sprintf(_x('Check out %1$s on %2$s! %3$s', '1: Article title 2: Site Name 3: Site URL', 'jobify'), get_the_title(), get_bloginfo('name'), get_permalink()));
?>
<div class="entry-share">
    <script>
        function fbs_click() {
            u = location.href;
            t = document.title;
            window.open('http://www.facebook.com/sharer.php?u=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t), 'sharer', 'toolbar=0,status=0,width=626,height=436');
            return false;
        }</script>

    <ul>
<?php do_action('jobify_share_before', $message); ?>
        <li class="twitter-share"><a target="_blank" href="<?php echo esc_url(sprintf('http://www.twitter.com?status=%s', urlencode($message))); ?>"
                                     onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                             return false;"><i class="icon-twitter"></i></a></li>
        <li class="facebook-share"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()"><i class="icon-facebook"></i></a></li>
        <li class="gplus-share"><a target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>"
                                   onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                           return false;"><i class="icon-gplus"></i></a></li>
        <li class="linkedin-share"><a target="_blank" href="http://www.linkedin.com/shareArticle?url=<?php the_permalink(); ?>"
                                      onclick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');
                                              return false;"><i class="icon-linkedin"></i></a></li>
        <li class="whatsapp-share"><a target="_blank" href="whatsapp://send" data-text="Take a look at this awesome website:" data-href="" class="wa_btn wa_btn_s" style="display:none">Share</a></li>

<?php do_action('jobify_share_after', $message); ?>
    </ul>
</div>
