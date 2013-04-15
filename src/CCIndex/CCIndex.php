<?php
/**
* Standard controller layout.
*
* @package MollyCore
*/
class CCIndex implements IController
{
		/**
		 * Implementing interface IController. All controllers must have an index action.
		 */
		 public function Index()
		 {   
		 		 global $my;
		 		 $my->data['title'] = "The Index Controller";
		 		 $my->data['main']  = "<h1>The Index Controller</h1>";
		 }
} 
