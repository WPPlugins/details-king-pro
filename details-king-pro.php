<?php
/*
Plugin Name: Details King Pro
Plugin URI: http://kingpro.me/plugins/details-king-pro/
Description: Creates a section in settings to dynamically create fields available to use anywhere in your theme
Version: 1.0
Author: Ash Durham
Author URI: http://durham.net.au/
License: GPL2
Text Domain: dkptext

Copyright 2013 Your Name (email : plugins@kingpro.me)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
*/

    global $dkp_db_version;
    $dkp_db_version = "1.0";

    function dkp_install() {
       global $wpdb;
       global $dkp_db_version;

       require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
       
       add_option("dkp_db_version", $dkp_db_version);
    }
    
    // Register hooks at activation
    register_activation_hook(__FILE__,'dkp_install');
    
    // END INSTALL
    
    if (get_option("dkp_db_version") != $dkp_db_version) {
        // Execute your upgrade logic here
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Then update the version value
        update_option("dkp_db_version", $dkp_db_version);
    }
    
    function dkp_settings_link($action_links,$plugin_file){
            if($plugin_file==plugin_basename(__FILE__)){
                    $dkp_settings_link = '<a href="admin.php?page=' . str_replace('-', '', dirname(plugin_basename(__FILE__))) . '">' . __("Settings") . '</a>';
                    array_unshift($action_links,$dkp_settings_link);
            }
            return $action_links;
    }
    add_filter('plugin_action_links','dkp_settings_link',10,2);

require_once plugin_dir_path(__FILE__).'includes/admin_area.php';
require_once plugin_dir_path(__FILE__).'includes/output.php';

?>