<?php 
   Class Committee extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
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
		$query = $this->db->get("committees"); 
        $data['records'] = $query->result(); 
      	print_r($data);

        
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
	   
	  public function update($prev_name,$name,$des)
	{
		$data = array( 
  		 'name' => "$name", 
  		 'description' => "$des" 
		); 

			$this->db->set($data); 
			$this->db->where("name", "$prev_name"); 
			$this->db->update("committees", $data);
	

	}
	
	

	
   } 
?>