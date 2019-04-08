<?php 
class IndexController extends Louis_Controller_Action{ 
   
		public function init(){
			parent::init();
      //  $this->view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
       //  Cau hinh multi layout, ko can set trong application.ini
       /*
         $option=array(
        "layout" => "layout",
        "layoutPath" => APPLICATION_PATH."/layouts/scripts/"
      ); */
    //  Zend_Layout::startMvc($option);
      //  $this->view->headTitle("QHOnline - Zend Layout");
        
	// thong tin co ban trong zend view
	$url = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $baseurl=$this->_request->getbaseurl();
  $this->view->doctype();
 $this->view->headTitle("Công ty tổ chức hội nghị hội thảo, Công ty tổ chức Sự kiện chuyên nghiệp, Nhà tổ chức tour du lịch uy tín");
  $this->view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8');
 $this->view->headMeta()->appendName("keywords","Hoabinhgroup, Công ty tổ chức sự kiện, Sự kiện truyền thông Việt Nam, tổ chức hội nghị, tổ chức hội thảo, du lịch MICE, du lich MICE, to chuc hoi thao, tour du lich"); 
  $this->view->headMeta()->offsetSetName("2","description","Tập đoàn ​HoaBinh Group (Convention – Events – Travel) đã khẳng định uy tín của mình là một trong những tập đoàn hàng đầu trong lĩnh vực tổ chức Hội nghị, hội thảo, sự kiện và du lịch tại Việt Nam.");
/* $this->view->headLink()->appendAlternate($url, 'application/rss+xml',
'News Feeds', 'hreflang');*/
 // $this->view->headLink()->appendStylesheet($baseurl."/public/css/style.css");
 // $this->view->headLink()->appendStylesheet($baseurl."/public/css/form.css");
 // $this->view->headLink()->appendStylesheet($baseurl."/public/css/nav.css");
  //$this->view->headScript()->appendFile($baseurl."/public/js/test.js","text/javascript");
 // $this->view->headScript()->offsetSetFile("1",$baseurl."/public/js/test2.js","text/javascrip");
      }
      
