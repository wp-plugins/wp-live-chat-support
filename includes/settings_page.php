<div class="wrap">
    <div id="icon-edit" class="icon32 icon32-posts-post">
        <br>
    </div>
    <h2><?php _e("WP Live Chat Support Settings","wplivechat")?></h2>
    <?php
        $wplc_settings = get_option("WPLC_SETTINGS");
        if ($wplc_settings["wplc_settings_align"]) { $wplc_settings_align[intval($wplc_settings["wplc_settings_align"])] = "SELECTED"; }
        if ($wplc_settings["wplc_settings_enabled"]) { $wplc_settings_enabled[intval($wplc_settings["wplc_settings_enabled"])] = "SELECTED"; }
        if ($wplc_settings["wplc_settings_fill"]) { $wplc_settings_fill = $wplc_settings["wplc_settings_fill"]; } else { $wplc_settings_fill = "ed832f"; }
        if ($wplc_settings["wplc_settings_font"]) { $wplc_settings_font = $wplc_settings["wplc_settings_font"]; } else { $wplc_settings_font = "FFFFFF"; }
        if(get_option("WPLC_HIDE_CHAT") == true) { $wplc_hide_chat = "checked"; } else { $wplc_hide_chat = ""; };
        
                
     ?>
    <form action='' name='wplc_settings' method='POST' id='wplc_settings'>
    
    <div id="wplc_tabs">
      <ul>
          <li><a href="#tabs-1"><?php _e("General Settings","wplivechat")?></a></li>
          <li><a href="#tabs-2"><?php _e("Chat Box","wplivechat")?></a></li>
          <li><a href="#tabs-3"><?php _e("Offline Messages","wplivechat")?></a></li>
          <li><a href="#tabs-4"><?php _e("Styling","wplivechat")?></a></li>
          <li><a href="#tabs-5"><?php _e("Agents", "wplivechat") ?></a></li>
      </ul>
      <div id="tabs-1">
          <h3><?php _e("Main Settings",'wplivechat')?></h3>
          <table class='form-table' width='700'>
              <tr>
                  <td width='200' valign='top'><?php _e("Chat enabled","wplivechat")?>:</td>
                  <td>
                      <select id='wplc_settings_enabled' name='wplc_settings_enabled'>
                          <option value="1" <?php if (isset($wplc_settings_enabled[1])) { echo $wplc_settings_enabled[1]; } ?>><?php _e("Yes","wplivechat"); ?></option>
                          <option value="2" <?php if (isset($wplc_settings_enabled[2])) { echo $wplc_settings_enabled[2]; }?>><?php _e("No","wplivechat"); ?></option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Hide Chat","wplivechat")?>:
                      <p class="description"><?php _e("Hides chat for 24hrs when user clicks X", "wplivechat") ?></p>
                  </td>
                  <td valign='top'>
                      <input type="checkbox"  value="true" readonly disabled/>
                      <small>
                        <i> 
                            <?php _e("available in the","wplivechat")?> 
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=name" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a> 
                            <?php _e("only","wplivechat")?>
                        </i>
                    </small>
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Require Name And Email","wplivechat")?>:
                      <p class="description"><?php _e("Users will have to enter their Name and Email Address when starting a chat", "wplivechat") ?></p>
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_require_user_info" <?php if(isset($wplc_settings['wplc_require_user_info'])  && $wplc_settings['wplc_require_user_info'] == 1 ) { echo "checked"; } ?> />                    
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Input Field Replacement Text","wplivechat")?>:
                      <p class="description"><?php _e("This is the text that will show in place of the Name And Email fields", "wplivechat") ?></p>
                  </td>
                  <td valign='top'>
                      <textarea cols="45" rows="5" name="wplc_user_alternative_text" ><?php if(isset($wplc_settings['wplc_user_alternative_text'])) { echo stripslashes($wplc_settings['wplc_user_alternative_text']); } ?></textarea>
                </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Use Logged In User Details","wplivechat")?>:
                      <p class="description"><?php _e("A user's Name and Email Address will be used by default if they are logged in.", "wplivechat") ?></p>
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_loggedin_user_info" <?php if(isset($wplc_settings['wplc_loggedin_user_info'])  && $wplc_settings['wplc_loggedin_user_info'] == 1 ) { echo "checked"; } ?> />                      
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'>
                      <?php _e("Enable On Mobile Devices","wplivechat"); ?>
                      <p class="description"><?php _e("Disabling this will mean that the Chat Box will not be displayed on mobile devices. (Smartphones and Tablets)", "wplivechat") ?></p>
                  </td>
                  <td valign='top'>
                      <input type="checkbox" value="1" name="wplc_enabled_on_mobile" <?php if(isset($wplc_settings['wplc_enabled_on_mobile'])  && $wplc_settings['wplc_enabled_on_mobile'] == 1 ) { echo "checked"; } ?> />                      
                  </td>
              </tr>
          </table>

      </div>
      <div id="tabs-2">
          <h3><?php _e("Chat Window Settings",'wplivechat')?></h3>
          <table class='form-table' width='700'>
              <tr>
                  <td width='200' valign='top'><?php _e("Chat box alignment","wplivechat")?>:</td>
                  <td>
                      <select id='wplc_settings_align' name='wplc_settings_align'>
                          <option value="1" <?php if (isset($wplc_settings_align[1])) { echo $wplc_settings_align[1]; } ?>><?php _e("Bottom left","wplivechat"); ?></option>
                          <option value="2" <?php if (isset($wplc_settings_align[2])) { echo $wplc_settings_align[2]; } ?>><?php _e("Bottom right","wplivechat"); ?></option>
                          <option value="3" <?php if (isset($wplc_settings_align[3])) { echo $wplc_settings_align[3]; } ?>><?php _e("Left","wplivechat"); ?></option>
                          <option value="4" <?php if (isset($wplc_settings_align[4])) { echo $wplc_settings_align[4]; } ?>><?php _e("Right","wplivechat"); ?></option>
                      </select>
                  </td>
              </tr>
              <tr>
                  <td>
                      <?php _e("Auto Pop-up","wplivechat") ?>
                  </td>
                  <td>
                      <input type="checkbox" name="wplc_auto_pop_up" value="1" <?php if(isset($wplc_settings['wplc_auto_pop_up'])  && $wplc_settings['wplc_auto_pop_up'] == 1 ) { echo "checked"; } ?>/>
                      <p class="description"><small><?php _e("Expand the chat box automatically (prompts the user to enter their name and email address).","wplivechat") ?></small></p>
                  </td>
              </tr>
              <tr>
            <!-- Chat Name-->
                <td width='200' valign='top'>
                    <?php _e("Name","wplivechat")?>:
                </td>
                <td>
                    <input type='text' size='50' maxlength='50' disabled readonly value='admin' />
                    <small>
                        <i> 
                            <?php _e("available in the","wplivechat")?> 
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=name" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a> 
                            <?php _e("only","wplivechat")?>
                        </i>
                    </small>
                </td>
            </tr>
            <!-- Chat Pic-->
            <tr>
                <td width='200' valign='top'>
                    <?php _e("Picture","wplivechat")?>:
                </td>
                <td>
                    <input id="wplc_pro_pic_button" type="button" value="<?php _e("Upload Image","wplivechat")?>" readonly disabled />
                    <small>
                        <i>
                            <?php _e("available in the","wplivechat")?>
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=pic" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a>
                                <?php _e("only","wplivechat")?>
                        </i>
                    </small>
                </td>
            </tr>
            <!-- Chat Logo-->
             <tr>
                <td width='200' valign='top'>
                    <?php _e("Logo","wplivechat")?>:
                </td>
                <td>
                    <input id="wplc_pro_logo_button" type="button" value="<?php _e("Upload Image","wplivechat")?>" readonly disabled />
                    <small>
                        <i> 
                            <?php _e("available in the","wplivechat")?> 
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=pic" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a>
                            <?php _e("only","wplivechat")?>
                        </i>
                    </small>
                </td>
            </tr>
            <!-- Chat Delay-->
              <tr>
                <td width='200' valign='top'>
                    <?php _e("Chat delay (seconds)","wplivechat")?>:
                </td>
                <td>
                    <input type='text' size='50' maxlength='50' disabled readonly value='10' /> 
                    <small>
                        <i> 
                            <?php _e("available in the","wplivechat")?> 
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=delay" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a> 
                            <?php _e("only","wplivechat")?>    
                        </i>
                    </small>
                </td>
            </tr>
            <!-- Chat Notification if want to chat-->
              <tr>
                <td width='200' valign='top'>
                    <?php _e("Chat notifications","wplivechat")?>:
                </td>
                <td>
                    <input id='wplc_pro_chat_notification' name='wplc_pro_chat_notification' type='checkbox' value='yes' disabled="disabled" readonly/>
                    <?php _e("Alert me via email as soon as someone wants to chat","wplivechat")?>
                    <small>
                        <i>
                            <?php _e("available in the","wplivechat")?>
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=alert" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a> 
                            <?php _e("only","wplivechat")?>
                        </i>
                    </small>
                </td>
            </tr>
          </table>

      </div>
      <div id="tabs-3">
          <h3><?php _e("Offline Messages",'wplivechat')?></h3>
          <table class='form-table' width='700'>
              <tr>
                <td width='200' valign='top'>
                    <?php _e("Email Address","wplivechat")?>:
                </td>
                <td>
                    <input type='text' size='50' maxlength='150' class='regular-text' readonly value='' />
                    <small>
                        <i>
                            <?php _e("Get offline messages with the ","wplivechat")?>
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=offlinemessages" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a>.
                        </i>
                    </small>
                    <br />
                </td>
            </tr>
             <tr>
                <td width='200' valign='top'>
                    <?php _e("Offline text","wplivechat")?>:
                </td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='Chat offline. Leave a message' />
                    <small>
                        <i> <?php _e("Edit these text fields using the ","wplivechat")?> 
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=textfields4" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a>
                        </i>
                    </small>
                    <br />
                </td>
            </tr>
            
          </table>
      </div>
      
      
      <div id="tabs-4">
          <h3><?php _e("Styling",'wplivechat')?></h3>
          <table class='form-table' width='700'>
              <tr>
                  <td width='200' valign='top'><?php _e("Chat box fill color","wplivechat")?>:</td>
                  <td>
                      <input id="wplc_settings_fill" name="wplc_settings_fill" type="text" class="color" value="<?php echo $wplc_settings_fill;?>" />
                  </td>
              </tr>
              <tr>
                  <td width='200' valign='top'><?php _e("Chat box font color","wplivechat")?>:</td>
                  <td>
                      <input id="wplc_settings_font" name="wplc_settings_font" type="text" class="color" value="<?php echo $wplc_settings_font;?>" />
                  </td>
              </tr>
              <tr style='height:30px;'><td></td><td></td></tr>
            <tr>
                <td width='200' valign='top'><?php _e("First section text","wplivechat")?>:</td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='<?php _e("Questions?","wplivechat") ?>' /> <br />
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='<?php _e("Chat with us","wplivechat") ?>' /> <br />
                </td>
            </tr>
            <tr>
                <td width='200' valign='top'><?php _e("Second section text","wplivechat") ?>:</td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='<?php _e("Start Chat","wplivechat") ?>' /> <br />
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='<?php _e("Connecting you to a sales person. Please be patient.", "wplivechat") ?>' /> <br />


                </td>
            </tr>
            <tr>
                <td width='200' valign='top'><?php _e("Reactivate chat section text","wplivechat")?>:</td>
                <td>
                    <input type='text' size='50' maxlength='50' class='regular-text' readonly value='<?php _e("Reactivating your previous chat...", "wplivechat") ?>' />
                    <small>
                        <i>
                            <?php _e("Edit these text fields using the ","wplivechat")?>
                            <a href="http://www.wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=textfields3" title="<?php _e("Pro Add-on","wplivechat")?>" target="_BLANK"><?php _e("Pro Add-on","wplivechat")?></a>.
                        </i>
                    </small>
                    <br />


                </td>
            </tr>
          </table>
      </div>
        <div id="tabs-5">
            <h3><?php _e("Multiple Agents", "wplivechat") ?></h3>
            <p><?php _e("Get","wplivechat") ?> <a href="http://wp-livechat.com/purchase-pro/?utm_source=plugin&utm_medium=link&utm_campaign=multipleAgents"><?php _e("Multiple agent support", "wplivechat") ?></a></p>
        </div>
    </div>
    <p class='submit'><input type='submit' name='wplc_save_settings' class='button-primary' value='<?php _e("Save Settings","wplivechat")?>' /></p>
    </form>
    
    </div>
