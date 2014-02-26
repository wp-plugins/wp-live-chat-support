<?php
/*
Plugin Name: WP Live Chat Support
Plugin URI: http://www.wp-livechat.com
Description: The easiest to use website live chat plugin. Let your visitors chat with you and increase sales conversion rates with WP Live Chat Support. No third party connection required!
Version: 3.01
Author: WP-LiveChat
Author URI: http://www.wp-livechat.com
*/

error_reporting(E_ERROR);
global $wplc_version;
global $wplc_p_version;
global $wplc_tblname;
global $wpdb;
global $wplc_tblname_chats;
global $wplc_tblname_msgs;
$wplc_tblname_chats = $wpdb->prefix . "wplc_chat_sessions";
$wplc_tblname_msgs = $wpdb->prefix . "wplc_chat_msgs";
$wplc_version = "3.01";

require_once (plugin_dir_path( __FILE__ )."functions.php");
add_action('wp_ajax_wplc_admin_set_transient', 'wplc_action_callback');

add_action('wp_footer', 'wplc_display_box');


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




function wplc_admin_menu() {
    $wplc_mainpage = add_menu_page('WP Live Chat', __('Live Chat','wplivechat'), 'manage_options', 'wplivechat-menu', 'wplc_admin_menu_layout');
    add_submenu_page('wplivechat-menu', __('Settings','wplivechat'), __('Settings','wplivechat'), 'manage_options' , 'wplivechat-menu-settings', 'wplc_admin_settings_layout');
    add_submenu_page('wplivechat-menu', __('History','wplivechat'), __('History','wplivechat'), 'manage_options' , 'wplivechat-menu-history', 'wplc_admin_history_layout');
    
}
add_action('wp_head','wplc_user_top_js');
function wplc_user_top_js() {
    echo "<!-- DEFINING DO NOT CACHE -->";
    define('DONOTCACHEPAGE', true);
    define('DONOTCACHEDB', true);
    $ajax_nonce = wp_create_nonce("wplc");
    wp_register_script( 'wplc-user-jquery-cookie', plugins_url('/js/jquery-cookie.js', __FILE__) );
    wp_enqueue_script( 'wplc-user-jquery-cookie' );
    $wplc_settings = get_option("WPLC_SETTINGS");
    
?>    
<script type="text/javascript">
    <?php if (!function_exists("wplc_register_pro_version")) { ?>
    var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>';
    <?php } ?>
   var wplc_nonce = '<?php echo $ajax_nonce; ?>';
</script>
<?php

$hide_chat = get_option('WPLC_HIDE_CHAT');
    if($hide_chat == true){
        $hide_chat = "yes";
    } else {
        $hide_chat = '';
    }
    ?>
        <script>
            var hide_chat = "<?php echo $hide_chat; ?>";
        </script>
    <?php
}

