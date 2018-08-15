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


		$this->session_check();
		$this->load->model("User");
		$this->load->model('Committee');
		$data['Committies'] = $this->Committee->view_all();


		if($this->input->post("edit") == "editing"){


									 $name =  $this->input->post("name");
						 			 $email = $this->input->post("email");
						  			 $id    =  $this->input->post("id");
						             $committee_id = $this->input->post("committie_id");
						             $designation = $this->input->post("designation");
						             $password    = $this->input->post("password");
						             $Committee    = $this->input->post("Committee");
						             $Committee = is_array($Committee) ? implode (",", $Committee) : '';           
						             $this ->User->update($id,$name,$email,$Committee,$designation,$password);
									 echo "<script>alert('User Updated Succesfully');</script>";
									 $this->load->view('Admin/Partial/header');
									 $this->load->view('Admin/Users/Users',$data);
									 $this->load->view('Admin/Partial/footer');




		}


		else if($this->input->post("id") != null && !$this->User->search($this->input->post("id")) ){ 

									 $name =  $this->input->post("name");
						 			 $email = $this->input->post("email");
						  			 $id    =  $this->input->post("id");
						             $committee_id = $this->input->post("committie_id");
						             $designation = $this->input->post("designation");
						             $password    = $this->input->post("password");
						             $Committee    = $this->input->post("Committee");
						             if(is_array($Committee)){ $Committee = implode (",", $Committee); }		           
						             $this ->User->save($name,$email,$id,$Committee,$designation,$password);
									 echo "<script>alert('User Added Succesfully');</script>";
									 

									 $this->load->view('Admin/Partial/header');
									 $this->load->view('Admin/Users/Users',$data);
									 $this->load->view('Admin/Partial/footer');

									 
		
        } 
        
		else if($this->input->post("id") != null && $this->User->search($this->input->post("id")) ){ 

		$formData["name"] = $this->input->post("name");
		$formData["email"] = $this->input->post("email");
		$formData["id"] = $this->input->post("id");
		$formData["committee_id"] = $this->input->post("committie_id");
		$formData["designation"] = $this->input->post("designation");
		$formData["password"] = $this->input->post("password");
		$formData["Committee"] = $this->input->post("Committee");
		$data["error"] = "User already exists!";
		$data["formData"]= $formData;
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Users/Users', $data);
		$this->load->view('Admin/Partial/footer');

		
        } 
        else{ 
      	
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Users/Users',$data);

		$this->load->view('Admin/Partial/footer');

		}
		
	}
	public function register(){


					
	}		
	
	
	
}
