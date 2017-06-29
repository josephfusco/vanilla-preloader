<?php
/**
 * Plugin Name:         Vanilla Preloader
 * Plugin URI:          https://github.com/josephfusco/vanilla-preloader/
 * Description:         Fades in content after page is done loading.
 * Version:             1.0
 * Author:              Joseph Fusco
 * Author URI:          https://josephfus.co/
 * License:             GPLv2 or later
 * License URI:         http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:         vanilla-preloader
 * GitHub Plugin URI:   josephfusco/vanilla-preloader
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vanilla_Preloader {

	private $background_color          = '#fff';
	private $animation_duration        = '300ms';
	private $animation_timing_function = 'ease-out';

	function __construct() {
		$this->load_css();
		$this->load_js();
	}

	function load_css() {
		add_action( 'wp_head', array( $this, 'embedded_css' ) );
	}

	function load_js() {
		add_action( 'wp_head', array( $this, 'embedded_js' ) );
	}

	function embedded_css() {
		echo '<style id="vanilla-preloader-style">body{position:relative}body::before{will-change:opacity;position:fixed;content:"";top:0;left:0;height:100%;width:100%;background-color:' . $this->background_color . ';z-index:99999}body.hide-vanilla-preloader::before{animation-name:fadeOut;animation-timing-function:' . $this->animation_timing_function . ';animation-fill-mode:forwards;animation-duration:' . $this->animation_duration . '}@-webkit-keyframes fadeOut{0%{opacity:1}100%{opacity:0;visibility:hidden}}@keyframes fadeOut{0%{opacity:1}100%{opacity:0;visibility:hidden}}</style>';
	}

	function embedded_js() {
		echo '<script id="vanilla-preloader-script">window.onload=function(){document.body.className+=" hide-vanilla-preloader"};</script>';
	}
}

$vanilla_preloader = new Vanilla_Preloader();
