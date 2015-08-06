<?php
/*
  Plugin Name: WP Live Chat Support
  Plugin URI: http://www.wp-livechat.com
  Description: The easiest to use website live chat plugin. Let your visitors chat with you and increase sales conversion rates with WP Live Chat Support. No third party connection required!
  Version: 5.0.4
  Author: WP-LiveChat
  Author URI: http://www.wp-livechat.com
 */


/* 
 * 5.0.4 - 2015-08-06 - Medium priority
 * WP Live Chat Support is now compatible with all caching plugins
 * Fixed a bug that set the wrong permissions for the default agent
 * Fixed the bug that shows the status of undefined if the user minimized the chat
 * 
 * 
 * 5.0.3 - 2015-08-05 - High Priority
 * Small bug fix
 * 
 * 5.0.2 - 2015-08-05 - High Priority
 * Fixed a bug that caused a fatal error
 * 
 * 5.0.1 - 2015-08-05 - Medium Priority
 * Refactored the code so that the live chat box will show up even if there is a JS error from another plugin or theme
 * Live chat box styling fixes: top image padding; centered the "conneting, please be patient" message and added padding
 * The live chat long poll connection will not automatically reinitialize if the connection times out or returns a 5xx error
 * 
 * 5.0.0 - 2015-07-29 - Doppio update - Medium Priority
 * New, modern chat dashboard
 * Better user handling (chat long polling)
 * Added a welcome page to the live chat dashboard
 * The live hat dashboard is now fully responsive
 * You are now able to see who is a new visitor and who is a returning visitor
 * Bug fixes in the javascript that handles the live chat controls
 * Fixed the bug that stopped the chats from timing out after a certain amount of time
 * 
 * 4.4.4 - 2015-07-20 - Low Priority
 * Bug Fix: Big fixed that would cause the live chat to timeout during a conversation
 * 
 * 4.4.3 - 2015-07-16 - Low Priority
 * Bug Fix: Ajax URL undefined in some versions of WordPress
 * Improvement: Warning messages limited to the Settings page only
 * 
 * 4.4.2 - 2015-07-13 - Low Priority
 * Improvement: Gravatar images will load on sites using SSL without any issues
 * Improvement: Hungarian live chat translation file name fixed
 * Improvement: Styling improvements on the live chat dashboard
 * New Translations:
 *  Turkish (Thank you Yavuz Aksu)
 * 
 * 4.4.1 - 2015-07-08 - Critical Priority
 * Major security update. Please ensure you update to this version to eliminate previous vulnerabilities.
 * 
 * 4.3.5 Espresso - 2015-07-03 - Low Priority
 * Enhancement: Provision made for live chat encryption in the Pro version (compatibility)
 * Updated Translations:
 *  Hungarian (Thank you Andor Molnar)
 * 
 * 4.3.4 Ristretto - 2015-06-26 - Low Priority
 * Improvement: 404 errors for images in admin panel fixed
 * Translation Fix: Mistakes fixed in German Translation file.
 * 
 * 4.3.3 2015-06-11 - Low Priority
 * Security enhancements
 * New Translations:
 *  Polish (Thank you Sebastian Kajzer)
 * 
 * 4.3.2 2015-05-28 - Medium Priority
 * Bug Fix: Fixed PHP error
 * 
 * 4.3.1 2015-05-22 - Low Priority
 * New Translations:
 *  Finnish (Thank you Arttu Piipponen)
 * 
 * Translations Updated:
 *  French (Thank you Marcello Cavalucci)
 *  Dutch (Thank you Niek Groot Bleumink) 
 * 
 * Bug Fix: Exclude Functionality (Pro)
 * 
 * 4.3.0 2015-04-13 - Low Priority
 * Enhancement: Animations settings have been moved to the 'Styling' tab.
 * New Feature: Blocked User functionality has been moved to the Free version
 * Enhancement: All descriptions have been put into tooltips for a cleaner page
 * New Feature: Functionality added in to handle Chat Experience Ratings (Premium Add-on)
 * 
 * 4.2.12 2015-03-24 - Low Priority
 * Bug Fix: Warning to update showing erroneously 
 * 
 * 4.2.11 2015-03-23 - Low Priority
 * Bug Fix: Bug in the banned user functionality
 * Enhancement: Stying improvement on the Live Chat dashboard
 * Enhancement: Strings are handled better for localization plugins (Pro)
 * Updated Translation Files:
 *  Spanish (Thank you Ana Ayelen Martinez)
 * 
 * 4.2.10 2015-03-16 - Low Priority
 * Bug Fix: Mobile Detect class caused Fatal error on some websites
 * Bug Fix: PHP Errors when editing user page
 * Bug Fix: Including and Excluding the chat window caused issues on some websites
 * Bug Fix: Online/Offline Toggle Switch did not work in some browsers (Pro)
 * New Feature: You can now Ban visitors from chatting with you based on IP Address (Pro)
 * New Feature: You can now choose if you want users to make themselves an agent (Pro) 
 * Bug Fix: Chat window would not hide when selecting the option to not accept offline messages (Pro) 
 * Enhancement: Support page added 
 * Updated Translations:
 *  French (Thank you Marcello Cavallucci)
 * New Translations added:
 *  Norwegian (Thank you Robert Nilsen)
 *  Hungarian (Thank you GInception)
 *  Indonesian (Thank you Andrie Willyanta)
 * 
 * 4.2.9 2015-02-18 - Low Priority
 * New Feature: You can now choose to record your visitors IP address or not
 * New Feature: You can now send an offline message to more than one email address (Pro)
 * New Feature: You can now specify if you want to be online or not (Pro) 
 * 
 * 4.2.8 2015-02-12 - Low Priority
 * New Feature: You can now apply an animation to the chat window on page load
 * New Feature: You can now choose from 5 colour schemes for the chat window
 * Enhancement: Aesthetic Improvement to list of agents (Pro)
 * Code Improvement: PHP error fixed
 * Updated Translations:
 *  German (Thank you Dennis Klinger)   
 * 
 * 4.2.7 2015-02-10 - Low Priority
 * New Live Chat Translation added:
 *  Greek (Thank you Peter Stavropoulos)
 * 
 * 4.2.6 2015-01-29 - Low Priority
 * New feature: Live Chat dashboard has a new layout and design
 * Code Improvement: jQuery Cookie updated to the latest version
 * Code Improvement: More Live Chat strings are now translatable 
 * New Live Chat Translation added:
 *  Spanish (Thank you Ana Ayel�n Mart�nez)
 * 
 * 
 * 4.2.5 2015-01-21 - Low Priority
 * New Feature: You can now view any live chats you have missed
 * New Pro Feature: You can record offline messages when live chat is not online
 * Code Improvements: Labels added to buttons
 * Code Improvements: PHP Errors fixed
 * 
 * Updated Translations:
 *  Italian (Thank You Angelo Giammarresi)
 * 
 * 4.2.4 2014-12-17 - Low Priority
 * New feature: The chat window can be hidden when offline (Pro only)
 * New feature: Desktop notifications added
 * Bug fix: Email address gave false validation error when not required.
 * 
 * Translations Added:
 * Dutch (Thank you Elsy Aelvoet)
 * 
 * 
 * 4.2.3 2014-12-11 - Low Priority
 * Updated Translations:
 * French (Thank you Marcello Cavallucci)
 * Italian (Thank You Angelo Giammarresi)
 * 
 * 4.2.2 2014-12-10 - Low Priority
 * New feature: You can now toggle between displaying or hiding the users name in your Live Chat messages
 * New feature: You can now choose to display the Live Chat window to all or only registered users
 * New feature: A user image will now display in the Live Chat message
 * Code Improvement: jQuery UI CSS is loaded from a local source
 * Bug Fix: Only Admin users can make users Live Chat agents
 * 
 * Translations added:
 * Mongolian (Thank you Monica Batuskh)
 * Romanian (Thank you Sergiu Balaes)
 * Czech (Thank you Pavel Cvejn)
 * Danish (Thank you Mikkel Jeppesen Juhl)
 * 
 * Updated Translations:
 * German (Thank you Dennis Klinger)
 * 
 * 4.2.1 2014-11-24 - High Priority
 * Bug Fix: PHP Error on agent side in chat window
 * 
 * 
 * 4.2.0 2014-11-20 - Medium priority
 * Chat UI Improvements
 * Small bug fixes
 * 
 * 4.1.10 2014-10-29 - Low priority
 * Code Improvements: (Checks for DONOTCACHE)
 * New Pro Feature: You can now include or exclude the chat window on certain pages
 * 
 * 4.1.9 2014-10-10 - Low priority
 * Bug fix: Mobile Detect class caused an error if it existed in another plugin or theme. A check has been put in place. 
 * 
 * 4.1.8 2014-10-08 - Low priority
 * New feature: There is now an option if you do not require the user to input their name and email address before sending a chat request
 * New feature: Logged in users do not have to enter their details prior to sending the chat request.
 * New feature: Turn the chat on/off on a mobile device (smart phone and tablets)
 * 
 * 4.1.7 2014-10-06 - Low priority
 * Bug fix: sound was not played when user received a message from the admin
 * Internationalization update
 * New WP Live Chat Support Translation added:
 *  * Swedish (Thank You Tobias Sernhede)
 *  * French (Thank You Marcello Cavallucci)
 * 
 * 
 * 4.1.6
 * Code improvements (JavaScript errors fixed in IE)
 * New WP Live Chat Support Translations Added:
 *  * Slovakian (Thank You Dana Kadarova)
 *  * German (Thank You Dennis Klingr)
 *  * Hebrew (Thank You David Cohen)
 * 
 * 4.1.5
 * Code improvements (PHP warnings - set_time_limit caused warnings on some hosts)
 * 
 * 4.1.4
 * Significant performance improvements
 * Brazilian translation added - thank you Gustavo Silva
 * 
 * 4.1.3
 * Code improvements (PHP warnings)
 * 
 * 4.1.2
 * DB bug fix
 * 
 * 4.1.1
 * Significant performance improvements
 * Live chat window will now only show in one window (if user has multiple tabs open on your site)
 * You can now see the browser of the live chat user
 * Improved the UI of the backend
 * Bug fixes
 * 
 * 4.1.0
 * New feature: You can now show the chat box on the left or right
 * Vulnerability fix (JS injections). Thank you Patrik @ www.it-securityguard.com
 * Fixed 403 bug when saving settings
 * Fixed Ajax Time out error (Lowered From 90 to 28)
 * Fixed IE8 bug
 * Added option to auto pop up chat window
 * Added Italian language files. Thanks to Davide
 *  
 */

//error_reporting(E_ERROR);
global $wplc_version;
global $wplc_p_version;
global $wplc_tblname;
global $wpdb;
global $wplc_tblname_chats;
global $wplc_tblname_msgs;
$wplc_tblname_chats = $wpdb->prefix . "wplc_chat_sessions";
$wplc_tblname_msgs = $wpdb->prefix . "wplc_chat_msgs";
$wplc_version = "5.0.4";

define('WPLC_BASIC_PLUGIN_DIR', dirname(__FILE__));
define('WPLC_BASIC_PLUGIN_URL', plugins_url() . "/wp-live-chat-support/");
global $wplc_basic_plugin_url;
$wplc_basic_plugin_url = get_option('siteurl') . "/wp-content/plugins/wp-live-chat-support/";

if(!function_exists('wplc_pro_activate')){
    require_once (plugin_dir_path(__FILE__) . "ajax_new.php");
}

require_once (plugin_dir_path(__FILE__) . "functions.php");

add_action('wp_ajax_wplc_admin_set_transient', 'wplc_action_callback');
add_action('wp_ajax_wplc_hide_ftt','wplc_action_callback');
add_action('init', 'wplc_version_control');


add_action('wp_footer', 'wplc_display_box');

add_action('init', 'wplc_init');

if (function_exists('wplc_head_pro')) {
    add_action('admin_head', 'wplc_head_pro');
} else {
    add_action('admin_head', 'wplc_head_basic');
}

add_action('wp_enqueue_scripts', 'wplc_add_user_stylesheet');
add_action('admin_enqueue_scripts', 'wplc_add_admin_stylesheet');

if (function_exists('wplc_admin_menu_pro')) {
    add_action('admin_menu', 'wplc_admin_menu_pro');
} else {
    add_action('admin_menu', 'wplc_admin_menu');
}
add_action('admin_head', 'wplc_superadmin_javascript');
register_activation_hook(__FILE__, 'wplc_activate');


function wplc_basic_check() {
    // check if basic exists if pro is installed
}

function wplc_init() {
    $plugin_dir = basename(dirname(__FILE__)) . "/languages/";
    load_plugin_textdomain('wplivechat', false, $plugin_dir);        
    

}

