<?php
/**
* Holding a instance of CMolly to enable use of $this in subclasses and provide some helpers.
*
* @package MollyCore
*/
class CObject
{
		/**
		* Members
		*/
		protected $my;
		protected $config;
		protected $request;
		protected $data;
		protected $db;
		protected $views;
		protected $session;
		protected $user;

		/**
		* Constructor
		*/
		protected function __construct($my=null)
		{
				if(!$my)
				{
						$my = CMolly::Instance();
				} 
				
				$this->my				= &$my;
				$this->config  	= &$my->config;
				$this->request 	= &$my->request;
				$this->data 		= &$my->data;
				$this->db 			= &$my->db;
				$this->views 		= &$my->views;
				$this->session 	= &$my->session;
				$this->user     = &$my->user;
		}

		/**
		* Wrapper for same method in CMolly. See there for documentation.
		*/
		protected function RedirectTo($urlOrController=null, $method=null, $arguments=null)
		{
				$this->my->RedirectTo($urlOrController, $method, $arguments);
		}
		
		/**
		* Wrapper for same method in CMolly. See there for documentation.
		*/
		protected function RedirectToController($method=null, $arguments=null)
		{
				$this->my->RedirectToController($method, $arguments);
		}

		/**
		* Wrapper for same method in CMolly. See there for documentation.
		*/
		protected function RedirectToControllerMethod($controller=null, $method=null, $arguments=null)
		{
				$this->my->RedirectToControllerMethod($controller, $method, $arguments);
		}
		
		/**
		* Wrapper for same method in CMolly. See there for documentation.
		*/
		protected function AddMessage($type, $message, $alternative=null)
		{
				return $this->my->AddMessage($type, $message, $alternative);
		}

		/**
		* Wrapper for same method in CMolly. See there for documentation.
		*/
		protected function CreateUrl($urlOrController=null, $method=null, $arguments=null)
		{
				return $this->my->CreateUrl($urlOrController, $method, $arguments);
		}
}
