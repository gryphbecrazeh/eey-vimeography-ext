<?php
defined('ABSPATH') or die('Inaccessible');
/**
 * Plugin Name: East End Yovth Vimeography Extension
 * Plugin URI: http://www.cordine.site/
 * Description: A custom built by Christopher Cordine of The East End Yovth to allow for individual video sharing
 * Version: 0.0.1
 * Author: Christopher Cordine
 * Author URI: http://www.cordine.site/
 */

global $wpdb;

// PLUGIN VERSION
defined('EEY_VIMEOGRAPHY_EXT_VERSION') or define('EEY_VIMEOGRAPHY_EXT_VERSION', '0.0.1');
// PLUGIN ADMIN SLUG
defined('EEY_VIMEOGRAPHY_EXT_SLUG') or define('EEY_VIMEOGRAPHY_EXT_SLUG', 'eey-ve');
// PLUGIN'S TEXT DOMAIN
defined('EEY_VIMEOGRAPHY_EXT_TD') or define('EEY_VIMEOGRAPHY_EXT_TD', 'eey-ve');
// PLUGIN JS DIRECTORY
defined('EEY_VIMEOGRAPHY_EXT_JS_DIR') or define('EEY_VIMEOGRAPHY_EXT_JS_DIR', plugin_dir_url(__FILE__) . 'js');
// PLUGIN DIRECTORY URL
defined('EEY_VIMEOGRAPHY_EXT_URL') or define('EEY_VIMEOGRAPHY_EXT_URL', plugin_dir_url(__FILE__));
// PLUGIN CSS DIRECTORY
defined('EEY_VIMEOGRAPHY_EXT_CSS_DIR') or define('EEY_VIMEOGRAPHY_EXT_CSS_DIR', plugin_dir_url(__FILE__) . 'css');

if (!class_exists('EEY_VIMEOGRAPHY_EXT_Class')) {
    class EEY_VIMEOGRAPHY_EXT_Class
    {
        function __construct()
        {
            // Include scripts necessary to run, Register front end assets
            add_action('wp_enqueue_scripts', array($this, 'eey_vimeography_ext_include_scripts'));
            // Add Short Code
            add_shortcode('eey_dynamic_vimeo', array($this, 'eey_dynamic_vimeo'));
        }
        // Short Code
        function eey_dynamic_vimeo()
        {
            if (isset($_GET['video'])) {
                $video = $_GET['video'];
                $vimeo_url = "https://player.vimeo.com/video/$video";
?>
                <div class="vimeography-player" data0vimeo-initialized='true'>
                    <div style="padding:56.25% 0 0 0;position:relative;">
                        <iframe title='vimeo-player' class='eey-vimeo-player' allow='autoplay' src='<?php echo $vimeo_url ?>' frameborder='0' allowfullscreen data-ready='true' style='position:absolute;top:0;left:0;width:100%;height:100%;'></iframe>
                    </div>
                </div>
<?php
            }
        }
        // Register Front End Assets
        function register_frontend_assets()
        {
            $frontend_js_obj = array(

                'default_error_message' => __('This field is required', EEY_VIMEOGRAPHY_EXT_TD),

                'ajax_url' => admin_url('admin-ajax.php'),

                'ajax_nonce' => wp_create_nonce('frontend-ajax-nonce')
            );
            wp_register_style('eey-vimeography-ext.css', plugins_url('/css/eey-vimeography-ext.css', __FILE__));
            wp_enqueue_style('eey-vimeography-ext.css');
            wp_localize_script('eey-vimeography-ext.js', 'frontend_js_obj', $frontend_js_obj);
        }
        // Include Scripts
        function eey_vimeography_ext_include_scripts()
        {
            wp_enqueue_script('eey-vimeography-ext.js', plugins_url('/js/eey-vimeography-ext.js', __FILE__));
            EEY_VIMEOGRAPHY_EXT_Class::register_frontend_assets();
        }
    }
    $eey_vimeography_ext_obj = new EEY_VIMEOGRAPHY_EXT_Class();
}
