<?php

//model vo koj pristapuvam do baza i dodavam formulari za klientot. Toa znaci deka tuka ke imam funckii so pomos na koj ke dodadam
//nov formular za priem, nov plan, nova procenka itn. Isto taka tuka ke gi definiram i funckiite za azuriranje, odnosno pravenje 
//na edit za site formi vo koi vnesuvam podatoci za klientot.

class Model_post_formulari extends CI_Model{	
	
	//---------------------------------------------------------
	//funckii za dodavanje
	
	//funkcija koja ke primi array koj sodrzi podatoci za klientot i gi dodava vo baza.
	public function dodadi_klient($klient){
	
		if($this->db->insert('klient', $klient)){
			//dokolku uspesno sum dodal vo baza, togas treba da go vratam id-to na novo
			//dodadeniot red, za da mozam da go iskoristam za da dodadam poprecenosti za toj
			//korisnik.
			return $this->db->insert_id();
		}
		else return false;
	
	}

	//funkcija vo koja za korisnikot so prosledenoto id gi dodavame site poprecenosti koi sme gi selektirale
	public function dodadi_poprecenost($id, $poprecenosti){
	
		$rows = array();
	
		foreach($poprecenosti as $p){
				
			$row = array(
					'klient_id' => $id,
					'tip_poprecenost' => $p
			);
	
			array_push($rows, $row);
	
		}
	
		if($this->db->insert_batch('korisnik_poprecenost', $rows)){
			return true;
		}
	
		else return false;
	}

	//funckija koja prima id na klient i podatoci za plan i go dodava planot za klientot so toa id.
	public function dodadi_plan($id, $plan){
	
		$this->db->where('id', $id);
		$this->db->update('klient', $plan);
	
		if($this->db->affected_rows()>0){
			return true;
		}
	
		else return false;
	}
	
	//funckija koja prima id na klient i podatoci za procenka i ja dodava procenkata za klientot so toa id.
	public function dodadi_procenka($id, $procenka){
	
		$this->db->where('id', $id);
		$this->db->update('klient', $procenka);
		
		if($this->db->affected_rows()>0){
			return true;
		}
	
		else return false;	
	}
	
	//funckija vo koja pristapuvam do baza vo tabelata klient_terapevt i dodavam so koj terapevt raboti klientot. Kako argument
	//dobivam id na klientot i lista od terapevti koi se odbrani.
	public function dodadi_terapevt_klient($id, $terapevti){
		$rows = array();
		
		foreach($terapevti as $t){
				
			$row = array(
					'id_klient' => $id,
					'id_terapevt' => $t
			);

			
			array_push($rows, $row);
		
		}
		
		if($this->db->insert_batch('klient_terapevt', $rows)){
			return true;
		}
		
		else return false;
		
	}
	
	public function dodadi_dnevno_sledenje($poseta) {
		if ($this->db->insert ( 'poseta', $poseta )) {
			return true;
		} else
			return false;
	}
	
	public function dodadi_evaluacija($evaluacija) {
		if ($this->db->insert ( 'evaluacija', $evaluacija )) {
			return true;
		} else
			return false;
	}
	//---------------------------------------------------------
	//funckii za edit
	
	//funckija vo koja kako argument dobivam id na klient i plan i treba da pristapam do baza i da napravam promeni vo planot.
	//************************************************
	//mozebi moze da mi e istata funckija so dodadi_plan, treba da razmislam za affected rows
	public function edit_plan($id_klient, $plan){
	
		$this->db->where('id', $id_klient);
	
		if($this->db->update('klient', $plan)){
			return true;
		}
	
		else return false;
	
	}
	
	//funckija vo koja kako argument dobivam id na klient i procenka i treba da pristapam do baza i da napravam promeni vo procenkata
	//za toj klient.
	public function edit_procenka($id_klient, $procenka){
		
		$this->db->where('id', $id_klient);
		
		if($this->db->update('klient', $procenka)){
			return true;
		}
		
		else return false;
		
		
	}
	
	//funckija koja ja koristam za da napravam uspesen edit na terapevtite za klientot. Vo ovaa funckija gi brisam site
	//terapevti za klientot cie id go dobivam kako argument.
	public function brisi_terapevti_klient($id_klient){
		//**************************************************
		//nemam uslov za affected rows bidejki mozno e nikogas da ne sum imal terapevt za deteto, pa vo toj slucaj nema voopsto da se
		//izbrise nisto od baza.
		if($this->db->delete('klient_terapevt', array('id_klient' => $id_klient))){
			return true;
		}
	
		else return false;
	
	}
	
	
	public function update_dnevno_sledenje($data, $id) {
		$this->db->where ( 'id_poseta', $id );
		$result = $this->db->update ( 'poseta', $data );
		return $result;
	}
	
	public function update_evaluacija($evaluacija, $id) {
		$this->db->where ( 'id_evaluacija', $id );
		$result = $this->db->update ( 'evaluacija', $evaluacija );
		return $result;
	}
}

?>