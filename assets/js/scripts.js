jQuery(document).ready(function($) {

	// Prototypeing

	// Tabs
	$('.aye_tabs .tabs .tab').click(function() {
		var id = $(this).attr('data-id');

		$('#'+id+' .tabs .tab').removeClass('active');
		$(this).addClass('active');
		$('#'+id+' .content .tab_content[data-tabcontent="'+$(this).attr('data-tab')+'"]').show().siblings().hide();
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
	var AyeBeforeAfter = function(element) {
		this.$element = $(element);
		this.init();
	};

	AyeBeforeAfter.prototype.init = function() {
		var slider = this.$element,
			fox = this;

		$(slider).each(function(x,y) {
			fox.slide(y);
		});

	};

	AyeBeforeAfter.prototype.slide = function(slide) {
		var aye_before_after_heights = [];

		$(window).on('resize', function() {

			// Get heights
			var afterHeight = $(slide).children('.after').children('img')[0]['height'],
				beforeheight = $(slide).children('.before').children('img')[0]['height'];

			// Push heights
			aye_before_after_heights.push(afterHeight);
			aye_before_after_heights.push(beforeheight);

			// Add height
			$(slide).children('.after').children('img').css('height', afterHeight);
			$(slide).children('.after').children('img').css('width', $(slide).children('.after').children('img')[0]['width']);
			$(slide).children('.before').children('img').css('height', beforeheight);
			$(slide).children('.before').children('img').css('width', $(slide).children('.before').children('img')[0]['width']);

			// Set dimensions
			$(slide).css('height', Math.max.apply(null, aye_before_after_heights));
			$(slide).children('.after').css('width', '50%');
		}).trigger('resize');

		$(slide).on('mousemove', function(event) {
			$(slide).children('.after').css('width', Math.ceil((event.offsetX * 100 / $(slide).width())) + '%');
			$(slide).children('.border').css('left', Math.ceil((event.offsetX * 100 / $(slide).width())) + '%');
		});
	};

	$.fn.AyeBeforeAfter = function () {
		new AyeBeforeAfter(this);
	};

	$('.aye_before_after').AyeBeforeAfter();
	

	// Aye Counter
	$('.aye_counter').countTo();

});