<?php

//mi pretstavuva model vo koj pristapuvam do baza i zemam podatoci koi mi se potrebni za da napravam dodavanje i edit na 
//nekoja forma za klient, kako i prikaz na takva forma.

//Vo princip mi pretstavuvam model vo koj pristapuvam do baza i zemam informacii povrzani za klientot, koi se dodadeni
//vo formite za vnes.

class Model_get extends CI_Model{
		
	
	//funkcija koja gi zema site poprecenosti od baza gi smestuva vo asocijativno pole i gi vraka nazad do kontrolerot.
	public function get_poprecenosti(){
	
		$query = $this->db->get('tip_poprecenost');
	
		$result = array();
	
		foreach($query->result() as $row){
			$result[$row->tip_poprecenost] = $row->tip_poprecenost;
		}
	
		return $result;
	}
	
	//funckija koja gi zema site tipovi na obrazovanie od baza
	public function get_obrazovanie(){
	
		$query = $this->db->get('tip_obrazovanie');
	
		$result = array();
	
		foreach($query->result() as $row){
			$result[$row->tip_obrazovanie] = $row->tip_obrazovanie;
		}
	
		return $result;
	
	}
	
	//funckija koja gi zema site tipovi na poseta od baza
	public function get_tipPoseta(){
		$query = $this->db->get('tip_poseta');
	
		$result = array();
	
		foreach($query->result() as $row){
			$result[$row->tip_poseta] = $row->tip_poseta;
		}
	
		return $result;
	}

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

	
	//funckija vo koja pristapuvam do baza i gi zemam podatocite povrzani za plan za korisnikot cie id go dobivam kako parametar.
	//Razlikata so get_plan e vo toa sto tuka pravam join za da gi zemam tocnite iminja na vraboteniot koj go napravil planot.
	//*******************************************
	//mozno e da e redundanto
	public function get_prikaz_plan($id_klient){
		
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

	//funckija vo koja pristapivam do baza, i gi zemam podatocite povrzani za plan za korisnikot cie id go dobivam kako parametar.
	//Razlikata so get_procenka e vo toa sto tuka pravam join za da gi zemam tocnite iminja na vraboteniot koj ja napravil 
	//procenkata kako i so nastavnikot so koj raboti korisnikot.
	
	//****************************************************
	//nastavnikot i vraboteniot voopsto ne treba da se prikazuvaat dokolku ne se vneseni, i isto taka 
	//za terapevtot treba da zememe period koga posetuval, kontakt i institucija vo koja pripaga.
	public function get_prikaz_procenka($id_klient){
		
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

	
	//funckija vo koja gi zemam terapevtite za klientot cie id go davam kako argument. Ke go koristam za da gi prikazam iminjata 
	//na terapevtite koga ke pravam prikaz na formata za procenka za klient.
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