<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SchduleMeeting extends CI_Controller {

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
		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/schdulemeeting');
		$this->load->view('User/Partial/footer');
		$this->session_check();

  

//}


	}

	public function cancel()
	{

		$this->session_check();
		$this->load->model('Committee');
		$data['Committies'] = $this->Committee->view_all();

		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/cancelmeeting',$data);
		$this->load->view('User/Partial/footer');
		$this->session_check();

	}



	public function edit()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/editMeeting');
		$this->load->view('User/Partial/footer');
		$this->session_check();

	}

	public function deleteMeeting()
	{
		$this->session_check();
		$this->load->model('Committee');
		$Committies = $this->Committee->view_all();


		if(isset($_POST["meeting_id"])){



				//$meeting_id  = "'class'";
				$meeting_id  =  $_POST["meeting_id"];
                          $query = $this->db->query("SELECT * FROM meeting_logs WHERE id = '".$meeting_id."'" );
                          if($query->num_rows()>0){                          
                          	foreach ($query->result() as $row) {                           
                          			$title = $row->title;
                          			$initiated_time = date('M-d-Y g:ia l', strtotime($row->time));
                          			$description = $row->description;
                          			$commety  =$row->committee_id;
                          			$venue = $row->venue;
                         			$commArray = explode(',', $row->committee_id);                          
                                    $count = count($Committies["records"]);
                                    for($i=0; $i <$count; $i++){
                                 
                                                foreach ($commArray as $comm_Array) {
                                                    if($comm_Array==$Committies["records"][$i]->id ){ 
                                                      $commety = $Committies["records"][$i]->name ; 
                                                    }
                                                }
                                    }
                          $start_time = date('M-d-Y g:ia l', strtotime($row->start_time));
                          $end_time = date('M-d-Y g:ia l', strtotime($row->end_time));                        
                          }
                        }

                  


				$query = $this->db->query("SELECT name,designation,email FROM temporary_engages INNER JOIN users ON temporary_engages.user_id=users.id WHERE temporary_engages.meeting_id = '" . $meeting_id . "'");
				
				 $TableData = "";
    			foreach ($query->result() as $user) {        
        			$TableData .= '<tr><td >' . $user->name . '</td><td >' . $user->designation . '</td></tr>';   
    			}	


				foreach ($query->result() as $user) {
    			//$participants['users']= $row->name." ".$row->email." ".$row->designation;
				 //$participants[] = $user;
				$body = "
            <head><style>
table, th, td {
    border: 1px solid black;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;

}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: #000000 ;
    color: white;
}
tr:hover {background-color: #f5f5f5;}
tr:nth-child(even) {background-color: #f2f2f2;}

.button {
    background-color: #4CAF50; /* Green */
    border: none;
    color: white;
    padding: 15px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    border-radius: 12px;
    font-size: 14px;
    

    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
}
.button:hover {
    
    color: white;
    box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
    opacity: 1;
  right: 0;
}
.button2{
     background-color: #FF6347; 

}
.wrapper {
    text-align: center;
}


</style></head><label>Following Meeting has been cancelled. Below are the Meeting Details:<br>
        <div style='overflow-x:auto;'>
        <h2>Meeting Details</h2>
        <table>
         <thead>
         </thead>
         <tbody>
         <tr>         
            <td 'background-color: #0000CD;'>Title</td>            
            <td>" . $title . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >Initiator Name</td>            
            <td>" . $_SESSION["user-name"]  . "</td>
            </tr>


            <tr>
            <td 'background-color: #0000CD;' >Committee Invited</td>            
            <td>" . $commety . "</td>
            </tr>
            
            
            <tr>
            <td 'background-color: #0000CD;' >Start Time</td>            
            <td>" . $start_time . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;' >End Time</td>            
            <td>" . $end_time . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Description</td>            
            <td>" . $description . "</td>
            </tr>

            <tr>
            <td 'background-color: #0000CD;'>Venue</td>            
            <td>" . $venue . "</td>
            </tr>
            
             
         </tbody>
         </table>
         <br><br>
         <h2>Meeting Participants</h2>
         <table>     
         <thead>
         <tr>       
         <th>Name</th>
         <th>Designation</th>
         
         </tr>
         </thead>
         <tbody>" . $TableData . "</tbody>
         </table></div>

         <div class='wrapper'> 
        </div>";

        	
        	
        	$to = $user->email;
			$subject = $title;								
			$headers = "";			
			$headers.= "From: Siba Smart Planner <info@sibasmartplanner.com> \r\n";
			$headers .= "Reply-To: No Reply <no-reply@sibasmartplanner.com> \r\n" ."X-Mailer: PHP/" . phpversion();
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        
			$send=mail($to,$subject,$body,$headers);
			if($send)
			{
					//echo "mail sent to $to ";
			}
			else
			{	
				//echo " mail could not sent to $to the address ";
			}	


}




				$this->db->delete("temporary_engages", "meeting_id = ".$meeting_id);
				$this->db->delete("meeting_logs", "id = ".$meeting_id);				
				unset($_POST["meeting_id"]);

				echo "<script>alert('Meeting Cancelled Successfully');</script>";
			
		}

		$this->load->view('User/Partial/header');
		$this->load->view('User/SchduleMeeting/schdulemeeting');
		$this->load->view('User/Partial/footer');
		



	}


	public function editConform()
	{
		$this->load->view('User/Partial/header');
		$this->load->view('User/Partial/timedateheader');
		$this->load->view('User/SchduleMeeting/editMeeting2');
		$this->load->view('User/Partial/footer');
		$this->session_check();

	}

	public function setStatus($rowId = null, $status= null,$reason="Not Specified"){
		//echo $rowId ." ". $status;

		if(false){
			$this->load->view('User/InvitationStatus/response');
		}
		else{

			
			if($status=="Accepted"){
				$this->db->where("id", "$rowId");
    			$data = array( 
   					'status' => "$status",
   					'reason' => "-----"
				);
    			$this->db->update("temporary_engages", $data);		
				$this->load->view('User/InvitationStatus/accepted');
			
			}
			else if($status=="Rejected"){
							if($_GET['reason']==""){ $_GET['reason'] 	= "Not Specified";}

				$this->db->where("id", "$rowId");
    			$data = array( 
   					'status' => "$status",
   					'reason' => $_GET['reason']
				);
    			$this->db->update("temporary_engages", $data);
    			

    			//redirect('User/index/monthly');
    			echo "<script>window.history.go(-2);</script>";


			}
			else{
				/*$this->db->where("id", "$rowId");
    			$data = array( 
   					'status' => "Rejected",
   					'reason' => "$reason"
				);
    			$this->db->update("temporary_engages", $data);
				*/

				$row_id['rowId'] = $rowId;
				$this->load->view('User/InvitationStatus/rejected',$row_id);	
			}


			
		}


	}





}
