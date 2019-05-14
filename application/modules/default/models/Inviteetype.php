<?php
class Model_Inviteetype extends Louis_Db_Table_Abstract {
     	protected $_name = 'invitee_type';
       protected $_primary = 'id';
		
		function get_details($options = array()) {

       
        $select = $this->_db->select()
        					->from(array('p' => $this->_name));
        										        					
        $id = $this->get_array_value($options, "id");
        if ($id) {
           $select->where('id = ?', $id);
        }        
        
        $select->order('p.id desc');
               				
       	$result = $this->_db->fetchAll($select);	
       	
       	if(count($result) > 0) {
                return $result;
            }else{
                return null;
            }				
    	}

	
}