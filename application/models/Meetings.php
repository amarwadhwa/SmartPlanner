<?php 
   Class Meetings extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
		
		

	public function initiate($title, $initiater_id, $guest_id, $time , $start_time, $end_time, $description , $status="pending" )
	{
		

		
		$data = array( 
   		'title' => "$title", 
        'status' => "$status",
        'initiater_id' => "$initiater_id", 
		'guest_id' => "$guest_id" ,	
		'time' => "$time", 		
		'start_time' => "$start_time", 		
		'end_time' => "$end_time", 		
		'description' => "$description"); 
		
		$this->db->insert("meeting_logs", $data);	
	}



		//$success = FALSE;

		//Run these queries as a transaction, we want to make sure we do all or nothing
		//$this->db->trans_start();
		
		//if(parent::save($person_data, $customer_id))
		//{
			//if(!$customer_id || !$this->exists($customer_id))
			//{
			//	$customer_data['person_id'] = $person_data['person_id'];
			//	$success = $this->db->insert('customers', $customer_data);
			//}
			//else
			//{
			//	$this->db->where('person_id', $customer_id);
			//	$success = $this->db->update('customers', $customer_data);
			//}
		//}
		
		//$this->db->trans_complete();
		
		//$success &= $this->db->trans_status();

		//return $success;
	
	
	/*public function search($search, $rows = 0, $limit_from = 0, $sort = 'last_name', $order = 'asc')
	{
		//$this->db->from('customers');
		//$this->db->join('people', 'customers.person_id = people.person_id');
		//$this->db->group_start();
			//$this->db->like('first_name', $search);
			//$this->db->or_like('last_name', $search);
			//$this->db->or_like('email', $search);
			//$this->db->or_like('phone_number', $search);
			//$this->db->or_like('account_number', $search);
			//$this->db->or_like('CONCAT(first_name, " ", last_name)', $search);
		//$this->db->group_end();
		//$this->db->where('deleted', 0);
		//$this->db->order_by($sort, $order);

		//if($rows > 0)
		//{
		//	$this->db->limit($rows, $limit_from);
		//}

		//return $this->db->get();	
	}*/
	
	public function view_all()
		
	{

		//$query = $this->db->get("meeting_logs");

	    $query_str= "SELECT title , start_time as start , end_time end FROM meeting_logs ";
		$query= $this->db->query($query_str);
        $data['records'] = $query->result(); 
      	return $data;



	}
	
		/*
	
	public function cancel(&$person_data, &$customer_data, $customer_id = FALSE)
	{
	
	}
	
	public function postpone(&$person_data, &$customer_data, $customer_id = FALSE)
	{
	
	}
	
	public function update(&$person_data, &$customer_data, $customer_id = FALSE)
	{
	
	}
	
	
		
		
		
   } */

}
?>