<?php
/*
Plugin Name: WP Live Chat Support
Plugin URI: http://www.wp-livechat.com
Description: The easiest to use website live chat plugin. Let your visitors chat with you and increase sales conversion rates with WP Live Chat Support. No third party connection required!
Version: 4.1.7
Author: WP-LiveChat
Author URI: http://www.wp-livechat.com
*/


/* 4.1.7
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
$wplc_version = "4.1.7";

define('WPLC_BASIC_PLUGIN_DIR',dirname(__FILE__));
define('WPLC_BASIC_PLUGIN_URL',plugins_url()."/wp-live-chat-support/");
global $wplc_basic_plugin_url;
$wplc_basic_plugin_url = get_option('siteurl')."/wp-content/plugins/wp-live-chat-support/";
require_once (plugin_dir_path( __FILE__ )."functions.php");
add_action('wp_ajax_wplc_admin_set_transient', 'wplc_action_callback');
add_action('init','wplc_version_control');
add_action('wp_footer', 'wplc_display_box');

add_action('init','wplc_init');

if (function_exists('wplc_head_pro')) {
    add_action('admin_head', 'wplc_head_pro');
} else { 
    add_action('admin_head', 'wplc_head_basic');
}


add_action('wp_enqueue_scripts', 'wplc_add_user_stylesheet' );
add_action('admin_enqueue_scripts', 'wplc_add_admin_stylesheet');

if(function_exists('wplc_admin_menu_pro')){
    add_action('admin_menu', 'wplc_admin_menu_pro');
} else {
    add_action('admin_menu', 'wplc_admin_menu');
}
add_action('admin_head', 'wplc_superadmin_javascript');
register_activation_hook( __FILE__, 'wplc_activate' );

function wplc_basic_check(){
    // check if basic exists if pro is installed
}
function wplc_init() {
    $plugin_dir = basename(dirname(__FILE__))."/languages/";
    load_plugin_textdomain( 'wplivechat', false, $plugin_dir );
}


function wplc_version_control() {
    global $wplc_version;
    

    $current_version = get_option("wplc_current_version");
    if (!isset($current_version) || $current_version != $wplc_version) {
        wplc_handle_db();
        update_option("wplc_current_version",$wplc_version);
        
    }
    
    
}
function wplc_action_callback() {
    global $wpdb;
    global $wplc_tblname_chats;
    $check = check_ajax_referer( 'wplc', 'security' );

    if ($check == 1) {
        if ($_POST['action'] == "wplc_admin_set_transient") {
            set_transient("wplc_is_admin_logged_in", "1", 70 );

        }
    }
    die(); // this is required to return a proper result

}


function wplc_feedback_page_include(){
    include 'includes/feedback-page.php';
}

function wplc_admin_menu() {
    $wplc_mainpage = add_menu_page('WP Live Chat', __('Live Chat','wplivechat'), 'manage_options', 'wplivechat-menu', 'wplc_admin_menu_layout');
    add_submenu_page('wplivechat-menu', __('Settings','wplivechat'), __('Settings','wplivechat'), 'manage_options' , 'wplivechat-menu-settings', 'wplc_admin_settings_layout');
    add_submenu_page('wplivechat-menu', __('History','wplivechat'), __('History','wplivechat'), 'manage_options' , 'wplivechat-menu-history', 'wplc_admin_history_layout');
    add_submenu_page('wplivechat-menu', __('Feedback','wplivechat'), __('Feedback','wplivechat'), 'manage_options' , 'wplivechat-menu-feedback-page', 'wplc_feedback_page_include');
}
add_action('wp_head','wplc_user_top_js');
function wplc_user_top_js() {
    echo "<!-- DEFINING DO NOT CACHE -->";
    define('DONOTCACHEPAGE', true);
    define('DONOTCACHEDB', true);
    $ajax_nonce = wp_create_nonce("wplc");
    wp_register_script( 'wplc-user-jquery-cookie', plugins_url('/js/jquery-cookie.js', __FILE__) , array('jquery-ui-draggable'));
    wp_enqueue_script( 'wplc-user-jquery-cookie');
    $wplc_settings = get_option("WPLC_SETTINGS");
    
?>

<script type="text/javascript">
    <?php if (!function_exists("wplc_register_pro_version")) { ?>
    var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>';
    
    <?php } ?>
   var wplc_nonce = '<?php echo $ajax_nonce; ?>';
</script>
<?php


}

function wplc_draw_user_box() {
    $wplc_settings = get_option("WPLC_SETTINGS");
    if ($wplc_settings["wplc_settings_enabled"] == 2) { return; }

    
    wp_register_script( 'wplc-user-script', plugins_url('/js/wplc_u.js', __FILE__) );
    wp_enqueue_script( 'wplc-user-script' );
    wp_localize_script('wplc-user-script', 'wplc_hide_chat', null);
    wp_localize_script('wplc-user-script', 'wplc_plugin_url', plugins_url());
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-draggable');
    wplc_output_box();

}
function wplc_output_box() {
    
    $wplc_class = "";
    $wplc_settings = get_option("WPLC_SETTINGS");
    if ($wplc_settings["wplc_settings_enabled"] == 2) { return; }

    if ($wplc_settings["wplc_settings_align"] == 1) { 
        $original_pos = "bottom_left";
        $wplc_box_align = "left:100px; bottom:0px;"; 
        
    } else if ($wplc_settings["wplc_settings_align"] == 2){ 
        $original_pos = "bottom_right";
        $wplc_box_align = "right:100px; bottom:0px;"; 
        
    } else if($wplc_settings["wplc_settings_align"] == 3){
        $original_pos = "left";
        $wplc_box_align = "left:0; bottom:100px;";
        $wplc_class = "wplc_left";
    } else if($wplc_settings["wplc_settings_align"] == 4){
        $original_pos = "right";
        $wplc_box_align = "right:0; bottom:100px;";
        $wplc_class = "wplc_right";
    }
    if ($wplc_settings["wplc_settings_fill"]) { $wplc_settings_fill = "#".$wplc_settings["wplc_settings_fill"]; } else {  $wplc_settings_fill = "#ed832f"; }
    if ($wplc_settings["wplc_settings_font"]) { $wplc_settings_font = "#".$wplc_settings["wplc_settings_font"]; } else {  $wplc_settings_font = "#FFFFFF"; }

    $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
    if (!function_exists("wplc_register_pro_version") && $wplc_is_admin_logged_in != 1) {
        return "";
    }  
    
?>    
<div id="wp-live-chat" style="display:none; <?php echo $wplc_box_align; ?>; " class="<?php echo $wplc_class ?> wplc_close" original_pos="<?php echo $original_pos ?>" wplc-auto-pop-up="<?php if (isset($wplc_settings['wplc_auto_pop_up'])) { echo $wplc_settings['wplc_auto_pop_up']; } ?>">

    
    <?php if (function_exists("wplc_register_pro_version")) {
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
            
            <div>

                <div id="wp-live-chat-2" style="display:none;">

                    <div id="wp-live-chat-2-info">
                       <strong>Start Live Chat</strong> 
                    </div>

                        <input type="text" name="wplc_name" id="wplc_name" value="" placeholder="<?php _e("Name","wplivechat"); ?>" />

                        <input type="text" name="wplc_email" id="wplc_email" value="" placeholder="<?php _e("Email","wplivechat"); ?>"  />

                        <input id="wplc_start_chat_btn" type="button" value="<?php _e("Start Chat","wplivechat"); ?>" style="background-color: <?php echo $wplc_settings_fill; ?> !important; color: <?php echo $wplc_settings_font; ?> !important;"/>



                </div>

                <div id="wp-live-chat-3" style="display:none;">
                    <p><?php _e("Connecting you to a sales person. Please be patient.","wplivechat") ?></p>
                </div>
                <div id="wp-live-chat-react" style="display:none;">
                    <p><?php _e("Reactivating your previous chat...", "wplivechat") ?></p>
                </div>
                <div id="wp-live-chat-4" style="display:none;">
                    <div id="wplc_sound_update" style='height:0; width:0; display:none; border:0;'></div>;
                    <div id="wplc_chatbox"></div>
                    <p style="text-align:center; font-size:11px;"><?php _e("Press ENTER to send your message", "wplivechat" )?></p>
                    <p>
                        <input type="text" name="wplc_chatmsg" id="wplc_chatmsg" value="" />
                        <input type="hidden" name="wplc_cid" id="wplc_cid" value="" />
                        <input id="wplc_send_msg" type="button" value="<?php _e("Send","wplivechat"); ?>" style="display:none;" />
                    </p>
                </div>
            </div>
        </div>        
    </div>   
<?php  
    }
}

function wplc_display_box() {
    $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
    if ($wplc_is_admin_logged_in != 1) { echo "<!-- wplc a-n-c -->"; }
    
    /* do not show if pro is outdated */
    global $wplc_pro_version;
    if (isset($wplc_pro_version)) {
        $float_version = floatval($wplc_pro_version);
        if ($float_version < 4 || $wplc_pro_version == "4.1.0" || $wplc_pro_version == "4.1.1") { return; }
    }
    
    if (function_exists("wplc_register_pro_version")) { wplc_pro_draw_user_box(); } else { wplc_draw_user_box(); }
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
    wplc_change_chat_status($cid,3);
    return true;

}
add_action('admin_head','wplc_update_chat_statuses');


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
                wplc_return_pro_admin_chat_javascript($_GET['cid']); 
            } else {
                wplc_return_admin_chat_javascript($_GET['cid']); 
            }
            
            }
        
        
        
    }
    
    $ajax_nonce = wp_create_nonce("wplc");
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {


            var wplc_set_transient = null;
            
            wplc_set_transient = setInterval(function (){wpcl_admin_set_transient();}, 60000);
            wpcl_admin_set_transient();
            function wpcl_admin_set_transient() {
                var data = {
                        action: 'wplc_admin_set_transient',
                        security: '<?php echo $ajax_nonce; ?>'
                        
                };
                jQuery.post(ajaxurl, data, function(response) {
                    //console.log("wplc_admin_set_transient");
                });
            }





        });



    </script>
    <?php
}
function wplc_admin_javascript() {
    $ajax_nonce = wp_create_nonce("wplc");
    ?>
    
    <script type="text/javascript">
        var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>';
        var data = {
            action: 'wplc_admin_long_poll',
            security: '<?php echo $ajax_nonce; ?>',
            wplc_list_visitors_data: false ,
            wplc_update_admin_chat_table: false
        };
        var wplc_pending_refresh = null;
        
        var wplc_run = true;
        function wplc_call_to_server(data) {
            
            
            jQuery.ajax({
                url: wplc_ajaxurl,
                data:data,
                type:"POST",
                success: function(response) {
                   
                    //Update your dashboard gauge
                    if(response){
                        
                        response = JSON.parse(response);
                        //console.log(response);
                        data["wplc_update_admin_chat_table"] = response['wplc_update_admin_chat_table'];
                        //console.log(response['visitors']);
                        
                        if(response['action'] === "wplc_update_admin_chat"){
                            jQuery("#wplc_admin_chat_area").html(response['wplc_update_admin_chat_table']);
                            if (response['pending'] === true) {
                                
                                var orig_title = document.getElementsByTagName("title")[0].innerHTML;
                                var ringer_cnt = 0;
                                wplc_pending_refresh = setInterval(function (){
                                    //console.log("chat request");
                                    ringer_cnt++;
                                    if (ringer_cnt > 1) { 
                                        clearInterval(wplc_pending_refresh); 
                                        wplc_title_alerts4 = setTimeout(function (){ document.title = orig_title; }, 4000); 
                                        return;
                                    }
                                    document.title = "** CHAT REQUEST **";
                                    wplc_title_alerts2 = setTimeout(function (){ document.title = "** CHAT REQUEST **"; }, 2000);
                                    wplc_title_alerts4 = setTimeout(function (){ document.title = orig_title; }, 4000);

                                    document.getElementById("wplc_sound").innerHTML="<embed src='<?php echo plugins_url('/ring.wav', __FILE__); ?>' hidden=true autostart=true loop=false>";
                                }, 5000); 
                            } else {
                                //console.log("end");
                                clearInterval(wplc_pending_refresh);
                            }
                        }
                        
                    }
                },
                error: function(jqXHR, exception) {
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
                complete: function(response){
                    //console.log(wplc_run);
                    if (wplc_run) { 
                        setTimeout(function() { wplc_call_to_server(data); }, 1500); 
                    }
                },
                timeout: 120000
            });
        };
        
        

        jQuery(document).ready(function() {
            jQuery('body').on("click", "a", function (event) {
                if(jQuery(this).hasClass('wplc_open_chat')){
                    if(event.preventDefault) {
			event.preventDefault();
                    } else {
                        event.returnValue = false;
                    }
                    window.open(jQuery(this).attr("href"), jQuery(this).attr("window-title" ), "width=600,height=600,scrollbars=yes", false);
                }
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
               <p><?php _e("You are using an outdated version of <strong>WP Live Chat Support Pro</strong>. Please" , "wplivechat")?> <a href="http://wp-livechat.com/get-updated-version/" target=\"_BLANK\"><?php _e("update to at least version", "wplivechat") ?> 4.0</a> <?php _e("to ensure all functionality is in working order", "wplivechat" ) ?>.</p>
                <p><strong><?php _e("You're live chat box on your website has been temporarily disabled until the Pro plugin has been updated. This is to ensure a smooth and hassle-free user experience for both yourself and your visitors.","wplivechat") ?></strong></p>
                <p><?php _e("You can update your plugin <a href='./update-core.php'>here</a>, <a href='./plugins.php'>here</a> or <a href='http://wp-livechat.com/get-updated-version/' target='_BLANK'>here</a>.","wplivechat") ?></strong></p>
               <p><?php _e("If you are having difficulty updating the plugin, please contact","wplivechat") ?> nick@wp-livechat.com</p>

           </div>
       <?php
       }
    }
    if(get_option("WPLC_FIRST_TIME") == true && !class_exists("APC_Object_Cache")){
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

function wplc_admin_menu_layout_display() {
   if (!isset($_GET['action'])) {

        ?>
           <div style='float:right; display:block; width:450px;  padding:10px; text-align:center; background-color: #EEE; border: 1px solid #E6DB55; margin:10px;'>
           <strong><?php _e("Experiencing problems with the plugin?", "wplivechat") ?></strong>
           <br />
           <a href='http://wp-livechat.com/documentation/' title='WP Live Chat Support Documentation' target='_BLANK'><?php _e("Review the documentation.", "wplivechat") ?></a> 
           <?php _e("Or ask a question on our", "wplivechat") ?>  <a href='http://wp-livechat.com/forums/forum/support/' title='WP Live Chat Support Forum' target='_BLANK'>Support forum.</a>
           </div>
        
        <h1><?php _e("Live Chat", "wplivechat") ?> </h1>
        <div id="wplc_sound"></div>




        <div id="wplc_admin_chat_area">

        <?php if (function_exists("wplc_register_pro_version")) { 
            echo  wplc_list_chats_pro(); 
            
        } else { 
            echo wplc_list_chats(); 
            
        } 
        
        ?>
        </div>
        
        <h1><?php _e("Visitors on site","wplivechat") ?></h1>    
        <p><?php _e("With the Pro add-on of WP Live Chat Support, you can","wplivechat"); ?> <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate1" title="<?php _e("see who's online and initiate chats","wplivechat"); ?>" target=\"_BLANK\"><?php _e("see who's online and initiate chats","wplivechat"); ?></a> <?php _e("with your online visitors with the click of a button.","wplivechat"); ?> <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate2" title="<?php _e("Buy the Pro add-on now for only $29.95 once off. Free Updates FOREVER.","wplivechat"); ?>" target=\"_BLANK\"><strong><?php _e("Buy the Pro add-on now for only $29.95 once off. Free Updates Forever.","wplivechat"); ?></strong></a></p>
    <?php
    }
    else {
        
        if ($_GET['action'] == 'ac') {
            wplc_change_chat_status($_GET['cid'],3);
            if(function_exists('wplc_ma_register')){
                wplc_ma_update_agent_id($_GET['cid'], $_GET['agent_id']);
            }
            if (function_exists("wplc_register_pro_version")) { wplc_pro_draw_chat_area($_GET['cid']); } else { wplc_draw_chat_area($_GET['cid']); }
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
    );?>
        <style>
            .wplc-user-message{
                display: inline-block;
                padding: 5px;
                -webkit-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.5);
                -moz-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.5);
                box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.5);
                border-radius: 5px;
                float: left;
                margin-bottom: 5px;
            }
            .wplc-user-message hr , .wplc-admin-message hr{
                margin:0;
            }
            .wplc-clear-float-message{
                clear: both;
            }

            .wplc-admin-message{
                display: inline-block;
                padding: 5px;
                -webkit-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.5);
                -moz-box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.5);
                box-shadow: 0px 0px 5px 0px rgba(50, 50, 50, 0.5);
                border-radius: 5px;
                float: right;
                margin-bottom: 5px;
            }
        </style>
        <?php

   
    foreach ($results as $result) {
         $user_data = maybe_unserialize($result->ip);
        $user_ip = $user_data['ip'];
        $browser = wplc_return_browser_string($user_data['user_agent']);
        $browser_image = wplc_return_browser_image($browser,"16");
        global $wplc_basic_plugin_url;
        if ($result->status == 1) { $status = __("Previous", "wplivechat"); } else { $status = __("Active", "wplivechat"); }
        
        echo "<h2>$status Chat with ".$result->name."</h2>";
        echo "<style>#adminmenuwrap { display:none; } #adminmenuback { display:none; } #wpadminbar { display:none; } #wpfooter { display:none; } .update-nag { display:none; }</style>";
        echo "<div style='display:block;'>";
            echo "<div style='float:left; width:100px;'><img src=\"http://www.gravatar.com/avatar/".md5($result->email)."\" /></div>";
            echo "<div id=\"wplc_sound_update\"></div>";
            echo "<div style='float:left; width:350px;'>";
            echo "<table>";
            echo "<tr><td><i class=\"fa fa-envelope\"> </i></td><td><a href='mailto:".$result->email."' title='".$result->email."'>".$result->email."</a></td></tr>";
            echo "<tr><td valign='top'><i class=\"fa fa-user\"> </i></td><td>";
            echo "<img src='".$wplc_basic_plugin_url."/images/$browser_image' alt='$browser' title='$browser' /> ";
            echo "<a href='http://www.ip-adress.com/ip_tracer/".$user_ip."' title='Whois for ".$user_ip."'>".$user_ip."</a>";
            echo "</td></tr>";
            echo "<tr><td><i class=\"fa fa-link\"> </i></td><td>".$result->url. "  (<a href='".$result->url."' target='_BLANK'>open</a>)"."</td></tr>";
            echo "<tr><td><i class=\"fa fa-clock-o\"> </i></td><td>".$result->timestamp."</td></tr>";
            echo "</table><br />";
            echo "</div>";
        echo "</div>";

        echo "
                <div style=\"display:block; clear:both; width:99%; text-align:right; font-size:10px;\"><a href=\"javascript:void(0);\" class=\"wplc_admin_close_chat button\" id=\"wplc_admin_close_chat\">".__("End chat","wplivechat")."</a></div>
        <div id='admin_chat_box'>
                    <div id='admin_chat_box_area_".$result->id."' style='height:200px; width:95%; border:1px solid #ccc; overflow:auto; background-color:#FFF; padding:2%;'>".wplc_return_chat_messages($cid)."</div>
            <p>
        ";
        if ($result->status != 1) {
        echo "
                <p style=\"text-align:left; font-size:11px;\">Press ENTER to send your message</p>
                <input type='text' name='wplc_admin_chatmsg' id='wplc_admin_chatmsg' value='' style=\"border:1px solid #666; width:98%;\" />
                <input id='wplc_admin_cid' type='hidden' value='".$_GET['cid']."' />
                <input id='wplc_admin_send_msg' type='button' value='".__("Send","wplivechat")."' style=\"display:none;\" />
                    </p>
                ".__("Assign Quick Response","wplivechat")." <select name='wplc_macros_select' class='wplc_macros_select' disabled><option>".__('Select','wplivechat')."</option></select> <a href='http://wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=quick_resposnes' title='".__('Add Quick Responses to your Live Chat','wplivechat')."' target='_BLANK'>".__("Pro version only","wplivechat")."</a>

            </div>
            ";
            //echo wplc_return_admin_chat_javascript($_GET['cid']);
        }
        
    }
}

function wplc_return_admin_chat_javascript($cid) {
        $ajax_nonce = wp_create_nonce("wplc");
        if(function_exists("wplc_pro_get_admin_picture")){
                $src = wplc_pro_get_admin_picture();
                if($src){
                    $image = "<img src=".$src." width='20px' id='wp-live-chat-2-img'/>";
                }
            }
    ?>
        <script type="text/javascript">
        var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>';
        var chat_status = 3;
        var cid = <?php echo $cid; ?>;
        var data = {
            action: 'wplc_admin_long_poll_chat',
            security: '<?php echo $ajax_nonce; ?>',
            cid: cid,
            chat_status: chat_status
        };
        var wplc_run = true;
        function wplc_call_to_server_admin_chat(data) {
            jQuery.ajax({
                url: wplc_ajaxurl,
                data:data,
                type:"POST",
                success: function(response) {
                    if(response){
                        
                        response = JSON.parse(response);
                        //console.log(response);
                        if(response['action'] === "wplc_update_chat_status"){
                            data['chat_status'] = response['chat_status'];
                            wplc_display_chat_status_update(response['chat_status'],cid);
                        }
                        if(response['action'] === "wplc_new_chat_message"){
                            current_len = jQuery("#admin_chat_box_area_"+cid).html().length;
                            jQuery("#admin_chat_box_area_"+cid).append(response['chat_message']);
                            new_length = jQuery("#admin_chat_box_area_"+cid).html().length;
                            if (current_len < new_length) {
                                document.getElementById("wplc_sound_update").innerHTML="<embed src='<?php echo plugins_url('/ding.mp3', __FILE__); ?>' hidden=true autostart=true loop=false>";
                            }
                            var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                            jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                        }
                        if(response['action'] === "wplc_user_open_chat"){
                            data['action_2'] = "";
                            <?php $url = admin_url( 'admin.php?page=wplivechat-menu&action=ac&cid='.$cid); ?>
                            window.location.replace('<?php echo $url; ?>');
                        }
                        
                    }
                },
                error: function(jqXHR, exception) {
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
                complete: function(response){
                    //console.log(wplc_run);
                    if (wplc_run) { 
                        wplc_call_to_server_admin_chat(data); 
                    }
                },
                
                timeout: 120000
            });
        };
        
        function wplc_display_chat_status_update(new_chat_status, cid){
            if (new_chat_status === "0") { } else {
                if (chat_status !== new_chat_status) {
                    previous_chat_status = chat_status;
                    //console.log("previous chat status: "+previous_chat_status);
                    chat_status = new_chat_status;
                    //console.log("chat status: "+chat_status);

                    if ((previous_chat_status === "2" && chat_status === "3") || (previous_chat_status === "5" && chat_status === "3")) {
                        jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has opened the chat window","wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_'+cid).scrollTop(height);

                    } else if (chat_status == "10" && previous_chat_status == "3") { 
                        jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has minimized the chat window","wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                    }
                    else if(chat_status === "3" && previous_chat_status === "10"){
                        jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has maximized the chat window","wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                    }
                    else if (chat_status === "1" || chat_status === "8") { 
                        jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has closed and ended the chat","wplivechat"); ?></em><br />");
                        var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                        jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                        document.getElementById('wplc_admin_chatmsg').disabled = true;
                    } 
                }
            }
        }
        
        

        jQuery(document).ready(function() {
        
            var wplc_image = "<?php if (isset($image)) { echo $image; } else { echo ""; } ?>";
            var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>';
            
            
            jQuery("#wplc_admin_chatmsg").focus();
            
            
           
    
            wplc_call_to_server_admin_chat(data);
            
            if (jQuery('#wplc_admin_cid').length){
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var height = jQuery('#admin_chat_box_area_'+wplc_cid)[0].scrollHeight;
                jQuery('#admin_chat_box_area_'+wplc_cid).scrollTop(height);
            }

            jQuery(".wplc_admin_accept").on("click", function() {
                wplc_title_alerts3 = setTimeout(function (){ document.title = "WP Live Chat Support"; }, 2500);
                var cid = jQuery(this).attr("cid");
                
                var data = {
                        action: 'wplc_admin_accept_chat',
                        cid: cid,
                        security: '<?php echo $ajax_nonce; ?>'
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_admin_accept_chat");
                    wplc_refresh_chat_boxes[cid] = setInterval(function (){wpcl_admin_update_chat_box(cid);}, 3000);
                    jQuery("#admin_chat_box_"+cid).show();
                });
            });

            jQuery("#wplc_admin_chatmsg").keyup(function(event){
                if(event.keyCode == 13){
                    jQuery("#wplc_admin_send_msg").click();
                }
            });

            jQuery("#wplc_admin_close_chat").on("click", function() {
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var data = {
                        action: 'wplc_admin_close_chat',
                        security: '<?php echo $ajax_nonce; ?>',
                        cid: wplc_cid
                        
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
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
                return str;
            }
            jQuery("#wplc_admin_send_msg").on("click", function() {
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var wplc_chat = wplc_strip(document.getElementById('wplc_admin_chatmsg').value);
                var wplc_name = "a"+"d"+"m"+"i"+"n";
                jQuery("#wplc_admin_chatmsg").val('');
                
                
                jQuery("#admin_chat_box_area_"+wplc_cid).append("<span class='wplc-admin-message'>"+wplc_image+" <strong>"+wplc_name+"</strong>:<hr/>"+wplc_chat+"</span><br /><div class='wplc-clear-float-message'></div>");
                var height = jQuery('#admin_chat_box_area_'+wplc_cid)[0].scrollHeight;
                jQuery('#admin_chat_box_area_'+wplc_cid).scrollTop(height);
                

                var data = {
                        action: 'wplc_admin_send_msg',
                        security: '<?php echo $ajax_nonce; ?>',
                        cid: wplc_cid,
                        msg: wplc_chat
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
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
        add_option('WPLC_SETTINGS',array("wplc_settings_align" => "2", "wplc_settings_enabled" => "1", "wplc_settings_fill" => "ed832f", "wplc_settings_font" => "FFFFFF"));
    }
    add_option("WPLC_HIDE_CHAT","true");
    add_option("WPLC_FIRST_TIME", true);
}


function wplc_handle_db() {
   global $wpdb;
   global $wplc_version;
   global $wplc_tblname_chats;
   global $wplc_tblname_msgs;

    $sql = "
        CREATE TABLE ".$wplc_tblname_chats." (
          id int(11) NOT NULL AUTO_INCREMENT,
          timestamp datetime NOT NULL,
          name varchar(700) NOT NULL,
          email varchar(700) NOT NULL,
          ip varchar(700) NOT NULL,
          status int(11) NOT NULL,
          session varchar(100) NOT NULL,
          url varchar(700) NOT NULL,
          last_active_timestamp datetime NOT NULL,
          PRIMARY KEY  (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);

   $sql = '
        CREATE TABLE '.$wplc_tblname_msgs.' (
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
   update_option("wplc_db_version",$wplc_version);
}

function wplc_add_user_stylesheet() {
    wp_register_style( 'wplc-font-awesome', plugins_url('/css/font-awesome.min.css', __FILE__) );
    wp_enqueue_style( 'wplc-font-awesome' );
    wp_register_style( 'wplc-style', plugins_url('/css/wplcstyle.css', __FILE__) );
    wp_enqueue_style( 'wplc-style' );
    
}
function wplc_add_admin_stylesheet() {
    if (isset($_GET['page']) && ($_GET['page'] == 'wplivechat-menu' || $_GET['page'] == 'wplivechat-menu-settings')) {
        wp_register_style( 'wplc-admin-style', 'http://code.jquery.com/ui/1.8.24/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'wplc-admin-style' );
        wp_register_style( 'wplc-font-awesome', plugins_url('/css/font-awesome.min.css', __FILE__) );
        wp_enqueue_style( 'wplc-font-awesome' );
    }
}

if (isset($_GET['page']) && $_GET['page'] == 'wplivechat-menu-settings') {
    add_action('admin_print_scripts', 'wplc_admin_scripts_basic');
}
function wplc_admin_scripts_basic() {
    
    if (isset($_GET['page']) && $_GET['page'] == "wplivechat-menu-settings") {
        wp_enqueue_script( 'jquery' );
        wp_enqueue_script('jquery-ui-core');

        wp_register_script('my-wplc-color', plugins_url('js/jscolor.js',__FILE__), false, '1.4.1', false);
        wp_enqueue_script('my-wplc-color');
        wp_enqueue_script( 'jquery-ui-tabs');
        wp_register_script('my-wplc-tabs', plugins_url('js/wplc_tabs.js',__FILE__), array('jquery-ui-core'), '', true);
        wp_enqueue_script('my-wplc-tabs');
    }
}


function wplc_admin_settings_layout() {
    wplc_settings_page_basic();
}
function wplc_admin_history_layout() {
    echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("WP Live Chat History","wplivechat")."</h2>";
    if (function_exists("wplc_register_pro_version")) {
        wplc_pro_admin_display_history();
    }
    else {
        echo "<br /><br >This option is only available in the <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history1\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">Pro Add-on</a> of WP Live Chat. <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history2\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">Get it now for only $29.95 once off!</a>";
    }
}


function wplc_settings_page_basic() {
    if(function_exists("wplc_register_pro_version")){
        wplc_settings_page_pro();
    } else {
        include 'includes/settings_page.php';
    }
}
function wplc_head_basic() {
    global $wpdb;

    if (isset($_POST['wplc_save_settings'])){

        if (isset($_POST['wplc_settings_align'])) { $wplc_data['wplc_settings_align'] = esc_attr($_POST['wplc_settings_align']); }
        if (isset($_POST['wplc_settings_fill'])) { $wplc_data['wplc_settings_fill'] = esc_attr($_POST['wplc_settings_fill']); }
        if (isset($_POST['wplc_settings_font'])) { $wplc_data['wplc_settings_font'] = esc_attr($_POST['wplc_settings_font']); }
        if (isset($_POST['wplc_settings_enabled'])) { $wplc_data['wplc_settings_enabled'] = esc_attr($_POST['wplc_settings_enabled']); }
        if (isset($_POST['wplc_auto_pop_up'])) { $wplc_data['wplc_auto_pop_up'] = esc_attr($_POST['wplc_auto_pop_up']); }
        update_option('WPLC_SETTINGS', $wplc_data);
         if (isset($_POST['wplc_hide_chat'])) { update_option("WPLC_HIDE_CHAT", $_POST['wplc_hide_chat']); }
        echo "<div class='updated'>";
        _e("Your settings have been saved.","wplivechat");
        echo "</div>";
    }
    if(isset($_POST['action']) && $_POST['action'] == "wplc_submit_find_us"){
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
        echo "<div class=\"updated\"><p>". __("Thank You for your feedback!","wplivechat")."</p></div>";
    }
    if (isset($_POST['wplc_nl_send_feedback'])) {
        if(wp_mail("nick@wp-livechat.com", "Plugin feedback", "Name: ".$_POST['wplc_nl_feedback_name']."\n\r"."Email: ".$_POST['wplc_nl_feedback_email']."\n\r"."Website: ".$_POST['wplc_nl_feedback_website']."\n\r"."Feedback:".$_POST['wplc_nl_feedback_feedback'] )){
                echo "<div id=\"message\" class=\"updated\"><p>".__("Thank you for your feedback. We will be in touch soon","wplc")."</p></div>";
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
                echo "<div id=\"message\" class=\"updated\"><p>".__("Thank you for your feedback. We will be in touch soon","wplc")."</p></div>";
            } 
            else {
                echo "<div id=\"message\" class=\"error\">";
                echo "<p>".__("There was a problem sending your feedback. Please log your feedback on ","wplc")."<a href='http://wp-livechat.com/forums/forum/support/' target='_BLANK'>http://wp-livechat.com/forums/forum/support/</a></p>";
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
	$home = get_option( 'home' );
	$siteurl = get_option( 'siteurl' );
	if ( ! empty( $home ) && 0 !== strcasecmp( $home, $siteurl ) ) {
		$wp_path_rel_to_home = str_ireplace( $home, '', $siteurl ); /* $siteurl - $home */
		$pos = strripos( str_replace( '\\', '/', $_SERVER['SCRIPT_FILENAME'] ), trailingslashit( $wp_path_rel_to_home ) );
		$home_path = substr( $_SERVER['SCRIPT_FILENAME'], 0, $pos );
		$home_path = trailingslashit( $home_path );
	} else {
		$home_path = ABSPATH;
	}

	return str_replace( '\\', '/', $home_path );
}