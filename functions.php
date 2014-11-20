<?php
$wplc_basic_plugin_url = get_option('siteurl')."/wp-content/plugins/wp-live-chat-support/";
function wplc_log_user_on_page($name,$email,$session) {
    global $wpdb;
    global $wplc_tblname_chats;

    
    $user_data = array(
        'ip' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT']
    );
    
    
    $ins_array = array(
        'status' => '5',
        'timestamp' => date("Y-m-d H:i:s"),
        'name' => $name,
        'email' => $email,
        'session' => $session,
        'ip' => maybe_serialize($user_data),
        'url' => $_SERVER['HTTP_REFERER'],
        'last_active_timestamp' => date("Y-m-d H:i:s")
    );

    $rows_affected = $wpdb->insert( $wplc_tblname_chats, $ins_array );

    $lastid = $wpdb->insert_id;


    return $lastid;

}
function wplc_update_user_on_page($cid, $status = 5,$session) {
    global $wpdb;
    global $wplc_tblname_chats;

    
     
    $user_data = array(
        'ip' => $_SERVER['REMOTE_ADDR'],
        'user_agent' => $_SERVER['HTTP_USER_AGENT']
    );
    
    $query =
        "
    UPDATE $wplc_tblname_chats
        SET
            `url` = '".$_SERVER['HTTP_REFERER']."',
            `last_active_timestamp` = '".date("Y-m-d H:i:s")."',
            `ip` = '".maybe_serialize($user_data)."',
            `status` = '$status',
            `session` = '$session'

        WHERE `id` = '$cid'
        LIMIT 1
    ";
    $results = $wpdb->query($query);
    return $query;



}



