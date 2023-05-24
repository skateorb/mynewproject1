<?php
/*
  Plugin Name: All In One Php (Unique)
  Plugin URI: http://www.odrasoft.com
  Description: Executes PHP code on WordPress page, post, and default Text Widget
  Version: 1.0
  Author: swadeshswain, aiswaryaswain
  Author URI: http://www.odrasoft.com
 */
?>
<?php
function wp_all_in_one_php_unique($content) {
    if (strpos($content, '<' . '?') !== false) {
        ob_start();
        eval('?' . '>' . $content);
        $content = ob_get_clean();
    }
    return $content;
}
if (is_admin()) {
   
add_action('admin_menu', 'php_admin_menu_unique');

function php_admin_menu_unique() {
    add_options_page('All In One Php (Unique)', 'All In One Php (Unique)', 'manage_options',  basename(__FILE__), 'php_config_page_unique');
}
function php_config_page_unique() {
?>
<div class="wrap">
    <h3>All In One Php Option (Unique)</h3>
            
    <?php
    if (isset($_POST['submit'])) { 
        $nonce = $_REQUEST['_wpnonce'];
        if (!wp_verify_nonce($nonce, 'php-updatesettings-unique')) {
            die('Security error');
        }
        $phptitle = $_POST['phptitle'];
        $phpcontent = $_POST['phpcontent'];
        $phpwidget = $_POST['phpwidget'];
   
        update_option('od_phptitle_unique', $phptitle);
        update_option('od_phpcontent_unique', $phpcontent);
        update_option('od_phpwidget_unique', $phpwidget);
    } 
    $od_phptitle = get_option('od_phptitle_unique');
    $od_phpcontent = get_option('od_phpcontent_unique');
    $od_phpwidget = get_option('od_phpwidget_unique');
    ?>
 
    <form method="post" action="" id="php_config_page_unique">
        <?php wp_nonce_field('php-updatesettings-unique'); ?>
              
        <table class="form-table">
            <tbody>
                <tr>
                    <th><label>Add Php Code In Title section (Page, Post, or Any post type)</label></th>
                    <td>
                        <input type="radio" name="phptitle" value="yes" <?php if ($od_phptitle == 'yes') echo 'checked="checked"'; ?>>
                        Yes
                        <input type="radio" name="phptitle" value="no" <?php if ($od_phptitle == 'no') echo 'checked="checked"'; ?>>
                        No
                    </td>
                </tr>
                    
                <tr>
                    <th><label>Add Php Code In Content section (Page, Post, or Any post type)</label></th>
                    <td>
                        <input type="radio" name="phpcontent" value="yes" <?php if ($od_phpcontent == 'yes') echo 'checked="checked"'; ?>>
                        Yes
                        <input type="radio" name="phpcontent" value="no" <?php if ($od_phpcontent == 'no') echo 'checked="checked"'; ?>>
                        No
                    </td>
                </tr>
                    
                <tr>
                    <th><label>Add Php Code In Text Widget section (Default Text Widget)</label></th>
                    <td>
                        <input type="radio" name="phpwidget" value="yes" <?php if ($od_phpwidget == 'yes') echo 'checked="checked
