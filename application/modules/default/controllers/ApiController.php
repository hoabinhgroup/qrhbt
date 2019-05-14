<?php 
class ApiController extends Louis_Controller_Action{ 
	

	public function init(){
		parent::init();	
      }
      
	public function indexAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		
		$data = json_decode(file_get_contents("php://input"));
		$userId = $data->userId;
		$mdlEvents = new Model_Events();
		$events = $mdlEvents->get_details(
			array('user_id' => $userId)
		);
		
		$eventFormats = array();
		foreach($events as $event):
		$date = explode('/', $event['begindate']);
		$dateString = strtotime($date[1].'/'.$date[0].'/'.$date[2]);
		$eventFormats[] = array(
			'id' => $event['id'],
			'nd' => date("l, j M, Y", $dateString),
			'name' => $event['eventname'],
			'venue' => $event['venue'],
			'address' => $event['address'],
			'day' => date("j", $dateString),
			'month' => date("M", $dateString),
		);
		endforeach;
		$this->_helper->json($eventFormats);
	}
	
	public function inviteeAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		
		$data = json_decode(file_get_contents("php://input"));
		$event_id = $data->event_id;
		$mdlInvitee = new Model_Invitee();
		$invites = $mdlInvitee->get_details(array(
			'fk_event' => $event_id
		));
		
		$invitee = array();
		if(count($invites) > 0):
			foreach($invites as $invite):
		$invitee[] = array(
			'id' => $invite['id'],
			'title' => $invite['title'],
			'name' => $invite['fullname'],
			'phone' => $invite['phone'],
			'email' => $invite['email'],
			'checkedIn' => $invite['checkedIn'],
			'registered' => $invite['registered'],
			'paid' => $invite['paid'],
			'print' => $invite['print']
		);
			endforeach;
		endif;
		$this->_helper->json($invitee);
	}

	
	public function testAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		
		//$jwt = new Louis_JWT();
		$token = array();
		$token["id"] = 999;
		$token["hoten"] = "Cao Minh Tuấn";
		$token["email"] = "louis.standbyme@gmail.com";
		
		$jsonWebToken = Louis_JWT::encode($token, "HOI_LAM_GI");
		
		$this->_helper->json(array("token",$jsonWebToken)); 
		
			
	}
	
	
	
	function loginAction(){
		$this->_helper->viewRenderer->setNoRender(true);
		 $this->_helper->layout->disableLayout();
		 
		 $data = json_decode(file_get_contents("php://input"));
		 //$user = $this->_request->getParam("USERNAME", 0);
		 //$pass = md5($this->_request->getParam("PASSWORD", 0));
		// $this->_helper->json($data);
		 $user = $data->user;
		 $password = md5($data->password);
		 //$this->_helper->json(array($user, $password));
		 $mdlUser = new User_Model_User();
		 $auth = $mdlUser->get_one_where(array("username" => $user, "password" => $password));
		 if($auth){
			 $auth = $auth->toArray();
			 $token["id"] = $auth["id"];
			 $token["username"] = $auth["username"];
			 $token["first_name"] = $auth["first_name"];
			 $token["last_name"] = $auth["last_name"];
			 $token["email"] = $auth["email"];
			 
			 $jsonWebToken = Louis_JWT::encode($token, "HOI_LAM_GI");
			 $this->_helper->json(array("token" => $jsonWebToken)); 
		 }else{
			 //login sai
			  $this->_helper->json(array("token" => "ERROR"));
		 }
		 
	}
	
	function mannualAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		 
		$data = json_decode(file_get_contents("php://input"));
		$id = $data->id;
		$mdlInvitee = new Model_Invitee();
		$updated = $mdlInvitee->update_where(array(
			'checkedIn' => 1
		), array('id' => $id));
		
		$status = $mdlInvitee->get_one_where(array('id' => $id));
		if($status){
		$this->_helper->json(array("success" => true,"data" => $status->toArray())); 
		}else{
		$this->_helper->json(array("success" => false, "data" => "ERROR TICKET!!!"));	
		}
	}
	
	function uncheckAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		 
		$data = json_decode(file_get_contents("php://input"));
		$id = $data->id;
		$mdlInvitee = new Model_Invitee();
		$updated = $mdlInvitee->update_where(array(
			'checkedIn' => 0
		), array('id' => $id));
		
		$status = $mdlInvitee->get_one_where(array('id' => $id));
		if($status){
		$this->_helper->json(array("success" => true,"data" => $status->toArray())); 
		}else{
		$this->_helper->json(array("success" => false, "data" => "ERROR TICKET!!!"));	
		}
	}
	
	function checkinAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		 
		$data = json_decode(file_get_contents("php://input"));
		$code = $data->code;
		$mdlStaff = new Model_Invitee();
		$updated = $mdlStaff->update_where(array(
			'checkedIn' => 1
		), array('code' => $code));
		
		$status = $mdlStaff->get_one_where(array('code' => $code));
		if($status){
		$this->_helper->json(array("success" => true,"data" => $status->toArray())); 
		}else{
		$this->_helper->json(array("success" => false, "data" => "ERROR TICKET!!!"));	
		}
	}
	
	function printAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		 
		$data = json_decode(file_get_contents("php://input"));
		$code = $data->code;
		$mdlStaff = new Model_Invitee();
		$updated = $mdlStaff->update_where(array(
			'print' => 1
		), array('code' => $code));
		
		$status = $mdlStaff->get_one_where(array('code' => $code));
		if($status){
		$this->_helper->json(array("success" => true,"data" => $status->toArray())); 
		}else{
		$this->_helper->json(array("success" => false, "data" => "ERROR PRINT TICKET!!!"));	
		}

	}
	
	function statusAction()
	{
		$this->_helper->viewRenderer->setNoRender(true);
		$this->_helper->layout->disableLayout();
		$data = json_decode(file_get_contents("php://input"));
		$event_id = $data->event_id;
		$registered = 0;
		$checkedIn = 0;
		$paid = 0;
		$mdlInvitee = new Model_Invitee();
		$registered = $mdlInvitee->getStatus(array('registered' => true, 'event_id' => $event_id));
		
		$checkedIn = $mdlInvitee->getStatus(array('checkedIn' => true, 'event_id' => $event_id));
		$paid = $mdlInvitee->getStatus(array('paid' => true, 'event_id' => $event_id));
		
		$status = array(
			'registered' => $registered,
			'checkedIn' => $checkedIn,
			'paid' => $paid
		);
		
		$this->_helper->json(array('success' => true, 'data' => $status));
	}
	
	function test2Action(){
		require_once(APPLICATION_PATH . '/../library/PHPExcel.php');	
		 $this->_helper->viewRenderer->setNoRender(true);
		 $this->_helper->layout->disableLayout();
		 $objPHPExcel = PHPExcel_IOFactory::load(APPLICATION_PATH . '/../public/files/Vsem2019.xls');
		 		  $provinceSheet = $objPHPExcel->setActiveSheetIndex(0);
		  $worksheet = $objPHPExcel->getActiveSheet();
		  $rows = [];
		  foreach ($worksheet->getRowIterator() AS $row) {
		  $cellIterator = $row->getCellIterator();
		  $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
		  $cells = [];
		  foreach ($cellIterator as $cell) {
		  $cells[] = $cell->getValue();

    		}
			$rows[] = $cells;
			unset($rows[0]);
			}
		echo "<pre>";
		print_r($rows);
		echo "</pre>";	

	}
}