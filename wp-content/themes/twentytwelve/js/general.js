//placeholder input function

$(document).ready(function(){
	$('.placeholder_textbox').each(function(){
		var tAttr = $(this).attr('title');
		if(typeof(tAttr) != 'undefined' && tAttr != false){
			if(tAttr != null && tAttr != ''){
			  $(this).data('placeholder', tAttr);
			  $(this).removeAttr('title');
			  $(this).addClass('default_title_text');
			  $(this).val(tAttr);
			  $(this).focus(function(){
				$(this).removeClass('default_title_text');
				if($(this).val() == $(this).data('placeholder')){
				  $(this).val('');
				}
			  });
			  $(this).blur(function(){
				if($(this).val() == ''){
				  $(this).val($(this).data('placeholder'));
				  $(this).addClass('default_title_text');
				}
			  });
			}
		}    
	});
});
$(function() {

    $('#slideshow').cycle({
        fx:      'fade',
        timeout:  3000,
        prev:    '#prev',
        next:    '#next',
        pager:   '#nav',
        pagerAnchorBuilder: pagerFactory
    });

    function pagerFactory(idx, slide) {
        var s = idx > 2 ? ' ' : '';
        return '<li'+s+'><a href="#">'+(idx+1)+'</a></li>';
    };
    
});
$(function() {

    $('#slideshow1').cycle({
        fx:      'fade',
        timeout:  3000,
        prev:    '#prev1',
        next:    '#next1',
        pager:   '#nav1',
        pagerAnchorBuilder: pagerFactory
    });

    function pagerFactory(idx, slide) {
        var s = idx > 2 ? ' ' : '';
        return '<li'+s+'><a href="#">'+(idx+1)+'</a></li>';
    };
    
});

