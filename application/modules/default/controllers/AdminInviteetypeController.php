<?php 
class AdminInviteetypeController extends Louis_Controller_Action
{ 	
		public function init()
		{
			 parent::init();
			 $this->_rec = new Model_Inviteetype();
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
			$mdlInviteetype=new Model_Inviteetype();
			$options = array(
				'id' => $id
			);

			$Inviteetype=$mdlInviteetype->get_one_where($options);

			$this->view->id = $Inviteetype->id;
			$this->view->name = $Inviteetype->name;
			$this->view->notes = $Inviteetype->notes;
			
		}
	public function create2Action(){				
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();
			
			
			$default_inviteetype=new Model_Inviteetype();
			$params = $this->_request->getParams();	
		  //Zend_Debug::dump($params);
		 //die;
		  $data = array(
				  'name' =>  $params['txtTenloaikhachmoi'],
				  'notes' =>  $params['txtGhichu'],
				  'create_date' =>  strtotime(date("m/d/Y H:i:s"))
				);
		  
			$id =  $default_inviteetype->save($data);
		   if($id){
			  
			   $this->_redirect("/admin/inviteetype/");
		   }
		
	}
		public function saveAction(){
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();


			$inviteetype=new Model_Inviteetype();
			$params = $this->_request->getParams();	
		  
		  $data = array(
				'name' => $params['txtTenloaikhachmoi'],
				'txtGhichu' => $params['notes']
				);
		  
		   $id=$inviteetype->update_where(
				$data,
				array('id' => $params['hdID'])
		   );
		   if($id){
			   $this->_redirect("/admin/inviteetype");
		   }
		}
		
	
	public function deleteAction()
	{
			$this->_helper->viewRenderer->setNoRender(true);
			$this->_helper->layout->disableLayout();
			$id = $this->_request->getParam('id');
			
			$this->_rec->delete_where(array('id' => $id));
			return $this->_redirect('/admin/inviteetype');
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