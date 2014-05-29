<?php

ini_set('html_errors', 0);
define('SHORTINIT', true);


//$absolute_path = __FILE__;

//$path_to_file = explode( 'wp-content', $absolute_path );

//$path_to_wp = $path_to_file[0];

// changed the path to wp-load to get from post

require_once( $_POST['wplc_wp_load_url'] );


require( ABSPATH . WPINC . '/l10n.php' );

require( ABSPATH . WPINC . '/link-template.php' );





global $wpdb;

global $wplc_tblname_chats;

global $wplc_tblname_msgs;

$wplc_tblname_chats = $wpdb->prefix . "wplc_chat_sessions";

$wplc_tblname_msgs = $wpdb->prefix . "wplc_chat_msgs";



require_once("functions.php");



// stuff goes here



$check = 1;

if ($check == 1) {





    // standard callbacks

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


    if ($_POST['action'] == "wplc_admin_close_chat") {
        $chat_id = $_POST['cid'];
        wplc_change_chat_status($chat_id,1);
        echo 'done';
    }




    // user


    if ($_POST['action'] == "wplc_user_awaiting_chat") {
        $chat_id = $_POST['id'];
        echo wplc_return_chat_status($chat_id);
    }
    if ($_POST['action'] == "wplc_user_minimize_chat") {
        $chat_id = $_POST['cid'];
        wplc_change_chat_status($_POST['cid'],2);
    }
    if ($_POST['action'] == "wplc_user_close_chat") {
        $chat_id = $_POST['cid'];
        wplc_change_chat_status($_POST['cid'],1);
    }
    if ($_POST['action'] == "wplc_user_maximize_chat") {
        $chat_id = $_POST['cid'];
        wplc_change_chat_status($_POST['cid'],3);
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
    if ($_POST['action'] == "wplc_update_user_chat_status") {
        echo wplc_return_chat_status($_POST['cid']);
    }

    if ($_POST['action'] == "wplc_user_reactivate_chat") {
        wplc_change_chat_status($_POST['cid'],3);
        echo wplc_return_chat_messages($_POST['cid']);

    }

}
function untrailingslashit($string) {
   return rtrim($string, '/');
}