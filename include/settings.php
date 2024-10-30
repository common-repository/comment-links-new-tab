<?php
###############################################################
//Enqueue Plugin Admin Scripts and Styles
###############################################################
function cruinnv_wp_comments_new_tab_admin_enqueue($cruinn_new_tab_enqueue_admin_css_js) {
    if ( 'settings_page_comment-links-new-tab-settings' != $cruinn_new_tab_enqueue_admin_css_js) {
        return;
    }
    $cruinnv_wp_comments_new_tab_admin_css_comp = '0'; //use unminified version for admin css
        if ($cruinnv_wp_comments_new_tab_admin_css_comp == '0') {
            $css_admin_type = plugins_url( 'css/cruinnv-com-links-new-tab-admin.css', __FILE__ );
        } elseif ($cruinnv_wp_comments_new_tab_admin_css_comp == '1') {
            $css_admin_type = plugins_url( 'css/cruinnv-com-links-new-tab-admin.min.css', __FILE__ );
        }
    $cruinnv_wp_comments_new_tab_admin_js_comp = '0'; //use unminified version for admin js
        if ($cruinnv_wp_comments_new_tab_admin_js_comp == '0') {
            $js_admin_help_type = plugins_url( 'js/cruinnv-com-links-new-tab-admin-help.js', __FILE__ );
        } elseif ($cruinnv_wp_comments_new_tab_admin_js_comp == '1') {
            $js_admin_help_type = plugins_url( 'js/cruinnv-com-links-new-tab-admin-help.min.js', __FILE__ );
        }
    wp_register_style(
        'cruinnvcommentsnewtabadmincss',
        $css_admin_type,
        '', //dependencies arry
        '1.0.0', //version
        'all' //media
    );
    wp_enqueue_style(
        'cruinnvcommentsnewtabadmincss'
    );
    wp_register_script(
        'cruinnvcommentsnewtabadminhelpjs',
        $js_admin_help_type,
        array( 'jquery' ),
        '1.0.0', //version
        true //true = header
    );
    wp_enqueue_script(
        'cruinnvcommentsnewtabadminhelpjs'
    );
}
add_action( 'admin_enqueue_scripts', 'cruinnv_wp_comments_new_tab_admin_enqueue' );
function cruinnv_wp_comments_new_tab_add_plugin_menu_item() {
    if(is_multisite()) {
        $level = 'manage_options';
    } else {
        $level = 'administrator';
    }
    $menutitle = '<img style="background-color:transparent;" src="' . plugins_url('images/cruinnv-com-links-new-tab-target.png', __FILE__) . '" alt="" height="16" width="16" /> <span style="vertical-align:middle; padding-bottom:11px;">Coms New Tab</span>';
    //page title, menu title, permission level, wp-admin plugin settings page link to create, wp-admin plugin settings function
    add_options_page('Comment Links New Tab Settings', $menutitle , $level, 'comment-links-new-tab-settings', 'cruinnv_wp_comments_new_tab_add_plugin_settings_page');
    if(is_multisite()) {
        $update_level = 'update_plugins';
    }
    if (is_admin()) {
        $update_level = 'administrator';
    }
    if (! current_user_can( $update_level )) {
        return;
    } else {
        echo cruinnv_wp_comments_new_tab_upgrade_check();
    }
}
add_action('admin_menu', 'cruinnv_wp_comments_new_tab_add_plugin_menu_item');
function cruinnv_wp_comments_new_tab_add_plugin_settings_page() {
    include_once('admin-help.php');
    ?>
        <div id="cruinnv_wp_comments_new_tab_wrap">
        <h1 style="line-height:1.1em;">Comment Links New Tab</h1>
        <?php
            $img_main_settings_admin = '<img id="cruinnv_wp_comments_new_tab_admin_settings_image" style="margin-bottom:1px; margin-right:10px;" align="left" src="' . plugins_url('images/cruinnv-com-links-new-tab-admin.png', __FILE__) . '" alt="" height="45" width="45" />';
        ?>
        <p style="margin-bottom:22px;"><?php echo $img_main_settings_admin; ?><strong>Comment Links New Tab Info:</strong><br>Enter your desired settings below. Be sure to save your settings.<br>You can hover over, or tap the ?'s for help. And, use the "Reset Defaults" to restore settings to original.
        </p>
        <br>
                <form method="post" action="options.php">
                    <?php
                        if (isset($_POST['reset_com_auth'])) {
                            cruinnv_wp_comments_new_tab_reset_reset_com_defaults();
                        }
                        settings_fields('cruinnv-coms-new-tab-section');            
                        do_settings_sections('cruinnv-coms-new-tab-plugin-options');
                        submit_button();  
                    ?>
                </form>
                <form method="post" action="">
                <p class="reset_settings_button"><?php wp_nonce_field('cruinnv-coms-new-tab-plugin-options'); ?><input id="reset_settings_button" name="reset_com_auth" class="button-primary" type="submit" value="Reset Defaults" onclick="return confirm('Warning ! \n \n You are about to restore default values. \n Are you sure you want to reset all data? \n')"><input type="hidden" name="action" value="reset" />
                </p>
                </form>
                <br><br><br>
        </div>
        <?php
}
function cruinnv_wp_comments_new_tab_plugin_fields() {
    $cruinnv_wp_comments_new_tab_whitelisted_sites_one_help = '<a href="#" onclick="return false;" id="cruinnv_whitelisted_domain_trigger" class="cruinnv_wp_comments_new_tab_admin_help_question">?</a>';
    $cruinnv_wp_comments_new_tab_css_options_help = '<a href="#" onclick="return false;" id="cruinnv_css_options_trigger" class="cruinnv_wp_comments_new_tab_admin_help_question">?</a>';
    $cruinnv_wp_comments_new_tab_css_value_help = '<a href="#" onclick="return false;" id="cruinnv_css_value_trigger" class="cruinnv_wp_comments_new_tab_admin_help_question">?</a>';
    $cruinnv_wp_comments_new_tab_target_help = '<a href="#" onclick="return false;" id="cruinnv_target_trigger" class="cruinnv_wp_comments_new_tab_admin_help_question">?</a>';
    $cruinnv_wp_comments_new_tab_rel_help = '<a href="#" onclick="return false;" id="cruinnv_rel_trigger" class="cruinnv_wp_comments_new_tab_admin_help_question">?</a>';
    $cruinnv_wp_comments_new_tab_title_help = '<a href="#" onclick="return false;" id="cruinnv_title_trigger" class="cruinnv_wp_comments_new_tab_admin_help_question">?</a>';
    $cruinnv_wp_comments_new_tab_js_help = '<a href="#" onclick="return false;" id="cruinnv_js_trigger" class="cruinnv_wp_comments_new_tab_admin_help_question">?</a>';
    //add sections-settings-fields
    add_settings_section(
        'cruinnv-coms-new-tab-section',
        'Comment Links New Tab Settings:',
        null,
        'cruinnv-coms-new-tab-plugin-options'
    );
    add_settings_field(
        'cruinnv_wp_comments_new_tab_whitelist_site',
        "$cruinnv_wp_comments_new_tab_whitelisted_sites_one_help Whitelist Your Domain:",
        'cruinnv_wp_comments_new_tab_whitelisted_one_func',
        'cruinnv-coms-new-tab-plugin-options',
        'cruinnv-coms-new-tab-section'
    );
    add_settings_field(
        'cruinnv_wp_comments_new_tab_css_options',
        "$cruinnv_wp_comments_new_tab_css_options_help CSS Options:",
        'cruinnv_wp_comments_new_tab_css_options_func',
        'cruinnv-coms-new-tab-plugin-options',
        'cruinnv-coms-new-tab-section'
    );
    add_settings_field(
        'cruinnv_wp_comments_new_tab_css_value',
        "$cruinnv_wp_comments_new_tab_css_value_help CSS Value:",
        'cruinnv_wp_comments_new_tab_css_value_func',
        'cruinnv-coms-new-tab-plugin-options',
        'cruinnv-coms-new-tab-section'
    );
    add_settings_field(
        'cruinnv_wp_comments_new_tab_target',
        "$cruinnv_wp_comments_new_tab_target_help Target:",
        'cruinnv_wp_comments_new_tab_target_func',
        'cruinnv-coms-new-tab-plugin-options',
        'cruinnv-coms-new-tab-section'
    );
    add_settings_field(
        'cruinnv_wp_comments_new_tab_rel',
        "$cruinnv_wp_comments_new_tab_rel_help Rel:",
        'cruinnv_wp_comments_new_tab_rel_func',
        'cruinnv-coms-new-tab-plugin-options',
        'cruinnv-coms-new-tab-section'
    );
    add_settings_field(
        'cruinnv_wp_comments_new_tab_title',
        "$cruinnv_wp_comments_new_tab_title_help Title:",
        'cruinnv_wp_comments_new_tab_title_func',
        'cruinnv-coms-new-tab-plugin-options',
        'cruinnv-coms-new-tab-section'
    );
    add_settings_field(
        'cruinnv_wp_comments_new_tab_is_comp_js',
        "$cruinnv_wp_comments_new_tab_js_help Compress/Minify JS:",
        'cruinnv_wp_comments_new_tab_is_comp_js_func',
        'cruinnv-coms-new-tab-plugin-options',
        'cruinnv-coms-new-tab-section'
    );
    //section, name field, sanitation
    register_setting(
        'cruinnv-coms-new-tab-section',
        'cruinnv_wp_comments_new_tab_whitelisted_one',
        'cruinnv_sanitize_whitelisted_one'
    );
    register_setting(
        'cruinnv-coms-new-tab-section',
        'cruinnv_wp_comments_new_tab_css_options',
        'cruinnv_sanitize_css_options'
    );
    register_setting(
        'cruinnv-coms-new-tab-section',
        'cruinnv_wp_comments_new_tab_css_value',
        'cruinnv_sanitize_css_value'
    );
    register_setting(
        'cruinnv-coms-new-tab-section',
        'cruinnv_wp_comments_new_tab_target',
        'cruinnv_sanitize_target'
    );
    register_setting(
        'cruinnv-coms-new-tab-section',
        'cruinnv_wp_comments_new_tab_rel',
        'cruinnv_sanitize_rel'
    );
    register_setting(
        'cruinnv-coms-new-tab-section',
        'cruinnv_wp_comments_new_tab_title',
        'cruinnv_sanitize_title'
    );
    register_setting(
        'cruinnv-coms-new-tab-section',
        'cruinnv_wp_comments_new_tab_is_comp_js',
        'cruinnv_sanitize_js'
    );
}
add_action('admin_init', 'cruinnv_wp_comments_new_tab_plugin_fields');
################-Plugin Admin Functions-##################
function cruinnv_wp_comments_new_tab_whitelisted_one_func() {
    ?>
    <p>
    <input required id="cruinnv_wp_comments_new_tab_inputs" type="text" maxlength="80" name="cruinnv_wp_comments_new_tab_whitelisted_one" size="30" value="<?php echo esc_attr(get_option('cruinnv_wp_comments_new_tab_whitelisted_one')); ?>" />
    </p>
    <?php
}
################################################################
function cruinnv_wp_comments_new_tab_css_options_func() {
    $cruinnv_wp_comments_new_wingdow_css_options = get_option('cruinnv_wp_comments_new_tab_css_options');
    ?>
    <p>
    <select name="cruinnv_wp_comments_new_tab_css_options" style="min-width:180px; max-width:240px;" id="cruinnv_wp_comments_new_tab_inputs">
    <?php
        if ($cruinnv_wp_comments_new_wingdow_css_options == 'class') {
    ?>
            <option value="class" selected>class</option>
            <option value="id">id</option>
            <option value="custom">custom</option>
    </select>
    </p>
    <?php
        } elseif ($cruinnv_wp_comments_new_wingdow_css_options == 'id') {
    ?>
            <option value="class">class</option>
            <option value="id" selected>id</option>
            <option value="custom">custom</option>
    </select>
    </p>
    <?php
        } elseif ($cruinnv_wp_comments_new_wingdow_css_options == 'custom') {
    ?>
            <option value="class">class</option>
            <option value="id">id</option>
            <option value="custom" selected>custom</option>
    </select>
    </p>
    <?php
        }
}
##################################################################
function cruinnv_wp_comments_new_tab_css_value_func() {
    ?>
    <p>
    <input required placeholder="example: comments" id="cruinnv_wp_comments_new_tab_inputs" type="text" maxlength="80" name="cruinnv_wp_comments_new_tab_css_value" size="30" value="<?php echo esc_attr(get_option('cruinnv_wp_comments_new_tab_css_value')); ?>" />
    </p>
    <?php
}
##################################################################
function cruinnv_wp_comments_new_tab_target_func() {
    $cruinnv_wp_comments_new_wingdow_target = get_option('cruinnv_wp_comments_new_tab_target');
    ?>
    <p>
    <select name="cruinnv_wp_comments_new_tab_target" style="min-width:180px; max-width:240px;" id="cruinnv_wp_comments_new_tab_inputs">
    <?php
        if ($cruinnv_wp_comments_new_wingdow_target == '_blank') {
    ?>
            <option value="_blank" selected>New Tab</option>
            <option value="_self">Same Tab</option>
            </select>
    </p>
    <?php
        } elseif ($cruinnv_wp_comments_new_wingdow_target == '_self') {
    ?>
            <option value="_blank">New Tab</option>
            <option value="_self" selected>Same Tab</option>
    </select>
    </p>
    <?php
        }
}
##################################################################
function cruinnv_wp_comments_new_tab_rel_func() {
    $cruinnv_wp_comments_new_tab_rel = get_option('cruinnv_wp_comments_new_tab_rel');
    ?>
    <p>
    <select name="cruinnv_wp_comments_new_tab_rel" style="min-width:180px; max-width:240px;" id="cruinnv_wp_comments_new_tab_inputs">
    <?php
        if ($cruinnv_wp_comments_new_tab_rel == 'keep original') {
    ?>
            <option value="keep original" selected>keep original</option>
            <option value="external nofollow">external nofollow</option>
            <option value="nofollow">nofollow</option>
            <option value="dofollow">dofollow</option>
    </select>
    </p>
    <?php
        } elseif ($cruinnv_wp_comments_new_tab_rel == 'external nofollow') {
    ?>
            <option value="keep original">keep original</option>
            <option value="external nofollow" selected>external nofollow</option>
            <option value="nofollow">nofollow</option>
            <option value="dofollow">dofollow</option>
    </select>
    </p>
    <?php
        } elseif ($cruinnv_wp_comments_new_tab_rel == 'nofollow') {
    ?>
            <option value="keep original">keep original</option>
            <option value="external nofollow">external nofollow</option>
            <option value="nofollow" selected>nofollow</option>
            <option value="dofollow">dofollow</option>
    </select>
    </p>
    <?php
        } elseif ($cruinnv_wp_comments_new_tab_rel == 'dofollow') {
    ?>
            <option value="keep original">keep original</option>
            <option value="external nofollow">external nofollow</option>
            <option value="nofollow">nofollow</option>
            <option value="dofollow" selected>dofollow</option>
    </select>
    </p>
    <?php
        }
}
##################################################################
function cruinnv_wp_comments_new_tab_title_func() {
    ?>
    <p>
    <input placeholder="Optional" id="cruinnv_wp_comments_new_tab_inputs" type="text" maxlength="80" name="cruinnv_wp_comments_new_tab_title" size="30" value="<?php echo esc_attr(get_option('cruinnv_wp_comments_new_tab_title')); ?>" />
    </p>
    <?php
}
##################################################################
function cruinnv_wp_comments_new_tab_is_comp_js_func() {
    $cruinnv_wp_comments_new_tab_is_comp_js = get_option('cruinnv_wp_comments_new_tab_is_comp_js');
        if ($cruinnv_wp_comments_new_tab_is_comp_js == '0') {
    ?>
            <p style="margin-top:11px;">
            <input type="radio" name="cruinnv_wp_comments_new_tab_is_comp_js" value="0" checked><span style="color:#23282d; font-weight:bold;">Uncompressed</span>
            <input type="radio" name="cruinnv_wp_comments_new_tab_is_comp_js" value="1">Minified
            </p>
    <?php
        } elseif ($cruinnv_wp_comments_new_tab_is_comp_js == '1') {
    ?>
            <p style="margin-top:11px;">
            <input type="radio" name="cruinnv_wp_comments_new_tab_is_comp_js" value="0">Uncompressed
            <input type="radio" name="cruinnv_wp_comments_new_tab_is_comp_js" value="1" checked><span style="color:#23282d; font-weight:bold;">Minified</span>
            </p>
    <?php
        }
}
###############################################################
//sanitize and validate input Plugin Admin Functions
###############################################################
function cruinnv_sanitize_whitelisted_one($url) { 
    $url = wp_filter_nohtml_kses($url);      
    $find = array( 'http://www.', 'https://www.', 'http://', 'https://' );
    $replace = ''; //use this
    $url = str_replace( $find, $replace, $url );
    if(substr($url, -1) == '/') {    //remove end slash if exists
        $url = substr($url, 0, -1);
    }
    if (strlen($url) < 80) {
        // Verified OK
        $url = strtolower($url);
    } else {
        $url = 'Error - Too Long!'; //else length too long
        $url = strtoupper($url);
    }
    return $url;
}
function cruinnv_sanitize_css_options($css_options) {
    $css_options = wp_filter_nohtml_kses($css_options);
    if (preg_match('(class|id|custom)', $css_options)) {
        // match class, id, or custom
    } else {
        $css_options = 'class';
    }
    return $css_options;
}
function cruinnv_sanitize_css_value($css_value) { 
    $css_value = wp_filter_nohtml_kses($css_value);      
    if (strlen($css_value) < 80) {
        // Verified OK
    } else {
        $css_value = 'Error - Too Long!'; //else length too long
    }
    return $css_value;
}
function cruinnv_sanitize_target($target) {
    $target = wp_filter_nohtml_kses($target);
    if (preg_match('(_blank|_self)', $target)) {
        // match _blank or _self
    } else {
        $target = '_blank';
    }
    return $target;
}
function cruinnv_sanitize_rel($rel) {
    $rel = wp_filter_nohtml_kses($rel);
    if (preg_match('(keep original|external nofollow|nofollow|dofollow)', $rel)) {
        // match keep original, external nofollow, nofollow, dofollow
    } else {
        $rel = 'keep original';
    }
    return $rel;
}
function cruinnv_sanitize_title($title) { 
    //$title = wp_filter_nohtml_kses($title);
    $title = wp_strip_all_tags($title);
    if (strlen($title) < 80) {
        // Verified OK
    } else {
        $title = 'Error - Too Long!'; //else length too long
    }
    return $title;
}
function cruinnv_sanitize_js($js) {
    $js = wp_filter_nohtml_kses($js);
    if (preg_match('(0|1)', $js)) {
        // match 0 or 1
    } else {
        $js = '0';
    }
    return $js;
}
?>