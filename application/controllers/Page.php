<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function index()
	{
		// print_r(base_url());
		// die();
		// ' . base_url() . '


		$this->load->view('page');
	}
        

}
