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
		wp_register_style( 'fontawesome', PLUGIN_URL . 'assets/libs/font-awesome/css/font-awesome.min.css' );
	}

	// Temporary
	public function loadAssets() {
		wp_enqueue_style( 'bootstrap', PLUGIN_URL . 'assets/css/main.min.css' );
	}

	/**
	 * Use this method to load an style asset on shortcodes methods.
	 */
	public function loadStyle($asset) {
		if(!in_array($asset, $this->styles_assets)) {
			wp_enqueue_style($asset);
		}
	}

	/**
	 * Use this method to load an style asset on shortcodes methods.
	 */
	public function loadScript($asset) {
		if(!in_array($asset, $this->scripts_assets)) {
			wp_enqueue_script($asset);
		}
	}

}