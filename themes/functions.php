<?php
/**
 * Helpers for theming, available for all themes in their template files and functions.php.
 * This file is included right before the themes own functions.php
 */

/**
 * Print debuginformation from the framework.
 */
function get_debug()
{
		$my = CMolly::Instance();
		$html = "<h2>Debuginformation</h2><hr><p>The content of the config array:</p><pre>" . htmlentities(print_r($my->config, true)) . "</pre>";
		$html .= "<hr><p>The content of the data array:</p><pre>" . htmlentities(print_r($my->data, true)) . "</pre>";
		$html .= "<hr><p>The content of the request array:</p><pre>" . htmlentities(print_r($my->request, true)) . "</pre>";
		return $html;
}
 
/**
 * Prepend the base_url.
 */
function base_url($url)
{
		return $my->request->base_url . trim($url, '/');
}


/**
 * Return the current url.
 */
function current_url()
{
		return $my->request->current_url;
}
