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
		// Only if debug is wanted.
		$my = CMolly::Instance();
		if(empty($ly->config['debug']))
		{
				return;
		}
  
		// Get the debug output
		$html = null;
		if(isset($my->config['debug']['db-num-queries']) && $my->config['debug']['db-num-queries'] && isset($my->db))
		{
				$flash = $my->session->GetFlash('database_numQueries');
				$flash = $flash ? "$flash + " : null;
				$html .= "<p>Database made $flash" . $my->db->GetNumQueries() . " queries.</p>";
		}
		if(isset($my->config['debug']['db-queries']) && $my->config['debug']['db-queries'] && isset($my->db))
		{
				$flash = $my->session->GetFlash('database_queries');
				$queries = $my->db->GetQueries();
				if($flash)
				{
						$queries = array_merge($flash, $queries);
				}
				$html .= "<p>Database made the following queries.</p><pre>" . implode('<br/><br/>', $queries) . "</pre>";
		}
		if(isset($my->config['debug']['timer']) && $my->config['debug']['timer'])
		{
				$html .= "<p>Page was loaded in " . round(microtime(true) - $my->timer['first'], 5)*1000 . " msecs.</p>";
		}
		if(isset($my->config['debug']['lydia']) && $my->config['debug']['lydia'])
		{
				$html .= "<hr><h3>Debuginformation</h3><p>The content of CMolly:</p><pre>" . htmlent(print_r($my, true)) . "</pre>";
		}
		if(isset($my->config['debug']['session']) && $my->config['debug']['session'])
		{
				$html .= "<hr><h3>SESSION</h3><p>The content of CMolly->session:</p><pre>" . htmlent(print_r($my->session, true)) . "</pre>";
				$html .= "<p>The content of \$_SESSION:</p><pre>" . htmlent(print_r($_SESSION, true)) . "</pre>";
		}
		return $html;
}

/**
* Get messages stored in flash-session.
*/
function get_messages_from_session()
{
		$messages = CMolly::Instance()->session->GetMessages();
		$html = null;
		if(!empty($messages))
		{
				foreach($messages as $val)
				{
						$valid = array('info', 'notice', 'success', 'warning', 'error', 'alert');
						$class = (in_array($val['type'], $valid)) ? $val['type'] : 'info';
						$html .= "<div class='$class'>{$val['message']}</div>\n";
				}
		}
		return $html;
}

/**
* Prepend the base_url.
*/
function base_url($url=null)
{
		return CMolly::Instance()->request->base_url . trim($url, '/');
}

/**
* Create a url to an internal resource.
*/
function create_url($url=null)
{
		return CMolly::Instance()->request->CreateUrl($url);
}

/**
* Prepend the theme_url, which is the url to the current theme directory.
*/
function theme_url($url)
{
		$my = CMolly::Instance();
		return "{$my->request->base_url}themes/{$my->config['theme']['name']}/{$url}";
}

/**
* Return the current url.
*/
function current_url()
{
		return CMolly::Instance()->request->current_url;
}

/**
* Render all views.
*/
function render_views()
{
		return CMolly::Instance()->views->Render();
}
