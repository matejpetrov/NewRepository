<?php


//model vo koj ke pristapuvam do baza i ke gi zemam site licnosti koi se nadvoresni na organizacijata, odnosno tuka ke spagaat, 
//terapevtite, nastavnicite i vrabotenite od firmite, kade klientot odi na poseta. 

class Model_get_nadvoresni extends CI_Model{
	
	//funckija so koja gi zemam imeto i id-to na site terapevti koi gi imam vo baza
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
	
	//funckija vo koja ke pristapam do baza i ke gi zemam site informacii za terapevtite koi mi se vneseni, vklucuvajki ja i 
	//institucijata vo koja rabotat. Treba da upotrebam join za polesen da mi e pristapot do institucijata.
	public function get_terapevi_everything(){
		
		$this->db->select('t.id_terapevt, t.terapevt_ime_prezime, t.mail, t.telefon, t.institucija, i.ime_institucija');
		
		$this->db->from('terapevt t');
		
		$this->db->join('institucija i', 'i.id_institucija = t.institucija');
		
		$query = $this->db->get();
		
		$result = array();
		
		foreach($query->result() as $row){
			//go konvertiram rezultatot za eden terapevt od stdClass vo array, za da mozam polesno da pristapuvam do podatocite.
			$row1 = (array)$row;
			
			if($row1['mail'] == ""){
				$row1['mail'] = "/";
			}
			
			if($row1['telefon'] == ""){
				$row1['telefon'] = "/";
			}
						
			
			//go dodavam vo glavnata lista koja ke ja vratam do controller-ot. Eden element od listata ke mozam da pristapam preku
			//id-to na terapevtot.
			$result[$row->id_terapevt] = $row1;			
		}
		
		return $result;
	}
	
	//funckija koja gi zema site institucii vo koi moze da raboti eden terapevt
	public function get_institucii(){
		$query = $this->db->get('institucija');
	
		$result = array();
	
		foreach($query->result() as $row){
			//vrednosta na ona sto ke se selektira vo nekoja korisnicka kontrola ke bide
			//id-to na institucijata, a ke se prikazuva imeto na institucijata
			$result[$row->id_institucija] = $row->ime_institucija;
		}
	
		return $result;
	}
	
	//funckija koja gi imeto i id-to na site nastavnici koi gi imam vo baza
	public function get_nastavnici(){
		$query = $this->db->get('nastavnik');
	
		$result = array();
	
		foreach($query->result() as $row){
			//vrednosta na ona sto ke se selektira vo nekoja korisnicka kontrola ke bide
			//id-to na terapevtot, a ke se prikazuva imeto i prezimeto na terapevtot
			$result[$row->id_nastavnik] = $row->nastavnik_ime_prezime;
		}
	
		return $result;
	}
	
	//funckija vo koja ke pristapam do baza i ke gi zemam site informacii za nastavnicite koi mi se vneseni, vklucuvajki go i
	//ucilisteto vo koe rabotat. Treba da upotrebam join za polesen da mi e pristapot do ucilisteto.
	public function get_nastavnici_everything(){
		
	}
	
	//funckija vo koja gi zemam od baza site ucilista vo koi moze da raboti eden nastavnik
	public function get_ucilista(){
		
	}
	
	//funckija koja gi imeto i id-to na site odgovorni_firma koi gi imam vo baza.
	public function get_odgovorni_firma(){
		
	}
	
	//funckija vo koja ke pristapam do baza i ke gi zemam site informacii za odgovorni_firma koi mi se vneseni, vklucuvajki ja i
	//firmata vo koja rabotat. Treba da upotrebam join za polesen da mi e pristapot do firmata.
	public function get_odgovorni_firma_everything(){
		
	}
	
	//funckija vo koja gi zemam od baza site firmi vo koi moze da raboti eden vraboten
	public function get_firmi(){
		
	}
}



?>