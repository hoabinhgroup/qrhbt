<?php 
class AdminEmailtemplateController extends Louis_Controller_Action
{ 	
		public function init()
		{
			 parent::init();
			 $this->_rec = new Model_Emailtemplate();
			 $this->view->headScript()->appendFile('http://code.jquery.com/jquery-1.9.1.js');
			 
		}
		
		public function indexAction(){
			$result = $this->_rec->get_details();
			$this->view->products = $result;
		}
		
		public function createAction()
		{
            $this->view->headScript()->appendFile('http://cdn.ckeditor.com/4.11.4/full/ckeditor.js');
            //$this->view->headScript()->appendFile('/public/scripts/ckeditor/ckeditor.js');
		//	$this->view->id = $this->_request->getParam('hotel');
			//$productForm->setAction('/admin/defaulthotel/create');
			//$this->view->form = $productForm;
		}
	
	
		public function editAction()
		{
            $this->view->headScript()->appendFile('http://cdn.ckeditor.com/4.11.4/full/ckeditor.js');
            $id = $this->_request->getParam('id');
            $options = array();
            $emailtemp=new Model_Emailtemplate();
            $options = array(
                'id' => $id
            );
            $email=$emailtemp->get_one_where($options);
            $this->view->id = $email->id;
            $this->view->title = $email->title;
            $this->view->contents = $email->contents;
		}

	public function create2Action(){				
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();
			
			
			$emailtemp=new Model_Emailtemplate();
			$params = $this->_request->getParams();	
		  /*
		   Zend_Debug::dump($params);
		 die;*/


		   $data = array(
				'title' =>  $params['txtTieude'],
				  'contents' =>  $params['txtNoidung'],
				  'fk_event' =>  $_SESSION["eventid"],
				  'create_date' =>  strtotime(date("m/d/Y H:i:s")),
				  'status' =>  0
				);

			$id =  $emailtemp->save($data);
		   if($id){

			   $this->_redirect("/admin/emailtemplate/");
		   }

	}
		public function saveAction(){
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();


            $emailtemp =new Model_Emailtemplate();
			$params = $this->_request->getParams();	
		  
		  $data = array(
              'title' =>  $params['txtTieude'],
              'contents' =>  $params['txtNoidung']
				);
		  
		   $id=$emailtemp->update_where(
				$data,
				array('id' => $params['txtID'])
				
		   );
		   if($id){
			   $this->_redirect("/admin/emailtemplate");
		   }
		}
		
	
	public function deleteAction()
	{
			$this->_helper->viewRenderer->setNoRender(true);
			$this->_helper->layout->disableLayout();
			$id = $this->_request->getParam('id');
			
			$this->_rec->delete_where(array('id' => $id));
			return $this->_redirect('/admin/emailtemplate');
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