function wplc_draw_user_box() {
    $wplc_settings = get_option("WPLC_SETTINGS");
    if ($wplc_settings["wplc_settings_enabled"] == 2) { return; }

    wp_register_script( 'wplc-user-script', plugins_url('/js/wplc_u.js', __FILE__) );
    wp_enqueue_script( 'wplc-user-script' );
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'jquery-ui-core' );
    wp_enqueue_script( 'jquery-ui-draggable');
    wplc_output_box();

}
function wplc_output_box() {
    

    $wplc_settings = get_option("WPLC_SETTINGS");
    if ($wplc_settings["wplc_settings_enabled"] == 2) { return; }

    if ($wplc_settings["wplc_settings_align"] == 1) { $wplc_box_align = "left:100px;"; } else { $wplc_box_align = "right:100px;"; }
    if ($wplc_settings["wplc_settings_fill"]) { $wplc_settings_fill = "#".$wplc_settings["wplc_settings_fill"]; } else {  $wplc_settings_fill = "#73BE28"; }
    if ($wplc_settings["wplc_settings_font"]) { $wplc_settings_font = "#".$wplc_settings["wplc_settings_font"]; } else {  $wplc_settings_font = "#FFFFFF"; }

    $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
    if (!function_exists("wplc_register_pro_version") && $wplc_is_admin_logged_in != 1) {
        return "";
    }  
    if($wplc_settings["wplc_settings_align"] == 1){
        $original_pos = "left";
    } else {
        $original_pos = "right";
    }
    
?>    
<div id="wp-live-chat" style="display:none; <?php echo $wplc_box_align; ?>;" original_pos="<?php echo $original_pos ?>">

    
    <?php if (function_exists("wplc_register_pro_version")) {
        wplc_pro_output_box();
    } else {
    ?>
        <div id="wp-live-chat-header" style="background-color: <?php echo $wplc_settings_fill; ?> !important; color: <?php echo $wplc_settings_font; ?> !important;">
            
            <div id="wp-live-chat-minimize" style="display:none;"><i class="fa fa-minus"  ></i></div>
            <div id="wp-live-chat-close" style="display:none;"><i class="fa fa-times"  ></i></div>
            
            <div id="wp-live-chat-1" >
                <div style="display:block; ">
                <strong>Questions?</strong> Chat with us
                </div>
            </div>
        </div>
        <div id="wp-live-chat-2" style="display:none;">
            
            <div id="wp-live-chat-2-info">
               <strong>Start Live Chat</strong> 
            </div>

                <input type="text" name="wplc_name" id="wplc_name" value="" placeholder="<?php _e("Name","wplivechat"); ?>"/>
           
                <input type="text" name="wplc_email" id="wplc_email" value="" placeholder="<?php _e("Email","wplivechat"); ?>"/>
           
                <input id="wplc_start_chat_btn" type="button" value="Start Chat" style="background-color: <?php echo $wplc_settings_fill; ?> !important; color: <?php echo $wplc_settings_font; ?> !important;"/>

            
            
        </div>
        
        <div id="wp-live-chat-3" style="display:none;">
            <p>Connecting you to a sales person. Please be patient.</p>
        </div>
        <div id="wp-live-chat-react" style="display:none;">
            <p>Reactivating your previous chat...</p>
        </div>
        <div id="wp-live-chat-4" style="display:none;">
            <div id="wplc_chatbox"></div>
            <p style="text-align:center; font-size:11px;">Press ENTER to send your message</p>
            <p>
                <input type="text" name="wplc_chatmsg" id="wplc_chatmsg" value="" />
                <input type="hidden" name="wplc_cid" id="wplc_cid" value="" />
                <input id="wplc_send_msg" type="button" value="<?php _e("Send","wplc"); ?>" style="display:none;" /></p>
        </div>
            
    </div>    
<?php  
    }
}

function wplc_display_box() {
    $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
    if ($wplc_is_admin_logged_in != 1) { echo "<!-- wplc a-n-c -->"; }
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
        jQuery(document).ready(function() {
            var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>';
            var wplc_autoLoad = null;
            var wplc_refresh_chat_area = null;
            var wplc_refresh_status = null;

            


            wplc_refresh_chat_area = setInterval(function (){wpcl_admin_update_chats();}, 4000);
            function wpcl_admin_update_chats(cid) {
                var data = {
                        action: 'wplc_update_admin_chat',
                        security: '<?php echo $ajax_nonce; ?>'
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
                        //console.log("wplc_update_admin_chat");
                        jQuery("#wplc_admin_chat_area").html(response);
                        if (response.indexOf("pending") >= 0) {
                            var orig_title = document.getElementsByTagName("title")[0].innerHTML;
                            document.title = "** CHAT REQUEST **";
                            wplc_title_alerts1 = setTimeout(function (){ document.title = "__ CHAT Request __"; }, 1000);
                            wplc_title_alerts2 = setTimeout(function (){ document.title = "** CHAT REQUEST **"; }, 1500);
                            wplc_title_alerts3 = setTimeout(function (){ document.title = "__ CHAT Request __"; }, 2000);
                            wplc_title_alerts4 = setTimeout(function (){ document.title = orig_title; }, 2500);

                            document.getElementById("wplc_sound").innerHTML="<embed src='<?php echo plugins_url('/ring.wav', __FILE__); ?>' hidden=true autostart=true loop=false>";
                        }
                            
                        
                });
            }

            wplc_refresh_status = setInterval(function (){wplc_update_statuses();}, 10000);
            function wplc_update_statuses() {
                var data = {
                        action: 'wplc_update_admin_status',
                        security: '<?php echo $ajax_nonce; ?>'
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_update_admin_status");
                    //alert(response);
                });
            };


        });



    </script>
    <?php
}



