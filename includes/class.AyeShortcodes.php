<?php

namespace Aye\Shortcodes;

class Shortcodes {

	function __construct() {
		add_action( 'init', array( $this, 'loadAssets') );

	}

	public function loadAssets() {
		wp_enqueue_style( 'ayeshortcodes', PLUGIN_URL . 'assets/css/main.min.css' );
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
	    ), $atts );

	    $class  = '';
		$class .= ( $args['lg'] )                                      ? ' col-lg-' . $args['lg'] : '';
		$class .= ( $args['md'] )                                      ? ' col-md-' . $args['md'] : '';
		$class .= ( $args['sm'] )                                      ? ' col-sm-' . $args['sm'] : '';
		$class .= ( $args['xs'] )                                      ? ' col-xs-' . $args['xs'] : '';
		$class .= ( $args['pull_lg']   || $args['pull_lg'] === "0" )   ? ' col-lg-pull-' . $args['pull_lg'] : '';
		$class .= ( $args['pull_md']   || $args['pull_md'] === "0" )   ? ' col-md-pull-' . $args['pull_md'] : '';
		$class .= ( $args['pull_sm']   || $args['pull_sm'] === "0" )   ? ' col-sm-pull-' . $args['pull_sm'] : '';
		$class .= ( $args['pull_xs']   || $args['pull_xs'] === "0" )   ? ' col-xs-pull-' . $args['pull_xs'] : '';
		$class .= ( $args['push_lg']   || $args['push_lg'] === "0" )   ? ' col-lg-push-' . $args['push_lg'] : '';
		$class .= ( $args['push_md']   || $args['push_md'] === "0" )   ? ' col-md-push-' . $args['push_md'] : '';
		$class .= ( $args['push_sm']   || $args['push_sm'] === "0" )   ? ' col-sm-push-' . $args['push_sm'] : '';
		$class .= ( $args['push_xs']   || $args['push_xs'] === "0" )   ? ' col-xs-push-' . $args['push_xs'] : '';
		$class .= ( $args['offset_lg'] || $args['offset_lg'] === "0" ) ? ' col-lg-offset-' . $args['offset_lg'] : '';
		$class .= ( $args['offset_md'] || $args['offset_md'] === "0" ) ? ' col-md-offset-' . $args['offset_md'] : '';
		$class .= ( $args['offset_sm'] || $args['offset_sm'] === "0" ) ? ' col-sm-offset-' . $args['offset_sm'] : '';
		$class .= ( $args['offset_xs'] || $args['offset_xs'] === "0" ) ? ' col-xs-offset-' . $args['offset_xs'] : '';

		return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
	}
}