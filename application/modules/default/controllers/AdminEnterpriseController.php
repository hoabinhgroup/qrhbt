<?php 
class AdminEnterpriseController extends Louis_Controller_Action
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
			$mdlHotel=new Model_Hotel();
			$mdlAccommodation = new Model_Events();
			$options = array(
				'hotel_id' => $id
			);
			
			$hotel=$mdlHotel->get_one_where($options);
			
			
			$this->view->city_id = $hotel->city_id;
			$this->view->title = $hotel->title;
			$this->view->address = $hotel->address;
			$this->view->website = $hotel->website;
			$this->view->intro = $hotel->intro;
			$this->view->content = $hotel->content;
			$this->view->star_number = $hotel->star_number;
			$this->view->priority = $hotel->priority;
			$this->view->accommodation = $accommodation = $mdlAccommodation->get_details($options);
			//$this->view->country_id = $hotel->country_id;
			
			
			
			
			
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
			
			
			$default_hotel=new Model_Hotel();
			$params = $this->_request->getParams();	
		  
		  $data = array(
				'city_id' => $params['city_id'],
				'title' => $params['title'],
				'address' => $params['address'],
				'website' => $params['website'],
				'intro' => $params['intro'],
				'content' => $params['textarea_content'],
				'star_number' => $params['star_number'],
				'priority' => $params['priority']
				);
		  
		   $id=$default_hotel->update_where(
				$data,
				array('hotel_id' => $params['hotel_id'])
				
		   );
		   if($id){
			  
			   $this->_redirect("/admin/defaulthotel");
		   }
		}
		
	
	public function deleteAction()
	{
			$this->_helper->viewRenderer->setNoRender(true);
			$this->_helper->layout->disableLayout();
			$id = $this->_request->getParam('id');
			
			$this->_rec->delete_where(array('id' => $id));
			return $this->_redirect('/admin/recruitment');
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