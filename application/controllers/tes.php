<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tes extends CI_Controller {

	public function index()
	{
		$this->load->view('tes');
	}

	public function home()
	{
		$this->load->view('home');
	}
	public function performance()
	{
		$this->load->view('report/performance_tes');
	}

		public function realisasi()
	{
		$this->load->view('report/realisasi_tes');
	}
	public function leads()
	{
		$this->load->view('sales/cust_ind');
	}

}