    public function indexAction()
    { 
	   // require_once(APPLICATION_PATH . '/../libraries/Mobile_Detect.php');
	   // $this->view->headScript()->appendFile('http://vietnamevents.com/public/templates/vietnamevents/default/js/jquery.bootstrap.newsbox.min.js');
	    $this->view->headScript()->appendFile(TEMPLATE_URL.'/default/js/custom-home.js');
	     $this->view->headLink()->appendStylesheet(TEMPLATE_URL.'/default/css/owl.carousel.min.css');
	     $this->view->headLink()->appendStylesheet(TEMPLATE_URL.'/default/css/owl.theme.default.min.css');
	     $this->view->headLink()->appendStylesheet(TEMPLATE_URL.'/default/css/snow.css');
	    
	    $this->view->headScript()->appendFile(TEMPLATE_URL.'/default/js/owl.carousel.min.js');
	  //  $detect = new Mobile_Detect();
	  //  if ( $detect->isMobile() ) {
		$this->view->headScript()->appendFile(TEMPLATE_URL.'/default/js/scroll-effects.js');
		//}
	 
	    $this->view->headLink()->appendStylesheet('/public/popup/css/slick-modal-min.css');
	    $this->view->headScript()->appendFile('/public/popup/js/jquery.slick-modal.min.js');
	    
	   // $this->view->headScript()->appendFile('/public/js/jquery.happy_new_year.js');
	    $this->view->headScript()->appendFile('/public/js/jquery.snow.js');
	    $module = $this->_request->getModuleName();
	   $this->_helper->translate($this->_lang);
	   	$params = $this->getRequest()->getParams();
	  
	  	if(isset($params['lang']) && $params['lang'] == 'en'){
		   	if($this->_lang != 'en'){
			   	$this->_redirect('/translate/filter/change/en');
		   	}
	   	}elseif(!isset($params['lang']) && $this->_lang == 'en'){
		   	$this->_redirect('/translate/filter/change/en');
	   	}
	   	
	  
	   	
	     $identity = Zend_Auth::getInstance()->getIdentity();
	    
	     
	     $menu_item = new Model_MenuItem();
	     $options = array(
		     'link' => '',
		     'lang' => $this->_lang,
	     );
	     $result = $menu_item->get_one_where($options);
	     
	     $this->view->assign($result->toArray());
	     	   
	   $new = new New_Model_Product();
	   $options_news = array(
		   'image' => 'yes',
		   'content_type' => 'new',
		   'lang' => $this->_lang,
		   'limit' => 4,
		   'status' => 1,
		   'order' => 'p.date desc',
	   );
	   $this->view->news = $news = $new->get_details($options_news);
	   
	   
	   $featured = array(
		  // 'image' => 'yes',
		   'limit' => 5,
		   'status' => 1,
		   'order' => 'p.date desc',
		   'link' => 'tin-khuyen-mai',
		   'lang' => $this->_lang,
	   );
	  
	    $this->view->featured = $feature = $new->get_details($featured);
	
	 
	    /* 
	     if($this->_lang == 'vi'){
		$product = $new->getProductById(25);	
		}elseif($this->_lang == 'en'){
		$product = $new->getProductById(26);	

		}
		
		
		$this->view->assign($product->toArray());
		
		 "SELECT distinct p.* 
					FROM product as p 
					INNER JOIN product_relationships as s 
					ON p.id = s.object_id 
					WHERE p.content_type = 'new' 
					AND p.status = 1 
					AND p.lang='".$lang."' 
					ORDER BY p.date DESC $limit";
		*/
		
		//$listnew = $new->getlistNews($this->_lang, 4);
		$options2 = array(
			'image' => 'Yes',
			'content_type' => 'new',
			'status' => 1,
			'lang' => $this->_lang,
			'order' => 'p.date DESC',
			'limit' => 4,
		);
	 $listnew = $new->get_details($options2);
	 
	  $this->view->result = $listnew;
	  
	  //testimonial
	  	$options = array(
		  	'image' => 'Yes',
	  	);
	     $testimonial = new Model_Testimonial();
	     $row_testimonial = $testimonial->get_details($options);
		 $this->view->testimonial = $row_testimonial;
		 
	  //video
	  $product = new Product_Model_Product();
	  $videos = array(
		  'content_type' => 'video',
		  'status' => 1,
		  'featured' => 1,
		  'limit' => 6,
	  );
	  
	 $this->view->result_video = $result_video = $product->get_details($videos);	
	  /*
		if($this->_lang == 'vi'){
			$this->render('index-vi');
		} else{
			$this->render('index-en');
		}
		
		$product = new Product_Model_Product();
	    $result = $product->featureProducts();

		
   
		$frontendParam=array(
            'lifetime'=>3600,        //thời gian tồn tại của cache, giá trị null nghĩa là thời gian tồn tại vô hạn
            'automatic_serialization'=>'true' //cho phép tự động serialize với các kiểu dữ liệu phức tạp
        );
        $backendParam=array(
            'cache_dir'=>CACHE_DIR    //chỉ định vị trí thư mục cache
        );
        $cache=Zend_Cache::factory('Core','File',$frontendParam,$backendParam);//khởi tạo một đối tượng $cache với cache frontend là Core, cache backend là File cùng các thông số tương ứng
        
        $cache_id='featureProducts';
        
        $cache->save($result,$cache_id);
        $this->view->result = $cache->load($cache_id); 
        */
        
                 // $this->view->promotion = $promotion = $product->promotionProducts();
    }
    
    
     public function test2Action()
    { 
	   // require_once(APPLICATION_PATH . '/../libraries/Mobile_Detect.php');
	   // $this->view->headScript()->appendFile('http://vietnamevents.com/public/templates/vietnamevents/default/js/jquery.bootstrap.newsbox.min.js');
	    $this->view->headScript()->appendFile(TEMPLATE_URL.'/default/js/custom-home.js');
	     $this->view->headLink()->appendStylesheet(TEMPLATE_URL.'/default/css/owl.carousel.min.css');
	     $this->view->headLink()->appendStylesheet(TEMPLATE_URL.'/default/css/owl.theme.default.min.css');
	    
	    $this->view->headScript()->appendFile(TEMPLATE_URL.'/default/js/owl.carousel.min.js');
	  //  $detect = new Mobile_Detect();
	  //  if ( $detect->isMobile() ) {
		$this->view->headScript()->appendFile(TEMPLATE_URL.'/default/js/scroll-effects.js');
		//}
	 
	    $this->view->headLink()->appendStylesheet('/public/popup/css/slick-modal-min.css');
	    $this->view->headScript()->appendFile('/public/popup/js/jquery.slick-modal.min.js');
	    
	   // $this->view->headScript()->appendFile('/public/js/jquery.happy_new_year.js');
	   // $this->view->headScript()->appendFile('/public/js/jquery.snow.js');
	    $module = $this->_request->getModuleName();
	   $this->_helper->translate($this->_lang);
	   	$params = $this->getRequest()->getParams();
	  
	  	if(isset($params['lang']) && $params['lang'] == 'en'){
		   	if($this->_lang != 'en'){
			   	$this->_redirect('/translate/filter/change/en');
		   	}
	   	}elseif(!isset($params['lang']) && $this->_lang == 'en'){
		   	$this->_redirect('/translate/filter/change/en');
	   	}
	   	
	  
	   	
	     $identity = Zend_Auth::getInstance()->getIdentity();
	    
	     
	     $menu_item = new Model_MenuItem();
	     $options = array(
		     'link' => '',
		     'lang' => $this->_lang,
	     );
	     $result = $menu_item->get_one_where($options);
	     
	     $this->view->assign($result->toArray());
	     	   
	   $new = new New_Model_Product();
	   $options_news = array(
		   'image' => 'yes',
		   'content_type' => 'new',
		   'lang' => $this->_lang,
		   'limit' => 4,
		   'status' => 1,
		   'order' => 'p.date desc',
	   );
	   $this->view->news = $news = $new->get_details($options_news);
	   
	   
	   $featured = array(
		  // 'image' => 'yes',
		   'limit' => 5,
		   'status' => 1,
		   'order' => 'p.date desc',
		   'link' => 'tin-khuyen-mai',
		   'lang' => $this->_lang,
	   );
	  
	    $this->view->featured = $feature = $new->get_details($featured);
	
	 
	    /* 
	     if($this->_lang == 'vi'){
		$product = $new->getProductById(25);	
		}elseif($this->_lang == 'en'){
		$product = $new->getProductById(26);	

		}
		
		
		$this->view->assign($product->toArray());
		
		 "SELECT distinct p.* 
					FROM product as p 
					INNER JOIN product_relationships as s 
					ON p.id = s.object_id 
					WHERE p.content_type = 'new' 
					AND p.status = 1 
					AND p.lang='".$lang."' 
					ORDER BY p.date DESC $limit";
		*/
		
		//$listnew = $new->getlistNews($this->_lang, 4);
		$options2 = array(
			'image' => 'Yes',
			'content_type' => 'new',
			'status' => 1,
			'lang' => $this->_lang,
			'order' => 'p.date DESC',
			'limit' => 4,
		);
	 $listnew = $new->get_details($options2);
	 
	  $this->view->result = $listnew;
	  
	  //testimonial
	  	$options = array(
		  	'image' => 'Yes',
	  	);
	     $testimonial = new Model_Testimonial();
	     $row_testimonial = $testimonial->get_details($options);
		 $this->view->testimonial = $row_testimonial;
		 
	  //video
	  $product = new Product_Model_Product();
	  $videos = array(
		  'content_type' => 'video',
		  'status' => 1,
		  'featured' => 1,
		  'limit' => 6,
	  );
	  
	 $this->view->result_video = $result_video = $product->get_details($videos);	
	  
    }
 
