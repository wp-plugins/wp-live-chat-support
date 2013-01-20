<?php
/*
Plugin Name: WP Live Chat Support
Plugin URI: http://www.wp-livechat.com
Description: The easiest to use website live chat plugin. Let your visitors chat with you and increase sales conversion rates with WP Live Chat Support. No third party connection required!
Version: 2.2
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
$wplc_version = "2.2";


add_action('wp_footer', 'wplc_display_box');
add_action('wp_ajax_wplc_start_chat', 'wplc_action_callback');
add_action('wp_ajax_nopriv_wplc_start_chat', 'wplc_action_callback');
add_action('wp_ajax_wplc_relay_stage', 'wplc_action_callback');
add_action('wp_ajax_nopriv_wplc_relay_stage', 'wplc_action_callback');
add_action('wp_ajax_wplc_update_admin_chat', 'wplc_action_callback');
add_action('wp_ajax_wplc_update_admin_status', 'wplc_action_callback');
add_action('wp_ajax_wplc_user_awaiting_chat', 'wplc_action_callback');
add_action('wp_ajax_nopriv_wplc_user_awaiting_chat', 'wplc_action_callback');
add_action('wp_ajax_wplc_user_send_msg', 'wplc_action_callback');
add_action('wp_ajax_nopriv_wplc_user_send_msg', 'wplc_action_callback');
add_action('wp_ajax_wplc_user_close_chat', 'wplc_action_callback');
add_action('wp_ajax_nopriv_wplc_user_close_chat', 'wplc_action_callback');
add_action('wp_ajax_wplc_user_reactivate_chat', 'wplc_action_callback');
add_action('wp_ajax_nopriv_wplc_user_reactivate_chat', 'wplc_action_callback');
add_action('wp_ajax_wplc_admin_accept_chat', 'wplc_action_callback');
add_action('wp_ajax_wplc_update_admin_chat_boxes', 'wplc_action_callback');
add_action('wp_ajax_wplc_update_user_chat_boxes', 'wplc_action_callback');
add_action('wp_ajax_nopriv_wplc_update_user_chat_boxes', 'wplc_action_callback');
add_action('wp_ajax_wplc_admin_send_msg', 'wplc_action_callback');
add_action('wp_ajax_wplc_admin_set_transient', 'wplc_action_callback');
add_action('wp_ajax_wplc_update_admin_return_chat_status', 'wplc_action_callback');




add_action('admin_head', 'wplc_head');
add_action( 'wp_enqueue_scripts', 'wplc_add_user_stylesheet' );
add_action('admin_menu', 'wplc_admin_menu');
add_action('admin_head', 'wplc_superadmin_javascript');
register_activation_hook( __FILE__, 'wplc_activate' );


function wplc_admin_menu() {
    $wplc_mainpage = add_menu_page('WP Live Chat', __('Live Chat','wplivechat'), 'manage_options', 'wplivechat-menu', 'wplc_admin_menu_layout');
    add_submenu_page('wplivechat-menu', __('Settings','wplivechat'), __('Settings','wplivechat'), 'manage_options' , 'wplivechat-menu-settings', 'wplc_admin_settings_layout');
    add_submenu_page('wplivechat-menu', __('History','wplivechat'), __('History','wplivechat'), 'manage_options' , 'wplivechat-menu-history', 'wplc_admin_history_layout');
    
}
add_action('wp_head','wplc_user_top_js');
function wplc_user_top_js() {
    $ajax_nonce = wp_create_nonce("wplc");
    wp_register_script( 'wplc-user-jquery-cookie', plugins_url('/js/jquery-cookie.js', __FILE__) );
    wp_enqueue_script( 'wplc-user-jquery-cookie' );
    $wplc_settings = get_option("WPLC_SETTINGS");
?>    
<script type="text/javascript">
   var ajaxurl = '<?php echo admin_url( 'admin-ajax.php' ); ?>';
   var wplc_nonce = '<?php echo $ajax_nonce; ?>';
</script> 
<?php
}

function wplc_draw_user_box() {
    wp_register_script( 'wplc-user-script', plugins_url('/js/wplc_u.js', __FILE__) );
    wp_enqueue_script( 'wplc-user-script' );
    wplc_output_box();

}
function wplc_output_box() {
    $wplc_settings = get_option("WPLC_SETTINGS");
    
    if ($wplc_settings["wplc_settings_align"] == 1) { $wplc_box_align = "left:100px;"; } else { $wplc_box_align = "right:100px;"; }
    
    $wplc_is_admin_logged_in = get_transient("wplc_is_admin_logged_in");
    if (!function_exists("wplc_register_pro_version") && $wplc_is_admin_logged_in != 1) {
        return "";
    }    
    
?>    
<div id="wp-live-chat" style="<?php echo $wplc_box_align; ?>;">

    
    <?php if (function_exists("wplc_register_pro_version")) {
        wplc_pro_output_box();
    } else {
    ?>

        <div id="wp-live-chat-close" style="display:none;"></div>
        <div id="wp-live-chat-1">
            <strong>Questions?</strong> Chat with us
        </div>
        <div id="wp-live-chat-2" style="display:none;">
            <table>
            <tr>
                <td></td>
                <td><strong>Start Live Chat</strong></td>
            </tr>
            <tr>
                <td><?php _e("Name","wplivechat"); ?></td>
                <td><input type="text" name="wplc_name" id="wplc_name" value="" /></td>
            </tr>
            <tr>
                <td><?php _e("Email","wplivechat"); ?></td>
                <td><input type="text" name="wplc_email" id="wplc_email" value="" /></td>
            </tr>
            <tr>
                <td></td>
                <td><input id="wplc_start_chat_btn" type="button" value="Start Chat" /></td>
            </tr>
            </table>
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


function wplc_action_callback() {
        global $wpdb;
        global $wplc_tblname_chats;
        $check = check_ajax_referer( 'wplc', 'security' );

        if ($check == 1) {
            if ($_POST['action'] == "wplc_start_chat") {
                if ($_POST['cid']) {
                    if ($_POST['name'] && $_POST['email']) {
                        echo wplc_user_initiate_chat($_POST['name'],$_POST['email'],$_POST['cid']); // echo the chat session id
                    } else {
                        echo "error2";
                    }
                } else {
                    if ($_POST['name'] && $_POST['email']) {
                        echo wplc_user_initiate_chat($_POST['name'],$_POST['email']); // echo the chat session id
                    } else {
                        echo "error2";
                    }
                }
            }
            if ($_POST['action'] == "wplc_relay_stage") { 
                if ($_POST['stage'] == "1") {  // chat window is displayed to user
                    echo wplc_log_user_on_page("user".time(),"no email set");
                }
                else if ($_POST['stage'] == "2") { // user still hasnt opened chat window but is now on another page
                    echo wplc_update_user_on_page($_POST['cid']);
                    
                }
            }
            if ($_POST['action'] == "wplc_update_admin_chat") {
                wplc_list_chats();
            }
            if ($_POST['action'] == "wplc_update_admin_status") {
                wplc_update_chat_statuses();
            }
            if ($_POST['action'] == "wplc_admin_accept_chat") {
                wplc_admin_accept_chat($_POST['cid']);
            }
            if ($_POST['action'] == "wplc_update_admin_chat_boxes") {
                echo wplc_return_admin_chat_messages($_POST['cid']);
                wplc_mark_as_read_admin_chat_messages($_POST['cid']);
            }
            if ($_POST['action'] == "wplc_update_admin_return_chat_status") {
                echo wplc_return_chat_status($_POST['cid']);
            }
            
            if ($_POST['action'] == "wplc_admin_send_msg") {
                $chat_id = $_POST['cid'];
                $chat_msg = $_POST['msg'];
                $wplc_rec_msg = wplc_record_chat_msg("2",$chat_id,$chat_msg);
                if ($wplc_rec_msg) {
                    echo 'sent';
                } else {
                    echo "There was an error sending your chat message. Please contact support";
                }
            }
            if ($_POST['action'] == "wplc_admin_set_transient") {
                set_transient("wplc_is_admin_logged_in", "1", 70 );
                
            }


            // user

            if ($_POST['action'] == "wplc_user_awaiting_chat") {
                $chat_id = $_POST['id'];
                echo wplc_return_chat_status($chat_id);
            }
            if ($_POST['action'] == "wplc_user_close_chat") {
                $chat_id = $_POST['cid'];
                wplc_change_chat_status($_POST['cid'],1);
            }
            if ($_POST['action'] == "wplc_user_send_msg") {
                $chat_id = $_POST['cid'];
                $chat_msg = $_POST['msg'];
                $wplc_rec_msg = wplc_record_chat_msg("1",$chat_id,$chat_msg);
                if ($wplc_rec_msg) {
                    echo 'sent';
                } else {
                    echo "There was an error sending your chat message. Please contact support";
                }
            }

            
           
            
            
            
            
            if ($_POST['action'] == "wplc_update_user_chat_boxes") {
                echo wplc_return_user_chat_messages($_POST['cid']);
                wplc_mark_as_read_user_chat_messages($_POST['cid']);
            }
            if ($_POST['action'] == "wplc_user_reactivate_chat") {
                wplc_change_chat_status($_POST['cid'],3);
                echo wplc_return_chat_messages($_POST['cid']);
                
            }

        }
        
	die(); // this is required to return a proper result

}

function wplc_record_chat_msg($from,$cid,$msg) {
    global $wpdb;
    global $wplc_tblname_msgs;

    if ($from == "1") { 
        $fromname = wplc_return_chat_name($cid);
        $orig = '2';
    }
    else { 
        if (function_exists("wplc_register_pro_version")) { $fromname = wplc_return_from_name(); }
        else { $fromname = "admin"; }
        $orig = '1';
    }

    $ins_array = array(
      'chat_sess_id' => $cid,
      'timestamp' => date("Y-m-d H:i:s"),
      'from' => $fromname,
      'msg' => $msg,
      'status' => 0,
      'originates' => $orig
    );
    $rows_affected = $wpdb->insert( $wplc_tblname_msgs, $ins_array );
    
    wplc_update_active_timestamp($cid);
    wplc_change_chat_status($cid,3);
    return true;

    
}

function wplc_update_active_timestamp($cid) {
    global $wpdb;
    global $wplc_tblname_chats;
    $results = $wpdb->get_results(
        "
        UPDATE $wplc_tblname_chats 
        SET `last_active_timestamp` = '".date("Y-m-d H:i:s")."'
        WHERE `id` = '$cid'
        LIMIT 1
        "
    );
    wplc_change_chat_status($cid,3);
    return true;
    
}

function wplc_return_admin_chat_messages($cid) {
    global $wpdb;
    global $wplc_tblname_msgs;
    $results = $wpdb->get_results(
        "
            SELECT *
            FROM $wplc_tblname_msgs
            WHERE `chat_sess_id` = '$cid' AND `status` = '0' AND `originates` = '2'
            ORDER BY `timestamp` ASC
            
        "
    );
    $msg_hist = "";
    foreach ($results as $result) {
        $id = $result->id;
        $from = $result->from;
        
        $msg = stripslashes($result->msg);
        //$timestamp = strtotime($result->timestamp);
        //$timeshow = date("H:i",$timestamp);
        $msg_hist .= "<strong>$from</strong>: $msg<br />";
        
    }
    
    return $msg_hist;


}
function wplc_return_user_chat_messages($cid) {
    global $wpdb;
    global $wplc_tblname_msgs;
    $results = $wpdb->get_results(
        "
            SELECT *
            FROM $wplc_tblname_msgs
            WHERE `chat_sess_id` = '$cid' AND `status` = '0' AND `originates` = '1'
            ORDER BY `timestamp` ASC
            
        "
    );
    $msg_hist = "";
    foreach ($results as $result) {
        $id = $result->id;
        $from = $result->from;
        
        $msg = stripslashes($result->msg);
        //$timestamp = strtotime($result->timestamp);
        //$timeshow = date("H:i",$timestamp);
        $msg_hist .= "<strong>$from</strong>: $msg<br />";
        
    }
    
    return $msg_hist;


}
function wplc_return_chat_messages($cid) {
    global $wpdb;
    global $wplc_tblname_msgs;
    $results = $wpdb->get_results(
        "
        SELECT *
        FROM $wplc_tblname_msgs
        WHERE `chat_sess_id` = '$cid'
        ORDER BY `timestamp` ASC
        LIMIT 0, 100
        "
    );
    foreach ($results as $result) {
        $from = $result->from;
        $msg = $result->msg;
        $timestamp = strtotime($result->timestamp);
        $timeshow = date("H:i:s",$timestamp);
        $msg_hist .= "<strong>$from</strong>: $msg<br />";

    }
    return $msg_hist;


}
function wplc_mark_as_read_admin_chat_messages($cid) {
    global $wpdb;
    global $wplc_tblname_msgs;
    $results = $wpdb->get_results(
        "
            SELECT *
            FROM $wplc_tblname_msgs
            WHERE `chat_sess_id` = '$cid' AND `status` = '0' AND `originates` = '2' 
            ORDER BY `timestamp` DESC
            
        "
    );
    
    
    foreach ($results as $result) {
        $id = $result->id;
        $check = $wpdb->query(
	"
            UPDATE $wplc_tblname_msgs
            SET `status` = 1
            WHERE `id` = '$id' 
            LIMIT 1
		
	"
        );
    }
    return "ok";


}
function wplc_mark_as_read_user_chat_messages($cid) {
    global $wpdb;
    global $wplc_tblname_msgs;
    $results = $wpdb->get_results(
        "
            SELECT *
            FROM $wplc_tblname_msgs
            WHERE `chat_sess_id` = '$cid' AND `status` = '0' AND `originates` = '1' 
            ORDER BY `timestamp` DESC
            
        "
    );
    
    
    foreach ($results as $result) {
        $id = $result->id;
        $check = $wpdb->query(
	"
            UPDATE $wplc_tblname_msgs
            SET `status` = 1
            WHERE `id` = '$id' 
            LIMIT 1
		
	"
        );
    }
    return "ok";


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
function wplc_update_chat_statuses() {
    global $wpdb;
    global $wplc_tblname_chats;
    $results = $wpdb->get_results(
        "
        SELECT *
        FROM $wplc_tblname_chats
        WHERE `status` = '2' OR `status` = '3' OR `status` = '5'
        "
    );
    foreach ($results as $result) {
        $id = $result->id;
        $timestamp = strtotime($result->last_active_timestamp);
        if ($result->status == 2) {
            if ((time() -  $timestamp) >= 60) { // 1 minute max
                wplc_change_chat_status($id,0);
            }
        }
        else if ($result->status == 3) {
            if ((time() -  $timestamp) >= 600) { // 10 minute max
                wplc_change_chat_status($id,1);
            }
        }
        else if ($result->status == 5) {
            if ((time() -  $timestamp) >= 120) { // 2 minute timeout
                wplc_change_chat_status($id,7); // 7 - timedout
            }
        }
        echo time()." ".$timestamp;
    }
}

function wplc_user_initiate_chat($name,$email,$cid = null) {
    global $wpdb;
    global $wplc_tblname_chats;

    if (function_exists("wplc_register_pro_version")) { 
        wplc_pro_notify_via_email(); 
    }
    
    if ($cid != null) { // change from a visitor to a chat
        $query = 
        "
        UPDATE $wplc_tblname_chats 
            SET 
                `status` = '2',
                `timestamp` = '".date("Y-m-d H:i:s")."',
                `name` = '$name',
                `email` = '$email',
                `ip` = '".$_SERVER['REMOTE_ADDR']."',
                `url` = '".$_SERVER['HTTP_REFERER']."',
                `last_active_timestamp` = '".date("Y-m-d H:i:s")."'

            WHERE `id` = '$cid'
            LIMIT 1
        ";
        $results = $wpdb->query($query);
        return $cid;
    }
    else { // create new ID for the chat
        $ins_array = array(
          'status' => '2',
          'timestamp' => date("Y-m-d H:i:s"),
          'name' => $name,
          'email' => $email,
          'ip' => $_SERVER['REMOTE_ADDR'],
          'url' => $_SERVER['HTTP_REFERER'],
          'last_active_timestamp' => date("Y-m-d H:i:s")
        );
        $rows_affected = $wpdb->insert( $wplc_tblname_chats, $ins_array );
        $lastid = $wpdb->insert_id;
        return $lastid;
    }

}
function wplc_log_user_on_page($name,$email) {
    global $wpdb;
    global $wplc_tblname_chats;

    $ins_array = array(
      'status' => '5',
      'timestamp' => date("Y-m-d H:i:s"),
      'name' => $name,
      'email' => $email,
      'ip' => $_SERVER['REMOTE_ADDR'],
      'url' => $_SERVER['HTTP_REFERER'],
      'last_active_timestamp' => date("Y-m-d H:i:s")
    );
    
    $rows_affected = $wpdb->insert( $wplc_tblname_chats, $ins_array );

    $lastid = $wpdb->insert_id;


    return $lastid;

}
function wplc_update_user_on_page($cid) {
    global $wpdb;
    global $wplc_tblname_chats;

    $query = 
    "
    UPDATE $wplc_tblname_chats 
        SET 
            `url` = '".$_SERVER['HTTP_REFERER']."',
            `last_active_timestamp` = '".date("Y-m-d H:i:s")."',
            `ip` = '".$_SERVER['REMOTE_ADDR']."',
            `status` = '5'
            
        WHERE `id` = '$cid'
        LIMIT 1
    ";
    $results = $wpdb->query($query);
    return $query;
    
    

}
function wplc_change_chat_status($id,$status) {
    global $wpdb;
    global $wplc_tblname_chats;
    $results = $wpdb->get_results(
        "
        UPDATE $wplc_tblname_chats 
        SET `status` = '$status'
        WHERE `id` = '$id'
        LIMIT 1
        "
    );
    return true;

}
function wplc_return_chat_name($cid) {
    global $wpdb;
    global $wplc_tblname_chats;
    $results = $wpdb->get_results(
        "
        SELECT *
        FROM $wplc_tblname_chats
        WHERE `id` = '$cid'
        "
    );
    foreach ($results as $result) {
       return $result->name;
    }

}
function wplc_return_chat_status($cid) {
    global $wpdb;
    global $wplc_tblname_chats;
    $results = $wpdb->get_results(
        "
        SELECT *
        FROM $wplc_tblname_chats
        WHERE `id` = '$cid'
        "
    );
    foreach ($results as $result) {
       return $result->status;
    }
}


function wplc_return_status($status) {
    if ($status == 1) {
        return "complete";
    }
    if ($status == 2) {
        return "pending";
    }
    if ($status == 3) {
        return "active";
    }
    if ($status == 4) {
        return "deleted";
    }
    if ($status == 5) {
        return "browsing";
    }
    if ($status == 6) {
        return "requesting chat";
    }
}

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

            var wplc_autoLoad = null;
            var wplc_refresh_chat_area = null;
            var wplc_refresh_status = null;

            


            wplc_refresh_chat_area = setInterval(function (){wpcl_admin_update_chats();}, 4000);
            function wpcl_admin_update_chats(cid) {
                var data = {
                        action: 'wplc_update_admin_chat',
                        security: '<?php echo $ajax_nonce; ?>'
                };
                jQuery.post(ajaxurl, data, function(response) {
                        //console.log("wplc_update_admin_chat");
                        jQuery("#wplc_admin_chat_area").html(response);
                        if (response.indexOf("pending") >= 0) {
                            document.getElementById("wplc_sound").innerHTML="<embed src='<?php echo plugins_url('/beep-2.mp3', __FILE__); ?>' hidden=true autostart=true loop=false>";
                        }
                            
                        
                });
            }

            wplc_refresh_status = setInterval(function (){wplc_update_statuses();}, 10000);
            function wplc_update_statuses() {
                var data = {
                        action: 'wplc_update_admin_status',
                        security: '<?php echo $ajax_nonce; ?>'
                };
                jQuery.post(ajaxurl, data, function(response) {
                    //console.log("wplc_update_admin_status");
                    //alert(response);
                });
            };


        });



    </script>
    <?php
}


function wplc_list_chats() {

    global $wpdb;
    global $wplc_tblname_chats;

    $results = $wpdb->get_results(
	"
	SELECT *
	FROM $wplc_tblname_chats
        WHERE `status` = 3 OR `status` = 2
        ORDER BY `timestamp` ASC
        
	"
    );
    echo "
        

      <table class=\"wp-list-table widefat fixed \" cellspacing=\"0\">
	<thead>
	<tr>
		<th scope='col' id='wplc_id_colum' class='manage-column column-id sortable desc'  style=''><span>".__("IP","wplivechat")."</span></th>
                <th scope='col' id='wplc_name_colum' class='manage-column column-name_title sortable desc'  style=''><span>".__("Name","wplivechat")."</span></th>
                <th scope='col' id='wplc_email_colum' class='manage-column column-email' style=\"\">".__("Email","wplivechat")."</th>
                <th scope='col' id='wplc_url_colum' class='manage-column column-url' style=\"\">".__("URL","wplivechat")."</th>
                <th scope='col' id='wplc_status_colum' class='manage-column column-status'  style=\"\">".__("Status","wplivechat")."</th>
                <th scope='col' id='wplc_action_colum' class='manage-column column-action sortable desc'  style=\"\"><span>".__("Action","wplivechat")."</span></th>
        </tr>
	</thead>
        <tbody id=\"the-list\" class='list:wp_list_text_link'>
        ";
    
    if (!$results) {
        echo "<tr><td></td><td>".__("No chat sessions available at the moment","wplivechat")."</td></tr>";
    }
    else {
        foreach ($results as $result) {
             unset($trstyle);
             unset($actions);
             $wplc_c++;

            if ($result->status == 2) {
                $url = admin_url( 'admin.php?page=wplivechat-menu&action=ac&cid='.$result->id);
                $actions = "<a href=\"#\" onclick=\"window.open('$url', 'mywindow".$result->id."', 'location=no,status=1,scrollbars=1,width=500,height=650');return false;\">Accept Chat</a>";
                $trstyle = "style='background-color:#FFFBE4; height:30px;'";
            }
            if ($result->status == 3) {
                $url = admin_url( 'admin.php?page=wplivechat-menu&action=ac&cid='.$result->id);
                $actions = "<a href=\"#\" onclick=\"window.open('$url', 'mywindow".$result->id."', 'location=no,status=1,scrollbars=1,width=500,height=650');return false;\">Open Chat Window</a>";
                $trstyle = "style='background-color:#F7FCFE; height:30px;'";
            }


            echo "<tr id=\"record_".$result->id."\" $trstyle>";
            echo "<td class='chat_id column-chat_d'>".$result->ip."</td>";
            echo "<td class='chat_name column_chat_name' id='chat_name_".$result->id."'><img src=\"http://www.gravatar.com/avatar/".md5($result->email)."?s=40\" /> ".$result->name."</td>";
            echo "<td class='chat_email column_chat_email' id='chat_email_".$result->id."'>".$result->email."</td>";
            echo "<td class='chat_name column_chat_url' id='chat_url_".$result->id."'>".$result->url."</td>";
            echo "<td class='chat_status column_chat_status' id='chat_status_".$result->id."'><strong>".wplc_return_status($result->status)."</strong></td>";if ($wplc_c>1 && !function_exists("wplc_register_pro_version")) { $actions = wplc_get_msg(); }
            echo "<td class='chat_action column-chat_action' id='chat_action_".$result->id."'>$actions</td>";
            echo "</tr>";

        }
    }
    echo "</table><br /><br />";
    

}

function wplc_admin_menu_layout() {
    if (function_exists("wplc_register_pro_version")) {
        wplc_pro_admin_menu_layout_display();
    } else {
        wplc_admin_menu_layout_display();
    }

}

function wplc_admin_menu_layout_display() {
    
   if (!isset($_GET['action'])) {

        ?>
        <h1>Live Chat</h1>
        <div id="wplc_sound"></div>
        <div id="wplc_admin_chat_area">
        <?php wplc_list_chats(); ?>
        </div>
        <h1>Online Visitors</h1>    
        <p><?php _e("With the Pro add-on of WP Live Chat Support, you can","wplivechat"); ?> <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate1" title="<?php _e("see who's online and initiate chats","wplivechat"); ?>" target=\"_BLANK\"><?php _e("see who's online and initiate chats","wplivechat"); ?></a> <?php _e("with your online visitors with the click of a button.","wplivechat"); ?> <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=initiate2" title="<?php _e("Buy the Pro add-on now for only $9.95 once off","wplivechat"); ?>" target=\"_BLANK\"><?php _e("Buy the Pro add-on now for only $9.95 once off","wplivechat"); ?></a></p>
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
    );

    
    foreach ($results as $result) {
        if ($result->status == 1) { $status = "Previous"; } else { $status = "Active"; }
        
        echo "<h2>$status Chat with ".$result->name."</h2>";
        echo "<div style='display:block;'>";
            echo "<div style='float:left; width:100px;'><img src=\"http://www.gravatar.com/avatar/".md5($result->email)."\" /></div>";
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
        <div id='admin_chat_box'>
            <div id='admin_chat_box_area_".$result->id."' style='height:200px; width:290px; border:1px solid #ccc; overflow:auto;'>".wplc_return_chat_messages($cid)."</div>
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
function wplc_get_msg() {
    return "<a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=morechats\" title=\"".__("Get Pro Add-on to accept more chats","wplivechat")."\" target=\"_BLANK\">Get Pro Add-on to accept more chats</a>";
}

function wplc_return_admin_chat_javascript($cid) {
        $ajax_nonce = wp_create_nonce("wplc");
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function() {
            
            
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
                jQuery.post(ajaxurl, data, function(response) {
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
                jQuery.post(ajaxurl, data, function(response) {
                        //console.log("wplc_admin_send_msg");
                        
                });


            });            
            
            
            wplc_auto_refresh = setInterval(function (){wpcl_admin_auto_update_chat_box(wplc_gcid);}, 3500);
            function wpcl_admin_auto_update_chat_box(cid) {
                
                var data = {
                        action: 'wplc_update_admin_chat_boxes',
                        cid: cid,
                        security: wplc_nonce
                };
                jQuery.post(ajaxurl, data, function(response) {
                    //console.log("wplc_update_admin_chat_boxes");
                    //alert(response);
                    //jQuery("#admin_chat_box_area_"+cid).html(response);
                    jQuery("#admin_chat_box_area_"+cid).append(response);
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
                jQuery.post(ajaxurl, data, function(response) {
                    //console.log("wplc_update_admin_return_chat_status");
                    if (chat_status != response) {
                    chat_status = response;
                        if (chat_status == "1") { 
                            //clearInterval(wplc_auto_check_status_of_chat);
                            //clearInterval(wplc_auto_refresh);
                            jQuery("#admin_chat_box_area_"+cid).append("<em><?php _e("User has minimized the chat window","wplivechat"); ?></em><br />");
                            var height = jQuery('#admin_chat_box_area_'+cid)[0].scrollHeight;
                            jQuery('#admin_chat_box_area_'+cid).scrollTop(height);
                            
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
        add_option('WPLC_SETTINGS',array("wplc_settings_align" => "2", "other" => "other"));
    }
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
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);

   $sql = "
        CREATE TABLE `".$wplc_tblname_msgs."` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `chat_sess_id` int(11) NOT NULL,
          `from` varchar(150) NOT NULL,
          `msg` varchar(700) NOT NULL,
          `timestamp` datetime NOT NULL,
          `status` INT(3) NOT NULL,
          `originates` INT(3) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
    ";

   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
   dbDelta($sql);



   add_option("wplc_db_version", $wplc_version);
   update_option("wplc_db_version",$wplc_version);
}

function wplc_add_user_stylesheet() {
    wp_register_style( 'wplc-style', plugins_url('/css/wplcstyle.css', __FILE__) );
    wp_enqueue_style( 'wplc-style' );
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
        echo "<br /><br >This option is only available in the <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history1\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">Pro Add-on</a> of WP Live Chat. <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=history2\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">Get it now for only $9.95 once off!</a>";
    }
}

function wplc_settings_page_basic() {
    echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("WP Live Chat Support Settings","wplivechat")."</h2>";

    $wplc_settings = get_option("WPLC_SETTINGS");
    
    
    if ($wplc_settings["wplc_settings_align"]) { $wplc_settings_align[intval($wplc_settings["wplc_settings_align"])] = "SELECTED"; }
    


    echo "<form action='' name='wplc_settings' method='post' id='wplc_settings'>";
    
    if (function_exists("wplc_register_pro_version")) {
        $wplc_pro_chat_name = wplc_settings_page_pro('chat_name');
        $wplc_pro_chat_pic = wplc_settings_page_pro('chat_pic');
        $wplc_pro_chat_logo = wplc_settings_page_pro('chat_logo');
        $wplc_pro_chat_delay = wplc_settings_page_pro('chat_delay');
        $wplc_pro_chat_fs = wplc_settings_page_pro('wplc_chat_window_text1');
        $wplc_pro_chat_emailme = wplc_settings_page_pro('chat_email_on_chat');
    } else {
        $wplc_pro_chat_name = "
            <tr>
                <td width='200' valign='top'>".__("Name","wplivechat").":</td>
                <td>
                    <input type='text' size='50' maxlength='50' disabled readonly value='admin' /><small><i> ".__("available in the","wplivechat")." <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=name\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">".__("Pro Add-on","wplivechat")."</a> ".__("only","wplivechat").".   </i></small>
                </td>
            </tr>
        ";
        $wplc_pro_chat_pic = "
            <tr>
                <td width='200' valign='top'>".__("Picture","wplivechat").":</td>
                <td>
                    <input id=\"wplc_pro_pic_button\" type=\"button\" value=\"".__("Upload Image","wplivechat")."\" readonly disabled /><small><i> ".__("available in the","wplivechat")." <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=pic\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">".__("Pro Add-on","wplivechat")."</a> ".__("only","wplivechat").".   </i></small>
                </td>
            </tr>
        ";
        $wplc_pro_chat_logo = "
            <tr>
                <td width='200' valign='top'>".__("Logo","wplivechat").":</td>
                <td>
                    <input id=\"wplc_pro_logo_button\" type=\"button\" value=\"".__("Upload Image","wplivechat")."\" readonly disabled /><small><i> ".__("available in the","wplivechat")." <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=pic\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">".__("Pro Add-on","wplivechat")."</a> ".__("only","wplivechat").".   </i></small>
                </td>
            </tr>
        ";
        $wplc_pro_chat_delay = "
            <tr>
                <td width='200' valign='top'>".__("Chat Delay (seconds)","wplivechat").":</td>
                <td>
                    <input type='text' size='50' maxlength='50' disabled readonly value='10' /> <small><i> ".__("available in the","wplivechat")." <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=delay\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">".__("Pro Add-on","wplivechat")."</a> ".__("only","wplivechat").".   </i></small>
                </td>
            </tr>
        ";
        $wplc_pro_chat_emailme = "
            <tr>
                <td width='200' valign='top'>".__("Chat notifications","wplivechat").":</td>
                <td>
                    <input id='wplc_pro_chat_notification' name='wplc_pro_chat_notification' type='checkbox' value='yes' disabled=\"disabled\" readonly/>
                        ".__("Alert me via email as soon as someone wants to chat","wplivechat")."
                            <small><i> ".__("available in the","wplivechat")." <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=alert\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">".__("Pro Add-on","wplivechat")."</a> ".__("only","wplivechat").".   </i></small>
                </td>
            </tr>
        ";
        $wplc_pro_chat_fs = "
            <tr style='height:30px;'><td></td><td></td></tr>
            <tr>
                <td width='200' valign='top'>".__("First Section Text","wplivechat").":</td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='Questions?' /> <br />
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='Chat with us' /> <br />
                </td>
            </tr>
            <tr>
                <td width='200' valign='top'>".__("Second Section Text","wplivechat").":</td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='Start Chat' /> <br />
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='Connecting you to a sales person. Please be patient.' /> <br />


                </td>
            </tr>
            <tr>
                <td width='200' valign='top'>".__("Reactivate Chat Section Text","wplivechat").":</td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='Reactivating your previous chat...' /><small><i> ".__("Edit these text fields using the ","wplivechat")." <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=textfields3\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">".__("Pro Add-on","wplivechat")."</a>.   </i></small> <br />


                </td>
            </tr>
            <tr>
                <td width='200' valign='top'>".__("Offline Text","wplivechat").":</td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='Chat offline. Leave a message' /><small><i> ".__("Edit these text fields using the ","wplivechat")." <a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=textfields4\" title=\"".__("Pro Add-on","wplivechat")."\" target=\"_BLANK\">".__("Pro Add-on","wplivechat")."</a>.   </i></small> <br />


                </td>
            </tr>
        ";
    }
    
    
    
    echo "

                <h3>".__("Chat Window Settings",'wplivechat')."</h3>
                <table class='form-table' width='700'>
                    $wplc_pro_chat_name
                    $wplc_pro_chat_pic
                    $wplc_pro_chat_logo
                    $wplc_pro_chat_delay
                    $wplc_pro_chat_emailme
                    <tr>
                        <td width='200' valign='top'>".__("Chat Box Alignment","wplivechat").":</td>
                        <td>
                            <select id='wplc_settings_align' name='wplc_settings_align'>
                                <option value=\"1\" ".$wplc_settings_align[1].">".__("Bottom left","wplivechat")."</option>
                                <option value=\"2\" ".$wplc_settings_align[2].">".__("Bottom right","wplivechat")."</option>
                            </select>
                        </td>
                    </tr>
                    $wplc_pro_chat_fs
                    
                </table>


                <p class='submit'><input type='submit' name='wplc_save_settings' class='button-primary' value='".__("Save Settings","wplivechat")." &raquo;' /></p>


            </form>
    ";

    echo "</div>";

    
}
function wplc_head() {
    global $wpdb;

    if (isset($_POST['wplc_save_settings'])){

            $wplc_data['wplc_settings_align'] = attribute_escape($_POST['wplc_settings_align']);
            update_option('WPLC_SETTINGS', $wplc_data);

            if (function_exists("wplc_register_pro_version")) { 
                wplc_pro_save_settings();
            } 

            echo "<div class='updated'>";
            _e("Your settings have been saved.","wplivechat");
            echo "</div>";

    
   }

}

function wplc_logout() {
    delete_transient('wplc_is_admin_logged_in');
}
add_action('wp_logout', 'wplc_logout');