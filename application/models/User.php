<?php 
   Class User extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
	
	
	 public function search($id)
	{

		
		$this->db->select('*');
    	$this->db->from('users');
    	//$this->db->or_where('users.name', $name);
    	$this->db->where('users.id', $id);
    	$query = $this->db->get();    
    	if($query->num_rows() > 0){
    		return true ;
    		//$data['records'] = $query->result(); 
   			//print_r($data);

   		}
   		else {
   			return false;
   		}
	}
	
	 public function view_all()
	{
	
		$query = $this->db->get("users"); 
        $data['records'] = $query->result(); 
      	return $data;
      	

	}
	public function insert_data($data){
		$this->db->insert("users" ,$data);
	}
	
	public function save($name,$email,$id,$commitee_id,$designation,$password)
	{
		$data = array(
		'id' => "$id",
		'password' => "$password", 
   		'name' => "$name", 
        'designation' => "$designation",
        'commitee_id' => "$commitee_id",
        'email' => "$email"
		); 
		$this->db->insert("users", $data);	
	}
	

	public function changePassword($newPass,$userId)
	{
	
			
		 


	

	}




	
	public function update($id,$name,$email,$Committee,$designation,$password)
	{
		$data = array( 
    		'name'      => $name , 
    		'password' => $password, 
    		'designation'=> $designation,
    		'commitee_id'=> $Committee,
    		'email'=> $email
		);

		$this->db->where('id', $id);

		$this->db->update('users', $data);

		return true;

	}
	  
	  
	  public function edit($user_id)
	{
		//$this->db->where('person_id', $customer_id);

		//return $this->db->update('customers', array('deleted' => 1));
	}
	
	
	public function login($username, $password)
	{
	//	$query = $this->db->get_where('employees', array('username' => $username, 'deleted' => 0), 1);

	//	if($query->num_rows() == 1)
	//	{
	//		$row = $query->row();

			// compare passwords depending on the hash version
	//		if ($row->hash_version == 1 && $row->password == md5($password))
	//		{
	//			$this->db->where('person_id', $row->person_id);
	//			$this->session->set_userdata('person_id', $row->person_id);
	//			$password_hash = password_hash($password, PASSWORD_DEFAULT);
//
	//			return $this->db->update('employees', array('hash_version' => 2, 'password' => $password_hash));
	//		}
	//		else if ($row->hash_version == 2 && password_verify($password, $row->password))
	//		{
	//			$this->session->set_userdata('person_id', $row->person_id);

//				return TRUE;
	//		}

	
		
		

		//return FALSE;
	
	}
	
	public function is_logged_in()
	{
		//return ($this->session->userdata('person_id') != FALSE);
	}
	
	public function logout()
	{
		//$this->session->sess_destroy();

		//redirect('login');
	}
	
		
   } 
?>