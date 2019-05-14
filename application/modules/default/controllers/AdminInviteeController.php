<?php 
class AdminInviteeController extends Louis_Controller_Action
{ 	
		public function init()
		{
			 parent::init();
			 $this->_rec = new Model_Invitee();
			 $this->view->headScript()->appendFile('http://code.jquery.com/jquery-1.9.1.js');
			 
		}
		
		public function indexAction(){
                try{
                    if (isset($_SESSION["eventid"])){
                    $emailtemp=new Model_Emailtemplate();

                    $mdlinvitee_type = new Model_Inviteetype();
                    $keywords = $this->_request->getParam('txtSearch');

                        $evid=$_SESSION["eventid"];
                    $options = array(
                        'fk_event' => $evid
                        // 'fullname' => $keywords
                    );
                   // Zend_Debug::dump($_SESSION["eventid"]);
                   // die;
                    $mdlinvitee = new Model_Invitee();
                    $paginator = Zend_Paginator::factory($mdlinvitee->get_details($options));
                    $paginator->setItemCountPerPage(25);
                    $paginator->setPageRange(3);
                    $currentPage = $this->_request->getParam('page',1);
                    $paginator->setCurrentPageNumber($currentPage);
                    $this->view->data=$paginator;
                    $this->view->invitee_type=$invitee_type = $mdlinvitee_type->get_details();
                    $this->view->items_email=$items_email = $emailtemp->get_details();

                    }else{
                        echo 'Vui lòng đăng nhập lại để tiếp tục sử dụng chức năng này của hệ thống';
                        die();
                    }
                }catch (Exception $e){
                    echo 'Caught exception: ',  $e->getMessage(), "\n";
                }

		}
		
		public function createAction()
		{
            $mdlinvitee_type = new Model_Inviteetype();
            $mdlposition = new Model_Position();
            $mdlinvitee = new Model_Invitee();
            $qrcode=$mdlinvitee->generateRandomString();
            $this->view->invitee_type=$invitee_type = $mdlinvitee_type->get_details();
            $this->view->position=$position = $mdlposition->get_details();
            $this->view->qrcode=$qrcode;
		}
	
	
		public function editAction() 
		{
            $id = $this->_request->getParam('id');
            $options = array();
            $mdlInvitee=new Model_Invitee();
            $mdlposition = new Model_Position();
            $mdlinvitee_type = new Model_Inviteetype();
            $options = array(
                'id' => $id
            );
            $invitee=$mdlInvitee->get_one_where($options);

            $this->view->id = $invitee->id;
            $this->view->firstname = $invitee->firstname;
            $this->view->lastname = $invitee->lastname;
            $this->view->phone = $invitee->phone;
            $this->view->email = $invitee->email;
            $this->view->address = $invitee->address;
            $this->view->coupon = $invitee->coupon;
            $this->view->qrcode = $invitee->code;
            $this->view->fk_inviteetype = $invitee->fk_inviteetype;
            $this->view->fk_event = $invitee->fk_event;
            $this->view->fk_position = $invitee->fk_position;
            $this->view->invitee_type=$invitee_type = $mdlinvitee_type->get_details();
            $this->view->position=$position = $mdlposition->get_details();

		}

	public function create2Action(){				
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();

            $params = $this->_request->getParams();
           // Zend_Debug::dump($params);
            //die;
        $invitee=new Model_Invitee();

        $data = array(
            'title' =>  $params['ddlChucdanh'],
            'firstname' =>  $params['txtHo'],
            'lastname' =>  $params['txtTen'],
            'fullname' =>  $params['txtHo'].' '.$params['txtTen'],
            'phone' =>  $params['txtDidong'],
            'email' =>  $params['txtEmail'],
            'qrcode' =>  $params['txtQr'],
            'address' =>  $params['txtDiachi'],
            'coupon' =>  $params['txtCoupon'],
            'fk_position' =>  $params['ddlChucvu'],
            'fk_inviteetype' =>  $params['ddlLoaiKhachmoi'],
            'fk_event' => $_SESSION["eventid"],
            'create_date' =>  strtotime(date("m/d/Y H:i:s")),
            'deleted' =>  0,
            'status' =>  0
        );

        $id =  $invitee->save($data);
        if($id) {
            $this->_redirect("/admin/invitee/");
        }
	}
		public function saveAction(){
			$this->_helper->viewRenderer->setNoRender(true);
		    $this->_helper->layout->disableLayout();

            $invitee=new Model_Invitee();
            $params = $this->_request->getParams();
            //Zend_Debug::dump($params);
            //die;
            $data = array(
                'title' => $params['ddlChucdanh'],
                'firstname' => $params['txtHo'],
                'lastname' => $params['txtTen'],
                'fullname' =>  $params['txtHo'].' '.$params['txtTen'],
                'phone' => $params['txtDidong'],
                'email' => $params['txtEmail'],
                'address' => $params['txtDiachi'],
                'coupon' => $params['txtCoupon'],
                'fk_position' => $params['ddlChucvu'],
                'fk_inviteetype' => $params['ddlLoaiKhachmoi'],
                'fk_event' => $params['ddlSukien']
            );

            $id=$invitee->update_where(
                $data,
                array('id' => $params['hdID'])
            );
            if($id) {
                $this->_redirect("/admin/invitee");
            }
		}
		
	
	public function deleteAction()
	{
			$this->_helper->viewRenderer->setNoRender(true);
			$this->_helper->layout->disableLayout();
			$id = $this->_request->getParam('id');
			
			$this->_rec->delete_where(array('id' => $id));
			return $this->_redirect('/admin/invitee');
	}