function wplc_record_chat_msg($from,$cid,$msg) {
    global $wpdb;
    global $wplc_tblname_msgs;

    if ($from == "1") {
        $fromname = wplc_return_chat_name($cid);
        //$fromemail = wplc_return_chat_email($cid);
        $orig = '2';
    }
    else {
        $fromname = "admin";
        //$fromemail = "SET email";
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
function wplc_return_chat_email($cid) {
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
        return $result->email;
    }

}
function wplc_list_chats() {

    global $wpdb;
    global $wplc_tblname_chats;
    $status = 3;
    $wplc_c = 0;    
    $results = $wpdb->get_results(
        "
	SELECT *
	FROM $wplc_tblname_chats
        WHERE `status` = 3 OR `status` = 2
        ORDER BY `timestamp` ASC

	"
    );
    
    $table = "<table class=\"wp-list-table widefat fixed \" cellspacing=\"0\">"
                . "<thead>"
                    . "<tr>"
                        . "<th scope='col' id='wplc_id_colum' class='manage-column column-id sortable desc'  style=''><i class=\"fa fa-globe\"> </i> <span>".__("User Data","wplivechat")."</span></th>"
                        . "<th scope='col' id='wplc_name_colum' class='manage-column column-name_title sortable desc'  style=''><i class=\"fa fa-user\"> </i> <span>".__("Name","wplivechat")."</span></th>"
                        . "<th scope='col' id='wplc_email_colum' class='manage-column column-email' style=\"\"><i class=\"fa fa-envelope\"> </i> ".__("Email","wplivechat")."</th>"
                        . "<th scope='col' id='wplc_url_colum' class='manage-column column-url' style=\"\"><i class=\"fa fa-link\"> </i> ".__("URL","wplivechat")."</th>"
                        . "<th scope='col' id='wplc_status_colum' class='manage-column column-status'  style=\"\"><i class=\"fa fa-cog\"> </i> ".__("Status","wplivechat")."</th>"
                        . "<th scope='col' id='wplc_action_colum' class='manage-column column-action sortable desc'  style=\"\"><i class=\"fa fa-rocket\"> </i> <span>".__("Action","wplivechat")."</span></th>"
                    . "</tr>"
                . "</thead>"
            . "<tbody id=\"the-list\" class='list:wp_list_text_link'>";

    if (!$results) {
        $table .= "<tr><td></td><td>".__("No chat sessions available at the moment","wplivechat")."</td></tr>";
    }
    else {
        
        foreach ($results as $result) {
            unset($trstyle);
            unset($actions);
            $wplc_c++;

            
            global $wplc_basic_plugin_url;
            $user_data = maybe_unserialize($result->ip);
            $user_ip = $user_data['ip'];
            $browser = wplc_return_browser_string($user_data['user_agent']);
            $browser_image = wplc_return_browser_image($browser,"16");
            
            if ($result->status == 2) {
                $url = admin_url( 'admin.php?page=wplivechat-menu&action=ac&cid='.$result->id);
                $actions = "<a href=\"".$url."\" class=\"wplc_open_chat button button-primary\" window-title=\"WP_Live_Chat_".$result->id."\">".__("Accept Chat","wplivechat")."</a>";
                $trstyle = "style='background-color:#FFFBE4; height:30px;'";
            }
            if ($result->status == 3) {
                $url = admin_url( 'admin.php?page=wplivechat-menu&action=ac&cid='.$result->id);
                $actions = "<a href=\"".$url."\" class=\"wplc_open_chat button button-primary\" window-title=\"WP_Live_Chat_".$result->id."\">".__("Open Chat Window","wplivechat")."</a>";
                $trstyle = "style='background-color:#F7FCFE; height:30px;'";
            }
            if ($wplc_c>1) { $actions = wplc_get_msg(); }
            $table .= "<tr id=\"record_".$result->id."\" $trstyle>"
                        . "<td class='chat_id column-chat_d'><img src='".$wplc_basic_plugin_url."/images/$browser_image' alt='$browser' title='$browser' /> ".$user_ip."</td>"
                        . "<td class='chat_name column_chat_name' id='chat_name_".$result->id."'><img src=\"http://www.gravatar.com/avatar/".md5($result->email)."?s=40\" /> ".$result->name."</td>"
                        . "<td class='chat_email column_chat_email' id='chat_email_".$result->id."'>".$result->email."</td>"
                        . "<td class='chat_name column_chat_url' id='chat_url_".$result->id."'>".$result->url."</td>"
                        . "<td class='chat_status column_chat_status' id='chat_status_".$result->id."'><strong>".wplc_return_status($result->status)."</strong></td>"
                        . "<td class='chat_action column-chat_action' id='chat_action_".$result->id."'>$actions</td>"
                    . "</tr>";

        }
    }
    $table .= "</table><br /><br />";
    
    return $table;
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
        $image = "";
        
            if(function_exists("wplc_pro_get_admin_picture")){
                $src = wplc_pro_get_admin_picture();
                if($src){
                    $image = "<img src=".$src." width='20px' id='wp-live-chat-2-img'/>";
                }
            }
        $msg_hist .= "<span class='wplc-admin-message'>$image <strong>$from</strong>:<hr/> $msg</span><br /><div class='wplc-clear-float-message'></div>";

    }

    return $msg_hist;


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
    $msg_hist = "";
    foreach ($results as $result) {
        $from = $result->from;
        $msg = $result->msg;
        $timestamp = strtotime($result->timestamp);
        $timeshow = date("H:i:s",$timestamp);
        $image = "";
        if($result->originates == 1){
            $class = "wplc-admin-message";
            if(function_exists("wplc_pro_get_admin_picture")){
                $src = wplc_pro_get_admin_picture();
                if($src){
                    $image = "<img src=".$src." width='20px' id='wp-live-chat-2-img'/>";
                }
            }
        } else {
            $class = "wplc-user-message";
        }
        
        
        
        
        $msg_hist .= "<span class='$class'>$image <strong>$from</strong>:<hr/> $msg</span><br /><div class='wplc-clear-float-message'></div>";

    }
    return $msg_hist;


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
        wplc_mark_as_read_admin_chat_messages($id);    
        $msg = stripslashes($result->msg);
        //$timestamp = strtotime($result->timestamp);
        //$timeshow = date("H:i",$timestamp);
        $msg_hist .= "<span class='wplc-user-message'><strong>$from</strong>:<hr/> $msg</span><br /><div class='wplc-clear-float-message'></div>";

    }

    return $msg_hist;


}
function wplc_mark_as_read_admin_chat_messages($mid) {
    global $wpdb;
    global $wplc_tblname_msgs;
        
    $check = $wpdb->query(
        "
        UPDATE $wplc_tblname_msgs
        SET `status` = 1
        WHERE `id` = '$mid'
        LIMIT 1

    "
    );

}





