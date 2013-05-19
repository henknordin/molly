<?php
class CNavigation
{
		public function GenerateMenu($menu)
		{
				$items = "a";
				return "<ul class='menu {$menu}'>\n{$items}</ul>\n";
		}
}; 
