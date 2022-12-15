<?php
/**
 * Plugin Name: Social Media
 * Plugin URI: https://smedia.com
 * Description: This plugin adds some Facebook Open Graph tags to our single posts.
 * Version: 1.0.0
 * Author: WPMU DEV
 * Author URI: https://smedia.com
 * License: GPL2
 */
add_action('admin_menu', 'smedia_menu');

function smedia_menu() {
	add_menu_page('SocialMedia', 'SMedia', 'manage_options', 
    'smedia-menu', 'smedia_settings_page', 'dashicons-format-status');
}

function smedia_settings_page() {?>
<div class="wrap">
    <h1>Social Media</h1>
    <form method="post" action="">
        <table class="form-table" role="presentation">>
            <tr>
                <th scope="row"><label for="siteurl">Facebook Address (URL)</label></th>
                <td><input name="facebook" type="url" id="facebook"
                        value="<?php echo esc_attr(get_option("facebook")) ?>" class="regular-text code"></td>
            </tr>
            <tr>
                <th scope="row"><label for="siteurl">Twitter Address (URL)</label></th>
                <td><input name="twitter" type="url" id="twitter" value="<?php echo esc_attr(get_option("twitter")) ?>"
                        class="regular-text code"></td>
            </tr>
            <tr>
                <th scope="row"><label for="siteurl">Linkedin Address (URL)</label></th>
                <td><input name="linkedin" type="url" id="linkedin"
                        value="<?php echo esc_attr(get_option("linkedin")) ?>" class="regular-text code"></td>
            </tr>
            <tr>
                <th scope="row"><label for="siteurl">Instagram Address (URL)</label></th>
                <td><input name="instagram" type="url" id="instagram"
                        value="<?php echo esc_attr(get_option("instagram")) ?>" class="regular-text code"></td>
            </tr>
        </table>
        <p class="submit"><input type="submit" name="submit" id="submit" class="button button-primary"
                value="Save Changes"></p>

    </form>
</div>

<?php }

if(isset($_POST['facebook']) && isset($_POST['twitter']) && isset($_POST['linkedin'])  && isset($_POST['instagram'])){
    
    update_option('facebook', $_POST['facebook'] );
    update_option('twitter', $_POST['twitter'] );
    update_option('linkedin', $_POST['linkedin'] );
    update_option('instagram', $_POST['instagram'] );

}