jQuery(document).ready(function($) {

	// Prototypeing

	// Tabs
	$('.aye_tabs .tabs .tab').click(function() {
		$('.aye_tabs .tabs .tab').removeClass('active');
		$(this).addClass('active');
		$('.aye_tabs .content .tab_content[data-tabcontent="'+$(this).attr('data-tab')+'"]').show().siblings().hide();
	});

	// Accordion
	$('.aye_accordion_title').click(function() {
		if(!$(this).hasClass('active')) {
			$('.aye_accordion_content').slideUp();
			$(this).siblings('.aye_accordion_content').slideDown();
			$('.aye_accordion_title').removeClass('active');
			$(this).addClass('active');
		} else {
			$(this).siblings('.aye_accordion_content').slideUp();
			$(this).removeClass('active');
		}
	});

	// Back to top
	$('.aye_divider_gotop').click(function() {
		$('body, html').animate({ scrollTop: 0});
	});
});