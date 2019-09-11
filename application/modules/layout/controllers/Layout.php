<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Layout extends MX_Controller {

	public function header($data = NULL)
	{
		$this->load->view('header', $data);
	}

	public function sidebar()
	{
		$this->load->view('sidebar');
	}

	public function footer()
	{
		$this->load->view('footer');
	}

	public function alert()
	{
		$this->load->view('alert');
	}

}
