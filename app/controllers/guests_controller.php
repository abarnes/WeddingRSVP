<?php
class GuestsController extends AppController {
 
	var $name = 'Guests';
	var $components = array('Session','Auth');
	
	function beforeFilter() {
		$this->Auth->allow('index','search','rsvp','party','end');
	}
	
	function index () {

	}
	
	function view_all (){
		$this->layout = 'backend';
		//$this->set('guests',$this->Guest->find('all',array('order'=>array('Guest.party_id ASC'))));
		$this->paginate = array('limit' => 30,'order'=>'Guest.party_id ASC');
		$guests = $this->paginate('Guest');
		$this->set(compact('guests'));
		
		$this->set('responded',$this->Guest->find('count',array('conditions'=>array('Guest.responded'=>'1'))));
		$this->set('attending',$this->Guest->find('count',array('conditions'=>array('Guest.attending'=>'1'))));
		$this->set('not_attending',$this->Guest->find('count',array('conditions'=>array('Guest.attending'=>'2'))));
	}
	
	function add() {
		if (!empty($this->data)) {
			if ($this->Guest->save($this->data)) {
				$this->Session->setFlash($this->data['Guest']['first_name'].' '.$this->data['Guest']['last_name'].' added');
				$this->redirect(array('controller'=>'guests','action' => 'view_all'));
			} else {
				$this->Session->setFlash('Error: Failed to Save Guest');
			}
		} else {
			$ids = $this->Guest->find('all');
			$arr = array();
			foreach ($ids as $i) {
				if (!in_array($i['Guest']['party_id'],$arr)) {
					$arr[] = $i['Guest']['party_id'];
				}
			}
			$w = 1;
			while (in_array($w,$arr)) {
				$w++;
			}
			$final = array();
			$final[$w] = 'New Party';
			foreach($arr as $a) {
				$count = 1;
				$g = $this->Guest->find('all',array('conditions'=>array('Guest.party_id'=>$a)));
				$s = '';
				foreach ($g as $g) {
					$s.=$g['Guest']['full_name'].', ';
					
					$count++;
					if ($count>2) {
						if ($count>3) {
							$s.='etc...';
						}
						break;
					}
				}
				$s = substr($s,0,-2);
				$final[$a] = $s;
			}
			$this->set('parties',$final);
		}
	}
	
	function edit($id) {
		$this->Guest->id  = $id;
		if (!empty($this->data)) {
			if ($this->data['Guest']['responded']==0) {
				$this->data['Guest']['attending']='0';
			}
			if ($this->Guest->save($this->data)) {
				$this->Session->setFlash($this->data['Guest']['first_name'].' '.$this->data['Guest']['last_name'].' updated');
				$this->redirect(array('controller'=>'guests','action' => 'view_all'));
			} else {
				$this->Session->setFlash('Error: Failed to Save Guest');
			}
		} else {
			$this->data = $this->Guest->read();
			
			$ids = $this->Guest->find('all');
			$arr = array();
			foreach ($ids as $i) {
				if (!in_array($i['Guest']['party_id'],$arr)) {
					$arr[] = $i['Guest']['party_id'];
				}
			}
			$w = 1;
			while (in_array($w,$arr)) {
				$w++;
			}
			$final = array();
			$final[$w] = 'New Party';
			foreach($arr as $a) {
				$count = 1;
				$g = $this->Guest->find('all',array('conditions'=>array('Guest.party_id'=>$a)));
				$s = '';
				foreach ($g as $g) {
					$s.=$g['Guest']['full_name'].', ';
					
					$count++;
					if ($count>2) {
						if ($count>3) {
							$s.='etc...';
						}
						break;
					}
				}
				$s = substr($s,0,-2);
				$final[$a] = $s;
			}
			$this->set('parties',$final);
		}
	}
	
	function search() {
		if (!empty($this->data)) {
			$find = $this->Guest->find('first',array('conditions'=>array('Guest.full_name LIKE'=>'%'.$this->data['Guest']['name'].'%')));
			if (!empty($find)) {
				$this->redirect(array('action'=>'rsvp/'.$find['Guest']['id']));
			} else {
				$this->Session->setFlash('The name "'.$this->data['Guest']['name'].'" was not found.  Please enter the name exactly as it appears on the invitation.');
				$this->redirect('/');
			}
		}
	}
	
