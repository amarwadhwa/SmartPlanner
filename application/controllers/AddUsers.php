<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddUsers extends CI_Controller {

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
		
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Users/Users');
		$this->load->view('Admin/Partial/footer');
		$this->session_check();
	}
	public function form_validation(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules("first_name", "First Name" , 'required|alpha');
		$this->form_validation->set_rules("last_name", "Last Name" , 'required|alpha');
		$this->form_validation->set_rules("email", "Email" , 'required');
		$this->form_validation->set_rules("id", "Id" , 'required');
		$this->form_validation->set_rules("committe_id", "Committie Id" , 'required');
		
		$this->form_validation->set_rules("designation", "Designation" , 'required');

		if($this->form_validation->run()){
			//ture

			
			//echo "string";
			$data = array("name" =>$this->input->post("first_name"),
						  "email" =>$this->input->post("email"),
						  "id" =>$this->input->post("id"),
						  "password" =>$this->input->post("last_name"),
						  "commitee_id" =>$this->input->post("committe_id"),
						  "designation" =>$this->input->post("designation"),
						  
						);
			$this->load->model("User");
			if($this -> User -> insert_data($data)){
				echo "ok";
			}
			else{
				echo "not ok";
			}
//			$this -> db ->insert_data('users',$data);
//			redirect("AddUsers/index");
		}
		else{
			//false
			echo "not ok";
			$this->index();

		}	
	}		
	
	
	
}