function wplc_version_control() {
    global $wplc_version;


    $current_version = get_option("wplc_current_version");
    if (!isset($current_version) || $current_version != $wplc_version) {
        wplc_handle_db();
        update_option("wplc_current_version", $wplc_version);

        $wplc_settings = get_option("WPLC_SETTINGS");
        if (!isset($wplc_settings['wplc_require_user_info'])) {
            $wplc_settings['wplc_require_user_info'] = "1";
        }
        if (!isset($wplc_settings['wplc_loggedin_user_info'])) {
            $wplc_settings['wplc_loggedin_user_info'] = "1";
        }
        if (!isset($wplc_settings['wplc_user_alternative_text'])) {
            $wplc_alt_text = __("Please click \'Start Chat\' to initiate a chat with an agent", "wplivechat");
            $wplc_settings['wplc_user_alternative_text'] = $wplc_alt_text;
        }
        if (!isset($wplc_settings['wplc_enabled_on_mobile'])) {
            $wplc_settings['wplc_enabled_on_mobile'] = "1";
        }
        if(!isset($wplc_settings['wplc_record_ip_address'])){
            $wplc_settings['wplc_record_ip_address'] = "1";
        }
        update_option("WPLC_SETTINGS", $wplc_settings);
    }
}

function wplc_action_callback() {
    global $wpdb;
    global $wplc_tblname_chats;
    $check = check_ajax_referer('wplc', 'security');

    if ($check == 1) {
        if ($_POST['action'] == "wplc_admin_set_transient") {
            set_transient("wplc_is_admin_logged_in", "1", 70);
        }
        if ($_POST['action'] == 'wplc_hide_ftt') {
            update_option("WPLC_FIRST_TIME_TUTORIAL",true);
        }
    }
    die(); // this is required to return a proper result
}

function wplc_feedback_page_include() {
    include 'includes/feedback-page.php';
}

function wplc_admin_menu() {
    $wplc_mainpage = add_menu_page('WP Live Chat', __('Live Chat', 'wplivechat'), 'manage_options', 'wplivechat-menu', 'wplc_admin_menu_layout');
    add_submenu_page('wplivechat-menu', __('Settings', 'wplivechat'), __('Settings', 'wplivechat'), 'manage_options', 'wplivechat-menu-settings', 'wplc_admin_settings_layout');
    add_submenu_page('wplivechat-menu', __('History', 'wplivechat'), __('History', 'wplivechat'), 'manage_options', 'wplivechat-menu-history', 'wplc_admin_history_layout');
    add_submenu_page('wplivechat-menu', __('Missed Chats', 'wplivechat'), __('Missed Chats', 'wplivechat'), 'manage_options', 'wplivechat-menu-missed-chats', 'wplc_admin_missed_chats');
    add_submenu_page('wplivechat-menu', __('Feedback', 'wplivechat'), __('Feedback', 'wplivechat'), 'manage_options', 'wplivechat-menu-feedback-page', 'wplc_feedback_page_include');
    add_submenu_page('wplivechat-menu', __('Support', 'wplivechat'), __('Support', 'wplivechat'), 'manage_options', 'wplivechat-menu-support-page', 'wplc_support_menu');        
}



add_action("init","wplc_load_user_js",0);


function wplc_load_user_js () {
    
    if (!is_admin()) {



        if(function_exists('wplc_display_chat_contents')){
            $display_contents = wplc_display_chat_contents();
        } else {
            $display_contents = 1;
        }

        if(function_exists('wplc_is_user_banned')){
            $user_banned = wplc_is_user_banned();
        } else if (function_exists('wplc_is_user_banned')){
            $user_banned = wplc_is_user_banned_basic();
        } else {
            $user_banned = 0;
        }
        if($display_contents && $user_banned == 0){  

            /* do not show if pro is outdated */
            global $wplc_pro_version;
            if (isset($wplc_pro_version)) {
                $float_version = floatval($wplc_pro_version);
                if ($float_version < 4 || $wplc_pro_version == "4.1.0" || $wplc_pro_version == "4.1.1") {
                    return;
                }
            }

            if (function_exists("wplc_register_pro_version")) {
                $wplc_settings = get_option("WPLC_SETTINGS");
                if (!class_exists('Mobile_Detect')) {
                    require_once (plugin_dir_path(__FILE__) . 'includes/Mobile_Detect.php');
                }
                $wplc_detect_device = new Mobile_Detect;
                $wplc_is_mobile = $wplc_detect_device->isMobile();
                if ($wplc_is_mobile && !isset($wplc_settings['wplc_enabled_on_mobile']) && $wplc_settings['wplc_enabled_on_mobile'] != 1) {
                    return;
                }
                if (function_exists('wplc_hide_chat_when_offline')) {
                    $wplc_hide_chat = wplc_hide_chat_when_offline();
                    if (!$wplc_hide_chat) {
                        if (function_exists("wplc_push_js_to_front_pro")) {
                            wplc_push_js_to_front_pro();    
                        }
                    }
                } else {
                        if (function_exists("wplc_push_js_to_front_pro")) {
                            wplc_push_js_to_front_pro();
                        }
                }
            } else {
                wplc_push_js_to_front_basic();
            }
        }
    }



    

}

function wplc_push_js_to_front_basic() {
    global $wplc_is_mobile;
    wp_enqueue_script('jquery');

    $wplc_settings = get_option("WPLC_SETTINGS");

    if (isset($wplc_settings['wplc_display_to_loggedin_only']) && $wplc_settings['wplc_display_to_loggedin_only'] == 1) {
        /* Only show to users that are logged in */
        if (!is_user_logged_in()) {
            return;
        }
    }
        
    if ($wplc_settings["wplc_settings_enabled"] == 2) {
        return;
    }

    if (isset($wplc_settings['wplc_display_name']) && $wplc_settings['wplc_display_name'] == 1) {
        $wplc_display = 'display';
    } else {
        $wplc_display = 'hide';
    }

    wp_register_script('wplc-user-script', plugins_url('/js/wplc_u.js', __FILE__),array('jquery'));
    wp_enqueue_script('wplc-user-script');
    wp_register_script('wplc-user-jquery-cookie', plugins_url('/js/jquery-cookie.js', __FILE__), array('wplc-user-script'),false, false);
    wp_enqueue_script('wplc-user-jquery-cookie');


    wp_localize_script('wplc-user-script', 'wplc_hide_chat', null);
    wp_localize_script('wplc-user-script', 'wplc_plugin_url', plugins_url());
    wp_localize_script('wplc-user-script', 'wplc_display_name', $wplc_display);

    if (isset($_COOKIE['wplc_email']) && $_COOKIE['wplc_email'] != "") {
        $wplc_user_gravatar = sanitize_text_field(md5(strtolower(trim($_COOKIE['wplc_email']))));
    } else {
        $wplc_user_gravatar = "";
    }

    if ($wplc_user_gravatar != "") {
        $wplc_grav_image = "<img src='//www.gravatar.com/avatar/$wplc_user_gravatar?s=20' />";
    } else {
        $wplc_grav_image = "";
    }
    wp_localize_script('wplc-user-script', 'wplc_gravatar_image', $wplc_grav_image);

    wp_enqueue_script('jquery-ui-core',false,array('wplc-user-script'),false,false);
    wp_enqueue_script('jquery-ui-draggable',false,array('wplc-user-script'),false,false);

}
if (function_exists('wplc_pro_user_top_js')) { 
    add_action('wp_head', 'wplc_pro_user_top_js');

} else {
    add_action('wp_head', 'wplc_user_top_js');

}

function wplc_user_top_js() {

    if(function_exists('wplc_display_chat_contents')){
        $display_contents = wplc_display_chat_contents();
    } else {
        $display_contents = 1;
    }
    if($display_contents >= 1){
        /*echo "<!-- DEFINING DO NOT CACHE -->";
        if (!defined('DONOTCACHEPAGE')) {
            define('DONOTCACHEPAGE', true);
        }
        if (!defined('DONOTCACHEDB')) {
            define('DONOTCACHEDB', true);
        }
        */
        $ajax_nonce = wp_create_nonce("wplc");
        $wplc_settings = get_option("WPLC_SETTINGS");
        ?>

        <script type="text/javascript">
        <?php if (!function_exists("wplc_register_pro_version")) { ?>
                /* var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>'; */
            var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
            var wplc_ajaxurl = ajaxurl;
        <?php } ?>
            var wplc_nonce = '<?php echo $ajax_nonce; ?>';
        </script>
        <?php
    }
}

function wplc_draw_user_box() {
  

    if(function_exists('wplc_display_chat_contents')){
        if(wplc_display_chat_contents() >= 1){
            wplc_output_box();
        }
    } else {
        wplc_output_box();
    }
    
}

