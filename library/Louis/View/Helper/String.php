<?php
class Louis_View_Helper_String extends Zend_View_Helper_Abstract{
        
       public function string()
		 {
			 return $this;
		 }
		 
		public function product_price($type, $value){

	if(strtoupper($type) == "VND"){

		$price = $value+0;
		$currency = new Zend_Currency(
				array(
				   "value"			=>$price,                           
				   "currency"		=>"VND",
				   "symbol"			=>"VNĐ",
				   "display"		=>2,
				   "precision"		=>0,
				   "number_format" 	=>"#.##0.00",
				   "locale"			=>"vi_VN",
				   "position"		=>Zend_Currency::RIGHT)
				);
		return $currency->toCurrency();

	}elseif(strtoupper($type) == 'USD'){
		$currency = new Zend_Currency('en_US');
		$helper = new Zend_View_Helper_Currency($currency);			
		return $helper->currency($value);
	}		

		}
		
		
		 public function cut_string($str,$len,$more)
		   {
    if ($str=="" || $str==NULL) return $str;
    if (is_array($str)) return $str;
    $str = trim($str);
    if (strlen($str) <= $len) return $str;
    $str = substr($str,0,$len);
    if ($str != "")
    {
        if (!substr_count($str," "))
        {
            if ($more) $str .= "...";
            return $str;
        }
        while(strlen($str) && ($str[strlen($str)-1] != " "))
        {
            $str = substr($str,0,-1);
        }
        $str = substr($str,0,-1);
        if ($more) $str .= "...";
    }
    return $str;
}

	public function time_travel($string){
		$arrString = explode('.', $string);
		$count = count($arrString);
		if($count < 2){
		return 'Full day ';	
		}
		return $arrString[0].' days '.$arrString[1].' nights ';
	}
	
	public function url($strvncodau,$thaythekhoangtrang) {

	$strvncodau = str_replace(
		array(' ','+','%',"/","\\",'"','?','<','>',"#","^","`","'","=","!",":" ,",,","..","*","&","__","▄","&!","(",")"),
		array('-','','' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'' ,'-','' ,'-','' ,'' ,'' , "_" , " - " ,"" ,"","","",""),
		$strvncodau);

	$chars = array("a","A","e","E","o","O","u","U","i","I","d", "D","y","Y");

	$uni[0] = array("á","à","ạ","ả","ã","â","ấ","ầ", "ậ","ẩ","ẫ","ă","ắ","ằ","ặ","ẳ","� �");
	$uni[1] = array("Á","À","Ạ","Ả","Ã","Â","Ấ","Ầ", "Ậ","Ẩ","Ẫ","Ă","Ắ","Ằ","Ặ","Ẳ","� �");
	$uni[2] = array("é","è","ẹ","ẻ","ẽ","ê","ế","ề" ,"ệ","ể","ễ");
	$uni[3] = array("É","È","Ẹ","Ẻ","Ẽ","Ê","Ế","Ề" ,"Ệ","Ể","Ễ");
	$uni[4] = array("ó","ò","ọ","ỏ","õ","ô","ố","ồ", "ộ","ổ","ỗ","ơ","ớ","ờ","ợ","ở","� �");
	$uni[5] = array("Ó","Ò","Ọ","Ỏ","Õ","Ô","Ố","Ồ", "Ộ","Ổ","Ỗ","Ơ","Ớ","Ờ","Ợ","Ở","� �");
	$uni[6] = array("ú","ù","ụ","ủ","ũ","ư","ứ","ừ", "ự","ử","ữ");
	$uni[7] = array("Ú","Ù","Ụ","Ủ","Ũ","Ư","Ứ","Ừ", "Ự","Ử","Ữ");
	$uni[8] = array("í","ì","ị","ỉ","ĩ");
	$uni[9] = array("Í","Ì","Ị","Ỉ","Ĩ");
	$uni[10] = array("đ");
	$uni[11] = array("Đ");
	$uni[12] = array("ý","ỳ","ỵ","ỷ","ỹ");
	$uni[13] = array("Ý","Ỳ","Ỵ","Ỷ","Ỹ");

	for($i=0; $i<=13; $i++) {
		$strvncodau = str_replace($uni[$i],$chars[$i],$strvncodau);
	}

	return strtolower($strvncodau);
}

function to_slug($str) {
    $str = trim(mb_strtolower($str));
    $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
    $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
    $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
    $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
    $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
    $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
    $str = preg_replace('/(đ)/', 'd', $str);
    $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
    $str = preg_replace('/([\s]+)/', '-', $str);
    return $str;
         }	



    } 