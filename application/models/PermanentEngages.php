<?php 
   Class PermanentEngages extends CI_Model {
	
      Public function __construct() { 
         parent::__construct(); 
      } 
		
		

	public function view_all()
		
	{

		

	    $query_str = "SELECT * FROM permanent_engages ";
		$query= $this->db->query($query_str);
        $data = $query->result(); 
      	return $data;



//$this->db->select('*');
//$this->db->from('permanent_engages');
    
  //  $query = $this->db->get();    
    //if($query->num_rows() > 0){
      //  $data['records'] = $query->result(); 
    //	print_r($data);
    //	}


	}
	

}
?>