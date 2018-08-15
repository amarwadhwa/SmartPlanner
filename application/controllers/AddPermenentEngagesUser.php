<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddPermenentEngagesUser extends CI_Controller {

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

	if(!isset($_SESSION["user-type"]) && $_SESSION["user-type"] != "user"){
		redirect("Login");
	}
	}




	public function index()
	{
		if(isset($_POST["addPermEng"]))
		{

			if($_POST["day"]=="daily"){
				if(isset($_POST["editCheck"]) && ($_POST["editCheck"]=="edited") ){
  						
  						$Engage_Id  = "'".$_POST["Engage_Id"]."'";   
						$this->db->delete("permanent_engages", "id = ".$Engage_Id);
  					}


				$startTime =  strtotime("2000-01-01 ".$_POST["start_timePerm"]);
				$start_timestamp =  date('Y-m-d H:i:s', $startTime);
				$endTime = strtotime("2000-01-01 ". $_POST["end_timePerm"]);
				$end_timestamp = date('Y-m-d H:i:s', $endTime); 			
			
					$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Monday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Tuesday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Wednesday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

 					$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Thursday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data); 

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Friday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Saturday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Sunday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);


			echo "<script> alert('Engage added successfully'); </script>";
			}
			else if($_POST["day"]=="mon-sat"){
					if(isset($_POST["editCheck"]) && ($_POST["editCheck"]=="edited") ){
  						
  						$Engage_Id  = "'".$_POST["Engage_Id"]."'";   
						$this->db->delete("permanent_engages", "id = ".$Engage_Id);
  					}


				$startTime =  strtotime("2000-01-01 ".$_POST["start_timePerm"]);
				$start_timestamp =  date('Y-m-d H:i:s', $startTime);
				$endTime = strtotime("2000-01-01 ". $_POST["end_timePerm"]);
				$end_timestamp = date('Y-m-d H:i:s', $endTime); 			
			
					$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Monday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Tuesday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Wednesday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

 					$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Thursday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data); 

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Friday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

    				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"Saturday",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);


			echo "<script> alert('Engage added successfully'); </script>";
			}

			else if($_POST["day"]=="selectDay"){

					if(isset($_POST["editCheck"]) && ($_POST["editCheck"]=="edited") ){
  						
  						$Engage_Id  = "'".$_POST["Engage_Id"]."'";   
						$this->db->delete("permanent_engages", "id = ".$Engage_Id);

  						
  					}




				$startTime =  strtotime("2000-01-01 ".$_POST["start_timePerm"]);
				$start_timestamp =  date('Y-m-d H:i:s', $startTime);
				$endTime = strtotime("2000-01-01 ". $_POST["end_timePerm"]);
				$end_timestamp = date('Y-m-d H:i:s', $endTime);
				$day = $_POST["particularDay"];


				$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionPerm"],
   					'day'=>"$day",
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("permanent_engages", $data);

			echo "<script> alert('Engage added successfully'); </script>";
			}

		}

		else if(isset($_POST["addTempEng"])) {

				$start_time =  strtotime($_POST["start_dateTemp"] . " ". $_POST["start_timeTemp"]);
				$start_timestamp =  date('Y-m-d H:i:s', $start_time);
				$end_time =  strtotime($_POST["start_dateTemp"] . " ". $_POST["end_timeTemp"]);
				$end_timestamp =  date('Y-m-d H:i:s', $end_time);
			
			
					$data = array(
					'user_id'=>$_SESSION["id"],
   					'description'=>$_POST["descriptionTemp"],
   					'start_time'=>"$start_timestamp",
   					'end_time'=>"$end_timestamp");
    				$this->db->set($data); 
    				$this->db->insert("temporary_engages", $data);


			echo "<script> alert('Engage added successfully'); </script>";
		} 

		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/PermanentEngages/AddPermanentEngages');
		$this->load->view('User/Partial/footer');
	}



	public function cancel()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/Engages/cancelEngage');
		$this->load->view('User/Partial/footer');
	}


	public function removeEngage()
	{


	if(isset($_POST["engage_id"])){

				//$meeting_id  = "'class'";
				$engage_id  =  $_POST["engage_id"];   
				$this->db->delete("permanent_engages", "id = ".$engage_id);
				//$this->db->delete("meeting_logs", "id = ".$meeting_id);				
				unset($_POST["engage_id"]);
			
			
		}
		

		$this->load->view('User/Partial/header');
		$this->load->view('User/Engages/PermanentEngages');
		$this->load->view('User/Partial/footer');
		$this->session_check();
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