function wplc_output_box_ajax() {

    if(function_exists('wplc_display_chat_contents')){
        $display_contents = wplc_display_chat_contents();
    } else {
        $display_contents = 1;
    }

    if(function_exists('wplc_is_user_banned')){
        $user_banned = wplc_is_user_banned();
    } else if (function_exists('wplc_is_user_banned')){
        $user_banned = wplc_is_user_banned_basic();
    } else {
        $user_banned = 0;
    }
    if($display_contents && $user_banned == 0){  
       

        /* do not show if pro is outdated */
        global $wplc_pro_version;
        if (isset($wplc_pro_version)) {
            $float_version = floatval($wplc_pro_version);
            if ($float_version < 4 || $wplc_pro_version == "4.1.0" || $wplc_pro_version == "4.1.1") {
                return "";
            }
        }

        if (function_exists("wplc_register_pro_version")) {
            $wplc_settings = get_option("WPLC_SETTINGS");
            if (!class_exists('Mobile_Detect')) {
                require_once (plugin_dir_path(__FILE__) . 'includes/Mobile_Detect.php');
            }
            $wplc_detect_device = new Mobile_Detect;
            $wplc_is_mobile = $wplc_detect_device->isMobile();
            if ($wplc_is_mobile && !isset($wplc_settings['wplc_enabled_on_mobile']) && $wplc_settings['wplc_enabled_on_mobile'] != 1) {
                return "";
            }
            if (function_exists('wplc_hide_chat_when_offline')) {
                $wplc_hide_chat = wplc_hide_chat_when_offline();
                if (!$wplc_hide_chat) {
                    $draw_box = true;
                }
            } else {
                $draw_box = true;
            }
        } else {
            $draw_box = true;
        }
    }



    if ($draw_box) {
        $wplc_class = "";
        $ret_msg = "";
        $wplc_settings = get_option("WPLC_SETTINGS");

        if ($wplc_settings["wplc_settings_enabled"] == 2) {
            return;
        }

        if ($wplc_settings["wplc_settings_align"] == 1) {
            $original_pos = "bottom_left";
            //$wplc_box_align = "left:100px; bottom:0px;";
            $wplc_box_align = "bottom:0px;";
        } else if ($wplc_settings["wplc_settings_align"] == 2) {
            $original_pos = "bottom_right";
            //$wplc_box_align = "right:100px; bottom:0px;";
            $wplc_box_align = "bottom:0px;";
        } else if ($wplc_settings["wplc_settings_align"] == 3) {
            $original_pos = "left";
    //        $wplc_box_align = "left:0; bottom:100px;";
            $wplc_box_align = " bottom:100px;";
            $wplc_class = "wplc_left";
        } else if ($wplc_settings["wplc_settings_align"] == 4) {
            $original_pos = "right";
    //        $wplc_box_align = "right:0; bottom:100px;";
            $wplc_box_align = "bottom:100px;";
            $wplc_class = "wplc_right";
        }
        
        if ($wplc_settings["wplc_settings_fill"]) {
            $wplc_settings_fill = "#" . $wplc_settings["wplc_settings_fill"];
        } else {
            $wplc_settings_fill = "#ed832f";
        }
        if ($wplc_settings["wplc_settings_font"]) {
            $wplc_settings_font = "#" . $wplc_settings["wplc_settings_font"];
        } else {
            $wplc_settings_font = "#FFFFFF";
        }

        $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
        if (!function_exists("wplc_register_pro_version") && $wplc_is_admin_logged_in != 1) {
            $ret_msg = "";
        }
        
        if(function_exists('wplc_pro_activate')){
            if(function_exists('wplc_return_animations')){
                
                $animations = wplc_return_animations();
                
                isset($animations['animation']) ? $wplc_animation = $animations['animation'] : $wplc_animation = 'animation-4';
                isset($animations['starting_point']) ? $wplc_starting_point = $animations['starting_point'] : $wplc_starting_point = 'display: none;';
                isset($animations['box_align']) ? $wplc_box_align = $animations['box_align'] : $wplc_box_align = '';

            } else {
                
            }
        } else {
            
            $wplc_starting_point = '';
            $wplc_animation = '';
            
            if ($wplc_settings["wplc_settings_align"] == 1) {
                $original_pos = "bottom_left";
                $wplc_box_align = "left:100px; bottom:0px;";
            } else if ($wplc_settings["wplc_settings_align"] == 2) {
                $original_pos = "bottom_right";
                $wplc_box_align = "right:100px; bottom:0px;";
            } else if ($wplc_settings["wplc_settings_align"] == 3) {
                $original_pos = "left";
                $wplc_box_align = "left:0; bottom:100px;";
                $wplc_class = "wplc_left";
            } else if ($wplc_settings["wplc_settings_align"] == 4) {
                $original_pos = "right";
                $wplc_box_align = "right:0; bottom:100px;";
                $wplc_class = "wplc_right";
            }

        }
        
        if (isset($wplc_settings['wplc_auto_pop_up'])) { $wplc_auto_popup = $wplc_settings['wplc_auto_pop_up']; } else { $wplc_auto_popup = "" ;}
        $ret_msg .= "<div id=\"wp-live-chat\" wplc_animation=\"".$wplc_animation."\" style=\"".$wplc_starting_point." ".$wplc_box_align.";\" class=\"".$wplc_class." wplc_close\" original_pos=\"".$original_pos."\" wplc-auto-pop-up=\"". $wplc_auto_popup."\" > ";
      
            if (function_exists("wplc_pro_output_box_ajax")) {
                 $ret_msg .= wplc_pro_output_box_ajax();
            } else {
                
                $ret_msg .= "<div class=\"wp-live-chat-wraper\">";
                $ret_msg .= "<div id=\"wp-live-chat-header\" style=\"background-color: ".$wplc_settings_fill." !important; color: ".$wplc_settings_font." !important; \">";
                $ret_msg .= "<i id=\"wp-live-chat-minimize\" class=\"fa fa-minus\" style=\"display:none;\" ></i>";
       
                $ret_msg .= "<i id=\"wp-live-chat-close\" class=\"fa fa-times\" style=\"display:none;\" ></i>";

                $ret_msg .= " <div id=\"wp-live-chat-1\" >";
                $ret_msg .= "<div style=\"display:block; \">";
                $ret_msg .= "<strong>".__("Questions?", "wplivechat")."</strong> ".__("Chat with us", "wplivechat");
                $ret_msg .= "</div>";
                $ret_msg .= "</div>";
                $ret_msg .= "</div>";

                $ret_msg .= "<div id=\"wp-live-chat-2\" style=\"display:none;\">";
                $ret_msg .= "<div id=\"wp-live-chat-2-info\">";
                $ret_msg .= "<strong>".__('Start Live Chat', 'wplivechat')."</strong>";
                $ret_msg .= "</div>";
                        
                        if (isset($wplc_settings['wplc_loggedin_user_info']) && $wplc_settings['wplc_loggedin_user_info'] == 1) {
                            $wplc_use_loggedin_user_details = 1;
                        } else {
                            $wplc_use_loggedin_user_details = 0;
                        }

                        $wplc_loggedin_user_name = "";
                        $wplc_loggedin_user_email = "";

                        if ($wplc_use_loggedin_user_details == 1) {
                            global $current_user;

                            if ($current_user->data != null) {
                                //Logged in. Get name and email
                                $wplc_loggedin_user_name = $current_user->user_nicename;
                                $wplc_loggedin_user_email = $current_user->user_email;
                            }
                        } else {
                            $wplc_loggedin_user_name = '';
                            $wplc_loggedin_user_email = '';
                        }

                        if (isset($wplc_settings['wplc_require_user_info']) && $wplc_settings['wplc_require_user_info'] == 1) {
                            $wplc_ask_user_details = 1;
                        } else {
                            $wplc_ask_user_details = 0;
                        }

                        if ($wplc_ask_user_details == 1) {
                            //Ask the user to enter name and email
                   
                            $ret_msg .= "<input type=\"text\" name=\"wplc_name\" id=\"wplc_name\" value=\"".$wplc_loggedin_user_name."\" placeholder=\"".__("Name", "wplivechat")."\" />";
                            $ret_msg .= "<input type=\"text\" name=\"wplc_email\" id=\"wplc_email\" wplc_hide=\"0\" value=\"".$wplc_loggedin_user_email."\" placeholder=\"".__("Email", "wplivechat")."\"  />";
                        } else {
                            //Dont ask the user
                            $ret_msg .= "<div style=\"padding: 7px; text-align: center;\">";
                            if (isset($wplc_settings['wplc_user_alternative_text'])) {
                                $ret_msg .= stripslashes($wplc_settings['wplc_user_alternative_text']);
                            }
                            $ret_msg .= '</div>';

                            $wplc_random_user_number = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
                            //$wplc_loggedin_user_email = $wplc_random_user_number."@".$wplc_random_user_number.".com";
                            if ($wplc_loggedin_user_name != '') { $wplc_lin = $wplc_loggedin_user_name; } else {  $wplc_lin = 'user' . $wplc_random_user_number; }
                            if ($wplc_loggedin_user_email != '' && $wplc_loggedin_user_email != null) { $wplc_lie = $wplc_loggedin_user_email; } else { $wplc_lie = $wplc_random_user_number . '@' . $wplc_random_user_number . '.com'; }
                            $ret_msg .= "<input type=\"hidden\" name=\"wplc_name\" id=\"wplc_name\" value=\"".$wplc_lin."\" />";
                            $ret_msg .= "<input type=\"hidden\" name=\"wplc_email\" id=\"wplc_email\" wplc_hide=\"1\" value=\"".$wplc_lie."\" />";
                        }   
                        
                        $ret_msg .= "<input id=\"wplc_start_chat_btn\" type=\"button\" value=\"".__("Start Chat", "wplivechat")."\" style=\"background-color: ".$wplc_settings_fill." !important; color: ".$wplc_settings_font." !important;\"/>";
                        $ret_msg .= "</div>";
                        $ret_msg .= "<div id=\"wp-live-chat-3\" style=\"display:none;\">";
                        $ret_msg .= "<p>".__("Connecting you to a sales person. Please be patient.", "wplivechat")."</p>";
                        $ret_msg .= "</div>";
                        $ret_msg .= "<div id=\"wp-live-chat-react\" style=\"display:none;\">";
                        $ret_msg .= "<p>".__("Reactivating your previous chat...", "wplivechat")."</p>";
                        $ret_msg .= "</div>";
                        $ret_msg .= "<div id=\"wp-live-chat-4\" style=\"display:none;\">";
                        $ret_msg .= "<div id=\"wplc_sound_update\" style=\"height:0; width:0; display:none; border:0;\"></div>";
                        $ret_msg .= "<div id=\"wplc_chatbox\"></div>";
                        $ret_msg .= "<p style=\"text-align:center; font-size:11px;\">".__("Press ENTER to send your message", "wplivechat")."</p>";
                        $ret_msg .= "<p>";
                        $ret_msg .= "<input type=\"text\" name=\"wplc_chatmsg\" id=\"wplc_chatmsg\" value=\"\" />";
                        $ret_msg .= "<input type=\"hidden\" name=\"wplc_cid\" id=\"wplc_cid\" value=\"\" />";
                        $ret_msg .= "<input id=\"wplc_send_msg\" type=\"button\" value=\"".__("Send", "wplivechat")."\" style=\"display:none;\" />";
                        $ret_msg .= "</p>";
                        $ret_msg .= "</div>";
                        $ret_msg .= "</div>";
            }
        $ret_msg .= "</div>";
        return json_encode($ret_msg);
    } else {
        return "";
    }


}

function wplc_output_box() {
    $wplc_class = "";
    $wplc_settings = get_option("WPLC_SETTINGS");

    if ($wplc_settings["wplc_settings_enabled"] == 2) {
        return;
    }

    if ($wplc_settings["wplc_settings_align"] == 1) {
        $original_pos = "bottom_left";
        //$wplc_box_align = "left:100px; bottom:0px;";
        $wplc_box_align = "bottom:0px;";
    } else if ($wplc_settings["wplc_settings_align"] == 2) {
        $original_pos = "bottom_right";
        //$wplc_box_align = "right:100px; bottom:0px;";
        $wplc_box_align = "bottom:0px;";
    } else if ($wplc_settings["wplc_settings_align"] == 3) {
        $original_pos = "left";
//        $wplc_box_align = "left:0; bottom:100px;";
        $wplc_box_align = " bottom:100px;";
        $wplc_class = "wplc_left";
    } else if ($wplc_settings["wplc_settings_align"] == 4) {
        $original_pos = "right";
//        $wplc_box_align = "right:0; bottom:100px;";
        $wplc_box_align = "bottom:100px;";
        $wplc_class = "wplc_right";
    }
    
    if ($wplc_settings["wplc_settings_fill"]) {
        $wplc_settings_fill = "#" . $wplc_settings["wplc_settings_fill"];
    } else {
        $wplc_settings_fill = "#ed832f";
    }
    if ($wplc_settings["wplc_settings_font"]) {
        $wplc_settings_font = "#" . $wplc_settings["wplc_settings_font"];
    } else {
        $wplc_settings_font = "#FFFFFF";
    }

    $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
    if (!function_exists("wplc_register_pro_version") && $wplc_is_admin_logged_in != 1) {
        return "";
    }
    
    if(function_exists('wplc_pro_activate')){
        if(function_exists('wplc_return_animations')){
            
            $animations = wplc_return_animations();
            
            isset($animations['animation']) ? $wplc_animation = $animations['animation'] : $wplc_animation = 'animation-4';
            isset($animations['starting_point']) ? $wplc_starting_point = $animations['starting_point'] : $wplc_starting_point = 'display: none;';
            isset($animations['box_align']) ? $wplc_box_align = $animations['box_align'] : $wplc_box_align = '';

        } else {
            
        }
    } else {
        
        $wplc_starting_point = '';
        $wplc_animation = '';
        
        if ($wplc_settings["wplc_settings_align"] == 1) {
            $original_pos = "bottom_left";
            $wplc_box_align = "left:100px; bottom:0px;";
        } else if ($wplc_settings["wplc_settings_align"] == 2) {
            $original_pos = "bottom_right";
            $wplc_box_align = "right:100px; bottom:0px;";
        } else if ($wplc_settings["wplc_settings_align"] == 3) {
            $original_pos = "left";
            $wplc_box_align = "left:0; bottom:100px;";
            $wplc_class = "wplc_left";
        } else if ($wplc_settings["wplc_settings_align"] == 4) {
            $original_pos = "right";
            $wplc_box_align = "right:0; bottom:100px;";
            $wplc_class = "wplc_right";
        }

    }
    /* here */
    ?>    
    <div id="wp-live-chat" wplc_animation='<?php echo $wplc_animation; ?>' style="<?php echo $wplc_starting_point." ".$wplc_box_align; ?>; " class="<?php echo $wplc_class; ?> wplc_close" original_pos="<?php echo $original_pos; ?>" wplc-auto-pop-up="<?php if (isset($wplc_settings['wplc_auto_pop_up'])) { echo $wplc_settings['wplc_auto_pop_up']; } ?>" > 
    <?php
        if (function_exists("wplc_register_pro_version")) {
             wplc_pro_output_box();
        } else {
            ?>
            <div class="wp-live-chat-wraper">
                <div id="wp-live-chat-header" style="background-color: <?php echo $wplc_settings_fill; ?> !important; color: <?php echo $wplc_settings_font; ?> !important; ">
                    <i id="wp-live-chat-minimize" class="fa fa-minus" style="display:none;" ></i>
                    <i id="wp-live-chat-close" class="fa fa-times" style="display:none;" ></i>

                    <div id="wp-live-chat-1" >
                        <div style="display:block; ">
                            <strong><?php _e("Questions?", "wplivechat") ?></strong> <?php _e("Chat with us", "wplivechat") ?>
                        </div>
                    </div>
                </div>

                <div id="wp-live-chat-2" style="display:none;">
                    <div id="wp-live-chat-2-info">
                        <strong><?php _e('Start Live Chat', 'wplivechat'); ?></strong> 
                    </div>
                    <?php
                    $wplc_settings = get_option("WPLC_SETTINGS");

                    if (isset($wplc_settings['wplc_loggedin_user_info']) && $wplc_settings['wplc_loggedin_user_info'] == 1) {
                        $wplc_use_loggedin_user_details = 1;
                    } else {
                        $wplc_use_loggedin_user_details = 0;
                    }

                    $wplc_loggedin_user_name = "";
                    $wplc_loggedin_user_email = "";

                    if ($wplc_use_loggedin_user_details == 1) {
                        global $current_user;

                        if ($current_user->data != null) {
                            //Logged in. Get name and email
                            $wplc_loggedin_user_name = $current_user->user_nicename;
                            $wplc_loggedin_user_email = $current_user->user_email;
                        }
                    } else {
                        $wplc_loggedin_user_name = '';
                        $wplc_loggedin_user_email = '';
                    }

                    if (isset($wplc_settings['wplc_require_user_info']) && $wplc_settings['wplc_require_user_info'] == 1) {
                        $wplc_ask_user_details = 1;
                    } else {
                        $wplc_ask_user_details = 0;
                    }

                    if ($wplc_ask_user_details == 1) {
                        //Ask the user to enter name and email
                        ?>
                        <input type="text" name="wplc_name" id="wplc_name" value="<?php echo $wplc_loggedin_user_name; ?>" placeholder="<?php _e("Name", "wplivechat"); ?>" />
                        <input type="text" name="wplc_email" id="wplc_email" wplc_hide="0" value="<?php echo $wplc_loggedin_user_email; ?>" placeholder="<?php _e("Email", "wplivechat"); ?>"  />
                        <?php
                    } else {
                        //Dont ask the user
                        echo '<div style="padding: 7px; text-align: center;">';
                        if (isset($wplc_settings['wplc_user_alternative_text'])) {
                            echo stripslashes($wplc_settings['wplc_user_alternative_text']);
                        }
                        echo '</div>';

                        $wplc_random_user_number = rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9);
                        //$wplc_loggedin_user_email = $wplc_random_user_number."@".$wplc_random_user_number.".com";
                        ?>
                        <input type="hidden" name="wplc_name" id="wplc_name" value="<?php if ($wplc_loggedin_user_name != '') { echo $wplc_loggedin_user_name; } else { echo 'user' . $wplc_random_user_number; } ?>" />
                        <input type="hidden" name="wplc_email" id="wplc_email" wplc_hide="1" value="<?php if ($wplc_loggedin_user_email != '' && $wplc_loggedin_user_email != null) { echo $wplc_loggedin_user_email; } else { echo $wplc_random_user_number . '@' . $wplc_random_user_number . '.com'; } ?>" />
                        <?php
                    }   
                    ?>
                    <input id="wplc_start_chat_btn" type="button" value="<?php _e("Start Chat", "wplivechat"); ?>" style="background-color: <?php echo $wplc_settings_fill; ?> !important; color: <?php echo $wplc_settings_font; ?> !important;"/>
                </div>
                <div id="wp-live-chat-3" style="display:none;">
                    <p><?php _e("Connecting you to a sales person. Please be patient.", "wplivechat") ?></p>
                </div>
                <div id="wp-live-chat-react" style="display:none;">
                    <p><?php _e("Reactivating your previous chat...", "wplivechat") ?></p>
                </div>
                <div id="wp-live-chat-4" style="display:none;">
                    <div id="wplc_sound_update" style='height:0; width:0; display:none; border:0;'></div>
                    <div id="wplc_chatbox"></div>
                    <p style="text-align:center; font-size:11px;"><?php _e("Press ENTER to send your message", "wplivechat") ?></p>
                    <p>
                        <input type="text" name="wplc_chatmsg" id="wplc_chatmsg" value="" />
                        <input type="hidden" name="wplc_cid" id="wplc_cid" value="" />
                        <input id="wplc_send_msg" type="button" value="<?php _e("Send", "wplivechat"); ?>" style="display:none;" />
                    </p>
                </div>
            </div>    
        <?php } ?>
