<?php
/*
Plugin Name: Comment Links New Tab
Description: This plugin will allow you to have your comment author name links open in a new tab or window. In other words, instead of leaving your site completely when clicked, they will open in a new tab.
Author: Crucial Innovations
Plugin URI: https://www.crucialinnovations.com/?.html
Text Domain: comment-links-new-tab
Version: 1.0
Author URI: https://www.crucialinnovations.com

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
include_once('include/functions.php');
include_once('include/settings.php');

register_activation_hook(__FILE__, 'cruinnv_wp_comments_new_tab_activation');
register_deactivation_hook(__FILE__, 'cruinnv_wp_comments_new_tab_deactivation');
register_uninstall_hook(__FILE__, 'cruinnv_wp_comments_new_tab_uninstall');
add_action( 'wp_enqueue_scripts', 'cruinnv_wp_comments_new_tab_js', 3 );
?>