function wplc_return_chat_session_variable($cid) {
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
        return $result->session;
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
        return __("complete","wplivechat");
    }
    if ($status == 2) {
        return __("pending", "wplivechat");
    }
    if ($status == 3) {
        return __("active", "wplivechat");
    }
    if ($status == 4) {
        return __("deleted", "wplivechat");
    }
    if ($status == 5) {
        return __("browsing", "wplivechat");
    }
    if ($status == 6) {
        return __("requesting chat", "wplivechat");
    }
    if($status == 8){
        return __("Chat Ended - User still browsing", "wplivechat");
    }
    if($status == 9){
        return __("User is browsing but doesn't want to chat", "wplivechat");
    }
    
}

function wplc_user_initiate_chat($name,$email,$cid = null,$session) {
    global $wpdb;
    global $wplc_tblname_chats;

    if (function_exists("wplc_list_chats_pro")) { /* check if functions-pro is around */
        wplc_pro_notify_via_email();
    }

    if ($cid != null) { /* change from a visitor to a chat */
        
        $user_data = array(
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        );

        $query =
            "
        UPDATE $wplc_tblname_chats
            SET
                `status` = '2',
                `timestamp` = '".date("Y-m-d H:i:s")."',
                `name` = '$name',
                `email` = '$email',
                `session` = '$session',
                `ip` = '".maybe_serialize($user_data)."',
                `url` = '".$_SERVER['HTTP_REFERER']."',
                `last_active_timestamp` = '".date("Y-m-d H:i:s")."'

            WHERE `id` = '$cid'
            LIMIT 1
        ";
        $results = $wpdb->query($query);
        return $cid;
    }
    else { // create new ID for the chat
        $user_data = array(
            'ip' => $_SERVER['REMOTE_ADDR'],
            'user_agent' => $_SERVER['HTTP_USER_AGENT']
        );
        $ins_array = array(
            'status' => '2',
            'timestamp' => date("Y-m-d H:i:s"),
            'name' => $name,
            'email' => $email,
            'session' => $session,
            'ip' => maybe_serialize($user_data),
            'url' => $_SERVER['HTTP_REFERER'],
            'last_active_timestamp' => date("Y-m-d H:i:s")
        );
        $rows_affected = $wpdb->insert( $wplc_tblname_chats, $ins_array );
        $lastid = $wpdb->insert_id;
        return $lastid;
    }

}



function wplc_get_msg() {
    return "<a href=\"http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=morechats\" title=\"".__("Get Pro Add-on to accept more chats","wplivechat")."\" target=\"_BLANK\">Get Pro Add-on to accept more chats</a>";
}
function wplc_update_chat_statuses() {

    global $wpdb;
    global $wplc_tblname_chats;
    $results = $wpdb->get_results(
        "
        SELECT *
        FROM $wplc_tblname_chats
        WHERE `status` = '2' OR `status` = '3' OR `status` = '5' or `status` = '8' or `status` = '9' or `status` = '10'
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
            if ((time() -  $timestamp) >= 30) { // 30 seconds
                wplc_change_chat_status($id,1);
            }
        }
        else if ($result->status == 5) {
            if ((time() -  $timestamp) >= 120) { // 2 minute timeout
                wplc_change_chat_status($id,7); // 7 - timedout
            }
        } else if($result->status == 8){ // chat is complete but user is still browsing
            if ((time() -  $timestamp) >= 20) { // 20 seconds
                wplc_change_chat_status($id,1); // 1 - chat is now complete
            }
        } else if($result->status == 9 || $result->status == 10){
            if ((time() -  $timestamp) >= 20) { // 20 seconds
                wplc_change_chat_status($id,7); // 7 - timedout
            }
        }
    }
}
function wplc_check_pending_chats(){
    global $wpdb;
    global $wplc_tblname_chats;
    $sql = "SELECT * FROM `$wplc_tblname_chats` WHERE `status` = 2";
    $wpdb->query($sql);
    if($wpdb->num_rows){
        return true;
    } else {
        return false;
    }       
}
function wplc_get_active_and_pending_chats(){
    global $wpdb;
    global $wplc_tblname_chats;
    $sql = "SELECT * FROM `$wplc_tblname_chats` WHERE `status` = 2 OR `status` = 3 ORDER BY `status`";
    $results = $wpdb->get_results($sql);
    if($results){
        return $results;
    } else {
        return false;
    }
}
function wplc_convert_array_to_string($array){
    $string = "";
    if($array){
        foreach($array as $value){
            $string.= $value->id." ;";
        }
    } else {
        $string = false;
    }
    return $string;
}

