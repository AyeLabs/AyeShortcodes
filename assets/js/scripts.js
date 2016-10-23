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

	// Before after
	$(window).on('resize', function() {
		var aye_before_after_heights = [];
		$('.aye_before_after img').each(function(x, y) {
			aye_before_after_heights.push($(y).height());
			$(y).css({
				'width': $(y).width(),
				'height': $(y).height()
			});
		});
		$('.aye_before_after').css('height', Math.max(...aye_before_after_heights));
		$('.aye_before_after .after').css('width', '50%');
	}).trigger('resize');

	$('.aye_before_after').on('mousemove', function(event) {
		$('.aye_before_after .after').css('width', Math.ceil((event.offsetX * 100 / $('.aye_before_after').width())) + '%');
		$('.aye_before_after .border').css('left', Math.ceil((event.offsetX * 100 / $('.aye_before_after').width())) + '%');
	});

	// Aye Counter
	$('.aye_counter').countTo();

});