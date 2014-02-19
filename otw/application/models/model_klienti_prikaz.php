<?php

class Model_klienti_prikaz extends CI_Model{
	
	
	//funckija vo koja pristapuvam do baza i gi zemam site potrebni informacii za procenka, vneseni za klinetot cie id go dobivam 
	//kako argument.
	public function prikaz_procenka($id_klient){
		
		$this->db->select('k.ime_prezime, k.datum_na_procenka, k.motorika, k.kognitivni_spos, k.govor_komunikacija, k.pismenost,
				k.odnesuvanje, k.rizici, k.opkruzuvanje, k.interesi, k.kompjuterski_vestini, k.nastavnik, v.ime_prezime as
				vraboten_ime_prezime, n.nastavnik_ime_prezime');
		
		$this->db->from('klient k');
		
		$this->db->join('vraboten v', 'k.procenka_napravil = v.id');
		
		$this->db->join('nastavnik n', 'n.id_nastavnik = k.nastavnik');			
		
		$this->db->where('k.id', $id_klient);
		
		$query = $this->db->get();
		
		$result = array();
		
		foreach($query->result() as $row){
			$result = (array)$row;
		}
		
		$result['terapevti'] = $this->get_terapevti_klient($id_klient);
		
		return $result;
	
	}

	//funckija vo koja ke pristapam vo baza i ke gi zemam site podatoci za planot na klientot so id koe ke go dobijam kako argument.
	//Isto taka ke treba da pristapam i do tabelata za vraboten za da go zemam imeto na vraboteniot koj go napravil planot za ovoj
	//klient.
	public function prikaz_plan($id_klient){
		
		$this->db->select('k.ime_prezime, k.dolgorocni_celi, k.kratkorocni_celi, k.uredi_softver, k.metodi_frekvencija, k.ocekuvani_rezultati
				, k.planirana_evaluacija_postaveni_celi, k.datum_plan, v.ime_prezime as vraboten_ime_prezime');
		$this->db->from('klient k');
		
		$this->db->join('vraboten v', 'v.id = k.plan_napravil');
		
		$this->db->where('k.id', $id_klient);
		
		$query = $this->db->get();
		
		$result = array();
		
		foreach($query->result() as $row){
			$result = (array)$row;
		}
							
		return $result;
		
		
	}
	
	
	//funckija vo koja gi zemam site terapevti za eden klient, cie id ke go dadam kako argument
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