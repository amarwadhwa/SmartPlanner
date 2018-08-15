<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AdminSettings extends CI_Controller {




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
		$this->load->view('Admin/Partial/header');
		$this->load->view('Admin/Settings/Settings');
		$this->load->view('Admin/Partial/footer');
	
	}


public function custom_mail(){
			$to = "karansachrani.cs14@iba-suk.edu.pk";
			$subject = "Testing";
			$body = "<h1>HTML BODY<h1>";					
			$headers = "";			
			$headers.= "From: Siba Smart Planner <info@sibasmartplanner.com> \r\n";
			$headers .= "Reply-To: No Reply <no-reply@sibasmartplanner.com> \r\n" ."X-Mailer: PHP/" . phpversion();
			//$mail->addReplyTo('no-reply@SmartPlanner.com', 'No Reply');
			$headers .= 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";        
			$send=mail($to,$subject,$body,$headers);
			if($send)
			{
					echo "mail sent to $to ";
			}
			else
			{	
				echo " mail could not sent to $to the address ";
			}

}
}
?>