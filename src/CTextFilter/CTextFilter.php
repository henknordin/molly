<?php
use \Michelf\MarkdownExtra;

/**
* Class for handling text filtering and formattin.
*
* @package MollyCore
*/
class CTextFilter
{
		private $purify = null;
		
		/**
		* Constructor
		*/
		public function __construct()
		{
				;
		}
		
		/**
		* Method for filter/formatting text
		* @param $data data to be filtered/formatted.
		* @param $filter filter/format to be applied.
		* @return filtered/formatted data
		*/
		public function Filter($data, $filter)
		{
				foreach ($filter as $value)
				{
						switch($value)
						{
						case 'markdown':
								$data = nl2br($this->markdown($data));
								break;
						case 'make_clickable':
								$data = nl2br($this->make_clickable($data));
								break;
						case 'smartypants':
								$data = nl2br($this->smartyPantsTypographer($data));
								break;
						case 'bbcode':
								$data = nl2br($this->bbcode2html($data));
								break;
						case 'htmlpurify':
								$data = nl2br($this->Purify($data));
								break;
						default:
								$data = nl2br($this->make_clickable($data));
								break;
						}
				}
				
				return $data;
    }
    
    /**
		* Format text according to Markdown syntax.
		*
		* @param $string the text that should be formatted.
		* @return string as the formatted html-text.
		*/
    private function markdown($text)
		{
				require_once(__DIR__ . '/php-markdown/Michelf/Markdown.php');
				require_once(__DIR__ . '/php-markdown/Michelf/MarkdownExtra.php');
				return MarkdownExtra::defaultTransform($text);
		}
    
    /**
    * Make clickable links from URLs in text.
    *
    * @param $text the text that should be formatted.
    * @return string with formatted anchors.
    */
    private function make_clickable($text)
    {
    		return preg_replace_callback(
    				'#\b(?<![href|src]=[\'"])https?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#',
    				create_function(
    						'$matches',
    						'return "<a href=\'{$matches[0]}\'>{$matches[0]}</a>";'
    						),
    						$text
    						);
    }
    
    /**
    * Format text according to PHP SmartyPants Typographer.
    *
    * @param $text the text that should be formatted.
    * @return string as the formatted html-text.
    */
    private function smartyPantsTypographer($text)
    {
    		require_once(__DIR__ . '/php-smartypants/smartypants.php');
    		return SmartyPants($text);
    }
    
    /**
    * Helper, BBCode formatting converting to HTML.
    *
    * @param $text The text to be converted.
    * @return string the formatted text.
    */
    private function bbcode2html($text)
    {
    		$search = array(
    				'/\[b\](.*?)\[\/b\]/is',
    				'/\[i\](.*?)\[\/i\]/is',
    				'/\[u\](.*?)\[\/u\]/is',
    				'/\[img\](https?.*?)\[\/img\]/is',
    				'/\[url\](https?.*?)\[\/url\]/is',
    				'/\[url=(https?.*?)\](.*?)\[\/url\]/is'
    				);   
    		$replace = array(
    				'<strong>$1</strong>',
    				'<em>$1</em>',
    				'<u>$1</u>',
    				'<img src="$1" />',
    				'<a href="$1">$1</a>',
    				'<a href="$1">$2</a>'
    				);     
    		return preg_replace($search, $replace, $text);
    }
    
    /**
    * Purify it. Create an instance of HTMLPurifier if it does not exists.
    *
    * @param $text string the dirty HTML.
    * @return string as the clean HTML.
    */
    private function Purify($text)
    {   
    		
    		if(!isset($purify))
    		{
    				require_once(__DIR__.'/htmlpurifier-4.5.0-standalone/HTMLPurifier.standalone.php');
    				$config = HTMLPurifier_Config::createDefault();
    				$config->set('Cache.DefinitionImpl', null);
    				$purify = new HTMLPurifier($config);
    		}

    		return $purify->purify($text);
    }
}
