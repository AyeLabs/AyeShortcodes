jQuery(document).ready(function($) {

	// Tabs
	$('.aye_tabs .tabs .tab').click(function() {
		$('.aye_tabs .tabs .tab').removeClass('active');
		$(this).addClass('active');
		$('.aye_tabs .content .tab_content[data-tabcontent="'+$(this).attr('data-tab')+'"]').show().siblings().hide();
	});
});