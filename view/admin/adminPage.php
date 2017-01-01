<h1>SimplyAJAXContacted Settings</h1>
<div class="sacAdminBody">
        
    <form id="sac-options" method="POST" action="<?php echo plugins_url('controller\admin\settings_controller.php', dirname(dirname(__FILE__))); ?>">
         <!--E-mail  section!-->
         <div id="emailSetting" class="panelSection">
             <h1>E-mail Settings</h1>
              <label for="toAddress">Sent to E-mail Address
                  <div class="toolTip">
                      [?]<span class="toolTipText">Set the e-mail address that mail would be sent to. <strong>Default:</strong>
                    <?php echo get_option('admin_email');?></span>
                 </div>
                  :</label>
              <input type="text" name="toAddress" value="<?php echo get_option('toAddress');?>"/>
              <br/>
             <label for="fromAddress">From E-mail Address Name
                 <div class="toolTip">
                      [?]<span class="toolTipText"> Use this field if you would like to change the default email address WordPress uses for sending mails.<br/> <strong>Default:</strong>
                    <?php echo 'wordpress@' . $_SERVER['HTTP_HOST'];?></span>
                 </div>:</label>
             <input type="text" name="fromAddress" value="<?php echo get_option('fromAddress');?>"/>
             <br/>
             <label for="Cc/Bcc Address">Cc: and/or Bcc Address:
                 <div class="toolTip">
                      [?]<span class="toolTipText">You can specify the Cc: and/or Bcc:  recipients Addresses here. <br/> <strong>Default:</strong>
                    None</span>
                 </div>:</label>
             <input type="text" name="copyAddress" value="<?php echo get_option('copyAddress');?>"/>
              <br/>
             <label for="Cc/Bcc Address"> Allow Attachments?
                 <div class="toolTip">
                      [?]<span class="toolTipText">You can specify whether the contact form will allow sender to send attachments <br/> <strong>Default:</strong>
                    Disabled</span>
                 </div>:</label>
             <input type="radio" name="attachment" value="true" <?php checked(get_option('attachment'),1); ?>/>Enable
             <input type="radio" name="attachment" value="false" <?php checked(get_option('attachment'),''); ?>/>Disabled
             <!-- attachment extra settings!-->
             <div id="attachmentOpt" <?php echo (get_option('attachment')) ? '':'hidden';?>>   
                 <label for="fileType"> Attachment file type restrictions: </label>
                 <select name="fileType">
                     <?php
                     $fileTypes= array('docs'=>'Only Documents',
                                                'photo'=>'Only  Photos',
                                                'zip'=>'Only  zip files',
                                                'none'=>'No restrictions');
                     foreach($fileTypes as $i=>$v){
                         if($i==get_option('attachmentType')){
                             echo '<option value="'. $i .'" selected>'. $v .'</option>';    
                         }else{
                        echo '<option value="'. $i .'">'. $v .'</option>';
                         }
                     }
                     ?>
                 </select>
                 <br/><label for="fileSize"> Attachment file  size restrictions: </label>
                 <select name="fileSize">
                     <?php
                     $fileTypes= array('1'=>'1MB',
                                                '2'=>'2MB',
                                                '25'=>'25MB',
                                                '64'=>'64MB');
                     foreach($fileTypes as $i=>$v){
                         if($i==get_option('attachmentSize')){
                             echo '<option value="'. $i .'" selected>'. $v .'</option>';    
                         }else{
                        echo '<option value="'. $i .'">'. $v .'</option>';
                         }
                     }
                     ?>
                 </select>
             </div>
             <div>
                <label for="messageBody" style="vertical-align: top;">Message Body<div class="toolTip" style="vertical-align: top;">
                      [?]<span class="toolTipText"> Here you can  customize the message body with HTML and tags below.<br/> <strong>Default:</strong>
                    [senderMessage]</span>
                 </div>:</label>
                 <textarea id="msgBody" name="messageBody" style="vertical-align: middle; " rows="10" cols="50" ><?php echo  get_option('messageBody');?></textarea>
                 <label>Message Tags: &nbsp;</label>
                     <?php $msgTags= self::$messageTags;
                     foreach($msgTags as $v):?>
                         <a  href="#" title="<?php echo $v; ?>" class="TagClick"><?php echo $v; ?></a>
                 <?php endforeach;?>
         </div>
         </div>
         <!--end of email section!-->
        <!--recaptcha section!-->
        <div id="reCaptchaSetting" class="panelSection">
            <h1>Recaptcha Settings</h1>
            <label for"reCaptchaEnabled">Enable reCaptcha:</label>
            <input type="checkbox" name="reCaptchaEnabled" value="true" <?php checked(get_option('reCaptchaEnabled'), true); ?>/>
            <br/>
            <label for=""siteKey">Site Key:</label>
            <input type="text" name="siteKey" value="<?php echo get_option('siteKey'); ?>"/>
            <br/>
            <label for="secretKey">Secret Key:</label>
            <input type="text" name="secretKey" value="<?php echo get_option('secretKey'); ?>"/>
            <label><i>Need Keys<div class="toolTip">[?]<span class="toolTipText"> To get your <b>site</b> and <b>secret</b> keys head over to 
                            <a href="https://www.google.com/recaptcha/">https://www.google.com/recaptcha/admin</a></span></div>
            </i>
            </label>
            <br/>
            <?php foreach (get_option('reCaptchaConfig') as $i => $v): ?>
                <?php switch ($i) {
                    case "theme":
                        ?>
                        <label for="theme"> reCaptcha Theme<div class="toolTip">
                [?]<span class="toolTipText">The color theme of the widget.</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="light" <?php checked($v, 'light'); ?>>Light
                        <input  name="<?php echo $i; ?>" type="radio" value="dark" <?php checked($v, 'dark'); ?> >Dark
                        <br/>
                        <?php
                        break;
                    case 'type':
                        ?>
                        <label for="theme"> reCaptcha Type<div class="toolTip">
                [?]<span class="toolTipText"> The type of CAPTCHA to serve..</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="image" <?php checked($v, 'image'); ?>>Image
                        <input  name="<?php echo $i; ?>" type="radio" value="audio" <?php checked($v, 'audio'); ?>>Audio
                        <br/>
            <?php break;
        case "size":
            ?>
                        <label for="theme"> reCaptcha Size<div class="toolTip">
                [?]<span class="toolTipText"> The size of the widget.</span>
            </div>:</label>
                        <input type='hidden' name='confId[]' value="<?php echo $i; ?>"  id="configId"> 
                        <input name="<?php echo $i; ?>" type="radio" value="normal"<?php checked($v, 'normal'); ?> >Normal
                        <input  name="<?php echo $i; ?>" type="radio" value="compact" <?php checked($v, 'compact'); ?>>Compact
                        <br/>
                        <?php
                        break;
                }
                ?>
