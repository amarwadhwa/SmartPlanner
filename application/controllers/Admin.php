<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function session_check(){

	if(!isset($_SESSION["user-type"]) && $_SESSION["user-type"] != "admin"){
		redirect("Login");
	}
	}
	public function index()
	{
		
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/home');
		$this->load->view('Admin/Partial/footer');
		$this->session_check();
	}
	
	public function users()
	{
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Users');
		$this->load->view('Admin/Partial/footer');
	}
	
	public function committies()
	{
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Committies');
		$this->load->view('Admin/Partial/footer');
	}
	public function settings()
	{
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Settings');
		$this->load->view('Admin/Partial/footer');
	}
	
}
