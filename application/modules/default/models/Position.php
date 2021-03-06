<?php
class Model_Position extends Louis_Db_Table_Abstract {
     	protected $_name = 'position';
       protected $_primary = 'id';
		
		function get_details($options = array()) {

       
        $select = $this->_db->select()
        					->from(array('p' => $this->_name));
        										        					
        $id = $this->get_array_value($options, "id");
        if ($id) {
           $select->where('id = ?', $id);
        }        
        
        $select->order('p.orders asc');
               				
       	$result = $this->_db->fetchAll($select);	
       	
       	if(count($result) > 0) {
                return $result;
            }else{
                return null;
            }				
    	}

	
}