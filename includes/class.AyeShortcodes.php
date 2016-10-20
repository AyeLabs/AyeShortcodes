<?php

namespace Aye\Shortcodes;

class Shortcodes {
	private $tab_titles = array();

	function __construct() {
		add_action( 'init', array( $this, 'loadAssets') );

	}

	public function loadAssets() {
		wp_enqueue_style( 'bootstrap', PLUGIN_URL . 'assets/css/main.min.css' );
		wp_enqueue_style( 'fontawesome', PLUGIN_URL . 'assets/libs/font-awesome/css/font-awesome.min.css' );
		wp_enqueue_script( 'ayeshortcode', PLUGIN_URL . 'assets/js/scripts.js', array('jquery') );
	}

	static function aye_column($atts, $content = '') {
		$args = shortcode_atts( array(
	        "lg"          => '',
            "md"          => '',
            "sm"          => '',
            "xs"          => '',
            "pull_lg"     => '',
            "pull_md"     => '',
            "pull_sm"     => '',
            "pull_xs"     => '',
            "push_lg"     => '',
            "push_md"     => '',
            "push_sm"     => '',
            "push_xs"     => '',
            "offset_lg"   => '',
            "offset_md"   => '',
            "offset_sm"   => '',
            "offset_xs"   => '',
            "pricing_table"   => '',
            "pricing_highlighted"   => '',
	    ), $atts );

	    $class  = '';
		$class .= ( $args['lg'] )                                      ? ' col-lg-'. $args['lg'] : '';
		$class .= ( $args['md'] )                                      ? ' col-md-'. $args['md'] : '';
		$class .= ( $args['sm'] )                                      ? ' col-sm-'. $args['sm'] : '';
		$class .= ( $args['xs'] )                                      ? ' col-xs-'. $args['xs'] : '';
		$class .= ( $args['pull_lg']   || $args['pull_lg'] === "0" )   ? ' col-lg-pull-'. $args['pull_lg'] : '';
		$class .= ( $args['pull_md']   || $args['pull_md'] === "0" )   ? ' col-md-pull-'. $args['pull_md'] : '';
		$class .= ( $args['pull_sm']   || $args['pull_sm'] === "0" )   ? ' col-sm-pull-'. $args['pull_sm'] : '';
		$class .= ( $args['pull_xs']   || $args['pull_xs'] === "0" )   ? ' col-xs-pull-'. $args['pull_xs'] : '';
		$class .= ( $args['push_lg']   || $args['push_lg'] === "0" )   ? ' col-lg-push-'. $args['push_lg'] : '';
		$class .= ( $args['push_md']   || $args['push_md'] === "0" )   ? ' col-md-push-'. $args['push_md'] : '';
		$class .= ( $args['push_sm']   || $args['push_sm'] === "0" )   ? ' col-sm-push-'. $args['push_sm'] : '';
		$class .= ( $args['push_xs']   || $args['push_xs'] === "0" )   ? ' col-xs-push-'. $args['push_xs'] : '';
		$class .= ( $args['offset_lg'] || $args['offset_lg'] === "0" ) ? ' col-lg-offset-'. $args['offset_lg'] : '';
		$class .= ( $args['offset_md'] || $args['offset_md'] === "0" ) ? ' col-md-offset-'. $args['offset_md'] : '';
		$class .= ( $args['offset_sm'] || $args['offset_sm'] === "0" ) ? ' col-sm-offset-'. $args['offset_sm'] : '';
		$class .= ( $args['offset_xs'] || $args['offset_xs'] === "0" ) ? ' col-xs-offset-'. $args['offset_xs'] : '';
		$class .= ( $args['pricing_table'] || $args['pricing_table'] === "0" ) ? ' aye_pricing_table '. $args['pricing_table'] : '';
		$class .= ( $args['pricing_highlighted'] || $args['pricing_highlighted'] === "0" ) ? ' aye_pricing_highlighted' : '';

		return '<div class="'. $class .'">'. do_shortcode($content) .'</div>';
	}

	static function aye_tabs($atts, $content = '') {
		$args = shortcode_atts( array(
	        "orientation"          => 'horizontal'
	    ), $atts );

		$return = '<div class="row aye_tabs '.$args['orientation'].'">';

		// Start tabs
	    if($args['orientation'] == 'horizontal') {
			$return .= '<div class="tabs col-md-12 col-sm-12 col-xs-12 col-lg-12">';
	    } else {
			$return .= '<div class="tabs col-md-4 col-sm-4 col-xs-12 col-lg-4">';
	    }

	    $tab_content = do_shortcode(wp_strip_all_tags($content));

	    foreach($this->tab_titles as $key => $title) {
	    	$return .= '<div class="tab'.($key == 0 ? ' active' : '').'" data-tab="'. esc_attr($key) .'">'. esc_html($title) .'</div>';
	    }

	    // End tabs
		$return .= '</div><!--/.tabs-->';

		// Start contennt
		if($args['orientation'] == 'horizontal') {
			$return .= '<div class="content col-md-12 col-sm-12 col-xs-12 col-lg-12">';
		} else{
			$return .= '<div class="content col-md-8 col-sm-8 col-xs-12 col-lg-8">';
		}

		// Content and closing divs
		$return .= $tab_content . '</div><!--/.content--></div><!-- / .row -->';

		return $return;
	}

