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
		public $config;
		public $request;
		public $data;
		public $db;
		public $views;
		public $session;


		/**
		* Constructor
		*/
		protected function __construct()
		{
				$my = CMolly::Instance();
				$this->config = &$my->config;
				$this->request = &$my->request;
				$this->data = &$my->data;
				$this->db = &$my->db;
				$this->views = &$my->views;
				$this->session = &$my->session;
		}

		/**
		* Redirect to another url and store the session
		*/
		protected function RedirectTo($url)
		{
				$my = CMolly::Instance();
				if(isset($my->config['debug']['db-num-queries']) && $my->config['debug']['db-num-queries'] && isset($my->db))
				{
						$this->session->SetFlash('database_numQueries', $this->db->GetNumQueries());
				}
				if(isset($my->config['debug']['db-queries']) && $my->config['debug']['db-queries'] && isset($my->db))
				{
						$this->session->SetFlash('database_queries', $this->db->GetQueries());
				}
				if(isset($my->config['debug']['timer']) && $my->config['debug']['timer'])
				{
						$this->session->SetFlash('timer', $my->timer);
				}
				$this->session->StoreInSession();
				header('Location: ' . $this->request->CreateUrl($url));
		}
}
