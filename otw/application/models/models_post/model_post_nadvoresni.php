<?php

//model vo koj pristapuvam do baza i dodavam podatoci za nadvoresni luge, kako terapevti, nastavnici i odgovorni_firma. 
//Tuka ke imam funckii za dodavanje na nov 

class Model_post_nadvoresni extends CI_Model{

	
	//---------------------------------------------------------------------------------------------------------------
	//funckii za terapevt
	
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
	
	
	//funckija vo koja pristapuvam do baza i go brisam terapevtot cie id go dobivam kako parametar.
	public function delete_terapevt($id_terapevt){
		
		if($this->db->delete('terapevt', array('id_terapevt' => $id_terapevt))){
			return true; 	
		}
		
		else return false;
	}

	
	//---------------------------------------------------------------------------------------------------------------
	//funckii za institucii
	
	//funckija vo koja pristapuvam do baza i dodavam nova institucija vo tabelata za institucija
	public function dodadi_nova_institucija($institucija){
		
		$ime_institucija = $institucija['ime_institucija'];
		
		$this->db->set('ime_institucija', $ime_institucija);
		
		if($this->db->insert('institucija')){
			//vrakam true ako uspesno e dodadeno vo baza
			return true;
		}
		else return false;
		
	}

	
	//funckija vo koja pristapuvam do baza i pravam promeni za institucijata cie id ke go dobijam kako parametar
	public function edit_institucija($id_institucija, $institucija){
		
		$this->db->where('id_institucija', $id_institucija);
		
		if($this->db->update('institucija', $institucija)){
			return true;
		}
		
		else return false;
	}
	
	//funckija vo koja pristapuvam do baza i ja brisam institucijata cie id go dobivam kako parametar.
	public function delete_institucija($id_institucija){
		
		if($this->db->delete('institucija', array('id_institucija' => $id_institucija))){
			return true;
		}
		
		else return false;
	}


	//---------------------------------------------------------------------------------------------------------------
	//funckii za nastavnici
	
	
	//funckija vo koja pristapuvam do baza i dodavam nov nastavnik vo tabelata za nastavnici
	public function dodadi_nov_nastavnik($nastavnik){
		
		if($this->db->insert('nastavnik', $nastavnik)){
			//vrakam true ako uspesno e dodadeno vo baza
			return true;
		}
		else return false;
		
	}

	//funckija vo koja pristapuvam do baza i pravam promeni za nastavnikot cie id ke go dobijam kako parametar
	public function edit_nastavnik($id_nastavnik, $nastavnik){
		
		$this->db->where('id_nastavnik', $id_nastavnik);
		
		if($this->db->update('nastavnik', $nastavnik)){
			return true;
		}
		
		else return false;
		
	}
	
	//funckija vo koja pristapuvam do baza i go brisam nastavnikot cie id go dobivam kako parametar.
	public function delete_nastavnik($id_nastavnik){
		
		if($this->db->delete('nastavnik', array('id_nastavnik' => $id_nastavnik))){
			return true;
		}
		
		else return false;
	}
	

	//---------------------------------------------------------------------------------------------------------------
	//funckii za ucilista
	
	
	//funckija vo koja pristapuvam do baza i dodavam novo uciliste vo tabelata za uciliste
	public function dodadi_novo_uciliste($uciliste){
		
		if($this->db->insert('uciliste', $uciliste)){
			return true;
		}
		else return false;
		
	}

	//funckija vo koja pristapuvam do baza i pravam promeni za ucilisteto cie id ke go dobijam kako parametar
	public function edit_uciliste($id_uciliste, $uciliste){
		
		$this->db->where('id_uciliste', $id_uciliste);
		
		if($this->db->update('uciliste', $uciliste)){
			return true;
		}
		
		else return false;
	}

	//funckija vo koja pristapuvam do baza i ja brisam ucilisteto cie id go dobivam kako parametar.
	public function delete_uciliste($id_uciliste){
	
		if($this->db->delete('uciliste', array('id_uciliste' => $id_uciliste))){
			return true;
		}
	
		else return false;
	}
	
}

?>