</div> 
<?php

}

function wplc_display_box() {

    global $wplc_pro_version;
    $wplc_ver = str_replace('.', '', $wplc_pro_version);
    $checker = intval($wplc_ver);
    
    if (function_exists("wplc_pro_version_control") && ($checker <= 501 || $checker == 4410)) {
        /* prior to latest pro version with ajax handling */

        if(function_exists('wplc_display_chat_contents')){
            $display_contents = wplc_display_chat_contents();
        } else {
            $display_contents = 1;
        }

        if(function_exists('wplc_is_user_banned')){
            $user_banned = wplc_is_user_banned();
        } else if (function_exists('wplc_is_user_banned')){
            $user_banned = wplc_is_user_banned_basic();
        } else {
            $user_banned = 0;
        }
        if($display_contents && $user_banned == 0){  
            $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
            if ($wplc_is_admin_logged_in != 1) {
                echo "<!-- wplc a-n-c -->";
            }

            /* do not show if pro is outdated */
            global $wplc_pro_version;
            if (isset($wplc_pro_version)) {
                $float_version = floatval($wplc_pro_version);
                if ($float_version < 4 || $wplc_pro_version == "4.1.0" || $wplc_pro_version == "4.1.1") {
                    return;
                }
            }

            if (function_exists("wplc_register_pro_version")) {
                $wplc_settings = get_option("WPLC_SETTINGS");
                if (!class_exists('Mobile_Detect')) {
                    require_once (plugin_dir_path(__FILE__) . 'includes/Mobile_Detect.php');
                }
                $wplc_detect_device = new Mobile_Detect;
                $wplc_is_mobile = $wplc_detect_device->isMobile();
                if ($wplc_is_mobile && !isset($wplc_settings['wplc_enabled_on_mobile']) && $wplc_settings['wplc_enabled_on_mobile'] != 1) {
                    return;
                }
                if (function_exists('wplc_hide_chat_when_offline')) {
                    $wplc_hide_chat = wplc_hide_chat_when_offline();
                    if (!$wplc_hide_chat) {
                        wplc_pro_draw_user_box();
                    }
                } else {
                    wplc_pro_draw_user_box();
                }
            } else {
                wplc_draw_user_box();
            }
        }
    }
}
function wplc_display_box_ajax() {

    if(function_exists('wplc_display_chat_contents')){
        $display_contents = wplc_display_chat_contents();
    } else {
        $display_contents = 1;
    }

    if(function_exists('wplc_is_user_banned')){
        $user_banned = wplc_is_user_banned();
    } else if (function_exists('wplc_is_user_banned')){
        $user_banned = wplc_is_user_banned_basic();
    } else {
        $user_banned = 0;
    }
    if($display_contents && $user_banned == 0){  
        $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
        if ($wplc_is_admin_logged_in != 1) {
            return "";
        }

        /* do not show if pro is outdated */
        global $wplc_pro_version;
        if (isset($wplc_pro_version)) {
            $float_version = floatval($wplc_pro_version);
            if ($float_version < 4 || $wplc_pro_version == "4.1.0" || $wplc_pro_version == "4.1.1") {
                return;
            }
        }

        if (function_exists("wplc_register_pro_version")) {
            $wplc_settings = get_option("WPLC_SETTINGS");
            if (!class_exists('Mobile_Detect')) {
                require_once (plugin_dir_path(__FILE__) . 'includes/Mobile_Detect.php');
            }
            $wplc_detect_device = new Mobile_Detect;
            $wplc_is_mobile = $wplc_detect_device->isMobile();
            if ($wplc_is_mobile && !isset($wplc_settings['wplc_enabled_on_mobile']) && $wplc_settings['wplc_enabled_on_mobile'] != 1) {
                return;
            }
            if (function_exists('wplc_hide_chat_when_offline')) {
                $wplc_hide_chat = wplc_hide_chat_when_offline();
                if (!$wplc_hide_chat) {
                    wplc_pro_draw_user_box();
                }
            } else {
                wplc_pro_draw_user_box();
            }
        } else {
            wplc_draw_user_box();
        }
    }
}

function wplc_admin_display_chat($cid) {
    global $wpdb;
    global $wplc_tblname_msgs;
    $results = $wpdb->get_results(
            "
        SELECT *
        FROM $wplc_tblname_msgs
        WHERE `chat_sess_id` = '$cid'
        ORDER BY `timestamp` DESC
        LIMIT 0, 100
        "
    );
    foreach ($results as $result) {
        $from = $result->from;
        $msg = stripslashes($result->msg);
        $msg_hist .= "$from: $msg<br />";
    }
    echo $msg_hist;
}

function wplc_admin_accept_chat($cid) {   
    wplc_change_chat_status(sanitize_text_field($cid), 3);
    return true;
}

add_action('admin_head', 'wplc_update_chat_statuses');

function wplc_superadmin_javascript() {

    if (isset($_GET['page']) && $_GET['page'] == 'wplivechat-menu') {

        if (!isset($_GET['action'])) {
            if (function_exists("wplc_register_pro_version")) {
                wplc_pro_admin_javascript();
            } else {
                wplc_admin_javascript();
            }
        } // main page
        else if (isset($_GET['action'])) {
            if (function_exists("wplc_register_pro_version")) {
                wplc_return_pro_admin_chat_javascript(sanitize_text_field($_GET['cid']));
            } else {
                wplc_return_admin_chat_javascript(sanitize_text_field($_GET['cid']));
            }
        }
    }

    $ajax_nonce = wp_create_nonce("wplc");
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function () {


            var wplc_set_transient = null;

            wplc_set_transient = setInterval(function () {
                wpcl_admin_set_transient();
            }, 60000);
            wpcl_admin_set_transient();
            function wpcl_admin_set_transient() {
                var data = {
                    action: 'wplc_admin_set_transient',
                    security: '<?php echo $ajax_nonce; ?>'

                };
                jQuery.post(ajaxurl, data, function (response) {
                    //console.log("wplc_admin_set_transient");
                });
            }

        });

        function wplc_desktop_notification() {
            if (typeof Notification !== 'undefined') {
                if (!Notification) {
                    return;
                }
                if (Notification.permission !== "granted")
                    Notification.requestPermission();

                var wplc_desktop_notification = new Notification('<?php _e('New chat received', 'wplivechat'); ?>', {
                    icon: wplc_notification_icon_url,
                    body: "<?php _e("A new chat has been received. Please go the 'Live Chat' page to accept the chat", "wplivechat"); ?>"
                });
                //Notification.close()
            }
        }

    </script>
    <?php
}

