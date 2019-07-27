<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    public function __construct()
    {
		parent::__construct();
	}

	public function index()
	{
        // load view admin/overview.php
        $this->load->view("admin/includes/header");
        $this->load->view("admin/includes/js");
        $this->load->view("admin/v_dashboard");
	}
}
