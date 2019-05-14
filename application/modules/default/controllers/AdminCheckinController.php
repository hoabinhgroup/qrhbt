<?php 
class AdminCheckinController extends Louis_Controller_Action
{ 	
		public function init()
		{
			 parent::init();

			 /*
			  $this->_rec = new Model_Events();
			 $this->view->headScript()->appendFile('http://code.jquery.com/jquery-1.9.1.js');
			 */
		}
		
		public function indexAction(){
			/*
			$result = $this->_rec->get_details();
			$this->view->products = $result;
			*/
		}

    public function checkinautoAction(){
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();

        $options = array();
        $options = array(
            'print' => '1'
        );
        $mdlInvitee=new Model_Invitee();
        $invitee=$mdlInvitee->get_one_where($options);

        //Zend_Debug::dump($invitee);
         //die;
        if($invitee!=null){
            $data = array(
                'print' => '2'
            );

            $id=$mdlInvitee->update_where(
                $data,
                array('id' => $invitee['id'])
            );
            if($id){
                $html='';
                $html.='<p style="text-align:center;padding:0px !important;margin:0px !important;font-size: 10px;"><strong>'.$invitee->fullname.'</strong></p>';
                $html.='<p style="text-align:center;padding:0px !important;margin:0px !important;font-size: 10px;">'.$invitee->phone.'</p>';
                $html.='<hr />';
                $html.='<p style="text-align:center;padding:0px !important;margin:0px !important;font-size: 10px;"><b>DELEGATE</b></p>';
                echo $html;
            }
        }
        else{
            echo '0';
        }
    }
    public function checkinqrcodeAction(){
        /*
        $result = $this->_rec->get_details();
        $this->view->products = $result;
        */
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        $params = $this->_request->getParams();
        //Zend_Debug::dump($params);
       // die;
        echo "{\"errCode\":0, \"contactMsg\":\"Hello\"}";
        exit;
    }
}