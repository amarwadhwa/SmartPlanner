<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_profile extends CI_Controller {

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
	public function index()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/User_profile/user_profile');
		$this->load->view('User/Partial/footer');
	}
	
		public function changePassword()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/User_profile/ChangePassword');
		$this->load->view('User/Partial/footer');

	}

		public function updateProfile()
	{
		
		$this->db->where("id", $_SESSION['id']);
    			
    			$data = array(
    				'name' =>$_POST['Uname'],
   					'designation' => $_POST['designation'],
   					'email' => $_POST['email']
				);



    	$this->db->update("users", $data);		
    	echo "<script>alert('Profile Updated Successfully')</script>";
		$this->load->view('User/Partial/header');
		$this->load->view('User/User_profile/user_profile');
		$this->load->view('User/Partial/footer');

	}




	public function edit()
	{
		$this->load->view('welcome_message');
	}
	public function save()
	{
		$this->load->view('welcome_message');
	}

}