function wplc_admin_javascript() {
    $ajax_nonce = wp_create_nonce("wplc");
    ?>

    <script type="text/javascript">
        /* var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>'; */
        var wplc_ajaxurl = ajaxurl;
        var data = {
            action: 'wplc_admin_long_poll',
            security: '<?php echo $ajax_nonce; ?>',
            wplc_list_visitors_data: false,
            wplc_update_admin_chat_table: false
        };
        var wplc_pending_refresh = null;
        var current_chat_ids = new Object();
        var chat_count = 0;
        var wplc_run = true;
        var ringer_cnt = 0;
        var orig_title = document.getElementsByTagName("title")[0].innerHTML;
        
        var wplc_notification_icon_url = '<?php echo plugins_url('/images/wplc_notification_icon.png', __FILE__); ?>';

        Object.size = function(obj) {
            var size = 0, key;
            for (key in obj) {
                if (obj.hasOwnProperty(key)) size++;
            }
            return size;
        };
        function wplc_notify_agent() {
            
            var wplc_sounder = document.createElement("embed");
            wplc_sounder.src = '<?php echo plugins_url('/ring.wav', __FILE__); ?>';
            wplc_sounder.hidden = 'true';
            wplc_sounder.autostart = 'true';
            wplc_sounder.loop = 'false';
            wplc_sounder.type = 'audio/x-wav';
            var seconds = new Date().getTime() / 1000;
            wplc_sounder.id = 'wplc_s_'+seconds;

            
            document.body.appendChild(wplc_sounder);  
            
            if (ringer_cnt <= 0) {
                wplc_desktop_notification();
            }
            ringer_cnt++;

            if (ringer_cnt > 1) {
                clearInterval(wplc_pending_refresh);
                wplc_title_alerts4 = setTimeout(function () {
                    document.title = orig_title;
                }, 4000);
                return;
            }

            document.title = "** CHAT REQUEST **";
            wplc_title_alerts2 = setTimeout(function () {
                document.title = "** CHAT REQUEST **";
            }, 2000);
            wplc_title_alerts4 = setTimeout(function () {
                document.title = orig_title;
            }, 4000);


                
            

        }
        function wplc_call_to_server(data) {


            jQuery.ajax({
                url: wplc_ajaxurl,
                data: data,
                type: "POST",
                success: function (response) {

                    //Update your dashboard gauge
                    if (response) {
    //                        console.log('Running');
                        response = JSON.parse(response);
                        //console.log(response);
                        data["wplc_update_admin_chat_table"] = response['wplc_update_admin_chat_table'];
                        //console.log(response['visitors']);
                        
                        if (response['action'] === "wplc_update_chat_list") {
                            wplc_handle_chat_output(response['wplc_update_admin_chat_table']);
                            if (response['pending'] === true) {
                                
                                wplc_notify_agent();
                                wplc_pending_refresh = setInterval(function () {
                                    
                                    wplc_notify_agent();
                                }, 5000);
                            } else {
                                //console.log("end");
                                clearInterval(wplc_pending_refresh);
                                ringer_cnt = 0;
                            }
                        }
                        if (response['action'] === "wplc_update_admin_chat") {
                            jQuery("#wplc_admin_chat_area").html(response['wplc_update_admin_chat_table']);
                            if (response['pending'] === true) {

                                var orig_title = document.getElementsByTagName("title")[0].innerHTML;
                                var ringer_cnt = 0;
                                wplc_pending_refresh = setInterval(function () {
                                    //console.log("chat request");

                                    if (ringer_cnt <= 0) {
                                        wplc_desktop_notification();
                                    }

                                    ringer_cnt++;

                                    if (ringer_cnt > 1) {
                                        clearInterval(wplc_pending_refresh);
                                        wplc_title_alerts4 = setTimeout(function () {
                                            document.title = orig_title;
                                        }, 4000);
                                        return;
                                    }

                                    document.title = "** CHAT REQUEST **";
                                    wplc_title_alerts2 = setTimeout(function () {
                                        document.title = "** CHAT REQUEST **";
                                    }, 2000);
                                    wplc_title_alerts4 = setTimeout(function () {
                                        document.title = orig_title;
                                    }, 4000);

                                    document.getElementById("wplc_sound").innerHTML = "<embed src='<?php echo plugins_url('/ring.wav', __FILE__); ?>' hidden=true autostart=true loop=false>";

    //                                    var wplc_notify_sound = '<?php echo plugins_url('/ring.wav', __FILE__); ?>';
    //                                    var wplc_notify_chat = new Audio(wplc_notify_sound);
    //
    //                                    if(ringer_cnt < 5){
    //                                        wplc_notify_chat.play();
    //                                    }

                                }, 5000);
                            } else {
                                //console.log("end");
                                clearInterval(wplc_pending_refresh);
                            }
                        }

                    }
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status == 404) {
                        if( window.console ) { console.log('Requested page not found. [404]'); }
                        wplc_run = false;
                    } else if (jqXHR.status == 500) {
                        if( window.console ) { console.log('Internal Server Error [500].'); }
                        wplc_run = false;
                    } else if (exception === 'parsererror') {
                        if( window.console ) { console.log('Requested JSON parse failed.'); }
                        wplc_run = false;
                    } else if (exception === 'abort') {
                        if( window.console ) { console.log('Ajax request aborted.'); }
                        wplc_run = false;
                    } else {
                        if( window.console ) { console.log('Uncaught Error.\n' + jqXHR.responseText); }
                        wplc_run = false;
                    }
                },
                complete: function (response) {
                    //console.log(wplc_run);
                    if (wplc_run) {
                        setTimeout(function () {
                            wplc_call_to_server(data);
                        }, 1500);
                    }
                },
                timeout: 120000
            });
        };


    function wplc_handle_chat_output(response) {
        var obj = jQuery.parseJSON(response);
        if (obj === false || obj === null) {
                jQuery("#wplc_chat_ul").html("");
                current_chat_ids = {};
                wplc_handle_count_change(0);
                
        } else {
            var size = Object.size(current_chat_ids);
            wplc_handle_count_change(size);
            if (size < 1) {
                /* no prior visitor information, update without any checks */
                current_chat_ids = obj["ids"];
                wplc_update_chat_list(false,obj);
            } else {
                /* we have had visitor information prior to this call, update systematically */
                if (obj === null) {
                    jQuery("#wplc_chat_ul").html("");
                } else {
                    current_chat_ids = obj["ids"];
                    wplc_update_chat_list(true,obj);
                }
            }

        
        }
        var size = Object.size(current_chat_ids);
        wplc_handle_count_change(size);
        
    

    }
    function wplc_handle_count_change(qty) {
        if (qty > chat_count) {
            jQuery(".wplc_chat_vis_count_box").animate({backgroundColor: '#B3D24B'}, 300);
            jQuery(".wplc_vis_online").html(qty);
            jQuery(".wplc_chat_vis_count_box").animate({backgroundColor: 'white'}, 200);
        } else if (qty === chat_count) {
            jQuery(".wplc_vis_online").html(qty);
        } else {
            jQuery(".wplc_chat_vis_count_box").animate({backgroundColor: '#E1734A'}, 300);
            jQuery(".wplc_vis_online").html(qty);
            jQuery(".wplc_chat_vis_count_box").animate({backgroundColor: 'white'}, 200);
        }
        chat_count = qty;
        
    }
    
    
    function wplc_get_status_name(status) {
        if (status === 1) {
            return "<span class='wplc_status_box wplc_status_"+status+"'>complete</span>";
        }
        if (status === 2) {
            return "<span class='wplc_status_box wplc_status_"+status+"'>pending</span>";
        }
        if (status === 3) {
            return "<span class='wplc_status_box wplc_status_"+status+"'>active</span>";
        }
        if (status === 4) {
            return "<span class='wplc_status_box wplc_status_"+status+"'>deleted</span>";
        }
        if (status === 5) {
            return "<span class='wplc_status_box wplc_status_"+status+"'>browsing</span>";
        }
        if (status === 6) {
            return "<span class='wplc_status_box wplc_status_"+status+"'>requesting chat</span>";
        }
        if (status === 8){
            return "<span class='wplc_status_box wplc_status_"+status+"'>chat ended</span></span>";
        }
        if (status === 9){
            return "<span class='wplc_status_box wplc_status_"+status+"'>chat closed</span>";
        }
        if (status === 10){
            return "<span class='wplc_status_box wplc_status_8'>minimized</span>";
        }
    }
    function wplc_get_type_box(type) {
        if (type === "New") {
            return "<span class='wplc_status_box wplc_type_new'>New</span>";
        }
        if (type === "Returning") {
            return "<span class='wplc_status_box wplc_type_returning'>Returning</span>";
        }
    }
    
    function wplc_create_chat_ul_element_after_eating_vindaloo(obj,key) {
        var v_img = obj[key]['image'];
        var v_name = obj[key]['name'];
        var v_email = obj[key]['email'];
        var v_browser = obj[key]['data']['browser'];
        var v_browsing = obj[key]['data']['browsing_nice_url'];
        var v_browsing_url = obj[key]['data']['browsing'];
        var v_status = obj[key]['status'];
        var v_time = obj[key]['timestamp'];
        var v_type = obj[key]['type'];
        var v_action = obj[key]['action'];
        var v_status_string = wplc_get_status_name(parseInt(v_status));

        var v_vis_html = "<span class='wplc_headerspan_v'>"+v_name+"</span>";
        var v_nr_html = "<span class='wplc_headerspan_nr'><span class='browser-tag'>"+v_browser+"</span> "+wplc_get_type_box(v_type)+"</span>";
        var v_time_html = "<span class='wplc_headerspan_t'><span class='wplc_status_box wplc_status_1'>"+v_time+"</span></span>";
        var v_nr_data = "<span class='wplc_headerspan_d'><span class='wplc-sub-item-header'>Page:</span> <a href='"+v_browsing_url+"' target='_BLANK'>"+v_browsing+"</a><br /><span class='wplc-sub-item-header'>Email:</span> <a href='mailto:"+v_email+"' target='_BLANK'>"+v_email+"</a></span>";
        var v_nr_status_html = "<span class='wplc_headerspan_s'>"+v_status_string+"</span>";
        var v_nr_action_html = "<span class='wplc_headerspan_a'>"+v_action+"</span>";

        var wplc_v_html = "\
            <ul id='wplc_p_ul_"+key+"' class='wplc_p_cul' cid='"+key+"'>\n\
                    <li>"+v_vis_html+"</li>\n\
                    <li>"+v_time_html+"</li>\n\
                    <li>"+v_nr_html+"</li>\n\
                    <li>"+v_nr_data+"</li>\n\
                    <li>"+v_nr_status_html+"</li>\n\
                    <li>"+v_nr_action_html+"</li>\n\
            <ul>";
    return wplc_v_html;

        
    }
    
    function wplc_update_chat_list(update,obj) {

        /* first compare existing elements with the elements on the page */
        if (update === false) {
            jQuery( ".wplc_chat_ul" ).html("");

            for (var key in obj) {
                if (obj.hasOwnProperty(key) && key !== "ids") {
                    wplc_v_html = wplc_create_chat_ul_element_after_eating_vindaloo(obj,key);
                    jQuery( "#wplc_chat_ul" ).append(wplc_v_html).hide().fadeIn(2000);
                    
                }
            }
            current_chat_ids = obj["ids"];

        } else {
            
            for (var key in current_chat_ids) {
                current_id = key;
                if (document.getElementById("wplc_p_ul_"+current_id) !== null) {
                    /* element is already there */
                    /* update element */
                    if (typeof obj[current_id] !== "undefined") { /* if this check isnt here, it will throw an error. This check is here incase the item has been deleted. If it has, it will be handled futher down */
                        jQuery("#wplc_p_ul_"+current_id).remove();
                        wplc_v_html = wplc_create_chat_ul_element_after_eating_vindaloo(obj,current_id);
                        jQuery( "#wplc_chat_ul" ).append(wplc_v_html);
                        //jQuery( ".wplc_chats_container" ).append(obj[current_id]['content']);
                    }


                } else {
                    jQuery("#nifty_c_none").hide();
                    /* new element to be created */
                    if (typeof obj[current_id] !== "undefined") { /* if this check isnt here, it will throw an error. This check is here incase the item has been deleted. If it has, it will be handled futher down */
                        
                        wplc_v_html = wplc_create_chat_ul_element_after_eating_vindaloo(obj,current_id);
                        jQuery( "#wplc_chat_ul" ).append(wplc_v_html);
                        
                        jQuery("#wplc_p_ul_"+current_id).hide().fadeIn(2000);
                        
                    }
                }


            }

        }

            /* compare new elements to old elements and delete where neccessary */


            jQuery(".wplc_p_cul").each(function(n, i) {
                var cid = jQuery(this).attr("cid");
                if (typeof cid !== "undefined") {
                    if (typeof current_chat_ids[cid] !== "undefined") { /* element still there dont delete */ }
                    else {
                        jQuery("#wplc_p_ul_"+cid).fadeOut(2000).delay(2000).remove();
                        
                    }
                    var size = Object.size(current_chat_ids);
                    wplc_handle_count_change(size);
                }
                // do something with it
            });
            if(jQuery('.wplc_p_cul').length < 1) {
                wplc_handle_count_change(0);
                current_chat_ids = {};
            }





    }


        jQuery(document).ready(function () {
            jQuery('body').on("click", "a", function (event) {
                if (jQuery(this).hasClass('wplc_open_chat')) {
                    if (event.preventDefault) {
                        event.preventDefault();
                    } else {
                        event.returnValue = false;
                    }
                    window.open(jQuery(this).attr("href"), jQuery(this).attr("window-title"), "width=800,height=600,scrollbars=yes", false);
                }
            });
            
            jQuery('body').on("click", "#wplc_close_ftt", function (event) {
                jQuery("#wplcftt").fadeOut(1000);
                var data = {
                    action: 'wplc_hide_ftt',
                    security: '<?php echo $ajax_nonce; ?>',
                };
                jQuery.ajax({
                    url: wplc_ajaxurl,
                    data: data,
                    type: "POST",
                    success: function (response) {

                    }
                });
               
               
               
               
               
               
               
               
               
               
               
               
               
               
               
            });

            wplc_call_to_server(data);
        });



    </script>
    <?php
}

function wplc_admin_menu_layout() {
    if (function_exists("wplc_register_pro_version")) {
        global $wplc_pro_version;
        if (floatval($wplc_pro_version) < 4 || $wplc_pro_version == "4.1.0" || $wplc_pro_version == "4.1.1") {
            ?>
            <div class='error below-h1'>

                <p><?php _e("Dear Pro User", "wplivechat") ?><br /></p>
                <p><?php _e("You are using an outdated version of <strong>WP Live Chat Support Pro</strong>. Please", "wplivechat") ?> <a href="http://wp-livechat.com/get-updated-version/" target=\"_BLANK\"><?php _e("update to at least version", "wplivechat") ?> 4.0</a> <?php _e("to ensure all functionality is in working order", "wplivechat") ?>.</p>
                <p><strong><?php _e("You're live chat box on your website has been temporarily disabled until the Pro plugin has been updated. This is to ensure a smooth and hassle-free user experience for both yourself and your visitors.", "wplivechat") ?></strong></p>
                <p><?php _e("You can update your plugin <a href='./update-core.php'>here</a>, <a href='./plugins.php'>here</a> or <a href='http://wp-livechat.com/get-updated-version/' target='_BLANK'>here</a>.", "wplivechat") ?></strong></p>
                <p><?php _e("If you are having difficulty updating the plugin, please contact", "wplivechat") ?> nick@wp-livechat.com</p>

            </div>
            <?php
        }
        $wplc_ver = str_replace('.', '', $wplc_pro_version);
        $wplc_ver = intval($wplc_ver);
        if ($wplc_ver != 501) {
            ?>
            <div class='error below-h1'>

                <p><?php _e("Dear Pro User", "wplivechat") ?><br /></p>
                <p><?php _e("You are using an outdated version of <strong>WP Live Chat Support Pro</strong>.", "wplivechat") ?></p>
                <p>
                    <strong><?php _e("Please update to the latest version of WP Live Chat Support Pro", 'wplivechat'); ?>
                        <a href="http://wp-livechat.com/get-updated-version/" target=\"_BLANK\"> <?php _e("Version 5.0.1", "wplivechat"); ?></a>  
                        <?php _e("to ensure everything is working correctly.", "wplivechat"); ?>
                    </strong>
                </p>
                <p><?php _e("You can update your plugin <a href='./update-core.php'>here</a>, <a href='./plugins.php'>here</a> or <a href='http://wp-livechat.com/get-updated-version/' target='_BLANK'>here</a>.", "wplivechat") ?></strong></p>
                <p><?php _e("If you are having difficulty updating the plugin, please contact", "wplivechat") ?> nick@wp-livechat.com</p>

            </div>
            <?php
        }
    }
    if (get_option("WPLC_FIRST_TIME") == true && !class_exists("APC_Object_Cache")) {
        update_option('WPLC_FIRST_TIME', false);
        include 'includes/welcome_page.php';
    } else {
        update_option('WPLC_FIRST_TIME', false);
        if (function_exists("wplc_register_pro_version")) {
            wplc_pro_admin_menu_layout_display();
        } else {
            wplc_admin_menu_layout_display();
        }
    }
}
function wplc_first_time_tutorial() {
    if (!get_option('WPLC_FIRST_TIME_TUTORIAL')) {
        
        global $wplc_basic_plugin_url;
        ?>


        <div id="wplcftt" style='margin-top:30px; margin-bottom:20px; width: 65%; background-color: #FFF; box-shadow: 1px 1px 3px #ccc; display:block; padding:10px; text-align:center; margin-left:auto; margin-right:auto;'>
            <img src='<?php echo $wplc_basic_plugin_url; ?>/images/wplc_notification_icon.png' width="130" align="center" />
            <h1 style='font-weight: 300; font-size: 50px; line-height: 50px;'><strong style="color: #ec822c;"><?php _e("Congratulations","wplivechat"); ?></strong></h1>
            <h2><strong><?php _e("You are now accepting live chat requests on your site.","wplivechat"); ?></strong></h2>
            <p><?php _e("The live chat box has automatically been enabled on your website.","wplivechat"); ?></p>
            <p><?php _e("Chat notifications will start appearing once visitors send a request.","wplivechat"); ?></p>
            <p><?php _e("You may <a href='?page=wplivechat-menu-settings' target='_BLANK'>modify your chat box settings here.","wplivechat"); ?></a></p>
            <p><?php _e("Experiencing issues?","wplivechat"); ?> <a href="http://wp-livechat.com/documentation/troubleshooting/" target="_BLANK" title=""><?php _e("Visit our troubleshooting section.","wplivechat"); ?></a></p>
            
            <p><button id="wplc_close_ftt" class="button button-secondary"><?php _e("Hide","wplivechat"); ?></button></p>
            
        </div>
        
    <?php }
}