function wplc_admin_menu_layout() {
   if (function_exists("wplc_register_pro_version")) {
       global $wplc_pro_version;
       if ($wplc_pro_version < 3.0) {
           ?>
           <div class='error below-h1'>

               <p>Dear Pro User<br /></p>
               <p>You are using an outdated version of WP Live Chat Support Pro. Please <a href="http://wp-livechat.com/get-updated-version/" target=\"_BLANK\">update to at least version 3.0</a> to ensure all functionality is in working order.</p>
               <p>&nbsp;</p>
               <p>If you are having difficulty updating the plugin, please contact nick@wp-livechat.com</p>

           </div>
       <?php
       }


   }
    if (function_exists("wplc_register_pro_version")) {
        wplc_pro_admin_menu_layout_display();
    } else {
        wplc_admin_menu_layout_display();
    }

}

function wplc_admin_menu_layout_display() {
   if (!isset($_GET['action'])) {

        ?>
           <div style='float:right; display:block; width:450px;  padding:10px; text-align:center; background-color: #EEE; border: 1px solid #E6DB55; margin:10px;'>
           <strong>Experiencing problems with the plugin?</strong>
           <br />
           <a href='http://wp-livechat.com/documentation/' title='WP Live Chat Support Documentation' target='_BLANK'>Review the documentation.</a> 
           Or ask a question on our  <a href='http://wp-livechat.com/forums/forum/support/' title='WP Live Chat Support Forum' target='_BLANK'>Support forum.</a>
           </div>
        
        <h1>Live Chat</h1>
        <div id="wplc_sound"></div>




        <div id="wplc_admin_chat_area">

        <?php if (function_exists("wplc_register_pro_version")) { wplc_list_chats_pro(); } else { wplc_list_chats(); } ?>
        </div>
        <h1>Online Visitors</h1>    
        <p><?php _e("With the Pro add-on of WP Live Chat Support, you can","wplivechat"); ?> <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate1" title="<?php _e("see who's online and initiate chats","wplivechat"); ?>" target=\"_BLANK\"><?php _e("see who's online and initiate chats","wplivechat"); ?></a> <?php _e("with your online visitors with the click of a button.","wplivechat"); ?> <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate2" title="<?php _e("Buy the Pro add-on now for only $24.95 once off. Free Updates FOREVER.","wplivechat"); ?>" target=\"_BLANK\"><strong><?php _e("Buy the Pro add-on now for only $24.95 once off. Free Updates Forever.","wplivechat"); ?></strong></a></p>
    <?php
    }
    else {

        if ($_GET['action'] == 'ac') {
            wplc_change_chat_status($_GET['cid'],3);
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
        if ($result->status == 1) { $status = "Previous"; } else { $status = "Active"; }
        
        echo "<h2>$status Chat with ".$result->name."</h2>";
        echo "<style>#adminmenuwrap { display:none; } #adminmenuback { display:none; } #wpadminbar { display:none; } #wpfooter { display:none; } .update-nag { display:none; }</style>";
        echo "<div style='display:block;'>";
            echo "<div style='float:left; width:100px;'><img src=\"http://www.gravatar.com/avatar/".md5($result->email)."\" /></div>";
            echo "<div id=\"wplc_sound_update\"></div>";
            echo "<div style='float:left; width:350px;'>";
            echo "<table>";
            echo "<tr><td>Email address</td><td><a href='mailto:".$result->email."' title='".$result->email."'>".$result->email."</a></td></tr>";
            echo "<tr><td>IP Address</td><td><a href='http://www.ip-adress.com/ip_tracer/".$result->ip."' title='Whois for ".$result->ip."'>".$result->ip."</a></td></tr>";
            echo "<tr><td>From URL</td><td>".$result->url. "  (<a href='".$result->url."' target='_BLANK'>open</a>)"."</td></tr>";
            echo "<tr><td>Date</td><td>".$result->timestamp."</td></tr>";
            echo "</table><br />";
            echo "</div>";
        echo "</div>";

        echo "
        <p style=\"display:block; width:290px; text-align:right; font-size:10px;\"><a href=\"javascript:void(0);\" class=\"wplc_admin_close_chat\" id=\"wplc_admin_close_chat\">".__("End chat","wplivechat")."</a></p>
        <div id='admin_chat_box'>
            <div id='admin_chat_box_area_".$result->id."' style='height:200px; width:290px; border:1px solid #ccc; overflow:auto; padding: 5px;'>".wplc_return_chat_messages($cid)."</div>
            <p>
        ";
        if ($result->status != 1) {
        echo "
                <p style=\"text-align:left; font-size:11px;\">Press ENTER to send your message</p>
                <input type='text' name='wplc_admin_chatmsg' id='wplc_admin_chatmsg' value='' style=\"border:1px solid #666; width:290px;\" />
                <input id='wplc_admin_cid' type='hidden' value='".$_GET['cid']."' />
                <input id='wplc_admin_send_msg' type='button' value='".__("Send","wplc")."' style=\"display:none;\" />
                    </p>
            </div>
            ";
            //echo wplc_return_admin_chat_javascript($_GET['cid']);
        }
        
    }
}

function wplc_return_admin_chat_javascript($cid) {
        $ajax_nonce = wp_create_nonce("wplc");
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {


            var wplc_ajaxurl = '<?php echo plugins_url('/ajax.php', __FILE__); ?>';
            var wplc_nonce = '<?php echo $ajax_nonce; ?>';
            var wplc_gcid = '<?php echo $cid; ?>';
            
            if (jQuery('#wplc_admin_cid').length){
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var height = jQuery('#admin_chat_box_area_'+wplc_cid)[0].scrollHeight;
                jQuery('#admin_chat_box_area_'+wplc_cid).scrollTop(height);
            }

            jQuery(".wplc_admin_accept").live("click", function() {
                var cid = jQuery(this).attr("cid");
                
                var data = {
                        action: 'wplc_admin_accept_chat',
                        cid: cid,
                        security: wplc_nonce
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
            jQuery("#wplc_admin_close_chat").live("click", function() {
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

            jQuery("#wplc_admin_send_msg").live("click", function() {
                var wplc_cid = jQuery("#wplc_admin_cid").val();
                var wplc_chat = jQuery("#wplc_admin_chatmsg").val();
                var wplc_name = "a"+"d"+"m"+"i"+"n";
                jQuery("#wplc_admin_chatmsg").val('');
                
                
                jQuery("#admin_chat_box_area_"+wplc_cid).append("<strong>"+wplc_name+"</strong>: "+wplc_chat+"<br />");
                var height = jQuery('#admin_chat_box_area_'+wplc_cid)[0].scrollHeight;
                jQuery('#admin_chat_box_area_'+wplc_cid).scrollTop(height);
                

                var data = {
                        action: 'wplc_admin_send_msg',
                        security: wplc_nonce,
                        cid: wplc_cid,
                        msg: wplc_chat
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
                        //console.log("wplc_admin_send_msg");
                        
                });


            });            
            
            
            wplc_auto_refresh = setInterval(function (){wpcl_admin_auto_update_chat_box(wplc_gcid);}, 3500);
            function wpcl_admin_auto_update_chat_box(cid) {
                current_len = jQuery("#admin_chat_box_area_"+cid).html().length;


                var data = {
                        action: 'wplc_update_admin_chat_boxes',
                        cid: cid,
                        security: wplc_nonce
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_update_admin_chat_boxes");
                    //jQuery("#admin_chat_box_area_"+cid).html(response);
                    jQuery("#admin_chat_box_area_"+cid).append(response);
                    new_length = jQuery("#admin_chat_box_area_"+cid).html().length;
                    if (current_len < new_length) {
                        document.getElementById("wplc_sound_update").innerHTML="<embed src='<?php echo plugins_url('/ding.mp3', __FILE__); ?>' hidden=true autostart=true loop=false>";
                    }

                    var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                    jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                });

            }

             
            
            wplc_auto_check_status_of_chat = setInterval(function (){wpcl_admin_auto_check_status_of_chat(<?php echo $cid; ?>);}, 5000);
            var chat_status = 3;
            function wpcl_admin_auto_check_status_of_chat(cid) {
                
                var data = {
                        action: 'wplc_update_admin_return_chat_status',
                        cid: <?php echo $cid; ?>,
                        security: '<?php echo $ajax_nonce; ?>'
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_update_admin_return_chat_status");
                    if (response == "0") { } else {
                        if (chat_status != response) {
                            previous_chat_status = chat_status;
                            console.log("previous chat status: "+previous_chat_status)
                            chat_status = response;
                            //console.log("chat status: "+chat_status)
                            if (chat_status == "2") { 
                                //clearInterval(wplc_auto_check_status_of_chat);
                                //clearInterval(wplc_auto_refresh);
                                jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has minimized the chat window","wplivechat"); ?></em><br />");
                                var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                                jQuery('#admin_chat_box_area_'+cid).scrollTop(height);

                            }
                            else if (previous_chat_status == "2" && chat_status == "3") {
                                jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has opened the chat window","wplivechat"); ?></em><br />");
                                var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                                jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                            }
                            else if (chat_status == "1") { 
                                //clearInterval(wplc_auto_check_status_of_chat);
                                //clearInterval(wplc_auto_refresh);
                                jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has closed and ended the chat","wplivechat"); ?></em><br />");
                                var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                                jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                                clearInterval(wplc_auto_check_status_of_chat);
                                clearInterval(wplc_auto_refresh);
                                document.getElementById('wplc_admin_chatmsg').disabled = true;


                            }

                        }
                    }
                    
                });

            }
            
            
           
        });
    </script>
    <?php
}
function wplc_activate() {
    wplc_handle_db();
    if (!get_option("WPLC_SETTINGS")) {
        add_option('WPLC_SETTINGS',array("wplc_settings_align" => "2", "wplc_settings_enabled" => "1", "wplc_settings_fill" => "73BE28", "wplc_settings_font" => "FFFFFF"));
    }
    add_option("WPLC_HIDE_CHAT","true");
}


