jQuery(document).ready(function() {


        
        var wplc_user_auto_refresh = "";
        var wplc_user_auto_refresh_status = "";
        
        var wplc_check_cookie_id;
        var wplc_check_cookie_stage;
        var wplc_check_hide_cookie;

        wplc_check_cookie_id = jQuery.cookie('wplc_cid');
        wplc_check_cookie_stage = jQuery.cookie('wplc_stage');
        wplc_check_hide_cookie = jQuery.cookie('wplc_hide');


        function wplc_relay_user_stage(stage,cid) {
            
            if (cid.length) {
                var data = {
                        action: 'wplc_relay_stage',
                        security: wplc_nonce,
                        stage: stage,
                        cid: cid
                };
            } else {
                var data = {
                        action: 'wplc_relay_stage',
                        security: wplc_nonce,
                        stage: stage
                };
            }
            jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_relay_stage");
            });
        }
        
        /* minimize chat window */
        jQuery("#wp-live-chat-minimize").live("click", function() {
            jQuery("#wp-live-chat-1").show();
            jQuery("#wp-live-chat-1").css('cursor', 'pointer');

            jQuery("#wp-live-chat-2").hide();
            jQuery("#wp-live-chat-3").hide();
            jQuery("#wp-live-chat-4").hide();
            jQuery("#wp-live-chat-minimize").hide();
            jQuery.cookie('wplc_hide', "yes", { expires: 1, path: '/' });
            jQuery.cookie('wplc_stage', "2", { expires: 1, path: '/' });
            
            
            
            var data = {
                action: 'wplc_user_minimize_chat',
                security: wplc_nonce,
                cid: wplc_check_cookie_id
            };
            jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_user_close_chat");
            });            
        });
         /* close chat window */
        jQuery("#wp-live-chat-close").live("click", function() {
            jQuery("#wp-live-chat").hide();
            jQuery("#wp-live-chat-1").hide();
            jQuery("#wp-live-chat-2").hide();
            jQuery("#wp-live-chat-3").hide();
            jQuery("#wp-live-chat-4").hide();
            jQuery("#wp-live-chat-minimize").hide();
            jQuery.cookie('wplc_hide', "yes", { expires: 1, path: '/' });
            jQuery.cookie('wplc_stage', "1", { expires: 1, path: '/' });
            
            
            
            var data = {
                action: 'wplc_user_close_chat',
                security: wplc_nonce,
                cid: wplc_check_cookie_id
            };
            jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_user_close_chat");
                    clearInterval(wplc_user_auto_refresh_status);
                    clearInterval(wplc_user_auto_refresh);
                    
            });            
        });   
        
        
        jQuery("#wp-live-chat-1").live("click", function() {
            //jQuery("#wp-live-chat-1").hide();
            jQuery("#wp-live-chat-1").css('cursor', 'default');
            jQuery.cookie('wplc_hide', "", { expires: 1, path: '/' });
            jQuery("#wp-live-chat-minimize").show();
            jQuery("#wp-live-chat-close").show();

            wplc_check_cookie_stage = jQuery.cookie('wplc_stage');
            if (wplc_check_cookie_stage == "3") {
                jQuery("#wp-live-chat-4").show();
                jQuery("#wplc_chatmsg").focus();
                jQuery("#wp-live-chat-2").hide();
            }
            else if (wplc_check_cookie_stage == "2") {
                var data = {
                    action: 'wplc_user_maximize_chat',
                    security: wplc_nonce,
                    cid: wplc_check_cookie_id
                };
                jQuery.post(wplc_ajaxurl, data, function(response) {
                        //log("user maximized chat success");
                });        
                jQuery("#wp-live-chat-4").show();
                jQuery("#wplc_chatmsg").focus();
                jQuery("#wp-live-chat-2").hide();
            }
            else {
                jQuery("#wp-live-chat-2").show();
            }
            
            
            
        });

        var wplc_user_waiting = null;

        jQuery("#wplc_start_chat_btn").live("click", function() {
            var wplc_name = jQuery("#wplc_name").val();
            var wplc_email = jQuery("#wplc_email").val();
            if (wplc_name.length <= 0) { alert("Please enter your name"); return false; }
            if (wplc_email.length <= 0) { alert("Please enter your email address"); return false; }

            jQuery("#wp-live-chat-2").hide();
            jQuery("#wp-live-chat-3").show();

            wplc_check_cookie_id = jQuery.cookie('wplc_cid');
            var wplc_chat_session_id;
            
            var data = {
                    action: 'wplc_start_chat',
                    security: wplc_nonce,
                    name: wplc_name,
                    email: wplc_email 
            };
            jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_start_chat");
                    wplc_chat_session_id = response;
                    wplc_check_cookie_id = response;
                    wplc_user_waiting = setInterval(function (){wplc_user_await_session(wplc_chat_session_id);}, 5000);

            });
        });

        function wplc_user_await_session(cid) {
            var data = {
                    action: 'wplc_user_awaiting_chat',
                    security: wplc_nonce,
                    id: cid
            };
            jQuery.post(wplc_ajaxurl, data, function(response) {
                //console.log("wplc_user_awaiting_chat");
                
                if (response == "3") {
                    clearInterval(wplc_user_waiting);
                    var wplc_name = jQuery("#wplc_name").val();
                    jQuery("#wplc_cid").val(cid)
                    jQuery("#wp-live-chat-3").hide();
                    jQuery("#wp-live-chat-4").show();
                     jQuery("#wplc_chatmsg").focus();

                    // chat is now active
                    jQuery.cookie('wplc_cid', cid, { expires: 1, path: '/' });
                    jQuery.cookie('wplc_name', wplc_name, { expires: 1, path: '/' });
                    jQuery.cookie('wplc_stage', 3, { expires: 1, path: '/' });
                    wplc_user_auto_refresh = setInterval(function (){wpcl_user_auto_update_chat_box(cid);}, 3500);
                    wplc_user_auto_refresh_status = setInterval(function (){wpcl_user_auto_update_chat_status(wplc_check_cookie_id);}, 3500);

                };
            });
            return;
        }
        jQuery("#wplc_chatmsg").keyup(function(event){
            if(event.keyCode == 13){
                jQuery("#wplc_send_msg").click();
            }
        });

        jQuery("#wplc_send_msg").live("click", function() {
            var wplc_cid = jQuery("#wplc_cid").val();
            var wplc_chat = jQuery("#wplc_chatmsg").val();
            var wplc_name = jQuery("#wplc_name").val();
            if (typeof wplc_name == "undefined" || wplc_name == null || wplc_name == "") {
                wplc_name = jQuery.cookie('wplc_name');
            }
            jQuery("#wplc_chatmsg").val('');
            jQuery("#wplc_chatbox").append("<strong>"+wplc_name+"</strong>: "+wplc_chat+"<br />");
            var height = jQuery('#wplc_chatbox')[0].scrollHeight;
            jQuery('#wplc_chatbox').scrollTop(height);

            var data = {
                    action: 'wplc_user_send_msg',
                    security: wplc_nonce,
                    cid: wplc_cid,
                    msg: wplc_chat
            };
            jQuery.post(wplc_ajaxurl, data, function(response) {
                    //console.log("wplc_user_send_msg");
            });

        });
        function wpcl_user_auto_update_chat_status(cid) {
            var data = {
                    action: 'wplc_update_user_chat_status',
                    cid: cid,
                    security: wplc_nonce
            };
            jQuery.post(wplc_ajaxurl, data, function(response) {
                if (response == "1") {
                    jQuery("#wplc_chatbox").append("The chat has been ended by the operator.<br />");
                    var height = jQuery('#wplc_chatbox')[0].scrollHeight;
                    jQuery('#wplc_chatbox').scrollTop(height);
                    jQuery.cookie('wplc_stage', '1', { path: '/' } );
                    jQuery.cookie('wplc_hide', null, { path: '/' } );
                    jQuery.cookie('wplc_cid', null, { path: '/' } );
                    clearInterval(wplc_user_auto_refresh_status);
                    jQuery("#wp-live-chat-minimize").hide();
                    document.getElementById('wplc_chatmsg').disabled = true;
                }
                console.log("wplc_update_user_chat_response "+response);
            });
            
            
        }        
        
        function wpcl_user_auto_update_chat_box(cid) {
            var data = {
                    action: 'wplc_update_user_chat_boxes',
                    cid: cid,
                    security: wplc_nonce
            };
            jQuery.post(wplc_ajaxurl, data, function(response) {
                //console.log("wplc_update_user_chat_boxes");
                jQuery("#wplc_chatbox").append(response);
                var height = jQuery('#wplc_chatbox')[0].scrollHeight;
                jQuery('#wplc_chatbox').scrollTop(height);

            });

        }                

        
        // user pushed the X button, dont show chat window
        if (wplc_check_hide_cookie === "yes" && wplc_check_cookie_stage !== '1') {
            jQuery("#wp-live-chat").css({ "display" : "block" });
            jQuery("#wp-live-chat-1").show();
            jQuery("#wp-live-chat-2").hide();
            jQuery("#wp-live-chat-3").hide();
            jQuery("#wp-live-chat-4").hide();
        } 
        else if (wplc_check_cookie_stage === "1") {
            jQuery("#wp-live-chat").hide();
        }
        else {

            // First time visitor has visited the site, show chat window and set cookie
            if (typeof wplc_check_cookie_id === "undefined" || wplc_check_cookie_id == null) {
                wplc_dc = setTimeout(function (){jQuery("#wp-live-chat").css({ "display" : "block" }); wplc_relay_user_stage(1,''); }, window.wplc_delay);
            }
            // user has been here before, show different chat windows depending on which stage of the chat funnel he/she was in
            else { 
            
                jQuery("#wplc_cid").val(wplc_check_cookie_id);
                
                
                    
                    jQuery("#wp-live-chat-1").show();
                    jQuery("#wp-live-chat-2").hide();
                    jQuery("#wp-live-chat-3").hide();
                    jQuery("#wp-live-chat-4").hide();
                    jQuery("#wp-live-chat-react").show();
                    jQuery("#wp-live-chat-minimize").show();
                    jQuery("#wp-live-chat-close").show();



                    jQuery("#wp-live-chat").css({ "display" : "block" });



                        var data = {
                                action: 'wplc_user_reactivate_chat',
                                security: wplc_nonce,
                                cid: wplc_check_cookie_id
                        };
                        jQuery.post(wplc_ajaxurl, data, function(response) {
                            //console.log("wplc_user_reactivate_chat");
                            jQuery("#wp-live-chat-react").hide();
                            jQuery("#wp-live-chat-4").show();
                            jQuery("#wplc_chatmsg").focus();
                            jQuery("#wp-live-chat-close").show();
                            jQuery("#wp-live-chat-minimize").show();

                            jQuery("#wplc_chatbox").append(response);
                            var height = jQuery('#wplc_chatbox')[0].scrollHeight;
                            jQuery('#wplc_chatbox').scrollTop(height);

                            wplc_user_auto_refresh = setInterval(function (){wpcl_user_auto_update_chat_box(wplc_check_cookie_id);}, 3500);
                            wplc_user_auto_refresh_status = setInterval(function (){wpcl_user_auto_update_chat_status(wplc_check_cookie_id);}, 3500);
                            
                        });
                    }
        }

    });