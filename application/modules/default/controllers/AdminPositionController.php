<?php 
class AdminPositionController extends Louis_Controller_Action
{ 	
		public function init()
		{
			 parent::init();
			 $this->_rec = new Model_Position();
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
            $mdlPosition=new Model_Position();
            $options = array(
                'id' => $id
            );
            $position=$mdlPosition->get_one_where($options);
            $this->view->id = $position->id;
            $this->view->name = $position->name;
            $this->view->notes = $position->notes;
            $this->view->orders = $position->orders;
		}
	public function create2Action(){				
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();
			
			$position=new Model_Position();
			$params = $this->_request->getParams();	
		  //Zend_Debug::dump($params);
		 //die;
		  $data = array(
				'name' =>  $params['txtTenchucvu'],
                'orders' =>  $params['txtThutu'],
				'notes' =>  $params['txtGhichu'],
				'create_date' =>  strtotime(date("m/d/Y H:i:s")),
				'deleted' =>  0,
				'status' =>  0
				);
		  
			$id =  $position->save($data);
		   if($id){
			  
			   $this->_redirect("/admin/position/");
		   }
		
	}
		public function saveAction(){
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();

            $position=new Model_Position();
            $params = $this->_request->getParams();

            $data = array(
                'name' => $params['txtTenchucvu'],
                'orders' => $params['txtThutu'],
                'notes' => $params['txtGhichu']
            );

            $id=$position->update_where(
                $data,
                array('id' => $params['hdID'])

            );
            if($id){
                $this->_redirect("/admin/position");
            }
		}
		
	
	public function deleteAction()
	{
			$this->_helper->viewRenderer->setNoRender(true);
			$this->_helper->layout->disableLayout();
			$id = $this->_request->getParam('id');
			
			$this->_rec->delete_where(array('id' => $id));
			return $this->_redirect('/admin/position');
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