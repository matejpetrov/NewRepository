<?php

//model vo koj pristapuvam do baza i dodavam podatoci za nadvoresni luge, kako terapevti, nastavnici i odgovorni_firma. 
//Tuka ke imam funckii za dodavanje na nov 

class Model_post_nadvoresni extends CI_Model{
	
	//funckija vo koja pristapuvam do baza i dodavam nov terapevt vo tabelata za tearpevti
	public function dodadi_nov_terapevt($terapevt){
	
		if($this->db->insert('terapevt', $terapevt)){
			//vrakam true ako uspesno e dodadeno vo baza
			return true;
		}
		else return false;
	
	}

	
	//funckija vo koja pristapuvam do baza i pravam promeni za terapevtot cie id ke go dobijam kako parametar
	function edit_terapevt($id_terapevt, $terapevt){
		
		$this->db->where('id_terapevt', $id_terapevt);
		
		if($this->db->update('terapevt', $terapevt)){
			return true;
		}
		
		else return false;
		
	}
	
}

?>