function wplc_admin_menu_layout_display() {
    if(current_user_can('wplc_ma_agent') || current_user_can('manage_options')){
        global $wplc_basic_plugin_url;
        if (!isset($_GET['action'])) {
            ?>
        <style>
                #wplc-support-tabs a.wplc-support-link {
            background: url('<?php echo $wplc_basic_plugin_url; ?>/images/support.png');
            right: 0px;
            top: 250px;
            height: 108px;
            width: 45px;
            margin: 0;
            padding: 0;
            position: fixed;
            z-index: 9999;
            display:block;
        }
        </style>

            <div id="wplc-support-tabs">
                <a class="wplc-support-link wplc-rotate" href="?page=wplivechat-menu-support-page"></a>
            </div>
            <div class='wplc_page_title'>
                <h1><?php _e("Chat Dashboard", "wplivechat"); ?></h1>
                <?php wplc_first_time_tutorial(); ?>

                <p><?php _e("Please note: This window must be open in order to receive new chat notifications.", "wplivechat"); ?></p>
            </div>
            
            <div id="wplc_sound"></div>

            <div id="wplc_admin_chat_holder">
                <div id='wplc_admin_chat_info_new'>
                    <div class='wplc_chat_vis_count_box'>
                        <span class='wplc_vis_online'>0</span>
                        <span style='text-transform:uppercase;'>
                            <?php _e("Visitors online","wplivechat"); ?>
                        </span>
                        <hr />
                        <p class='wplc-agent-info' id='wplc-agent-info'>
                            <span class='wplc_agents_online'>1</span>
                            <a href='javascript:void(0);'><?php _e("Agent(s) online","wplivechat"); ?></a>
                        </p>
                        
                    </div>
                    
                </div>
                
                <div id="wplc_admin_chat_area_new">
                    <div style="display:block;padding:10px;">
                    <ul class='wplc_chat_ul_header'>
                        <li><span class='wplc_header_vh wplc_headerspan_v'><?php _e("Visitor","wplivechat"); ?></span></li>
                        <li><span class='wplc_header_vh wplc_headerspan_t'><?php _e("Time","wplivechat"); ?></span></li>
                        <li><span class='wplc_header_vh wplc_headerspan_nr'><?php _e("Type","wplivechat"); ?></span></li>
                        <li><span class='wplc_header_vh wplc_headerspan_d'><?php _e("Data","wplivechat"); ?></span></li>
                        <li><span class='wplc_header_vh wplc_headerspan_s'><?php _e("Status","wplivechat"); ?></span></li>
                        <li><span class='wplc_header_vh wplc_headerspan_a'><?php _e("Action","wplivechat"); ?></span></li>
                    </ul>
                    <ul id='wplc_chat_ul'>


                    </ul>
                        <p>
            <?php _e("With the Pro add-on of WP Live Chat Support, you can", "wplivechat"); ?> 
            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate1" title="<?php _e("see who's online and initiate chats", "wplivechat"); ?>" target=\"_BLANK\">
               <?php _e("initiate chats", "wplivechat"); ?>
            </a> <?php _e("with your online visitors with the click of a button.", "wplivechat"); ?> 
            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate2" title="<?php _e("Buy the Pro add-on now for only $19.95 once off.", "wplivechat"); ?>" target=\"_BLANK\">
               <strong>
                   <?php _e("Buy the Pro add-on now for only $19.95 once off.", "wplivechat"); ?>
               </strong>
            </a>
            </p>
                    </div>

                </div>
                
            </div>
            
            
          

            <?php
        } else {
            if ($_GET['action'] == 'ac') {
                wplc_change_chat_status(sanitize_text_field($_GET['cid']), 3);
                if (function_exists('wplc_ma_register')) {
                    wplc_ma_update_agent_id(sanitize_text_field($_GET['cid']), sanitize_text_field($_GET['agent_id']));
                }
                if (function_exists("wplc_register_pro_version")) {
                    wplc_pro_draw_chat_area(sanitize_text_field($_GET['cid']));
                } else {
                    wplc_draw_chat_area(sanitize_text_field($_GET['cid']));
                }
            }
        }
    }
}

function wplc_draw_chat_area($cid) {

    global $wpdb;
    global $wplc_tblname_chats;
    $results = $wpdb->get_results(
            "
        SELECT *
        FROM $wplc_tblname_chats
        WHERE `id` = '$cid'
        LIMIT 1
        "
    );
    ?>
    <style>

        .wplc-clear-float-message{
            clear: both;
        }


    </style>
    <?php
    foreach ($results as $result) {
        $user_data = maybe_unserialize($result->ip);
        $user_ip = $user_data['ip'];
        $browser = wplc_return_browser_string($user_data['user_agent']);
        $browser_image = wplc_return_browser_image($browser, "16");
        global $wplc_basic_plugin_url;
        if ($result->status == 1) {
            $status = __("Previous", "wplivechat");
        } else {
            $status = __("Active", "wplivechat");
        }

        if($user_ip == ""){
            $user_ip = __('IP Address not recorded', 'wplivechat');
        } else {
            $user_ip = "<a href='http://www.ip-adress.com/ip_tracer/" . $user_ip . "' title='".__('Whois for' ,'wplivechat')." ".$user_ip."'>".$user_ip."</a>";
        } 
        
        echo "<h2>$status " . __('Chat with', 'wplivechat') . " " . $result->name . "</h2>";
        echo "<style>#adminmenuwrap { display:none; } #adminmenuback { display:none; } #wpadminbar { display:none; } #wpfooter { display:none; } .update-nag { display:none; }</style>";

        echo "<div class=\"end_chat_div\"><a href=\"javascript:void(0);\" class=\"wplc_admin_close_chat button\" id=\"wplc_admin_close_chat\">" . __("End chat", "wplivechat") . "</a></div>";

        echo "<div id='admin_chat_box'>";

        echo"<div class='admin_chat_box'><div class='admin_chat_box_inner' id='admin_chat_box_area_" . $result->id . "'>" . wplc_return_chat_messages($cid) . "</div><div class='admin_chat_box_inner_bottom'>" . wplc_return_chat_response_box($cid) . "</div></div>";
        echo "<div class='admin_visitor_info'>";
        echo "  <div style='float:left; width:100px;'><img src=\"//www.gravatar.com/avatar/" . md5($result->email) . "\" class=\"admin_chat_img\" /></div>";
        echo "  <div style='float:left;'>";

        echo "      <div class='admin_visitor_info_box1'>";
        echo "          <span class='admin_chat_name'>" . $result->name . "</span>";
        echo "          <span class='admin_chat_email'>" . $result->email . "</span>";
        echo "      </div>";
        echo "  </div>";

        echo "<div class='admin_visitor_advanced_info'>";
        echo "      <strong>" . __("Site Info", "wplivechat") . "</strong>";
        echo "      <hr />";
        echo "      <span class='part1'>" . __("Chat initiated on:", "wplivechat") . "</span> <span class='part2'>" . $result->url . "</span>";
        echo "</div>";

        echo "<div class='admin_visitor_advanced_info'>";
        echo "      <strong>" . __("Advanced Info", "wplivechat") . "</strong>";
        echo "      <hr />";
        echo "      <span class='part1'>" . __("Browser:", "wplivechat") . "</span><span class='part2'> $browser <img src='" . $wplc_basic_plugin_url . "/images/$browser_image' alt='$browser' title='$browser' /><br />";
        echo "      <span class='part1'>" . __("IP Address:", "wplivechat") . "</span><span class='part2'> ".$user_ip;
        echo "</div>";

        echo "  <div id=\"wplc_sound_update\"></div>";
        echo "</div>";

        if ($result->status != 1) {
            echo "<div class='admin_chat_quick_controls'>";
            echo "  <p style=\"text-align:left; font-size:11px;\">" . __('Press ENTER to send your message', 'wplivechat') . "</p>";
            echo "  " . __("Assign Quick Response", "wplivechat") . " <select name='wplc_macros_select' class='wplc_macros_select' disabled><option>" . __('Select', 'wplivechat') . "</option></select> <a href='http://wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=quick_resposnes' title='" . __('Add Quick Responses to your Live Chat', 'wplivechat') . "' target='_BLANK'>" . __("Pro version only", "wplivechat") . "</a>";
            echo "  </div>";
            echo "</div>";

            //echo wplc_return_admin_chat_javascript($_GET['cid']);
        }
    }
}

function wplc_return_chat_response_box($cid) {
    $ret = "<div class=\"chat_response_box\">";
    $ret .= "<input type='text' name='wplc_admin_chatmsg' id='wplc_admin_chatmsg' value='' placeholder='" . __("type here...", "wplivechat") . "' />";
    $ret .= "<input id='wplc_admin_cid' type='hidden' value='$cid' />";
    $ret .= "<input id='wplc_admin_send_msg' type='button' value='" . __("Send", "wplivechat") . "' style=\"display:none;\" />";
    $ret .= "</div>";
    return $ret;
}

