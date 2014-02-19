<?php

class Model_klienti extends CI_Model{
		
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
	
	//funckija koja gi zema site nastavnici koi se dodadeni vo baza.
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
	
	//********************************************
	//treba da ja smestam vo model_get_drugi, i da smenam za stdObject convert da napravam
		
	//funkcija koja ke ja povikam koga ke sakam da ja prikazam listata od site klienti. Tuka ke pristapam do baza i ke 
	//gi zemam potrebnite informacii za prikaz na klient. Vnatre ke gi povikam funkcijata get_poprecenost_klient
	//i get_vraboten_za_klient za da gi zemam poprecenostite za klientot i vraboteniot koj raboti so nego.
	public function get_klienti_za_lista(){
		//od klientot gi selektiram negovoto id, imeto i prezimeto, tipot na poseta vo otw i vraboteniot so koj raboti.
		$this->db->select('id, ime_prezime, tip_poseta, raboti_so');
		
		$query = $this->db->get('klient');
		
		$result = array();
		
		$pom = $query->result();
		
		//pristapuvam do sekoj klient koj e zemen od baza, i go zemam imeto na vraboteniot koj raboti so nego
		//za da mozam da go prikazam imeto, a ne negovoto id i isto taka pristapuvam.
		for($i=0;$i<sizeof($pom);$i++){
				
			
			$ime_vraboten = $this->get_vraboten_za_klient($pom[$i]->raboti_so);						

			$array_poprecenost = $this->get_poprecenosti_klient($pom[$i]->id);
			
			//dokolku imame poveke od edna poprecenost, togas treba da prikazeme, kombinirana, no sepak ke gi zacuvame
			//za da mozeme da gi prikazeme tocno koi poveke se selektirani.
			if(count($array_poprecenost) > 1){
				$poprecenost = "комбинирана";
			}
			else if(count($array_poprecenost) == 1){
				$poprecenost = $array_poprecenost;
			}
				
			//ovoj uslov e malku glupav, bidejki mora da imam selektirano poprecenost, inaku nema da ima potreba klientot
			//da doaga vo ustanovata. Razmilsi go malku
			//*********************************************************
			else if(count($array_poprecenost) == 0){
				$poprecenost = '/';
			}
			
			//dodavam nov atribut vo stdObject
			$pom[$i]->ime_vraboten = $ime_vraboten;
			
			//dodavam uste dva atributi, eden ke gi sodrzi originalnite poprecenosti, a vtoriot dokolku ima poveke ke bide
			//kombiniranata, vo sprotivnoke bide istata kako originalnata poprecenost
			$pom[$i]->poprecenost = $poprecenost;
			
				
			//bidejki zemam cel red od baza, kako rezultat mi se vraka stdObject, instanca od stdClass.
			//Vsusnost jas vo array-ot result ke imam lista od objekti, koi moze da gi pristapam kako obicen clen vo lista
			//a potoa so upotreba na -> da pristapam i do nekoe svojstvo od samiot objekt, svojstvata se vsusnost
			//redovite od baza. Pr: $result[0]->terapevt_ime_prezime.
			array_push($result, $pom[$i]);
		}
		
		//vrakam array od site klienti, so del od informaciite.
		return $result;
	}
	
	//****************************************************
	//treba isto taka da ja prefrlam vo model_get_drugi
	
	//funkcija koja isto taka ke ja povikuvam koga ke treba da ja prikazam listata od klienti na pocetok. Tuka ke pristapam do 
	//baza vo tabelata korisnik_poprecenost i ke gi zemam site poprecenosti za sekoj korisnik. Dokolku nekoj korisnik ima 
	//poveke od edna poprecenost, togas namesto da prikazam poveke, jas ke napisam KOMBINIRANA poprecenost.
	public function get_poprecenosti_klient($klient_id){
		
		$this->db->select('tip_poprecenost');
			
		$query_poprecenost = $this->db->get_where('korisnik_poprecenost', array('klient_id' => $klient_id));
			
		$array_poprecenost = array();
			
		foreach($query_poprecenost->result() as $row){
			array_push($array_poprecenost, $row->tip_poprecenost);
		}					
		
		return $array_poprecenost;
		
	}
	
	//funckija vo koja ke pristapam do baza za klientot cie id go dobivam kako argument ke go zemam imeto na vraboteniot
	//koj raboti so nego i ke go vratam kako rezultat od funckijata
	public function get_vraboten_za_klient($vraboten_id){
		
		$this->db->select('ime_prezime');
		
		$query_vraboten = $this->db->get_where('vraboten', array('id' => $vraboten_id));
		
		//imam eden red, no sakam da go zemam kako posebna promenliva, a ne kako array, pa zatoa go izminuvam
		foreach($query_vraboten->result() as $row){
			$ime_vraboten = $row->ime_prezime;
		}

		return $ime_vraboten;
											
	} 

	
	
	
	//funkcija vo koja ke gi zemam site informacii za klientot, i potoa zavisno koj view treba da mi se prikaze 
	//ke gi prikazam samo potrebnite informacii, a pritoa koristam konvertiranje od stdClass vo array, za da mozam 
	//poednostavno da gi pristapam informaciite vo controller-ot i view-to.
	public function get_klient_info($id){
		
		$query = $this->db->get_where('klient', array('id' => $id));
		
		
		foreach($query->result() as $row){
			$pom = $row;
		}
		
		$result = (array)$pom;
		
		return $result; 
		
	}
	
	
	//Vo ovoj del mi se funkciite za dodavanje vo baza.
	
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
	
	//funkcija vo koja za korisnikot so prosledenoto id gi dodavame site poprecenosti koi gi 
	//ima vo baza.
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


	public function dodadi_procenka($id, $procenka){
		
		$this->db->where('id', $id);		
		
		if($this->db->update('klient', $procenka)){
			return true;
		}
		
		else return false;
		
	}

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
	
	public function dodadi_plan($id, $plan){
		
		$this->db->where('id', $id);
		$this->db->update('klient', $plan);
		
		if($this->db->affected_rows()>0){
			return true;
		}
		
		else return false;
	}
	
	
	
	
}

?>