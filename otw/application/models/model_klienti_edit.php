<?php


class Model_klienti_edit extends CI_Model{
	
	
	//funckija vo koja ke pristapam do baza, ke gi zemam site potrebni podatoci vneseni za plan za nekoj klient cie id ke go dadam 
	//kako argument, i ke gi dadam kon controller-ot
	public function get_plan($id_klient){
		
		$this->db->select('ime_prezime, dolgorocni_celi, kratkorocni_celi, uredi_softver, metodi_frekvencija, ocekuvani_rezultati
				, planirana_evaluacija_postaveni_celi, datum_plan, plan_napravil');
		
		$this->db->from('klient');				
		
		$this->db->where('id', $id_klient);
		
		$query = $this->db->get();
		
		$result = array();
		
		foreach($query->result() as $row){
			$result = (array)$row;
		}
							
		return $result;
	
	}	
	
	//funckija vo koja kako argument dobivam id na klient i plan i treba da pristapam do baza i da napravam promeni vo planot.
	public function edit_plan($id_klient, $plan){
		
		$this->db->where('id', $id_klient);
		$this->db->update('klient', $plan);
		
		if($this->db->affected_rows()>0){
			return true;
		}
		
		else return false;
				
	}
	
	
	//funckija vo koja ke pristapam do baza, ke gi zemam site potrebni podatoci vneseni za procenka za nekoj klient cie id ke go dadam
	//kako argument, i ke gi dadam kon controller-ot.
	public function get_procenka($id_klient){
		
		$this->db->select('procenka_napravil, datum_na_procenka, motorika, kognitivni_spos, govor_komunikacija, pismenost, 
				odnesuvanje, rizici, opkruzuvanje, interesi, kompjuterski_vestini, nastavnik');
		
		$this->db->from('klient');
		
		$this->db->where('id', $id_klient);
		
		$query = $this->db->get();
		
		$result = array();
		
		foreach($query->result() as $row){
			$result = (array)$row;
		}
										
		$terapevti = $this->get_terapevti_klient($id_klient); 				
		
		$result['terapevti'] = $terapevti;
							
		return $result;
		
	}
	
	
	//funckija koja ja koristam za da napravam uspesen edit na terapevtite za klientot. Vo ovaa funckija gi brisam site 
	//terapevti za klientot cie id go dobivam kako argument, i potoa povikuvam funkcija od model_klienti koja odnovo gi dodava
	//terapevtite za ovoj klient
	public function brisi_terapevti_klient($id_klient){
		//**************************************************
		//nemam uslov za affected rows bidejki mozno e nikogas da ne sum imal terapevt za deteto, pa vo toj slucaj nema voopsto da se
		//izbrise nisto od baza.
		if($this->db->delete('klient_terapevt', array('id_klient' => $id_klient))){
			return true;
		}
		
		else return false;
		
	}
	
	
	//funckija vo koja gi zemam terapevtite za klientot cie id go davam kako argument.
	public function get_terapevti_klient($id_klient){
		$this->db->select('t.id_terapevt, t.terapevt_ime_prezime');
		
		$this->db->from('terapevt t');
		
		$this->db->join('klient_terapevt kt', 'kt.id_terapevt = t.id_terapevt');
		
		$this->db->where('kt.id_klient', $id_klient);
		
		$result = $this->db->get();
		
		$terapevti = array();
		
		foreach($result->result() as $row){
			$row1 = (array)$row;
				
			$id=$row1['id_terapevt'];
			$value=$row1['terapevt_ime_prezime'];
		
			$terapevti[$id]=$value;
		}
		
		return $terapevti;
	}
	
}

?>