function wplc_return_admin_chat_javascript($cid) {
    $ajax_nonce = wp_create_nonce("wplc");
    if (function_exists("wplc_pro_get_admin_picture")) {
        $src = wplc_pro_get_admin_picture();
        if ($src) {
            $image = "<img src=" . $src . " width='20px' id='wp-live-chat-2-img'/>";
        }
    }

    $wplc_settings = get_option("WPLC_SETTINGS");

    if (isset($wplc_settings['wplc_display_name']) && $wplc_settings['wplc_display_name'] == 1) {
        $display_name = 'display';
    } else {
        $display_name = 'hide';
    }
    if (isset($_COOKIE['wplc_email']) && $_COOKIE['wplc_email'] != "") {
        $wplc_user_email_address = sanitize_text_field($_COOKIE['wplc_email']);
    } else {
        $wplc_user_email_address = "";
    }
    ?>
    <script type="text/javascript">
        /* var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>'; */
        var wplc_ajaxurl = ajaxurl;
        var chat_status = 3;
        var cid = <?php echo $cid; ?>;
        var data = {
            action: 'wplc_admin_long_poll_chat',
            security: '<?php echo $ajax_nonce; ?>',
            cid: cid,
            chat_status: chat_status
        };
        var wplc_run = true;
        var wplc_display_name = '<?php echo $display_name; ?>';
        var wplc_user_email_address = '<?php echo $wplc_user_email_address; ?>';

        function wplc_call_to_server_admin_chat(data) {
            jQuery.ajax({
                url: wplc_ajaxurl,
                data: data,
                security: '<?php echo $ajax_nonce; ?>',
                type: "POST",
                success: function (response) {
                    if (response) {

                        response = JSON.parse(response);
                        if (response['action'] === "wplc_update_chat_status") {
                            data['chat_status'] = response['chat_status'];
                            wplc_display_chat_status_update(response['chat_status'], cid);
                        }
                        if (response['action'] === "wplc_new_chat_message") {
                            current_len = jQuery("#admin_chat_box_area_" + cid).html().length;
                            jQuery("#admin_chat_box_area_" + cid).append(response['chat_message']);
                            new_length = jQuery("#admin_chat_box_area_" + cid).html().length;
                            if (current_len < new_length) {
                                document.getElementById("wplc_sound_update").innerHTML = "<embed src='<?php echo plugins_url('/ding.mp3', __FILE__); ?>' hidden=true autostart=true loop=false>";
                            }
                            var height = jQuery('#admin_chat_box_area_' + cid)[0].scrollHeight;
                            jQuery('#admin_chat_box_area_' + cid).scrollTop(height);
                        }
                        if (response['action'] === "wplc_user_open_chat") {
                            data['action_2'] = "";
    <?php $url = admin_url('admin.php?page=wplivechat-menu&action=ac&cid=' . $cid); ?>
                            window.location.replace('<?php echo $url; ?>');
                        }

                    }
                },
                error: function (jqXHR, exception) {
                    if (jqXHR.status == 404) {
                        console.log('Requested page not found. [404]');
                        wplc_run = false;
                    } else if (jqXHR.status == 500) {
                        console.log('Internal Server Error [500].');
                        wplc_run = false;
                    } else if (exception === 'parsererror') {
                        console.log('Requested JSON parse failed.');
                        wplc_run = false;
                    } else if (exception === 'abort') {
                        console.log('Ajax request aborted.');
                        wplc_run = false;
                    } else {
                        console.log('Uncaught Error.\n' + jqXHR.responseText);
                        wplc_run = false;
                    }
                },
                complete: function (response) {
                    //console.log(wplc_run);
                    if (wplc_run) {
                        wplc_call_to_server_admin_chat(data);
                    }
                },
                timeout: 120000
            });
        }
        ;

        function wplc_display_chat_status_update(new_chat_status, cid) {
            if (new_chat_status === "0") {
            } else {
                if (chat_status !== new_chat_status) {
                    previous_chat_status = chat_status;
                    //console.log("previous chat status: "+previous_chat_status);
                    chat_status = new_chat_status;
                    //console.log("chat status: "+chat_status);

                    if ((previous_chat_status === "2" && chat_status === "3") || (previous_chat_status === "5" && chat_status === "3")) {
                        jQuery("#admin_chat_box_area_" + cid).append("<em><?php _e("User has opened the chat window", "wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_' + cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_' + cid).scrollTop(height);

                    } else if (chat_status == "10" && previous_chat_status == "3") {
                        jQuery("#admin_chat_box_area_" + cid).append("<em><?php _e("User has minimized the chat window", "wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_' + cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_' + cid).scrollTop(height);
                    }
                    else if (chat_status === "3" && previous_chat_status === "10") {
                        jQuery("#admin_chat_box_area_" + cid).append("<em><?php _e("User has maximized the chat window", "wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_' + cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_' + cid).scrollTop(height);
                    }
                    else if (chat_status === "1" || chat_status === "8") {
                        jQuery("#admin_chat_box_area_" + cid).append("<em><?php _e("User has closed and ended the chat", "wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_' + cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_' + cid).scrollTop(height);
                        document.getElementById('wplc_admin_chatmsg').disabled = true;
                    }
                }
            }
        }



        jQuery(document).ready(function () {

            var wplc_image = "<?php if (isset($image)) {
        echo $image;
    } else {
        echo "";
    } ?>";
            /* var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>'; */
            var wplc_ajaxurl = ajaxurl;


            jQuery("#wplc_admin_chatmsg").focus();




            wplc_call_to_server_admin_chat(data);

            if (jQuery('#wplc_admin_cid').length) {
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var height = jQuery('#admin_chat_box_area_' + wplc_cid)[0].scrollHeight;
                jQuery('#admin_chat_box_area_' + wplc_cid).scrollTop(height);
            }

            jQuery(".wplc_admin_accept").on("click", function () {
                wplc_title_alerts3 = setTimeout(function () {
                    document.title = "WP Live Chat Support";
                }, 2500);
                var cid = jQuery(this).attr("cid");

                var data = {
                    action: 'wplc_admin_accept_chat',
                    cid: cid,
                    security: '<?php echo $ajax_nonce; ?>'
                };
                jQuery.post(wplc_ajaxurl, data, function (response) {
                    //console.log("wplc_admin_accept_chat");
                    wplc_refresh_chat_boxes[cid] = setInterval(function () {
                        wpcl_admin_update_chat_box(cid);
                    }, 3000);
                    jQuery("#admin_chat_box_" + cid).show();
                });
            });

            jQuery("#wplc_admin_chatmsg").keyup(function (event) {
                if (event.keyCode == 13) {
                    jQuery("#wplc_admin_send_msg").click();
                }
            });

            jQuery("#wplc_admin_close_chat").on("click", function () {
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var data = {
                    action: 'wplc_admin_close_chat',
                    security: '<?php echo $ajax_nonce; ?>',
                    cid: wplc_cid

                };
                jQuery.post(wplc_ajaxurl, data, function (response) {
                    //console.log("wplc_admin_close_chat");
                    //console.log(response);
                    window.close();
                });

            });

            function wplc_strip(str) {
                str=str.replace(/<br>/gi, "\n");
                str=str.replace(/<p.*>/gi, "\n");
                str=str.replace(/<a.*href="(.*?)".*>(.*?)<\/a>/gi, " $2 ($1) ");
                str=str.replace(/<(?:.|\s)*?>/g, "");

                str=str.replace('iframe', "");    
                str=str.replace('src', "");    
                str=str.replace('href', "");  
                str=str.replace('<', "");  
                str=str.replace('>', "");  

                return str;
            }
            
            jQuery("#wplc_admin_send_msg").on("click", function () {
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var wplc_chat = wplc_strip(document.getElementById('wplc_admin_chatmsg').value);
                var wplc_name = "a" + "d" + "m" + "i" + "n";
                jQuery("#wplc_admin_chatmsg").val('');

                if (wplc_display_name == 'display') {
                    jQuery("#admin_chat_box_area_" + wplc_cid).append("<span class='wplc-admin-message'>" + wplc_image + " <strong>" + wplc_name + "</strong>:<hr/ style='margin-bottom: 0px;'>" + wplc_chat + "</span><br /><div class='wplc-clear-float-message'></div>");
                } else {
                    jQuery("#admin_chat_box_area_" + wplc_cid).append("<span class='wplc-admin-message'>" + wplc_chat + "</span><br /><div class='wplc-clear-float-message'></div>");
                }
                var height = jQuery('#admin_chat_box_area_' + wplc_cid)[0].scrollHeight;
                jQuery('#admin_chat_box_area_' + wplc_cid).scrollTop(height);


                var data = {
                    action: 'wplc_admin_send_msg',
                    security: '<?php echo $ajax_nonce; ?>',
                    cid: wplc_cid,
                    msg: wplc_chat
                };
                jQuery.post(wplc_ajaxurl, data, function (response) {
                    //console.log("wplc_admin_send_msg");

                    /* do nothing
                     jQuery("#admin_chat_box_area_"+wplc_cid).html(response);
                     var height = jQuery('#admin_chat_box_area_'+wplc_cid)[0].scrollHeight;
                     jQuery('#admin_chat_box_area_'+wplc_cid).scrollTop(height);
                     */
                });


            });







        });
    </script>
    <?php
}

function wplc_activate() {
    wplc_handle_db();
    if (!get_option("WPLC_SETTINGS")) {
        $wplc_alt_text = __("Please click \'Start Chat\' to initiate a chat with an agent", "wplivechat");
        add_option('WPLC_SETTINGS', array(
            "wplc_settings_align" => "2",
            "wplc_settings_enabled" => "1",
            "wplc_settings_fill" => "ed832f",
            "wplc_settings_font" => "FFFFFF",
            "wplc_require_user_info" => '1',
            "wplc_loggedin_user_info" => '1',
            "wplc_user_alternative_text" => $wplc_alt_text,
            "wplc_enabled_on_mobile" => '1',
            "wplc_display_name" => '1',
            "wplc_record_ip_address" => '1'
        ));
    }
    add_option("WPLC_HIDE_CHAT", "true");
    add_option("WPLC_FIRST_TIME", true);
}