	function rsvp($id) {
		$guest = $this->Guest->findById($id);
		$this->set('guest',$guest);
		if (!empty($this->data)) {
			$this->Guest->id = $id;
			$d = array();
			$d['Guest']['attending'] = $this->data['Guest']['sel'];
			$d['Guest']['responded'] = '1';
			if ($this->Guest->save($d)) {
				$find = $this->Guest->find('count',array('conditions'=>array('Guest.party_id'=>$guest['Guest']['party_id'])));
				if ($find>1) {
					$this->redirect(array('action'=>'party/'.$id));
				} else {
					if ($this->data['Guest']['sel']=='1') {
						$this->Session->setFlash('We look forward to seeing you there');
					}
					$this->redirect('/end');
				}
			}
		}
	}
	
	function party($id) {
		$guest = $this->Guest->findById($id);
		if ($guest['Guest']['party_id']!=null) {
			$others = $this->Guest->find('all',array('conditions'=>array('Guest.party_id'=>$guest['Guest']['party_id'],'Guest.id !='=>$id)));
		} else {
			$others = $guest;
		}
		$this->set('others',$others);
		$this->set('guest',$guest);
		if (!empty($this->data)) {
			foreach ($this->data['Guest'] as $row=>$value) {
				$i = substr($row,3);
				$this->Guest->id = $i;
				if ($value!='1'){
					$value = '0';
				}
				$d = array();
				$d['Guest']['responded'] = '1';
				$d['Guest']['attending'] = $value;
				$this->Guest->save($d);
				$this->Guest->id = false;
			}
			if ($guest['Guest']['attending']=='1') {
				$this->Session->setFlash('We look forward to seeing you there');
			}
			$this->redirect('/end');
		}
	}
	
	function delete_all() {
		$all = $this->Guest->find('all');
		foreach ($all as $a){
			$this->Guest->delete($a['Guest']['id']);
		}
		$this->redirect('/guests/view_all');
	}
	
	function end() {
		
	}
	
	function parseupload() {
			$this->layout = 'backend';
			$this->set('errors',array());
			if($this->data){
				if (!empty($this->data['Guest']['fn_column'])) {
					$fc = strtoupper($this->data['Guest']['fn_column']);
				} else {
					$fc = 'A';
				}
				if (!empty($this->data['Guest']['ln_column'])) {
					$lc = strtoupper($this->data['Guest']['ln_column']);
				} else {
					$lc = 'B';
				}
				
				require('../webroot/Classes/PHPExcel.php');
				$Reader = PHPExcel_IOFactory::createReaderForFile($this->data['Guest']['submittedfile']['tmp_name']);
				$Reader->setReadDataOnly(true);
				$objXLS = $Reader->load($this->data['Guest']['submittedfile']['tmp_name']);
				
				$rw = 1;
				$count_empty = 0;
				
				//find party id
				$c = $this->Guest->find('count');
				if ($c!=0) {
					$hg = $this->Guest->find('first',array('order'=>array('Guest.party_id DESC')));
					$party = $hg['Guest']['party_id']+1;
				} else {
					$party = 1;
				}
				
				while ($count_empty<4) {
					$fn = $objXLS->getSheet(0)->getCell($fc.$rw)->getValue();
					$ln = $objXLS->getSheet(0)->getCell($lc.$rw)->getValue();
					if ($ln!=''||$fn!='') {
						$d = array();
						$d['Guest']['first_name'] = $fn;
						$d['Guest']['last_name'] = $ln;
						$d['Guest']['party_id'] = $party;
						$this->Guest->save($d);
						$this->Guest->id = false;
						$count_empty = 0;
						unset($d);
					} else {
						$party++;
						$count_empty++;
					}
					$rw++;
				}
				unlink($this->data['Guest']['submittedfile']['tmp_name']);
				$this->Session->setFlash('Successfully Uploaded!');
				$this->redirect('/guests/view_all');
			}
		}
    
}
?>