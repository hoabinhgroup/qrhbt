<?php
class User_Form_User extends Zend_Form
{
    public function init()
    {
        $this->setMethod('post');
        
        $id = $this->createElement('hidden', 'id');
        $id->setDecorators(array('ViewHelper'));
        $this->addElement($id);
      
        $username = $this->createElement('text','username');
        $username->setLabel('Username: ');
        $username->setRequired('true');
        $username->addFilter('StripTags');
        $username->addErrorMessage('The username is required!');
        $this->addElement($username);
        $password = $this->createElement('password', 'password');
        $password->setLabel('Password: ');
        $password->setRequired('true');
        $this->addElement($password);
		$eventlist = $this->createElement('select', 'eventlist');
        $eventlist->setLabel('Events: ');
        $eventlist->setRequired('true');
        $this->addElement($eventlist);
        $firstName = $this->createElement('text','first_name');
        $firstName->setLabel('First Name: ');
        $firstName->setRequired('true');
        $firstName->addFilter('StripTags');
        $this->addElement($firstName);
        $lastName = $this->createElement('text','last_name');
        $lastName->setLabel('Last Name: ');
        $lastName->setRequired('true');
        $lastName->addFilter('StripTags');
        $this->addElement($lastName);
        $role = $this->createElement('select', 'role');
        $role->setLabel("Select a role:");
        $role->addMultiOption('User', 'user');
        $role->addMultiOption('Administrator', 'administrator');
        $this->addElement($role);
        //$submit = $this->addElement('submit', 'submit', array('label' => 'Submit'));
        $this->addElement(new Zend_Form_Element_Button( 'submit',
                   array( 'label' => '<i class="ace-icon fa fa-check">&nbsp;</i>Submit', 
                          'class' => 'btn btn-info', 
                          'type' => 'submit',
                          'escape' => false,
                          'required' => false,
                           'ignore' => false, ) ));
    }
} 