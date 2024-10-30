/* jquery for plugin admin hover over info help etc links
* called in admin-help.php div ahref=# id=trigger
* style in cruinnv-com-links-new-tab-admin.css
*/
jQuery(document).ready(function($) {
    var moveLeft = 18;
    var moveDown = -85;
    var moveDownLink = 18;

/*--whitelisted domain--*/
    $('a#cruinnv_whitelisted_domain_trigger').hover(function(e) {
        $('div#cruinnv_whitelisted_domain_trigger').fadeIn(400)
        .css('top', e.pageY + moveDown)
        .css('left', e.pageX + moveLeft)
        .appendTo('body');
    }, function() {
        setTimeout(function() { $('div#cruinnv_whitelisted_domain_trigger').fadeOut(400); });
    });
/*--css options--*/
    $('a#cruinnv_css_options_trigger').hover(function(e) {
        $('div#cruinnv_css_options_trigger').fadeIn(400)
        .css('top', e.pageY + moveDown)
        .css('left', e.pageX + moveLeft)
        .appendTo('body');
    }, function() {
        setTimeout(function() { $('div#cruinnv_css_options_trigger').fadeOut(400); });
    });
/*--css value--*/
    $('a#cruinnv_css_value_trigger').hover(function(e) {
        $('div#cruinnv_css_value_trigger').fadeIn(400)
        .css('top', e.pageY + moveDown)
        .css('left', e.pageX + moveLeft)
        .appendTo('body');
    }, function() {
        setTimeout(function() { $('div#cruinnv_css_value_trigger').fadeOut(400); });
    });
/*--target window--*/
    $('a#cruinnv_target_trigger').hover(function(e) {
        $('div#cruinnv_target_trigger').fadeIn(400)
        .css('top', e.pageY + moveDown)
        .css('left', e.pageX + moveLeft)
        .appendTo('body');
    }, function() {
        setTimeout(function() { $('div#cruinnv_target_trigger').fadeOut(400); });
    });
/*--rel--*/
    $('a#cruinnv_rel_trigger').hover(function(e) {
        $('div#cruinnv_rel_trigger').fadeIn(400)
        .css('top', e.pageY + moveDown)
        .css('left', e.pageX + moveLeft)
        .appendTo('body');
    }, function() {
        setTimeout(function() { $('div#cruinnv_rel_trigger').fadeOut(400); });
    });
/*--title--*/
    $('a#cruinnv_title_trigger').hover(function(e) {
        $('div#cruinnv_title_trigger').fadeIn(400)
        .css('top', e.pageY + moveDown)
        .css('left', e.pageX + moveLeft)
        .appendTo('body');
    }, function() {
        setTimeout(function() { $('div#cruinnv_title_trigger').fadeOut(400); });
    });
/*--compress minify js--*/
    $('a#cruinnv_js_trigger').hover(function(e) {
        $('div#cruinnv_js_trigger').fadeIn(400)
        .css('top', e.pageY + moveDown)
        .css('left', e.pageX + moveLeft)
        .appendTo('body');
    }, function() {
        setTimeout(function() { $('div#cruinnv_js_trigger').fadeOut(400); });
    });
});