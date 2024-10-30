<?php
function cruinnv_wp_comments_new_tab_js() {
    $cruinnv_get_wp_comments_new_tab_js_comp = get_option( 'cruinnv_wp_comments_new_tab_is_comp_js' );
        if ($cruinnv_get_wp_comments_new_tab_js_comp == '0') { 
            $js_type = plugins_url( 'js/cruinnv-com-links-new-tab.js', dirname(__FILE__ ));
        } elseif ($cruinnv_get_wp_comments_new_tab_js_comp == '1') { 
            $js_type = plugins_url( 'js/cruinnv-com-links-new-tab.min.js', dirname(__FILE__ ));
        }
    wp_register_script(
        'cruinnvcommentsnewtabjs',
        $js_type,
        array( 'jquery' ),
        '1.0.0',
        false
    );
    wp_enqueue_script(
        'cruinnvcommentsnewtabjs'
    );
    $cruinnv_get_home_url = get_option( 'cruinnv_wp_comments_new_tab_whitelisted_one' );
    $cruinnv_get_css_value = get_option( 'cruinnv_wp_comments_new_tab_css_value' );
    $cruinnv_get_css_options = get_option( 'cruinnv_wp_comments_new_tab_css_options' );
        if ($cruinnv_get_css_options == 'class') {
            $cruinnv_get_css_value = '.' . $cruinnv_get_css_value;  //add .(dot) if class is selected
        } elseif ($cruinnv_get_css_options == 'id') {
            $cruinnv_get_css_value = '#' . $cruinnv_get_css_value;  //add # if id is selected
        } elseif ($cruinnv_get_css_options == 'custom') {
            $cruinnv_get_css_value = $cruinnv_get_css_value;  //if custom is selected get from db
        }
    $cruinnv_target_type = get_option( 'cruinnv_wp_comments_new_tab_target' ); 
    $cruinnv_get_rel = get_option( 'cruinnv_wp_comments_new_tab_rel' );
        if ($cruinnv_get_rel == 'dofollow') {
            $cruinnv_do_rel_df = "1"; //dofollow
        } elseif ($cruinnv_get_rel == 'keep original') {
            $cruinnv_do_rel_df = "2"; //keep original rel
        } else {
            $cruinnv_do_rel_df = "0"; //anthing else external nofollow or nofollow
        }
    $cruinnv_get_title = get_option( 'cruinnv_wp_comments_new_tab_title' );
        if ($cruinnv_get_title == '') {
            $cruinnv_get_title = 'na';
        }
        wp_localize_script( 'cruinnvcommentsnewtabjs', 'cruinnv_wp_comments_new_tab_php_vars',
            array(
                'primaryhomeurl' => esc_attr($cruinnv_get_home_url),
                'cssvalue' => esc_attr($cruinnv_get_css_value),
                'target' => esc_attr($cruinnv_target_type),
                'rel' => esc_attr($cruinnv_get_rel),
                'title' => esc_attr($cruinnv_get_title),
                'reldf' => esc_attr($cruinnv_do_rel_df)
            )
        );
}
###############################################################
/*--UPGRADE CHECK For future upgrades and development--*/
function cruinnv_wp_comments_new_tab_upgrade_check() {
    $cruinnv_get_wp_comments_new_tab_version = get_option('cruinnv_wp_comments_new_tab_version');
    $cruinnv_new_wp_comments_new_tab_version = '1.0.0';
    if (version_compare($cruinnv_get_wp_comments_new_tab_version, $cruinnv_new_wp_comments_new_tab_version) == -1) {
        # Execute upgrade logic here
        # Update the version value
        update_option('cruinnv_wp_comments_new_tab_version', $cruinnv_new_wp_comments_new_tab_version);
    }
}
###############################################################
//Reset Defaults
function cruinnv_wp_comments_new_tab_reset_reset_com_defaults() {
    //$permalink = get_home_url();
    $permalink = get_option( 'home' );
    $find = array( 'http://www.', 'https://www.', 'http://', 'https://' );
    $replace = '';
    $url = str_replace( $find, $replace, $permalink );
    update_option('cruinnv_wp_comments_new_tab_whitelisted_one', $url);
    update_option('cruinnv_wp_comments_new_tab_is_comp_js', '0');
    update_option('cruinnv_wp_comments_new_tab_css_options', 'id');
    update_option('cruinnv_wp_comments_new_tab_css_value', 'comments');
    update_option('cruinnv_wp_comments_new_tab_target', '_blank');
    update_option('cruinnv_wp_comments_new_tab_title', '');
    update_option('cruinnv_wp_comments_new_tab_rel', 'keep original');
}
###############################################################
//REGISTER ACTIVATE DEACTIVATE UNINSTALL
function cruinnv_wp_comments_new_tab_activation() {
    if(is_multisite()) {
        //$level = 'manage_options';
        $level = 'activate_plugins';
    } else {
        $level = 'administrator';
    }
    if (! current_user_can( $level )) {
        return;
    }
    //$permalink = get_home_url();
    $permalink = get_option( 'home' );
    $find = array( 'http://www.', 'https://www.', 'http://', 'https://' );
    $replace = '';
    $url = str_replace( $find, $replace, $permalink );
    add_option('cruinnv_wp_comments_new_tab_version', '1.0.0');
    add_option('cruinnv_wp_comments_new_tab_is_comp_js', '0');
    add_option('cruinnv_wp_comments_new_tab_css_options', 'id');
    add_option('cruinnv_wp_comments_new_tab_css_value', 'comments');
    add_option('cruinnv_wp_comments_new_tab_whitelisted_one', $url);
    add_option('cruinnv_wp_comments_new_tab_target', '_blank');
    add_option('cruinnv_wp_comments_new_tab_title', '');
    add_option('cruinnv_wp_comments_new_tab_rel', 'keep original');
}
function cruinnv_wp_comments_new_tab_deactivation() {
    if(is_multisite()) {
        $level = 'activate_plugins';
      } else {
        $level = 'administrator';
      }
    if (! current_user_can( $level )) {
        return;
    }
}
function cruinnv_wp_comments_new_tab_uninstall() {
    if(is_multisite()) {
        $level = 'activate_plugins';
    } else {
        $level = 'administrator';
    }
    if (! current_user_can( $level )) {
        return;
    }
    delete_option('cruinnv_wp_comments_new_tab_version');
    delete_option('cruinnv_wp_comments_new_tab_is_comp_js');
    delete_option('cruinnv_wp_comments_new_tab_css_options');
    delete_option('cruinnv_wp_comments_new_tab_css_value');
    delete_option('cruinnv_wp_comments_new_tab_whitelisted_one');
    delete_option('cruinnv_wp_comments_new_tab_target');
    delete_option('cruinnv_wp_comments_new_tab_title');
    delete_option('cruinnv_wp_comments_new_tab_rel');
    /* Global */
  global $wpdb;
  /* Clean DB */
  $wpdb->query("OPTIMIZE TABLE `" .$wpdb->options. "`");
}
?>