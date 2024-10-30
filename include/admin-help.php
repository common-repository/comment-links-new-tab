<?php
    $img_help_settings = '<img style="margin:4px 6px 0 0; padding:2px; background-color:#1EAAF1; border-radius:15%; align:left; display:block; border:2px solid #acacac;" align="left" src="' . plugins_url('images/cruinnv-com-links-new-tab-admin-pop-up.png', __FILE__) . '" alt="" height="25" width="25" />';
?>
    <!-- POP-UP DIV -->
    <div id="cruinnv_whitelisted_domain_trigger">
        <?php echo $img_help_settings; ?><h3 id="cruinnv_wp_comments_new_tab_headline_h3">Whitelist Your Domain</h3>
        <p><span class="cruinnv_wp_comments_new_tab_value">Default Value:</span> <span class="cruinnv_wp_comments_new_tab_value_highlight">yourdomain.com</span></p>
        <p>This ensures that your domain name is exempt, and does not open in a new tab/tab.</p>
        <p><span class="cruinnv_wp_comments_new_tab_jqmax_value">Values Allowed:</span> <span class="cruinnv_wp_comments_new_tab_jqmax_numb">your-real-domain (.com, .net, .org, etc)</span></p>
        <p>Must be domain.com format only. No http://, https://, or www's please.</p>
    </div>
    <div id="cruinnv_css_options_trigger">
        <?php echo $img_help_settings; ?><h3 id="cruinnv_wp_comments_new_tab_headline_h3">CSS Options</h3>
        <p><span class="cruinnv_wp_comments_new_tab_value">Default Value:</span> <span class="cruinnv_wp_comments_new_tab_value_highlight">id</span></p>
        <p>This is the comment author name css link you wish to target.</p>
        <p>Custom will allow you to enter a more complex combination if your WordPress theme requires it.</p>
        <p><span class="cruinnv_wp_comments_new_tab_jqmax_value">Values Allowed:</span> <span class="cruinnv_wp_comments_new_tab_jqmax_numb">class, id, custom</span></p>
        <p>You can find this by right clicking on the comment author name and selecting inspect element.</p>
    </div>
    <div id="cruinnv_css_value_trigger">
        <?php echo $img_help_settings; ?><h3 id="cruinnv_wp_comments_new_tab_headline_h3">CSS Value</h3>
        <p><span class="cruinnv_wp_comments_new_tab_value">Default Value:</span> <span class="cruinnv_wp_comments_new_tab_value_highlight">comments</span></p>
        <p>This is the actual css class or id name.</p>
        <p>If you selected class above omit the .(dot), and enter only the class name. Example: comment-author</p>
        <p>If you selected id above omit the #, and enter only the id name. Example: comments</p>
        <p>If you selected custom above you can enter a combination of class / ids. Custom example: #comments .comment-author</p>
        <p><span class="cruinnv_wp_comments_new_tab_jqmax_value">Values Allowed:</span> <span class="cruinnv_wp_comments_new_tab_jqmax_numb">any</span></p>
        <p>You can find this by right clicking on the comment author name and selecting inspect element.</p>
    </div>
    <div id="cruinnv_target_trigger">
        <?php echo $img_help_settings; ?><h3 id="cruinnv_wp_comments_new_tab_headline_h3">Target</h3>
        <p><span class="cruinnv_wp_comments_new_tab_value">Default Value:</span> <span class="cruinnv_wp_comments_new_tab_value_highlight">New Tab</span></p>
        <p>This allows you to open the link in a new tab / tab, or in the same tab / tab.</p>
        <p>Same tab defeats the purpose, but it can optionally be used, or for test purposes.</p>
        <p><span class="cruinnv_wp_comments_new_tab_jqmax_value">Values Allowed:</span> <span class="cruinnv_wp_comments_new_tab_jqmax_numb">New Tab, Same Tab</span></p>
    </div>
    <div id="cruinnv_rel_trigger">
        <?php echo $img_help_settings; ?><h3 id="cruinnv_wp_comments_new_tab_headline_h3">Rel</h3>
        <p><span class="cruinnv_wp_comments_new_tab_value">Default Value:</span> <span class="cruinnv_wp_comments_new_tab_value_highlight">keep original</span></p>
        <p>This is relationship link attribute (rel="external nofollow").</p>
        <p><span class="cruinnv_wp_comments_new_tab_jqmax_value">Values Allowed:</span> <span class="cruinnv_wp_comments_new_tab_jqmax_numb">keep original, external nofollow, nofollow, dofollow</span></p>
        <p><span style="color:orange; font-weight:bold;">Warning:</span> Be careful with dofollow.</p>
    </div>
    <div id="cruinnv_title_trigger">
        <?php echo $img_help_settings; ?><h3 id="cruinnv_wp_comments_new_tab_headline_h3">Title</h3>
        <p><span class="cruinnv_wp_comments_new_tab_value">Default Value:</span> <span class="cruinnv_wp_comments_new_tab_value_highlight">none</span></p>
        <p>This is the title attribute (title="Whatever"), which you would see when hovering your mouse over a link that has a title assigned.</p>
        <p>If you add a title all links will have the same title.</p>
        <p><span class="cruinnv_wp_comments_new_tab_jqmax_value">Values Allowed:</span> <span class="cruinnv_wp_comments_new_tab_jqmax_numb">any</span></p>
    </div>
    <div id="cruinnv_js_trigger">
        <?php echo $img_help_settings; ?><h3 id="cruinnv_wp_comments_new_tab_headline_h3">Compress/Minify JS</h3>
        <p><span class="cruinnv_wp_comments_new_tab_value">Default Value:</span> <span class="cruinnv_wp_comments_new_tab_value_highlight">Uncompressed</span></p>
        <p>Minified will make the plugin js (javascript file) smaller by removing author comments, line breaks, and spaces for faster loading.</p>
        <p>Minified doesn't always play nice with some themes therefore, Uncompressed is the default.</p>
        <p><span class="cruinnv_wp_comments_new_tab_jqmax_value">Values Allowed:</span> <span class="cruinnv_wp_comments_new_tab_jqmax_numb">Uncompressed, Minified</span></p>
    </div>