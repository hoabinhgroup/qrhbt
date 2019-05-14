<?php
class Form_Emailtemplate extends Zend_Form
{
    public function init()
    {
        $this->setAttrib('enctype', 'multipart/form-data');
        // create new element
       // $id = $this->createElement('hidden', 'id');
        // element options
      //  $id->setDecorators(array('ViewHelper'));
        // add the element to the form
       // $this->addElement($id);
        
		$name = $this->createElement('text', 'title');
       
        $name->setLabel('Tiêu đề: ');
        $name->setRequired(TRUE);
        $name->setAttrib('size',60);
      //  $name->setAttrib('onkeyup',"ChangeToSlugRec();");
       // $name->setAttrib('autocomplete',"off");
        
        
        
         //$slug = $this->createElement('text', 'ident');
       
       // $slug->setLabel('Đường dẫn: ');
       // $slug->setRequired(TRUE);
       // $slug->setAttrib('size',60);


    
    // create new element
    $content = $this->createElement('textarea', 'description');
    // element options
    $content->setLabel('Nội dung');
    $content->setRequired(TRUE);
    $content->setAttrib('cols',50);
    $content->setAttrib('rows',12);
    // add the element to the form
    
 

      
      /*
        
      $status =  $this->addElement('checkbox', 'status', array(
         'decorators' => array(array('ViewScript', array(
                        'viewScript' => '_status.phtml',
                         'List' => (isset($this->_attribs['status']))?$this->_attribs['status']:0
      )))
      
      ));
      */
            
   
   // $submit = $this->addElement('submit', 'submit', array('label' => 'Submit'));
    $submit = $this->addElement('submit', 
        							'submit',
        					array('label' => 'Lưu',
        							'attribs' => array('class' => 'btn btn-info', 
        							'onClick' => 'form.submit();this.disabled=true')
        											
        								));
        								
        								
         $this->addElements( array (
                            $name,
                            $content,
                           $submit
                            )
                );
    
    
 
        
        $this->addDisplayGroup(array(
        
                    'title',
                    'description',
        
            ),'left');
        
        $col = $this->getDisplayGroup('left');
        $col->setDecorators(array(
        
                    'FormElements',
                    'Fieldset',
                    array('HtmlTag',array('tag'=>'div','class'=>'col-md-8'))
        ));
    
        
        $col = $this->getDisplayGroup('right');
        $col->setDecorators(array(
        
                    'FormElements',
                    'Fieldset',
                    array('HtmlTag',array('tag'=>'div','class'=>'col-md-4'))
        ));
    
}
}