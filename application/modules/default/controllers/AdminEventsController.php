<?php 
class AdminEventsController extends Louis_Controller_Action
{ 	
		public function init()
		{
			 parent::init();
			 $this->_rec = new Model_Events();
			 $this->view->headScript()->appendFile('http://code.jquery.com/jquery-1.9.1.js');
			 
		}
		
		public function indexAction(){
			$result = $this->_rec->get_details();
			$this->view->products = $result;
		}
		
		public function createAction()
		{			
		//	$this->view->id = $this->_request->getParam('hotel');
			//$productForm->setAction('/admin/defaulthotel/create');
			//$this->view->form = $productForm;
		}
	
	
		public function editAction()
		{
            $id = $this->_request->getParam('id');
            $options = array();
            $mdlEvent=new Model_Events();
            $options = array(
                'id' => $id
            );
            $event=$mdlEvent->get_one_where($options);
            $this->view->id = $event->id;
            $this->view->eventname = $event->eventname;
            $this->view->url = $event->url;
            $this->view->begindate = $event->begindate;
            $this->view->end_date = $event->end_date;
            $this->view->venue = $event->venue;
            $this->view->address = $event->address;
            $this->view->unit_organizational = $event->unit_organizational;
            $this->view->unit_chair = $event->unit_chair;
            $this->view->email = $event->email;
            $this->view->facebook_page = $event->facebook_page;


		}

	public function create2Action(){				
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();
			
			
			$default_events=new Model_Events();
			$params = $this->_request->getParams();	
		  //Zend_Debug::dump($params);
		 //die;
		  $data = array(
				'eventname' =>  $params['txtTensukien'],
				  'url' =>  $params['txtUrl'],
				  'begindate' =>  $params['date'],
				  'end_date' =>  $params['date2'],
				  'venue' =>  $params['txtDiadiemtochuc'],
				  'address' =>  $params['textarea_intro'],
				  'unit_organizational' =>  $params['txtTendonvitochuc'],
				  'unit_chair' =>  $params['txtTendaidien'],
				  'email' =>  $params['txtEmaildvtochuc'],
				  'facebook_page' =>  $params['txtPageFacebook'],
				  'create_date' =>  strtotime(date("m/d/Y H:i:s")),
				  'deleted' =>  0,
				  'status' =>  0
				);
		  
			$id =  $default_events->save($data);
		   if($id){

			   $this->_redirect("/admin/events/");
		   }

	}
		public function saveAction(){
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();
			
			
			$default_events =new Model_Events();
			$params = $this->_request->getParams();	
		  
		  $data = array(
				'eventname' => $params['txtTensukien'],
				'url' => $params['txtUrl'],
				'begindate' => $params['date'],
				'end_date' => $params['date2'],
				'venue' => $params['txtDiadiemtochuc'],
				'address' => $params['textarea_intro'],
				'unit_organizational' => $params['txtTendonvitochuc'],
              'unit_chair' => $params['txtTendaidien'],
              'email' => $params['txtEmaildvtochuc'],
              'facebook_page' => $params['txtPageFacebook']
				);
		  
		   $id=$default_events->update_where(
				$data,
				array('id' => $params['hdID'])
				
		   );
		   if($id){
			   $this->_redirect("/admin/events");
		   }
		}
		
	
	public function deleteAction()
	{
			$this->_helper->viewRenderer->setNoRender(true);
			$this->_helper->layout->disableLayout();
			$id = $this->_request->getParam('id');
			
			$this->_rec->delete_where(array('id' => $id));
			return $this->_redirect('/admin/events');
	}
	
	
		
	public function getProductById($id){
		 $currentProduct = $this->find($id)->current();
		 if ($currentProduct) {
       return $currentProduct;
	   } else {
        return false;
		}
		}
		
	
}