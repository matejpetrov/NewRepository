<?php

class Model_vraboteni extends CI_Model{
	
	//funkcijata kako argument ke dobie pole od site informacii za eden vraboten. Potoa vnatre ke pristapam do bazata i ke go vnesam
	//vraboteniot.
	public function dodadi_vraboten($vraboten){
		
		if($this->db->insert('vraboten', $vraboten)){
			return true;
		}
		else return false;
		
	}
	
	public function proveri_username($username){
		
		$query = $this->db->get_where('vraboten', array('username' => $username));

		return $query;
	}
	
	//funkcija koja pristapuva do baza i gi zema id-to i imeto i prezimeto na sekoj vraboten od tabelata vraboten vo baza , gi stavam vo
	//asocijativno pole kade klucot mi e id-to
	//na vraboteniot, a value mi e imeto i prezimeto na vraboteniot i potoa gi vrakam na controller-ot.	
	public function get_vraboteni(){
	
		$this->db->select('id, ime_prezime');
	
		$query = $this->db->get('vraboten');
	
		$result = array();
	
		foreach($query->result() as $row){
			$result[$row->id] = $row->ime_prezime;
		}
	
		return $result;
	}
	
	
	
	
}

?>