<?php 
   Class Classess extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
	
	
	 public function search($class_name)
	{

		
		$this->db->select('*');
    	$this->db->from('classess');
    	//$this->db->or_where('users.name', $name);
    	$this->db->where('classess.class_name', $class_name);
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
	
	public function save($class_id,$class_name,$added_by)
	{
		$data = array(
		'class_id' => "$class_id",
		'class_name' => "$class_name", 
   		'added_by' => "$added_by"
		); 
		$this->db->insert("classess", $data);	
	}
	

	public function changePassword($newPass,$userId)
	{
	
			
		 


	

	}




	
	public function delete($user_id)
	{
		//$this->db->where('person_id', $customer_id);

		//return $this->db->update('customers', array('deleted' => 1));
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