    function essayAction()
    {
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        if($this->getRequest()->isXmlHttpRequest())
        {
            //$this->_helper->json($this->_request->getParams());
            $louismail = new Louis_Mail();
            $html = new Zend_View();
            $mdlEssey = new Model_EssaySubmission();
            $name = $this->_request->getParam("name", 0);
            $gender = $this->_request->getParam("gender", 0);
            $age = $this->_request->getParam("age", 0);
            $ethnics = $this->_request->getParam("ethnics", 0);
            $university = $this->_request->getParam("university", 0);
            $schoolyear = $this->_request->getParam("schoolyear", 0);
            $address = $this->_request->getParam("address", 0);
            $telephone = $this->_request->getParam("telephone", 0);
            $email = $this->_request->getParam("email", 0);
            $content = $this->_request->getParam("content", 0);

            $id = $mdlEssey->save(
                array(
                    'name' => $name,
                    'gender' => $gender,
                    'age' => $age,
                    'ethnics' => $ethnics,
                    'university' => $university,
                    'schoolyear' => $schoolyear,
                    'address' => $address,
                    'telephone' => $telephone,
                    'email' => $email,
                    'content' => $content,
                    'date_created' => time()
                )
            );

            if($id != ''){
                $data = $this->view->partial("index/essay-successfully".$this->_lang.".phtml");

                $html->setScriptPath(APPLICATION_PATH . '/modules/default/views/emails/');

                $bodyText = $html->render('essay-submission-'.$this->_lang.'.phtml');
                $array = array(
                    "author" => ucfirst($name),
                    "name" => $name,
                    "gender" => $gender,
                    "age" => $age,
                    "ethnics" => $ethnics,
                    "university" => $university,
                    "schoolyear" => $schoolyear,
                    "address" => $address,
                    "telephone" => $telephone,
                    "email" => $email
                );

                $template = htmlspecialchars_decode($bodyText, ENT_QUOTES);
                $template = preg_replace_callback("#{([a-z_]+)}#i", function($data) use ($array){return isset($array[$data[1]])?$array[$data[1]]:$data[1];}, $template);

                $from = "mkt@hoabinh-group.com";
                $from_name = 'VMEConference 2018';
                $bcc = array('thienduongmanga@gmail.com','vicky@hoabinhtourist.com');
                $subject = 'Your essay has been submitted to the VMEConference 2018';

                $louismail->send($from,$from_name,$email,$subject,$template,array("bcc" => $bcc) );


                $this->_helper->json(array("success" => true, "message" => "Essay submission successfully!", "data" => $data));
            }else{
                $this->_helper->json(array("success" => true, "message" => "Abstract submission error!"));
            }

        }
    }

    function sendmailAction()
    {
        //require_once(APPLICATION_PATH . '/../library/class.onepay.php');
        $this->_helper->viewRenderer->setNoRender(true);
        $this->_helper->layout->disableLayout();
        //if($this->getRequest()->isXmlHttpRequest())
       // {

        $params = $this->_request->getParams();
       // echo $params;

        $options = array();
        $emailtemp=new Model_Emailtemplate();
        $options = array(
            'id' => $params["tmp_email"]
        );

        //$_pIDs=$params["txtIDs"].'0';
        //$options2=array();
       // $options2 = array(
        //    'id' => $_pIDs
       // );

       // Zend_Debug::dump($options2);
       // die();

        $email=$emailtemp->get_one_where($options);
        $title_mail=$email->title;
        $content_mail = $email->contents;




            $html = new Zend_View();
            $louismail = new Louis_Mail();
            $data = array();
            $amount= "";
            $payment_type = "";
            //$title = $this->_request->getParam("title", 0);
            //$email = $this->_request->getParam("lethanh376@gmail.com", 0);
            $now = time();
           // $expired = strtotime("2018/10/30");
            $success=true;


            //send mail
            $html->setScriptPath(APPLICATION_PATH . '/modules/default/views/emails/');


            $template = htmlspecialchars_decode("bodyText", ENT_QUOTES);//$bodyText
           // $template = preg_replace_callback("#{([a-z_]+)}#i", function($data) use ($array){return isset($array[$data[1]])?$array[$data[1]]:$data[1];}, $template);

            $from = "mkt@hoabinh-group.com";
            $from_name = $title_mail;
            $bcc = array('thanhls1987@gmail.com');
            $subject = $title_mail;
            try{
                //$mdlinvitee = new Model_Invitee();
                //$invitee=$mdlinvitee->get_arrIds($options2);
                // Zend_Debug::dump($invitee);

               // $new_chuoi='';
               // $mang = explode(',',$params["txtIDs"]);
               // $j=0;
               // foreach($mang as $k => $v)
            //    {
              //      if ($v.trim()!=''){

             //       }
             //   }

             //   die;
              //  if (count($invitee) > 0) {
             //       foreach($invitee as $i_invitee)
                //    {
                        //Zend_Debug::dump($params);
                       // echo $i_invitee["email"];
                        /*if ($i_invitee["email"]!=""){
                            $louismail->send($from,$from_name,$i_invitee["email"],$subject,$content_mail, array());//array('bcc' => $bcc )
                        }*/
                //    }
             //   }

                //die;
                $mdlInvitee=new Model_Invitee();
                $new_chuoi='';
                $mang = explode(',',$params["txtIDs"]);
                $j=0;
                foreach($mang as $k => $v)
                {
                    if ($v!=''){
                        $options=array();
                        $options = array(
                            'id' => $v
                        );
                        $invitee=$mdlInvitee->get_one_where($options);
                        $email = $invitee->email;
                        $louismail->send($from,$from_name,$email ,$subject,$content_mail, array());//array('bcc' => $bcc )

                    }
                }
            }catch (Exception $ex){
                $this->_helper->json(array('error' => $ex));
            }
            $this->_helper->json(array('success' => $success));

       // }
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