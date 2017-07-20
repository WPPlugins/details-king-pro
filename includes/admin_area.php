<?php

    function dkp_check_page($hook) {
        global $current_screen;
        $dkp_pages = array('king-pro-plugins_page_detailskingpro');

        if (in_array($hook, $dkp_pages)) return true;
        
        return false;
    }
    
    function register_dkp_options() {
        
        register_setting( 'dkp-options', 'dkp_fields' );
        register_setting( 'dkp-options', 'dkp_output_fields' );
        
        add_option( 'dkp_option_settings', '' );
        add_option( 'dkp_output_fields', '' );
    }
    add_action( 'admin_init', 'register_dkp_options' );
    
    function dkp_enqueue($hook) {
        if (dkp_check_page($hook)) :
            wp_register_style( 'dkp_jquery_ui', plugins_url('css/jquery-ui.css', dirname(__FILE__)), false, '1.9.2' );
            wp_register_style( 'dkp_css', plugins_url('css/detailskingpro-styles.css', dirname(__FILE__)), false, '1.0.0' );
            wp_register_style( 'fontawesome', plugins_url('css/font-awesome.min.css', dirname(__FILE__)), false, '3.2.1');

            wp_enqueue_style('dkp_jquery_ui');
            wp_enqueue_style( 'fontawesome' );
            wp_enqueue_style( 'dkp_css' );
            wp_enqueue_style( 'thickbox' );
            wp_enqueue_media();
            
            wp_enqueue_script( 'jquery-ui-datepicker');
            wp_register_script('dkp_admin_js', plugins_url( '/js/dkp_admin_functions.js', dirname(__FILE__) ), array('jquery', 'jquery-ui-datepicker'), '1.0.0');
            wp_enqueue_script( 'dkp_admin_js');
            wp_enqueue_script( 'thickbox' );

            // in javascript, object properties are accessed as ajax_object.ajax_url, ajax_object.we_value
            wp_localize_script( 'dkp_admin_js', 'dkp_ajax_object',
                array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'dkp_ajaxnonce' => wp_create_nonce( 'dkpN0nc3' ) ) );
        endif;
    }
    
    add_action('admin_enqueue_scripts', 'dkp_enqueue');
    
    function dkp_return_fields() {
        $output = get_option('dkp_output_fields');
        
        return $output;
    }
    
    // Add King Pro Plugins Section
    if(!function_exists('find_kpp_menu_item')) {
      function find_kpp_menu_item($handle, $sub = false) {
        if(!is_admin() || (defined('DOING_AJAX') && DOING_AJAX)) {
          return false;
        }
        global $menu, $submenu;
        $check_menu = $sub ? $submenu : $menu;
        if(empty($check_menu)) {
          return false;
        }
        foreach($check_menu as $k => $item) {
          if($sub) {
            foreach($item as $sm) {
              if($handle == $sm[2]) {
                return true;
              }
            }
          } 
          else {
            if($handle == $item[2]) {
              return true;
            }
          }
        }
        return false;
      }
    }

    function dkp_add_parent_page() {
        if(!find_kpp_menu_item('kpp_menu')) {
          add_menu_page('King Pro Plugins','King Pro Plugins', 'manage_options', 'kpp_menu', 'kpp_menu_page');
        }
    
        add_submenu_page('kpp_menu', 'Details King Pro', 'Details King Pro', 'manage_options', 'detailskingpro', 'dkp_settings_output');
    }
    add_action('admin_menu', 'dkp_add_parent_page');

    if(!function_exists('kpp_menu_page')) {
        function kpp_menu_page() {
            include 'screens/kpp.php';
        }
    }

    function dkp_settings_output() {
        include 'screens/settings.php';
    }
?>