function wplc_handle_db() {
   global $wpdb;
   global $wplc_version;
   global $wplc_tblname_chats;
   global $wplc_tblname_msgs;

    $sql = "
        CREATE TABLE `".$wplc_tblname_chats."` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `timestamp` datetime NOT NULL,
          `name` varchar(700) NOT NULL,
          `email` varchar(700) NOT NULL,
          `ip` varchar(700) NOT NULL,
          `status` int(11) NOT NULL,
          `url` varchar(700) NOT NULL,
          `last_active_timestamp` datetime NOT NULL,
          PRIMARY KEY  (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);

   $sql = "
        CREATE TABLE `".$wplc_tblname_msgs."` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `chat_sess_id` int(11) NOT NULL,
          `from` varchar(150) CHARACTER SET utf8 NOT NULL,
          `msg` varchar(700) CHARACTER SET utf8 NOT NULL,
          `timestamp` datetime NOT NULL,
          `status` INT(3) NOT NULL,
          `originates` INT(3) NOT NULL,
          PRIMARY KEY  (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);
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
    wp_register_style( 'wplc-admin-style', 'http://code.jquery.com/ui/1.8.24/themes/smoothness/jquery-ui.css' );
    wp_enqueue_style( 'wplc-admin-style' );
    
}

if (isset($_GET['page']) && $_GET['page'] == 'wplivechat-menu-settings') {
    add_action('admin_print_scripts', 'wplc_admin_scripts_basic');
}
function wplc_admin_scripts_basic() {
    
    if ($_GET['page'] == "wplivechat-menu-settings") {
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
        echo "<br /><br >This option is only available in the <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history1\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">Pro Add-on</a> of WP Live Chat. <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history2\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">Get it now for only $24.95 once off!</a>";
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

        $wplc_data['wplc_settings_align'] = esc_attr($_POST['wplc_settings_align']);
        $wplc_data['wplc_settings_fill'] = esc_attr($_POST['wplc_settings_fill']);
        $wplc_data['wplc_settings_font'] = esc_attr($_POST['wplc_settings_font']);
        $wplc_data['wplc_settings_enabled'] = esc_attr($_POST['wplc_settings_enabled']);
        update_option('WPLC_SETTINGS', $wplc_data);
        update_option("WPLC_HIDE_CHAT", $_POST['wplc_hide_chat']);
        echo "<div class='updated'>";
        _e("Your settings have been saved.","wplivechat");
        echo "</div>";

    
   }

}

function wplc_logout() {
    delete_transient('wplc_is_admin_logged_in');
}
add_action('wp_logout', 'wplc_logout');