    function testAction()
    {
	    $this->view->headScript()->appendFile('https://code.jquery.com/jquery-2.1.1.min.js');
	    $this->view->headScript()->appendFile('/public/js/jquery.snow.js');
	     $this->_helper->layout->disableLayout();
	    echo 2434;
    }
    
    
     public function counterAction()
    {
	    $this->_helper->viewRenderer->setNoRender(true);
	    $this->_helper->layout->disableLayout();
	   
	   if($this->getRequest()->isXmlHttpRequest())
	   		{
	   		
	    	
	    			          	   	    
	    		
	    		  
	    		  
	    $_SESSION['id'] = (isset($_SESSION['id'])) ? $_SESSION['id'] : uniqid();
	    
	    $secondsToConsiderOffline = 60;

		$currentTime = time();
		
		// Singular word to represent the visitor.
		$visitorSingular = "Khách";

		// Plural word to represent the visitor.
		$visitorPlural = "Khách";

		// Singular word to represent the page which visitor is.
		$pageSingular = "Trang";

		// Plural word to represent the page which visitor is.
		$pagePlural = "Trang";
		
		$linkFormat = '%1$d %2$s trên %3$d %4$s';
		//$ip  =  $_SERVER['REMOTE_ADDR'];

		$gracePeriod = $currentTime - $secondsToConsiderOffline;

		$id = $_SESSION['id'];

		$page_title = (isset($_REQUEST['page_title'])) ? $_REQUEST['page_title'] : '';

		$page_url = (isset($_REQUEST['page_url'])) ? $_REQUEST['page_url'] : '';
		
		$delete = $this->_db->query("DELETE FROM online WHERE last_activity < ? OR id = ?",
		array($gracePeriod,$id));
		
		$insert = $this->_db->query("INSERT INTO online (id, page_title, page_url, last_activity, ip) VALUES (?, ?, ?, ?, ?)", array($id,$page_title,$page_url,$currentTime));
		
		$count = $this->_db->query('SELECT COUNT(DISTINCT ip) AS visitors, COUNT(DISTINCT page_url) AS pages FROM online');
		$count = $count->fetchAll();
		$count = $count[0];
	
		if ($count['visitors'] <= 1)
		{
    $visitors = 1;
    $visitorWord = $visitorSingular;
		}
		else
		{
    $visitors = $count['visitors'];
    $visitorWord = $visitorPlural;
		}

		if ($count['pages'] <= 1)
		{
    $pages = 1;
    $pageWord = $pageSingular;
		}
		else
		{
    $pages = $count['pages'];
    $pageWord = $pagePlural;
		}

		echo sprintf($linkFormat, $visitors, $visitorWord, $pages, $pageWord);
		
	    		   		  
			
	   		}
    }
   
}