<?php
function custom_login_url(){
    global $pagenow;
    if ('wp-login.php' == $pagenow) {
        wp_redirect('member-login.php');
        exit();
    }
}

add_action('init', 'custom_login_url');
// Also replace all the wp-login in the member-login.php
?>