	static function aye_tab($atts, $content = "") {
		$args = shortcode_atts( array(
	        "title"          => ''
	    ), $atts );

	    $title = $args['title'];
		if(!empty($args['title']) and !in_array($args['title'], $this->tab_titles)) {
	    	$count = array_push($this->tab_titles, $title);
		}

		return '<div class="tab_content" style="display: '. (($count - 1) == 0 ? 'block' : 'none') .';" data-tabcontent="'. ($count - 1) .'">'. do_shortcode($content) .'</div>';

	}

	static function aye_button($atts) {
		$args = shortcode_atts( array(
	        "url"          => '',
	        "label"          => '',
	        "target"          => '',
	        "id"          => '',
	        "icon"          => ''
	    ), $atts );

		// Build class
	    $class = "aye_button";
	    if(!empty($args['icon'])) {
	    	$class .= ' fa fa-' . $args['icon'];
	    }

	    // Get permalink if id it's used
	    $permalink = $args['url'];
	    if(!empty($args['id'])) {
	    	$permalink = get_permalink($args['id']);
	    }

	    // Build target
    	$current_url = parse_url(home_url());
    	$shortcode_url = parse_url($permalink);

    	if($current_url['host'] != $shortcode_url['host'] and empty($args['target'])) {
    		$target = '_blank';
    	} elseif(!empty($args['target'])) {
    		$target = $args['target'];
    	} else {
    		$target = '';
    	}

    	return '<a class="'. esc_attr($class) .'" '. (empty($target) ? '' : 'target="'. esc_attr($target) .'"').' href="' .esc_url($permalink) .'">'. $args['label'] .'</a>';
	}

	static function aye_cta($atts, $content = "") {
		$args = shortcode_atts( array(
	        "position"		=> 'left'
	    ), $atts );

		return '<div class="aye_cta '. $args['position'] .'">'. do_shortcode($content) .'</div><!-- / .aye_cta -->';
	}

	static function aye_pricing_title($atts) {
		$args = shortcode_atts( array(
	        "title"          => '',
	        "price"			 => ''
	    ), $atts );

	    return '<div class="aye_pricing_title"><span class="title">'. $args['title'] .'</span><span class="price">'. $args['price'] .'</span></div><!-- / .aye_pricing_title -->';
	}

	static function aye_pricing_row($atts) {
		$args = shortcode_atts( array(
	        "content"          => '',
	        "icon"			 => ''
	    ), $atts );

	    $class = "aye_pricing_row";

		return '<div class="aye_pricing_row">'. (( $args['icon'] || $args['icon'] === "0" ) ? '<i class="fa fa-'. $args['icon'] . '"></i>' : '') . ' '  . $args['content'] .'</div>';
	}

	static function aye_progress_bar($atts) {
		$args = shortcode_atts( array(
	        "percent"          => 0,
	        "icon"			 => '',
	        "label"			 => ''
	    ), $atts );

		$return = '<div class="aye_progress_bar"><div class="loading" style="width: '. esc_attr($args['percent']) .'%;"></div><!-- / .loading -->';

		if(!empty($args['icon'])) {
			$return .= '<i class="fa fa-'. esc_attr($args['icon']) .'"></i>';
		}

		if(!empty($args['label'])) {
			$return .= '<span>' . $args['label'] . '</span>';
		}

		$return .= '</div>';

		return $return;
	}

	static function aye_message_box($atts) {
		$args = shortcode_atts( array(
	        "type"			 => '',
	        "text"			 => '',
	        "icon"			 => '',
	        "color"			 => '',
	        "background"	 => ''
	    ), $atts );
	    
    	// Set defaults
	    $icon = ( $args['icon'] ) ? $args['icon'] : '';
	    $background = ( $args['background'] ) ? $args['background'] : '#DDD';
	    $color = ( $args['color'] ) ? $args['color'] : '';

	    // Set background and icon based on type
    	if("error" == $args['type']) {
    		$background = '#FF6347';
    		$color = '#FFF';
    		$icon = 'ban';
    	} elseif("warning" == $args['type']) {
    		$background = '#FF8E47';
    		$color = '#FFF';
    		$icon = 'exclamation-triangle';
    	} elseif("info" == $args['type']) {
    		$background = '#007acc';
    		$color = '#FFF';
    		$icon = 'info-circle';
    	} elseif("success" == $args['type']) {
    		$background = '#1CFF8B';
    		$color = '#FFF';
    		$icon = 'check';
    	}

    	$return = '<div class="aye_message_box '. $args['type'] .'" style="color: '. esc_attr($color) .'; background-color: '. esc_attr($background) .';">';

    	if(!empty($icon)) {
    		$return .= '<i class="fa fa-'. esc_attr($icon) .'"></i> ';
    	}

    	$return .= $args['text'] . '</div>';

    	return $return;
	}

	static function aye_icon($atts) {
		$args = shortcode_atts( array(
	        "type"			 => '',
	    ), $atts );

	    return '<i class="fa fa-'. esc_attr($args['type']) .'"></i>';
	}


}