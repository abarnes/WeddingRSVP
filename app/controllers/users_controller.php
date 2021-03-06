<?php
class UsersController extends AppController {
 
	var $name = 'Users';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time', 'javascript');
	var $uses = array('Setting','User');
	var $components = array('Auth','Session');
        
        function beforeFilter() {
            $this->Auth->allow('login');
        }
	
        function login() {
		$this->layout = 'background';
		$this->Auth->redirect(array('controller' => 'guests', 'action' => 'view_all'));
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function add() {
		$this->layout = 'backend';
		    if (!empty($this->data)) {
			    $p2 = $this->data['User']['password2'];
			    if ($this->data['User']['password'] == /*$this->data['User']['password2']*/$this->Auth->password($p2)) {
				    if ($this->User->save($this->data)) {
					    $this->Session->setFlash('User "'.$this->data['User']['username'] . '" Successfully Added');
					    if($this->Auth->user()) {
						$aut = '1';
	     				    } else {
						$aut = '0';
					    }
					    if ($aut=='0') {
						$this->Auth->login(array('username'=>$this->data['User']['username'],'password'=>$this->data['User']['password']));
					    }
					    $this->redirect(array('controller'=>'guests','action' => 'view_all'));
				    } else {
					    $this->Session->setFlash('Error: Failed to save.');
				    }
			    } else {
				    $this->Session->setFlash('Passwords Did Not Match.  Please Try Again.');
			    }
		    }
	}
	
	/*
	function edit($id) {
		$this->layout = 'admin';
		$this->set('down','admin');
		$this->set('id',$id);
		$this->User->id = $id;
		    if (empty($this->data)) {
			    $this->data = $this->User->read();
		    } else {
			if ($this->User->save($this->data)) {
				$this->Session->setFlash('User Information Has Been Updated.');
				$this->redirect(array('action'=>'index'));
			}
		    }
	}
	
	function view($id) {
		
	}
	
	function passwordchange($id = null) {
		$this->layout = 'admin';
		$this->set('down','admin');
		$this->User->id = $id;
		$userinfo = $this->Auth->User();
			if (empty($this->data)) {
				$this->data = $this->User->read();
			} else {
				$p2 = $this->data['User']['password2'];
				if ($this->data['User']['password'] == $p2  && strlen($p2)>='6') {
					if ($this->User->saveField('password',$this->Auth->password($this->data['User']['password']))) {
						$this->Session->setFlash('Password Changed.');
						$this->redirect(array('controller'=>'users','action' => 'index'));
					}
				} else {
					$this->Session->setFlash('Passwords Did Not Match, Or Your New Password Is Less Than 6 Characters.');
				}
			}	
	}
    
	function delete($id) {
		$this->User->delete($id);
		$this->Session->setFlash('User Successfully Deleted.');
		$this->redirect(array('action'=>'index'));
	}
	*/
}

?>