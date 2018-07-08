<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddRoom extends CI_Controller {

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
		$this->load->view('Admin/Room/addRoom');
		$this->load->view('Admin/Partial/footer');
		
	}

	public function add_room()
	{
		$this->session_check();
		$this->load->model('Classess');

		
		



		if($this->input->post("room_name") != null && !$this->Classess->search($this->input->post("room_name")) ){ 
										
									$class_id = rand(111111111,999999999);		
									$class_name =  $this->input->post("room_name");
						 			$added_by = "admin";								
									$this ->Classess->save($class_id,$class_name,$added_by);
									 echo "<script>alert('Room Added Succesfully');</script>";
										 $this->load->view('Admin/Partial/header');
										 $this->load->view('Admin/Room/addRoom');
										 $this->load->view('Admin/Partial/footer');

									 
		
        } 
        
		else if($this->input->post("room_name") != null && $this->Classess->search($this->input->post("room_name")) ){ 
		
		$formData["room_name"] = $this->input->post("room_name");
		$formData["room_description"] = $this->input->post("room_description");
		$data["error"] = "Room already exists!";
		$data["formData"]= $formData;
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Room/addRoom',$data);
		$this->load->view('Admin/Partial/footer');

		
        } 
        else{ 
      	
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Room/addRoom');
		$this->load->view('Admin/Partial/footer');

		}


		



		
		//$data = array("name" =>$this->input->post("committie"),
		//				  "description" =>$this->input->post("committie_description")
						  
		//				);

		//		$this->load->model("Committee");
		//		$this ->Committee->insert_data($data);
		//		echo "Commeety Created Successfuly";
	
		




		
		
	}

	
	
	
}
