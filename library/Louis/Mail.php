<?php
class Louis_Mail extends Zend_Controller_Plugin_Abstract
{
	protected $_username = 'hoabinh@hoabinhtourist.com';
	protected $_password = 'hoabinh911911';
	public function __construct(){
	   return $this;
   }
	
	public function send($from, $from_name, $to, $subject, $message, $options){
		 $smtpHost = 'smtp.gmail.com';
		 $smtpConf = array(
		 'auth' => 'login',
		 'ssl' => 'tls',
		 'port' => '587',
		 'username' => $this->_username,
		 'password' => $this->_password
		 );
 
	$connmail = new Zend_Mail_Transport_Smtp ( $smtpHost, $smtpConf );
			Zend_Mail::setDefaultTransport ( $connmail );
			$mail = new Zend_Mail ( 'UTF-8' );
			
			$mail->setBodyHtml($message);
			$mail->setFrom ( $from, $from_name);
			$mail->addTo( $to );

			 //check cc
			 $cc = $this->get_array_value($options, "cc");
			 if ($cc) {				
				 $mail->addCc($cc);
           
        	}
        	
        	 $bcc = $this->get_array_value($options, "bcc");
			 if ($bcc) {
             $mail->addBcc($bcc);
        	}
        	
             $reply = $this->get_array_value($options, "reply");
			 if ($reply) {
             $mail->setReplyTo($reply);
        	}
        
			$mail->setSubject($subject);	
					
			$sent = true;
			
			 try {
			 $mail->send($connmail);
 			 }
 			 catch (Zend_Mail_Transport_Exception $e) {
 			 $sent = false;
 			}
 			return $sent;
	}
	
	public function get_array_value(array $array, $key)
	   {
		   if (array_key_exists($key, $array)) {
            return $array[$key];
        }
	   }  
}