var reldf = parseInt(cruinnv_wp_comments_new_tab_php_vars.reldf);
var cruinnvComLinksNewTab =
{
    /**
    * Open links in new tab, with ability to add title and nofollow.
    * Handles both http and https links.
    * Can target specific a id's or classes.
    */
    init: function() {
            (function($) {
                $(""+cruinnv_wp_comments_new_tab_php_vars.cssvalue+" a[href^=http]").each(function() {
                    var excluded = [
                        // format for whitelist: 'google.com', 'apple.com', 'myawesomeblog.com'
                        // add your excluded domains here                
                        cruinnv_wp_comments_new_tab_php_vars.primaryhomeurl
                        ];
                    for(i=0; i<excluded.length; i++) {
                        if(this.href.indexOf(excluded[i]) != -1) {
                            return true;
                        }
                    }
                    if(this.href.indexOf(location.hostname) == -1) { //dofollow
                        $(this).click(function() { return true; }); 
                            if ((reldf) == 1) {
                                $(this).attr({
                                    target: cruinnv_wp_comments_new_tab_php_vars.target
                                });
                                $(this).removeAttr('rel');
                            } else if ((reldf) == 0) { //external nofollow or nofollow
                                $(this).attr({
                                    target: cruinnv_wp_comments_new_tab_php_vars.target,
                                    rel: cruinnv_wp_comments_new_tab_php_vars.rel
                                });
                            } else if ((reldf) == 2) { //keep original rel
                                $(this).attr({
                                    target: cruinnv_wp_comments_new_tab_php_vars.target
                                });
                            }
                            if (cruinnv_wp_comments_new_tab_php_vars.title !== "na") {
                                $(this).attr({
                                    title: cruinnv_wp_comments_new_tab_php_vars.title
                                });
                            }
                        $(this).click();
                    }
                }); //end http
            })(jQuery);
    } //end init
}; //cruinnvComLinksNewTab
jQuery(document).ready(function($) {
    cruinnvComLinksNewTab.init();
});