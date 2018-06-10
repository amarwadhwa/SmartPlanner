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
	public function register(){
		
		//$this->load->library('form_validation');
		//$this->form_validation->set_rules("last_name", "Last Name" , 'required|alpha');
		//$this->form_validation->set_rules("email", "Email" , 'required');
		//$this->form_validation->set_rules("id", "Id" , 'required');
		//$this->form_validation->set_rules("committe_id", "Committie Id" , 'required');
		//$this->form_validation->set_rules("designation", "Designation" , 'required');
		//$this->form_validation->set_rules("password", "Password" , 'required');			
							
                           	$this->load->model("User");
                           	$id    =  $this->input->post("id");
							if($this ->User->search($id))
							{
									 
								echo "User Already Exist";
								
								
								  
				

							}
							else {
									 $name =  $this->input->post("name");
						 			 $email = $this->input->post("email");
						  			 $id    =  $this->input->post("id");
						             $committee_id = $this->input->post("committie_id");
						             $designation = $this->input->post("designation");
						             $password    = $this->input->post("password");
						             $this ->User->save($name,$email,$id,$committee_id,$designation,$password);
									 echo "User Added Succesfully";
									 
							}


					
	}		
	
	
	
}
