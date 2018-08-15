<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ViewUsers extends CI_Controller {

	/**
	 * Index Page for this controller.
	 * Maps to the following URL Hello
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
		
		$this->session_check();
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/ViewUsers/ViewUsers');
		$this->load->view('Admin/Partial/footer');
		
	}		
	

	public function deleteUser()
	{	
		$this->session_check();

		if(isset($_POST["user_id"])){



				//$meeting_id  = "'class'";
				$id = $_POST["user_id"];   
				//$this->db->delete("users", "id = ".$id);
				$this->db->where('id', $id);
				$check = $this->db->delete("users");
				//$this->db->delete("temporary_engages", "meeting_id = ".$meeting_id);

				unset($_POST["user_id"]);

				redirect("ViewUsers");

			
		}
		else{


		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/ViewUsers/DeleteUser');
		$this->load->view('Admin/Partial/footer');

		}
		
	}

	
	
	
}
