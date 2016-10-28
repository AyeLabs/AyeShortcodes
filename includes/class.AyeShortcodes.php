<?php

namespace Aye\Shortcodes;

class Shortcodes {
	private $tab_titles = array();
	private $tabs = array();

	// Load assets Class
	public $assets;

	// Shortcodes helper functions
	public $helpers;

	public function __construct() {
		$this->helpers = new Helpers();
		$this->assets = new Assets();
	}

	/**
	 * Create column with content inside using Bootstrap column system
	 */
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
	    ), $atts );

	    // Require assets
	    $this->assets->loadStyle('bootstrap-columns');

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
		$class .= ( array_key_exists('pricing_highlighted', $atts) ) ? ' aye_pricing_highlighted' : '';

		return '<div class="'. esc_attr($class) .'">'. do_shortcode($content) .'</div>';
	}

	/**
	 * Creates content tabs wrapper, default size is splitted in 4/8 columns combintion.
	 */
	static function aye_tabs($atts, $content = '') {
		$args = shortcode_atts( array(
	        "orientation"	=> 'horizontal',
	        "id"			=> ''
	    ), $atts );

	    if(!empty($args['id'])) {
			$this->tab_titles[ $args['id'] ] = array();
		}

		$return = '<div '. ( !empty($args['id']) ? 'id="' . $args['id'] . '" ' : '' ) .'class="row aye_tabs '. $args['orientation'] .'">';

		// Start tabs
	    if($args['orientation'] == 'horizontal') {
			$return .= '<div class="tabs col-md-12 col-sm-12 col-xs-12 col-lg-12">';
	    } else {
			$return .= '<div class="tabs col-md-4 col-sm-4 col-xs-12 col-lg-4">';
	    }

	    $tab_content = do_shortcode(wp_strip_all_tags($content));

	    if(!empty($args['id'])) {	
		    foreach($this->tab_titles[$args['id']] as $key => $title) {
		    	$return .= '<div '. ( !empty($args['id']) ? 'data-id="' . $args['id'] . '" ' : '' ) .'class="tab'.($key == 0 ? ' active' : '').'" data-tab="'. esc_attr($key) .'">'. esc_html($title) .'</div>';
		    }
	    } else {
	    	foreach($this->tab_titles as $key => $title) {
		    	$return .= '<div class="tab'.($key == 0 ? ' active' : '').'" data-tab="'. esc_attr($key) .'">'. esc_html($title) .'</div>';
		    }
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

	/**
	 * Creates content tabs
	 */
	static function aye_tab($atts, $content = "") {
		$args = shortcode_atts( array(
	        "title"          => '',
	        "id"          => ''
	    ), $atts );

	    $title = $args['title'];
		if( !empty($args['title']) and !in_array($args['title'], $this->tab_titles) ) {
			if(!empty($args['id'])) {
	    		$count = array_push($this->tab_titles[$args['id']], $title);
			} else {
	    		$count = array_push($this->tab_titles[$args['id']], $title);
			}
		}

		return '<div class="tab_content" style="display: '. (($count - 1) == 0 ? 'block' : 'none') .';" data-tabcontent="'. ($count - 1) .'">'. do_shortcode($content) .'</div>';

	}

	/**
	 * Generates a button. 
	 * Target attribute is mark automatcally as _blank is the url is external. 
	 * You can also specify a post ID and his permalink will be used.
	 */
	static function aye_button($atts) {
		$args = shortcode_atts( array(
	        "url"          => '',
	        "label"        => '',
	        "target"       => '',
	        "id"           => '',
	        "postid"       => '',
	        "icon"         => '',
	        "set"          => 'fontawesome'
	    ), $atts );

	    // Require icon
	    if(!empty($args['icon'])) {
	    	$icon = $this->helpers->getIcon($args['set'], $args['icon']);
		}

	    // Get permalink if id it's used
	    $permalink = $args['url'];
	    if(!empty($args['postid'])) {
	    	$permalink = get_permalink($args['postid']);
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

    	return '<a 
    			'. ( !empty($args['id']) ? 'id="' . $args['id'] . '" ' : '') .'class="aye_button" 
    			'. (empty($target) ? '' : 'target="'. esc_attr($target) .'"').' href="'. esc_url($permalink) .'">
    			'. (isset($icon) ? $icon : '') .' '. $args['label'] .'</a>';
	}

	/**
	 * Generates a call to action row
	 */
	static function aye_cta($atts, $content = "") {
		$args = shortcode_atts( array(
	        "position"		=> 'left',
	        "background"		=> '#007acc',
	        "color"		=> '#fff',
	    ), $atts );

		return '<div class="aye_cta '. esc_attr($args['position']) .'" style="background-color: '. esc_attr($args['background']) .'; color: '. esc_attr($args['color']) .'; border-color: '. esc_attr($args['color']) .';">'. do_shortcode($content) .'</div><!-- / .aye_cta -->';
	}

	/**
	 * Generates a pricing table title, containing the title and the price. 
	 * Should be used inside [aye_column]
	 */
	static function aye_pricing_title($atts) {
		$args = shortcode_atts( array(
	        "title"          => '',
	        "price"			 => ''
	    ), $atts );

	    return '<div class="aye_pricing_title"><span class="title">'. $args['title'] .'</span><span class="price">'. $args['price'] .'</span></div><!-- / .aye_pricing_title -->';
	}

	/**
	 * Generates a pricing row, like a feature the current package offers.
	 * Should be used inside [aye_column]
	 */
	static function aye_pricing_row($atts) {
		$args = shortcode_atts( array(
	        "content"        => '',
	        "icon"			 => '',
	        'set'			 => 'fontawesome'
	    ), $atts );

	    // Require Icon
	    if(!empty($args['icon'])) {
	    	$icon = $this->helpers->getIcon($args['set'], $args['icon']);
		}

		return '<div class="aye_pricing_row">'. (isset($icon) ? $icon : '') .' '. $args['content'] .'</div>';
	}

	/**
	 * Generates a progress bar, you cana also add an icon and a label.
	 */
	static function aye_progress_bar($atts) {
		$args = shortcode_atts( array(
	        "percent"        => 0,
	        "icon"			 => '',
	        "set"			 => 'fontawesome',
	        "label"			 => ''
	    ), $atts );

		$return = '<div class="aye_progress_bar"><div class="loading" style="width: '. esc_attr($args['percent']) .'%;"></div><!-- / .loading -->';

		// Require Icon
		if(!empty($args['icon'])) {
			$return .= $this->helpers->getIcon($args['set'], $args['icon']);
		}

		if(!empty($args['label'])) {
			$return .= '<span>' . $args['label'] . '</span>';
		}

		$return .= '</div>';

		return $return;
	}

	/**
	 * Generates an alert message box. 
	 * Four situation are already hardcoded: error, warning, info, success
	 */
	static function aye_message_box($atts) {
		$args = shortcode_atts( array(
	        "type"			 => '',
	        "text"			 => '',
	        "icon"			 => '',
	        "set"			 => 'fontawesome',
	        "color"			 => '',
	        "background"	 => ''
	    ), $atts );

    	// Set defaults
	    $icon = ( $args['icon'] ) ? $this->helpers->getIcon($args['set'], $args['icon']) : '';
	    $background = ( $args['background'] ) ? $args['background'] : '#DDD';
	    $color = ( $args['color'] ) ? $args['color'] : '';

	    // Set background and icon based on type
    	if("error" == $args['type']) {
    		$background = '#FF6347';
    		$color = '#FFF';
    		$icon = $this->helpers->getIcon($args['set'], 'ban');
    	} elseif("warning" == $args['type']) {
    		$background = '#FF8E47';
    		$color = '#FFF';
    		$icon = $this->helpers->getIcon($args['set'], 'exclamation-triangle');
    	} elseif("info" == $args['type']) {
    		$background = '#007acc';
    		$color = '#FFF';
    		$icon = $this->helpers->getIcon($args['set'], 'info-circle');
    	} elseif("success" == $args['type']) {
    		$background = '#1CFF8B';
    		$color = '#FFF';
    		$icon = $this->helpers->getIcon($args['set'], 'check');
    	}

    	$return = '<div class="aye_message_box '. $args['type'] .'" style="color: '. esc_attr($color) .'; background-color: '. esc_attr($background) .';">';

    	if(!empty($args['icon'])) {
    		$return .= $icon;
    	}

    	$return .= $args['text'] . '</div>';

    	return $return;
	}

	/**
	 * Creates a simple inline font-awesome icon
	 */
	static function aye_icon($atts) {
		$args = shortcode_atts( array(
	        "set"			 => 'fontawesome',
	        "icon"			 => '',
	    ), $atts );

		return $this->helpers->getIcon($args['set'], $args['icon']);
	}

	/**
	 * Generates a drop capital
	 */
	static function aye_drop_capital($atts) {
		$args = shortcode_atts( array(
	        "color"			 => '',
	        "letter"			 => '',
	        "font"			 => ''
	    ), $atts );

		if( !empty($args['color']) or !empty($args['font']) ) {
		    $style = ' style="';

		    if(!empty($args['color'])) {
		    	$style .= 'color: '. esc_attr($args['color']) .';';
		    }

		    if(!empty($args['font'])) {
		    	$style .= 'font-family: '. esc_attr($args['font']) .';';
		    }

		    $style .= '" ';
		}

		if(!empty($args['letter'])) {
			return '<span'. $style .' class="aye_drop_capital">'. $args['letter'] .'</span>';
		}
	}

	/**
	 * Generates a blockquote text with special design
	 */
	static function aye_blockquote($atts, $content = "") {
		$args = shortcode_atts( array(
	        "position"			 => 'left',
	        "columns"			 => 'col-md-4',
	        "author"			 => '',
	        'style'			     => 'default'
	    ), $atts );

		if('default' == $args['style']) {
			$return = '<div class="aye_blockquote '. esc_attr($args['columns']) .' col-lg-12 col-sm-12 col-xs-12" style="float: '. esc_attr($args['position']) .';">' . $content;

			if(!empty($args['author'])) {
				$return .= '<span class="author">'. $args['author'] .'</span>';
			}

			$return .= '</div>';
		}

		return $return;
	}

	/**
	 * Generates a text label with custom icon, background color, text color or an arrow available on all sides.
	 */
	static function aye_label($atts) {
		$args = shortcode_atts( array(
	        "icon"			 => '',
	        "set"			 => '',
	        "background"	 => 'tomato',
	        "text"	  		 => 'tomato',
	        "arrow"	 		 => '',
	        "color"			 => 'white'
	    ), $atts );

		// Require assets
	    $this->assets->loadStyle('fontawesome');

		// Build class
	    $class = "aye_label";
	    if(!empty($args['arrow'])) {
	    	$class .= ' ' . $args['arrow'];
	    }
	    
	    // Build Style
	    $style = ' style="' . 
	    	(!empty($args['color']) ? 'color: '. esc_attr($args['color']) .';' : '') . 
	    	(!empty($args['background']) ? 'background-color: '. esc_attr($args['background']) .';' : '') .
	    	((!empty($args['background']) and !empty($args['arrow'])) ? 'border-color: '. esc_attr($args['background']) .';' : '') . '" ';

	    // Build return
	    $return = '<span class="'. $class .'"'. $style .'>';

	    // Add icon
	    if(!empty($args['icon'])) {
	    	$return .= $this->helpers->getIcon($args['set'], $args['icon']);
	    }

	    $return .= esc_html($args['text']) .'</span>';

	    return $return;
	}

	/**
	 * Creates an accordion content slider
	 */
	static function aye_accordion($atts, $content = "") {
		$args = shortcode_atts( array(
	        "title"			 => '',
	        "active"		 => ''
	    ), $atts );

	    if(!empty($args['title'])) {
	    	return '<div class="aye_accordion">
	    		<div class="aye_accordion_title'. (!empty($args['active']) ? ' active' : '') .'">'. $args['title'] .'</div><!-- / .aye_accordion_title -->
	    		<div class="aye_accordion_content"'. (!empty($args['active']) ? ' style="display: block;"' : '') .'>'. do_shortcode($content) .'</div><!-- / .aye_accordion_content -->
	    	</div><!-- / .aye_accordion -->';
	    }
	}
	
	/**
	 * Creates a divider with a "Back to top" link
	 */
	static function aye_divider_gotop($atts) {
		$args = shortcode_atts( array(
	        "border_color"			 => '',
	        "border_height"			 => '',
	        "color"					 => '',
	        "margin"		 		 => ''
	    ), $atts );

	   	// Build style
	   	$style = ' style="' . 
	    	(!empty($args['border_color']) ? 'border-color: '. esc_attr($args['border_color']) .';' : '') . 
	    	(!empty($args['color']) ? 'color: '. esc_attr($args['color']) .';' : '') . 
	    	(!empty($args['border_height']) ? 'border-width: '. esc_attr($args['border_height']) .';' : '') .
	    	(!empty($args['margin']) ? 'margin: '. esc_attr($args['margin']) .' 0;' : '') . '" ';

		return '<div class="aye_divider_gotop"'. $style .'><span>&#8657; '. __('Back to top', 'ayeshort') .'</span></div><!-- / .aye_divider_gotop -->';
	}

	/**
	 * Creates a special headline divider. Use inside of this shortcode an heading tag (h1-h6).
	 * Margins will be defined by the heading style.
	 */
	static function aye_divider_headline($atts, $content = "") {
		$args = shortcode_atts( array(
	        "border_color"			 => '',
	        "color"			    	 => '',
	        "background_color"		 => ''
	    ), $atts );

	    // Build style
	   	$style = ' style="' . 
	    	(!empty($args['border_color']) ? 'border-color: '. esc_attr($args['border_color']) .';' : '') . 
	    	(!empty($args['color']) ? 'color: '. esc_attr($args['color']) .';' : '') . 
	    	(!empty($args['background_color']) ? 'background-color: '. esc_attr($args['background_color']) .';' : '') . '" ';

		return '<div class="aye_divider_headline"'. $style .'><span>'. do_shortcode($content) .'</span></div><!-- / .aye_divider_headline -->';
	}

	/**
	 * Transforms a normal paragraph in a lead paragraph https://en.wikipedia.org/wiki/Lead_paragraph.
	 */
	static function aye_lead_paragraph($atts, $content = "") {
		if(!empty($content)) {
			return '<p class="aye_lead_paragraph">'.$content.'</p>';
		}
	}

	/**
	 * Creates a tooltip on selected element/content.
	 */
	static function aye_tooltip($atts, $content = "") {
		$args = shortcode_atts( array(
	        "text"			 => ''
	    ), $atts );

		if(!empty($args['text'])) {
	    	return '<span class="aye_tooltip" data-tooltip="'. esc_attr($args['text']) .'">'. do_shortcode($content) .'</span>';
		} else {
			return do_shortcode($content);
		}
	}

	/**
	 * Apply the specified font to the selected content. Font is loaded only on page where the shortcode is used.
	 */
	static function aye_google_font($atts, $content = "") {
		$args = shortcode_atts( array(
	        "font"			 => '',
	        "weight"		 => ''
	    ), $atts );

		// Build font query
		$query = 
		(!empty($args['font']) ? str_replace(' ', '+', $args['font']) .':' : '') . $args['weight'] . 
		(in_array('italic', $atts) ? 'i' : '');

		// Build style
		$style = 
				(!empty($args['font']) ? 'font-family: ' . $args['font'] . ';' : '') . 
				(!empty($args['weight']) ? 'font-weight: ' . $args['weight'] . ';' : '') . 
				(in_array('italic', $atts) ? 'font-style: italic;' : '');

		if(!empty($query)) {
			wp_enqueue_style( str_replace(' ', '_', $args['font']),  '//fonts.googleapis.com/css?family=' . $query );
			return '<span style="'. $style .'">'.do_shortcode($content).'</span>';
		}
	}

	/**
	 * Creates a before/after images slider.
	 */
	static function aye_before_after($atts) {
		$args = shortcode_atts( array(
	        "before"			 => '',
	        "after"		 		 => ''
	    ), $atts );

	    if(!empty($args['before']) and !empty($args['after'])) {
	    	return '<div class="aye_before_after">
	    				<div class="after"><img src="'. esc_url($args['after']) .'" /></div>
	    				<div class="before"><img src="'. esc_url($args['before']) .'" /></div>
	    				<div class="border" style="left: 50%;"></div><!-- / .border -->
	    			</div><!-- / .aye_before_after -->';
	    }
	}

	/**
	 * Generates a number counter
	 */
	static function aye_counter($atts) {
		$args = shortcode_atts( array(
	        "from"			 => '0',
	        "to"		 	 => '0',
	        "speed"		     => '',
	        "refresh"		 => ''
	    ), $atts );

		$this->assets->loadScript('countTo');

		return '<span class="aye_counter" data-from="'.$args['from'].'" data-to="'.$args['to'].'"
		'. (!empty($args['speed']) ? 'data-speed="'. $args['speed'] .'"' : '') . '></span><!-- / .aye_counter -->';
	}

}
