<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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

		if(isset($_SESSION["passwordChange"]))
			{
				echo "<script type='text/javascript'> alert('Password successfully changed');  </script>"; 
				session_unset();
				$this->load->view('Login/header');	
				$this->load->view('Login/index');				

			}
		else{
				session_unset();
				$this->load->view('Login/header');	
				$this->load->view('Login/index');			
		}
		
	}
	
	public function check()
	{
	$user = $this ->input->post('email');
	$password = $this ->input->post('password');

		$query = $this->db->query("SELECT * FROM users WHERE id = '".$user."' AND password = '" .$password. "'");

	if($query->num_rows() >0){
	     
	        foreach ($query->result() as $row) {
            $_SESSION["user-type"] = "user";
            $_SESSION["user-name"]= $row->name;
            $_SESSION["gmail"]= $row->email;
            $_SESSION["id"] = $row->id;
            $_SESSION["designation"] = $row->designation;
            $_SESSION["commitee_id"] = $row->commitee_id;
            $_SESSION["password"] = $row->password;

            }
      		redirect("User");

        }  

        elseif($user=='admin@gmail.com' && $password=='admin')
        	        {  
            //declaring session  
            		$_SESSION["user-type"] = "admin";
            		redirect("Admin");
            		
        } 
        else{  
            $data['error'] = 'Your Account is Invalid';  
            $this->load->view('Login/header');	
			$this->load->view('Login/index' ,$data);  
        }    






    }
    public function logout()  
    {  
        //removing session  
        session_unset();
        redirect("Login");  
    }		
	

	
}