function wplc_return_browser_image($string,$size) {
    switch($string) {
        
        case "Internet Explorer":
            return "web_".$size."x".$size.".png";
            break;
        case "Mozilla Firefox":
            return "firefox_".$size."x".$size.".png";
            break;
        case "Opera":
            return "opera_".$size."x".$size.".png";
            break;
        case "Google Chrome":
            return "chrome_".$size."x".$size.".png";
            break;
        case "Safari":
            return "safari_".$size."x".$size.".png";
            break;
        case "Other browser":
            return "web_".$size."x".$size.".png";
            break;
        default:
            return "web_".$size."x".$size.".png";
            break;       
    }
    
    
}
function wplc_return_browser_string($user_agent) {
if(strpos($user_agent, 'MSIE') !== FALSE)
   return 'Internet explorer';
 elseif(strpos($user_agent, 'Trident') !== FALSE) //For Supporting IE 11
    return 'Internet explorer';
 elseif(strpos($user_agent, 'Firefox') !== FALSE)
   return 'Mozilla Firefox';
 elseif(strpos($user_agent, 'Chrome') !== FALSE)
   return 'Google Chrome';
 elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Opera') !== FALSE)
   return "Opera";
 elseif(strpos($user_agent, 'Safari') !== FALSE)
   return "Safari";
 else
   return 'Other browser';
}

function wplc_error_directory() {
    $upload_dir = wp_upload_dir();
    
    if (is_multisite()) {
        if (!file_exists($upload_dir['basedir'].'/wp-live-chat-support')) {
            wp_mkdir_p($upload_dir['basedir'].'/wp-live-chat-support');
            $content = "Error log created";
            $fp = @fopen($upload_dir['basedir'].'/wp-live-chat-support'."/error_log.txt","w+");
            fwrite($fp,$content);
        }
    } else {
        if (!file_exists(ABSPATH.'wp-content/uploads/wp-live-chat-support')) {
            wp_mkdir_p(ABSPATH.'wp-content/uploads/wp-live-chat-support');
            $content = "Error log created";
            $fp = @fopen(ABSPATH.'wp-content/uploads/wp-live-chat-support'."/error_log.txt","w+");
            fwrite($fp,$content);
        }
        
    }
    return true;
    
}

function wplc_error_log($error) {
    /*
    $content = "\r\n[".date("Y-m-d")."] [".date("H:i:s")."]".$error;
    $fp = @fopen(ABSPATH.'/wp-content/uploads/wp-live-chat-support'."/error_log.txt","a+");
    fwrite($fp,$content);
    fclose($fp);
    */
    
}
function Memory_Usage($decimals = 2)
{
    $result = 0;

    if (function_exists('memory_get_usage'))
    {
        $result = memory_get_usage() / 1024;
    }

    else
    {
        if (function_exists('exec'))
        {
            $output = array();

            if (substr(strtoupper(PHP_OS), 0, 3) == 'WIN')
            {
                exec('tasklist /FI "PID eq ' . getmypid() . '" /FO LIST', $output);

                $result = preg_replace('/[\D]/', '', $output[5]);
            }

            else
            {
                exec('ps -eo%mem,rss,pid | grep ' . getmypid(), $output);

                $output = explode('  ', $output[0]);

                $result = $output[1];
            }
        }
    }

    return number_format(intval($result) / 1024, $decimals, '.', '')." mb";
}
function wplc_get_memory_usage() {
    $size = memory_get_usage(true);
    $unit=array('b','kb','mb','gb','tb','pb');
    return @round($size/pow(1024,($i=floor(log($size,1024)))),2).' '.$unit[$i];
    
}
function wplc_record_mem() {
    $data = array(
        'date' => date('Y-m-d H:i:s'),
        'php_mem' => wplc_get_memory_usage()
    );
    $fp = @fopen(ABSPATH.'/wp-content/uploads/wp-live-chat-support'."/mem_usag.csv","a+");
    fputcsv($fp, $data);
    fclose($fp);
}