function wplc_handle_db() {
    global $wpdb;
    global $wplc_version;
    global $wplc_tblname_chats;
    global $wplc_tblname_msgs;

    $sql = "
        CREATE TABLE " . $wplc_tblname_chats . " (
          id int(11) NOT NULL AUTO_INCREMENT,
          timestamp datetime NOT NULL,
          name varchar(700) NOT NULL,
          email varchar(700) NOT NULL,
          ip varchar(700) NOT NULL,
          status int(11) NOT NULL,
          session varchar(100) NOT NULL,
          url varchar(700) NOT NULL,
          last_active_timestamp datetime NOT NULL,
          other LONGTEXT NOT NULL,
          PRIMARY KEY  (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

    $sql = '
        CREATE TABLE ' . $wplc_tblname_msgs . ' (
          id int(11) NOT NULL AUTO_INCREMENT,
          chat_sess_id int(11) NOT NULL,
          `from` varchar(150) CHARACTER SET utf8 NOT NULL,
          msg varchar(700) CHARACTER SET utf8 NOT NULL,
          timestamp datetime NOT NULL,
          status INT(3) NOT NULL,
          originates INT(3) NOT NULL,
          PRIMARY KEY  (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ';

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    @dbDelta($sql);

    add_option("wplc_db_version", $wplc_version);
    update_option("wplc_db_version", $wplc_version);
}

function wplc_add_user_stylesheet() {

    if(function_exists('wplc_display_chat_contents')){
        $show_chat_contents = wplc_display_chat_contents();
    } else {
        $show_chat_contents = 1;
    }
    if($show_chat_contents >= 1){
        wp_register_style('wplc-font-awesome', plugins_url('/css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('wplc-font-awesome');
        wp_register_style('wplc-style', plugins_url('/css/wplcstyle.css', __FILE__));
        wp_enqueue_style('wplc-style');
    }
    if(function_exists('wplc_ce_activate')){
        if(function_exists('wplc_ce_load_user_styles')){
            wplc_ce_load_user_styles();
        }
    }
}

function wplc_add_admin_stylesheet() {
    if (isset($_GET['page']) && ($_GET['page'] == 'wplivechat-menu' || $_GET['page'] == 'wplivechat-menu-settings' || $_GET['page'] == 'wplivechat-menu-offline-messages' || $_GET['page'] == 'wplivechat-menu-history')) {
        wp_register_style('wplc-admin-style', plugins_url('/css/jquery-ui.css', __FILE__));
        wp_enqueue_style('wplc-admin-style');
        wp_register_style('wplc-chat-style', plugins_url('/css/chat-style.css', __FILE__));
        wp_enqueue_style('wplc-chat-style');
        wp_register_style('wplc-font-awesome', plugins_url('/css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('wplc-font-awesome');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-effects-core');
        
        

    }
    if (isset($_GET['page']) && $_GET['page'] == "wplivechat-menu-support-page") {
        wp_register_style('fontawesome', plugins_url('css/font-awesome.min.css', __FILE__));
        wp_enqueue_style('fontawesome');
        wp_register_style('wplc-support-page-css', plugins_url('css/support-css.css', __FILE__));
        wp_enqueue_style('wplc-support-page-css');
    }
}

if (isset($_GET['page']) && $_GET['page'] == 'wplivechat-menu-settings') {
    add_action('admin_print_scripts', 'wplc_admin_scripts_basic');
}

function wplc_admin_scripts_basic() {

    if (isset($_GET['page']) && $_GET['page'] == "wplivechat-menu-settings") {
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-tooltip'); 
        wp_register_script('my-wplc-color', plugins_url('js/jscolor.js', __FILE__), false, '1.4.1', false);
        wp_enqueue_script('my-wplc-color');
        wp_enqueue_script('jquery-ui-tabs');
        wp_register_script('my-wplc-tabs', plugins_url('js/wplc_tabs.js', __FILE__), array('jquery-ui-core'), '', true);
        wp_enqueue_script('my-wplc-tabs');
    }
}

function wplc_admin_settings_layout() {
    wplc_settings_page_basic();
}

function wplc_admin_history_layout() {
    echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>" . __("WP Live Chat History", "wplivechat") . "</h2>";
    
    if(function_exists("wplc_ce_activate")){
        wplc_ce_admin_display_history();
    } else if (function_exists("wplc_register_pro_version")) {
        wplc_pro_admin_display_history();
    } else {
        echo "<br /><br >" . __('This option is only available in the ', 'wplivechat') . "<a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history1\" title=\"" . __("Pro Add-on", "wplivechat") . "\" target=\"_BLANK\">" . __('Pro Add-on', 'wplivechat') . "</a> of WP Live Chat. <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history2\" title=\"" . __("Pro Add-on", "wplivechat") . "\" target=\"_BLANK\">" . __('Get it now for only $19.95', 'wplivechat') . "</a>";
    }
}

function wplc_admin_missed_chats() {
    echo "<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>" . __("WP Live Chat Missed Chats", "wplivechat") . "</h2>";
    if (function_exists('wplc_admin_display_missed_chats')) {
        wplc_admin_display_missed_chats();
    }
}

function wplc_admin_offline_messages() {
    echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>" . __("WP Live Chat Offline Messages", "wplivechat") . "</h2>";
    if (function_exists("wplc_register_pro_version")) {
        if (function_exists('wplc_pro_admin_display_offline_messages')) {
            wplc_pro_admin_display_offline_messages();
        } else {
            echo "<div class='updated'><p>" . __('Please update to the latest version of WP Live Chat Support Pro to start recording any offline messages.', 'wplivechat') . "</p></div>";
        }
    } else {
        echo "<br /><br >" . _('This option is only available in the ', 'wplivechat') . "<a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history1\" title=\"" . __("Pro Add-on", "wplivechat") . "\" target=\"_BLANK\">" . __('Pro Add-on', 'wplivechat') . "</a> of WP Live Chat. <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=missed_chats2\" title=\"" . __("Pro Add-on", "wplivechat") . "\" target=\"_BLANK\">" . __('Get it now for only $19.95.', 'wplivechat') . "</a>";
    }
}

function wplc_settings_page_basic() {

    



    if (function_exists("wplc_register_pro_version")) {
        wplc_settings_page_pro();
    } else {
        include 'includes/settings_page.php';
    }
}

function wplc_head_basic() {
    global $wpdb;

    if (isset($_POST['wplc_save_settings'])) {

        if (isset($_POST['wplc_settings_align'])) {
            $wplc_data['wplc_settings_align'] = esc_attr($_POST['wplc_settings_align']);
        }
        if (isset($_POST['wplc_settings_fill'])) {
            $wplc_data['wplc_settings_fill'] = esc_attr($_POST['wplc_settings_fill']);
        }
        if (isset($_POST['wplc_settings_font'])) {
            $wplc_data['wplc_settings_font'] = esc_attr($_POST['wplc_settings_font']);
        }
        if (isset($_POST['wplc_settings_enabled'])) {
            $wplc_data['wplc_settings_enabled'] = esc_attr($_POST['wplc_settings_enabled']);
        }
        if (isset($_POST['wplc_auto_pop_up'])) {
            $wplc_data['wplc_auto_pop_up'] = esc_attr($_POST['wplc_auto_pop_up']);
        }
        if (isset($_POST['wplc_require_user_info'])) {
            $wplc_data['wplc_require_user_info'] = esc_attr($_POST['wplc_require_user_info']);
        }
        if (isset($_POST['wplc_loggedin_user_info'])) {
            $wplc_data['wplc_loggedin_user_info'] = esc_attr($_POST['wplc_loggedin_user_info']);
        }
        if (isset($_POST['wplc_user_alternative_text']) && $_POST['wplc_user_alternative_text'] != '') {
            $wplc_data['wplc_user_alternative_text'] = esc_attr($_POST['wplc_user_alternative_text']);
        } else {
            $wplc_data['wplc_user_alternative_text'] = __("Please click 'Start Chat' to initiate a chat with an agent", "wplivechat");
        }
        if (isset($_POST['wplc_enabled_on_mobile'])) {
            $wplc_data['wplc_enabled_on_mobile'] = esc_attr($_POST['wplc_enabled_on_mobile']);
        }
        if (isset($_POST['wplc_display_name'])) {
            $wplc_data['wplc_display_name'] = esc_attr($_POST['wplc_display_name']);
        }
        if (isset($_POST['wplc_display_to_loggedin_only'])) {
            $wplc_data['wplc_display_to_loggedin_only'] = esc_attr($_POST['wplc_display_to_loggedin_only']);
        }
        
        if(isset($_POST['wplc_record_ip_address'])){
            $wplc_data['wplc_record_ip_address'] = esc_attr($_POST['wplc_record_ip_address']);
        }
        
        if(isset($_POST['wplc_ban_users_ip'])){
            $wplc_banned_ip_addresses = explode('<br />', nl2br($_POST['wplc_ban_users_ip']));
            foreach($wplc_banned_ip_addresses as $key => $value) {
                $data[$key] = trim($value);
            }
            $wplc_banned_ip_addresses = maybe_serialize(sanitize_text_field($data));

            update_option('WPLC_BANNED_IP_ADDRESSES', $wplc_banned_ip_addresses);
        }

        update_option('WPLC_SETTINGS', $wplc_data);
        if (isset($_POST['wplc_hide_chat'])) {
            update_option("WPLC_HIDE_CHAT", esc_attr($_POST['wplc_hide_chat']));
        }



        echo "<div class='updated'>";
        _e("Your settings have been saved.", "wplivechat");
        echo "</div>";
    }
    if (isset($_POST['action']) && $_POST['action'] == "wplc_submit_find_us") {
        if (function_exists('curl_version')) {
            $request_url = "http://www.wp-livechat.com/apif/rec.php";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $request_url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
            curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $output = curl_exec($ch);
            curl_close($ch);
        }
        echo "<div class=\"updated\"><p>" . __("Thank You for your feedback!", "wplivechat") . "</p></div>";
    }
    if (isset($_POST['wplc_nl_send_feedback'])) {
        if (wp_mail("nick@wp-livechat.com", "Plugin feedback", "Name: " . $_POST['wplc_nl_feedback_name'] . "\n\r" . "Email: " . $_POST['wplc_nl_feedback_email'] . "\n\r" . "Website: " . $_POST['wplc_nl_feedback_website'] . "\n\r" . "Feedback:" . $_POST['wplc_nl_feedback_feedback'])) {
            echo "<div id=\"message\" class=\"updated\"><p>" . __("Thank you for your feedback. We will be in touch soon", "wplc") . "</p></div>";
        } else {

            if (function_exists('curl_version')) {
                $request_url = "http://www.wp-livechat.com/apif/rec_feedback.php";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $request_url);
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
                curl_setopt($ch, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                $output = curl_exec($ch);
                curl_close($ch);
                echo "<div id=\"message\" class=\"updated\"><p>" . __("Thank you for your feedback. We will be in touch soon", "wplc") . "</p></div>";
            } else {
                echo "<div id=\"message\" class=\"error\">";
                echo "<p>" . __("There was a problem sending your feedback. Please log your feedback on ", "wplc") . "<a href='http://wp-livechat.com/forums/forum/support/' target='_BLANK'>http://wp-livechat.com/forums/forum/support/</a></p>";
                echo "</div>";
            }
        }
    }
}

function wplc_logout() {
    delete_transient('wplc_is_admin_logged_in');
}

add_action('wp_logout', 'wplc_logout');

function wplc_get_home_path() {
    $home = get_option('home');
    $siteurl = get_option('siteurl');
    if (!empty($home) && 0 !== strcasecmp($home, $siteurl)) {
        $wp_path_rel_to_home = str_ireplace($home, '', $siteurl); /* $siteurl - $home */
        $pos = strripos(str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME']), trailingslashit($wp_path_rel_to_home));
        $home_path = substr($_SERVER['SCRIPT_FILENAME'], 0, $pos);
        $home_path = trailingslashit($home_path);
    } else {
        $home_path = ABSPATH;
    }
    return str_replace('\\', '/', $home_path);
}

/* Error Checks */
if(isset($_GET['page']) && $_GET['page'] == 'wplivechat-menu-settings'){
    if(is_admin()){
        $wplc_error_count = 0;
        $wplc_admin_warnings = "<div class='error'>";
        if(!function_exists('set_time_limit')){    
            $wplc_admin_warnings .= "
                <p>".__("WPLC: set_time_limit() is not enabled on this server. You may experience issues while using WP Live Chat Support as a result of this. Please get in contact your host to get this function enabled.", "wplivechat")."</p>
            ";
            $wplc_error_count++;        
        }
        if(ini_get('safe_mode')){
            $wplc_admin_warnings .= "
                <p>".__("WPLC: Safe mode is enabled on this server. You may experience issues while using WP Live Chat Support as a result of this. Please contact your host to get safe mode disabled.", "wplivechat")."</p>
            ";
            $wplc_error_count++;
        }
        $wplc_admin_warnings .= "</div>";
        if($wplc_error_count > 0){
            echo $wplc_admin_warnings;
        }
    }
}

function wplc_support_menu() {
?>   
    <h1><?php _e("WP Live Chat Support","wplivechat"); ?></h1>
    <div class="wplc_row">
        <div class='wplc_row_col' style='background-color:#FFF;'>
            <h2><i class="fa fa-book fa-2x"></i> <?php _e("Documentation","wplivechat"); ?></h2>
            <hr />
            <p><?php _e("Getting started? Read through some of these articles to help you along your way.","wplivechat"); ?></p>
            <p><strong><?php _e("Documentation:","wplivechat"); ?></strong></p>
            <ul>
                <li><a href='http://wp-livechat.com/documentation/minimum-system-requirements/' target='_BLANK' title='<?php _e("Minimum System Requirements","wplivechat"); ?>'><?php _e("Minimum System Requirements","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/do-i-have-to-be-logged-into-the-dashboard-to-chat-with-visitors/' target='_BLANK' title='<?php _e("Do I have to be logged into the dashboard to chat with visitors?","wplivechat"); ?>'><?php _e("Do I have to be logged into the dashboard to chat with visitors?","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/what-are-quick-responses/' target='_BLANK' title='<?php _e("What are Quick Responses?","wplivechat"); ?>'><?php _e("What are Quick Responses?","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/troubleshooting/is-this-plugin-multi-site-friendly/' target='_BLANK' title='<?php _e("Can I use this plugin on my multi-site?","wplivechat"); ?>'><?php _e("Can I use this plugin on my multi-site?","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/how-do-i-disable-apc-object-cache/' target='_BLANK' title='<?php _e("How do I disable APC Object Cache?","wplivechat"); ?>'><?php _e("How do I disable APC Object Cache?","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/do-you-have-a-mobile-app/' target='_BLANK' title='<?php _e("Do you have a mobile app?","wplivechat"); ?>'><?php _e("Do you have a mobile app?","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/how-do-i-check-for-javascript-errors-on-my-site/' target='_BLANK' title='<?php _e("How do I check for JavaScript errors on my site?","wplivechat"); ?>'><?php _e("How do I check for JavaScript errors on my site?","wplivechat"); ?></a></li>
            </ul>
        </div>
        <div class='wplc_row_col' style='background-color:#FFF;'>
            <h2><i class="fa fa-exclamation-circle fa-2x"></i> <?php _e("Troubleshooting","wplivechat"); ?></h2>
            <hr />
            <p><?php _e("WP Live Chat Support  has a diverse and wide range of features which may, from time to time, run into conflicts with the thousands of themes and other plugins on the market.", "wplivechat"); ?></p>
            <p><strong><?php _e("Common issues:","wplivechat"); ?></strong></p>
            <ul>
                <li><a href='http://wp-livechat.com/documentation/troubleshooting/the-chat-box-doesnt-show-up/' target='_BLANK' title='<?php _e("The chat box doesnt show up","wplivechat"); ?>'><?php _e("The chat box doesnt show up","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/the-chat-window-disappears-when-i-logout-or-go-offline/' target='_BLANK' title='<?php _e("The chat window disappears when I logout or go offline","wplivechat"); ?>'><?php _e("The chat window disappears when I logout or go offline","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/this-chat-has-already-been-answered-please-close-the-chat-window/' target='_BLANK' title='<?php _e("This chat has already been answered. Please close the chat window","wplivechat"); ?>'><?php _e("This chat has already been answered. Please close the chat window","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/messages-only-show-when-i-refresh-the-chat-window/' target='_BLANK' title='<?php _e("Messages only show when I refresh the chat window","wplivechat"); ?>'><?php _e("Messages only show when I refresh the chat window","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/documentation/im-not-getting-any-notifications-of-a-new-chat/' target='_BLANK' title='<?php _e("I'm not getting any notifications of a new chat","wplivechat"); ?>'><?php _e("I'm not getting any notifications of a new chat","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/the-chat-window-never-goes-offline/' target='_BLANK' title='<?php _e("The chat window never goes offline","wplivechat"); ?>'><?php _e("The chat window never goes offline","wplivechat"); ?></a></li>
            </ul>
        </div>
        <div class='wplc_row_col' style='background-color:#FFF;'>
            <h2><i class="fa fa-bullhorn fa-2x"></i> <?php _e("Support","wplivechat"); ?></h2>
            <hr />
            <p><?php _e("Still need help? Use one of these links below.","wplivechat"); ?></p>
            <ul>
                <li><a href='http://wp-livechat.com/forums/forum/support/' target='_BLANK' title='<?php _e("Support forum","wplivechat"); ?>'><?php _e("Support forum","wplivechat"); ?></a></li>
                <li><a href='http://wp-livechat.com/contact-us/' target='_BLANK' title='<?php _e("Contact us","wplivechat"); ?>'><?php _e("Contact us","wplivechat"); ?></a></li>
            </ul>
        </div>
    </div>
<?php
}
if (!function_exists("wplc_pro_version_control")) {
    add_action('admin_enqueue_scripts', 'wp_button_pointers_load_scripts');
}
function wp_button_pointers_load_scripts($hook) {
    
    if( $hook != 'toplevel_page_wplivechat-menu') {return;}   // stop if we are not on the right page

    
    $pointer_localize_strings = array(
      "initiate" => "<h3>".__("Initiate Chats","wplivechat")."</h3><p>".__("With the Pro add-on of WP Live Chat Support, you can", "wplivechat")." <a href='http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate1_pointer' title='".__("see who's online and initiate chats", "wplivechat")."' target=\"_BLANK\">".__("initiate chats", "wplivechat")."</a> ".__("with your online visitors with the click of a button.", "wplivechat")." <br /><br /><a href='http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate2_pointer' title='".__("Buy the Pro add-on now for only $19.95 once off.", "wplivechat")."' target=\"_BLANK\"><strong>".__("Buy the Pro add-on now for only $19.95 once off.", "wplivechat")."</strong></a></p>",
      "chats" => "<h3>".__("Multiple Chats","wplivechat")."</h3><p>".__("With the Pro add-on of WP Live Chat Support, you can", "wplivechat")." <a href='http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=morechats1_pointer' title='".__("accept and handle multiple chats.", "wplivechat")."' target=\"_BLANK\">".__("accept and handle multiple chats.", "wplivechat")."</a><br /><br /><a href='http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=morechats2_pointer' title='".__("Buy the Pro add-on now for only $19.95 once off.", "wplivechat")."' target=\"_BLANK\"><strong>".__("Buy the Pro add-on now for only $19.95 once off.", "wplivechat")."</strong></a></p>",
      "agent_info" => "<h3>".__("Add unlimited agents","wplivechat")."</h3><p><a href='http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=unlimited_agents1_pointer' title='".__("Add unlimited agents", "wplivechat")."' target=\"_BLANK\">".__("Add unlimited agents", "wplivechat")."</a> ".__(" with the Pro add-on of WP Live Chat Support","wplivechat")." "."<a href='http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=unlimited_agents2_pointer' target='_BLANK'>".__("for only $19.95 once off.","wplivechat")."</a></p>"
    ); 
    
    
    wp_enqueue_style( 'wp-pointer' );
    wp_enqueue_script( 'wp-pointer' );
    wp_register_script('wplc-user-admin-pointer', plugins_url('/js/wplc-admin-pointers.js', __FILE__), array('wp-pointer'));
    wp_enqueue_script('wplc-user-admin-pointer');
    wp_localize_script('wplc-user-admin-pointer', 'pointer_localize_strings', $pointer_localize_strings);
    
}