<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddCommitties extends CI_Controller {

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
		$this->load->view('Admin/Committies/Committies');
		$this->load->view('Admin/Partial/footer');
		$this->session_check();
	}
	public function register(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules("committie", "Committies" , 'required|alpha');
		$this->form_validation->set_rules("committie_id", "Committies Id" , 'required');
		$this->form_validation->set_rules("committie_description", "Committies Description" , 'required');
		


					
		/*if($this->form_validation->run()==FALSE){
			
		}	
		
		else{*/
		$data = array("name" =>$this->input->post("committie"),
						  "description" =>$this->input->post("committie_description")
						  
						);

				$this->load->model("Committee");
				$this ->Committee->insert_data($data);
				
		echo "<script>alert('Committee Created Successfully')</script>";		
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Committies/Committies');
		$this->load->view('Admin/Partial/footer');			


		
		
		//}			


	}		
	
	
	
	
}
