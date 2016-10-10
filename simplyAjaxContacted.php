<?php
/*
Plugin Name: Simply AJAX Contacted
Plugin URI: http://www.jasondarkx2.com
Description: Simply an AJAX Contact form 
Author:JasonDarkX2
version: x.xx
Author URI:http://www.jasondarkx2.com 
*/ 


class SimplyAjaxContacted{
    
    function init(){  
        add_shortcode('AjaxContactForm',array(__CLASS__,'contactFormView'));
        add_action('admin_menu', array(__CLASS__,'createAdminMenu'));
        define( 'MY_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
        add_action('admin_enqueue_scripts',array(__CLASS__, 'addAdminScripts'));
    }
    static function registerSettings() {
        //register our settings
        register_setting('sac-setting', 'reCaptchaEnabled');
        register_setting('sac-setting', 'secretKey');
        register_setting('sac-setting', 'siteKey');
        register_setting('sac-sertting','reCaptchaConfig');
        //setting initial config setting for first launch of plugin
        $config=[
            'theme'=> 'light',
            'type'=> 'image',
            'size' =>'normal'
        ];
        $con=get_option('reCaptchaConfig');
        if(empty($con)==TRUE){
            update_option('reCaptchaConfig', $config);
        }
    }
   static  function createAdminMenu() {
        add_options_page('SimplyAjaxContacted Settings','SimplyAjaxContacted','manage_options','sacMenu',array(__CLASS__,'adminView'));
        //call register settings function
        add_action('admin_init', array(__CLASS__, 'registerSettings'));
    }
    
    static  function add_scripts($hook){
         wp_enqueue_style('sac-style', plugins_url('_inc/SimplyAjaxContacted.css', __FILE__));
         wp_enqueue_script('sac-validate', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array('jquery'));
         wp_enqueue_script('sac-reCaptcha', 'https://www.google.com/recaptcha/api.js', array('jquery'));
         $controllers = array('emailController' => plugins_url('controller/email_controller.php',__FILE__ ));
         wp_enqueue_script('sac-script', plugins_url('_inc/SimplyAjaxContacted.js', __FILE__));
         wp_localize_script('sac-script', 'controller', $controllers);
    }
        static  function addMinifiedScripts($hook){
         wp_enqueue_style('sac-style', plugins_url('_inc/min/SimplyAjaxContacted.min.css', __FILE__));
         wp_enqueue_script('sac-validate', 'http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js', array('jquery'));
         wp_enqueue_script('sac-reCaptcha', 'https://www.google.com/recaptcha/api.js', array('jquery'));
         $controllers = array('emailController' => plugins_url('controller/email_controller.php',__FILE__ ));
         wp_enqueue_script('sac-script', plugins_url('_inc/min/SimplyAjaxContacted.min.js', __FILE__));
         wp_localize_script('sac-script', 'controller', $controllers);
    }
     static  function addAdminScripts($hook){
         wp_enqueue_style('sacAdmin-style', plugins_url('_inc/admin/sacAdmin.css', __FILE__));
         $controllers = array('settingsController' => plugins_url('controller/admin/settings_controller.php',__FILE__ ));
         wp_enqueue_script('sacAdmin-script', plugins_url('_inc/admin/sacAdmin.js', __FILE__));
         wp_localize_script('sacAdmin-script', 'controller', $controllers);
     }

     function adminView(){
         include (plugin_dir_path(__FILE__) .'view/admin/adminPage.php');
     }
  function contactFormView(){
      add_action('wp_footer', array(__CLASS__, 'addMinifiedScripts'));
ob_start();
     include (plugin_dir_path(__FILE__). '/view/contactForm.php');
     $output=ob_get_contents();;
     ob_end_clean();
     return $output;
 }
}
 add_action( 'wp_loaded',SimplyAjaxContacted::init());