<?php endforeach; ?>
        </div>
        <!--end of recaptch section!-->
                  <!--Contact form  section!-->
         <div id="ContactSetting" class="panelSection">
             <h1>ContactForm Settings</h1>
             <label for="formTheme">themes<div class="toolTip">[?]<span class="toolTipText">Set the preferred contact Form theme.<strong> Default:</strong> &nbsp;None</span></div>:</label>
             <select name="formTheme">
                 <?php
                     $themes= array('Dark'=>'dark-theme',
                                                'Light'=>'light-theme',
                                                'Transparent'=>'trans-heme',
                                                'None'=>'',
                                                );
                     foreach($themes as $i=>$v){
                         if($v==get_option('formTheme')){
                             echo '<option value="'. $v .'" selected>'. $i .'</option>';    
                         }else{
                        echo '<option value="'. $v .'">'. $i .'</option>';
                         }
                     }
                     ?>
             </select>
             <br/>
             <label for="customCSS">Custom CSS<div class="toolTip">[?]
                     <span class="toolTipText">Use this field for your custom Css styling for the contact Form.</span></div>:</label>
             <br/>
             <textarea  name="customCSS" rows="20"  cols="50"><?php  echo get_option('customCSS');?></textarea>
         </div>
                               <div  style=" margin-left:60px; border: solid 1px; display:inline-block;width:60%;">
                 <strong>Contact form Preview</strong>
                  <?php
                  self::$settings->getFormPreview();
                  ?>
                  </div>
         <!--end of ContactForm section!-->
         <div class="controlSection">
                     <input type="hidden" name="pluginDir" value ="<?php echo MY_PLUGIN_PATH; ?>"/>
                     <input type="submit" value="Save"/><span id="msg"></span>
         </div>
    </form>
    <div>
        <a href="<?php echo plugins_url('controller\admin\settings_controller.php', dirname(dirname(__FILE__))); ?>?sendTest=True"
           title="Send Test Mail"  id="testMail">
            Send Test Mail</a>
    </div>
</div>