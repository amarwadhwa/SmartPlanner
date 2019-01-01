<?php 
   Class Committee extends CI_Model {
	
     Public function __construct() { 
         parent::__construct(); 
     } 
	
	//Amar
    //Committoie Insertion
     public function insert_data($data){
	$this->db->insert("committees" ,$data);
	}




	public function search($name)
	{
	
	$this->db->select('*');
    $this->db->from('committees');
    $this->db->where('committees.name', $name);  
    $query = $this->db->get();    
    if($query->num_rows() > 0){
        $data['records'] = $query->result(); 
    	print_r($data);
    	}

	}




	
	 public function view_all()
	{
		/*
		//$query1 = "SELECT commitee_id FROM users";
		$this->db->select('commitee_id');
    	$this->db->from('users');
    	$this->db->where('users.commitee_id !=', ""); 
    	$query1 = $this->db->get();   
		$data2 =  $query1->result();
		//print_r($data2[2]);
		//$data2 = implode(",",$data2);
		//print($data2);

		//$query = $this->db->get("committees"); 
		$count = 0 ;
		for($i=1; $i<=3; $i++){
        $query = $this->db->get_where("committees",array('id =' => $i)); 
        $dataTest[] = $query->result(); 
      	}
      	$data['records'] = $dataTest[];
      	print_r($data['records']);
      	*/
      	
      	$query = $this->db->get("committees"); 
      	$data['records'] = $query->result(); 
      	return $data;

        
	}
	
	
	
	public function save($name, $des)
	{
		
		$data = array( 
   		'name' => "$name", 
        'description' => "$des" 
		); 
		$this->db->insert("committees", $data);	
	}
	



	public function delete($committee_name)
	{

		$this->db->where("name", "$committee_name");
    	
		$this->db->delete("committees");
		
	}
	   
	  public function update($prev_name,$name="",$des="")
	{
	

			if ($name!="" && $des!="")
		{
			
			$data = array( 
  		 	'name' => "$name", 
  		 	'description' => "$des" 
			);
		}
		elseif ($name!="") {
			
			$data = array( 
  			 'name' => "$name", 
  			);

		}
		elseif ($des!="") {
			
			$data = array( 
  		 	'description' => "$des" 
			);
		}



			$this->db->set($data); 
			$this->db->where("name", "$prev_name"); 
			$this->db->update("committees", $data);
	

	}







	
	

	
   } 
?>