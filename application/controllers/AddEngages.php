<?php
ini_set('max_execution_time', 300);
defined('BASEPATH') OR exit('No direct script access allowed');

class AddEngages extends CI_Controller {

	public function session_check(){

	if(!isset($_SESSION["user-type"]) && $_SESSION["user-type"] != "admin"){
		redirect("Login");
	}
	}
	public function index()
	{	
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/AddEngages/addEngages',array('error' => ' ' ));
		$this->load->view('Admin/Partial/footer');
		$this->session_check();
	}

	public function uploadxml(){
 				$config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'xml';
                $config['max_size']             = 1000;
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('Admin/Partial/header');
                        $this->load->view('Admin/AddEngages/addEngages', $error);
                        $this->load->view('Admin/Partial/footer');

                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());
						$this->load->view('Admin/Partial/header');
                        $this->load->view('Admin/AddEngages/uploadSuceess', $data);
                        $this->load->view('Admin/Partial/footer');
                }

 	 }
	
	
	
}
?>