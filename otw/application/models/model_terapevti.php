<?php

class Model_terapevti extends CI_Model{
	
	
	
	public function get_terapevti(){
		
		$query = $this->db->get('terapevt');
		
		$result = array();
		
		foreach($query->result() as $row){
			//vrednosta na ona sto ke se selektira vo nekoja korisnicka kontrola ke bide
			//id-to na terapevtot, a ke se prikazuva imeto i prezimeto na terapevtot
			$result[$row->id_terapevt] = $row->terapevt_ime_prezime;
		}
		
		return $result;
		
	} 
	
	
	//*****************************************
	//treba da napisam join za da polesno ja zemam institucijata vo koja pripaga terapevtot.
	public function get_terapevti_everything(){
				
		$query = $this->db->get('terapevt');				
		
		$result = array();
		
		$pom = $query->result();
		
		for($i=0;$i<sizeof($pom);$i++){
			
			
			$this->db->select('ime_institucija');
			
			$query_institucija = $this->db->get_where('institucija', array('id_institucija' => $pom[$i]->institucija)); 
			
			//imam eden red, no sakam da go zemam kako posebna promenliva, a ne kako array, pa zatoa go izminuvam
			foreach($query_institucija->result() as $row){
				$ime_institucija = $row->ime_institucija;
			}
			
			//dodavam nov atribut vo stdObject instancata ime_institucija koj za 
			$pom[$i]->ime_institucija = $ime_institucija;
			
			//bidejki zemam cel red od baza, kako rezultat mi se vraka stdObject, instanca od stdClass. 
			//Vsusnost jas vo array-ot result ke imam lista od objekti, koi moze da gi pristapam kako obicen clen vo lista
			//a potoa so upotreba na -> da pristapam i do nekoe svojstvo od samiot objekt, svojstvata se vsusnost
			//redovite od baza. Pr: $result[0]->terapevt_ime_prezime.									
			array_push($result, $pom[$i]);
		}
		
		return $result;
		
	}
		
	
	public function dodadi_nov_terapevt($terapevt){
				
		if($this->db->insert('terapevt', $terapevt)){
			//vrakam true ako uspesno e dodadeno vo baza
			return true;
		}
		else return false;
		
	}
	
	public function azuriraj_terapevt($id, $terapevt){
		
	}
	
	
	public function dodadi_nova_institucija($institucija){
		
		if($this->db->insert('institucija', $institucija)){
			return true;	
		}
		
		else return false;
	}
	
	
	
	
}


?>