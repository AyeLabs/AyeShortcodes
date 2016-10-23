<?php

namespace Aye\Shortcodes;

class Assets {

	/**
	 * These arrays will hold all assets loaded in the theme and defined by theme developer. 
	 * Is recommended to bundle and concat your theme assets and use this method to avoid duplicates. 
	 * All assets are also filtered by WordPress default assets dependecy manager.
	 */
	public $styles_assets = array();
	public $scripts_assets = array();

	function __construct() {
		add_action( 'init', array( $this, 'assetsInit') );
	}

	public function assetsInit() {

		// Load default assets
		add_action( 'wp_enqueue_scripts', array( $this, 'loadAssets') );

		// Register assets
		add_action( 'wp_enqueue_scripts', array( $this, 'registerAssets') );
		$this->styles_assets = apply_filters('aye_shortcodes_style_assets', $this->styles_assets);
		$this->scripts_assets = apply_filters('aye_shortcodes_scripts_assets', $this->scripts_assets);
	}

	/*
	 * Register assets that later will be enqueued by each shortcode
	 */
	public function registerAssets() {
		wp_register_style( 'fontawesome', PLUGIN_URL . 'assets/libs/font-awesome/css/font-awesome.min.css', array('ayeshortcode'), '4.6.3' );


		wp_register_script( 'countTo', PLUGIN_URL . 'assets/libs/jquery-countTo/jquery.countTo.js', array('jquery', 'ayeshortcode'), '1.0', true );
		wp_register_script( 'ayeshortcode', PLUGIN_URL . 'assets/js/scripts.js', array('jquery') );

	}

	// Temporary
	public function loadAssets() {
		wp_enqueue_style( 'ayeshortcode', PLUGIN_URL . 'assets/css/main.min.css' );
		wp_enqueue_script( 'ayeshortcode' );
	}

	/**
	 * Use this method to load more style assets on shortcode methods.
	 */
	public function loadStyles($assets) {
		foreach($assets as $asset) {
			if(!in_array($asset, $this->styles_assets)) {
				wp_enqueue_style($asset);
			}
		}
	}

	/**
	 * Use this method to load a style asset on shortcode methods.
	 */
	public function loadStyle($asset) {
		if(!in_array($asset, $this->styles_assets)) {
			wp_enqueue_style($asset);
		}
	}

	/**
	 * Use this method to load more script assets on shortcode methods.
	 */
	public function loadScripts($assets) {
		foreach($assets as $asset) {
			if(!in_array($asset, $this->scripts_assets)) {
				wp_enqueue_script($asset);
			}
		}
	}

	/**
	 * Use this method to load a script asset on shortcode methods.
	 */
	public function loadScript($asset) {
		if(!in_array($asset, $this->scripts_assets)) {
			wp_enqueue_script($asset);
		}
	}


}