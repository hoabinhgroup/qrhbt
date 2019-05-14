<?php
class Model_Invitee extends Louis_Db_Table_Abstract {
     	protected $_name = 'invitee';
        protected $_primary = 'id';
		
		function get_details($options = array()) {
        $select = $this->_db->select()
        					->from(array('p' => $this->_name));
        										        					
        $id = $this->get_array_value($options, "id");
        if ($id) {
           $select->where('id = ?', $id);
        }

        $fk_event = $this->get_array_value($options, "fk_event");
        if ($fk_event) {
           $select->where('fk_event = ?', $fk_event);
        }

        $keyword = $this->get_array_value($options, "fullname");
        if ($keyword) {
           $select->where('fullname LIKE ?', "%{$keyword}%");
        }




        $select->order('p.id desc');

       	$result = $this->_db->fetchAll($select);	
       	
       	if(count($result) > 0) {
                return $result;
            }else{
                return null;
            }				
    	}

    function get_arrIds($options = array()) {
        $select = $this->_db->select()
            ->from(array('p' => $this->_name));

        $id = $this->get_array_value($options, "id");
        if ($id) {
            $select->where('id IN (?)', $options);
        }

        $select->order('p.id desc');

        $result = $this->_db->fetchAll($select);

        if(count($result) > 0) {
            return $result;
        }else{
            return null;
        }
    }

    public function generateRandomString($length = 25) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    
    function getStatus($options = array()){
	     $select = $this->_db->select()
        					->from(array('p' => $this->_name), array('COUNT(*) as count'));
        										        				

        $registered = $this->get_array_value($options, "registered");
        if ($registered) {
           $select->where('registered = ?', 1);
        }
        
        $checkedIn = $this->get_array_value($options, "checkedIn");
        if ($checkedIn) {
           $select->where('checkedIn = ?', 1);
        }
        
        $paid = $this->get_array_value($options, "paid");
        if ($paid) {
           $select->where('paid = ?', 1);
        }

        $event_id = $this->get_array_value($options, "event_id");
        if ($event_id) {
           $select->where('fk_event = ?', $event_id);
        }


       	$result = $this->_db->fetchAll($select);	
       	
       	if(count($result) > 0) {
                return $result[0]['count'];
            }else{
                return null;
            }
    }

}