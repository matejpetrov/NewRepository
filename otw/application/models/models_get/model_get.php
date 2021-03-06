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
	
	public function get_poprecenosti_klient($klient_id){
	
		$this->db->select('tip_poprecenost');
			
		$query_poprecenost = $this->db->get_where('korisnik_poprecenost', array('klient_id' => $klient_id));
			
		$array_poprecenost = array();
			
		foreach($query_poprecenost->result() as $row){
			array_push($array_poprecenost, $row->tip_poprecenost);
		}
	
		return $array_poprecenost;
	
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
		

	/*	$rez=$this->db->query("SELECT k.ime_prezime, k.datum_na_procenka, k.motorika, k.kognitivni_spos, k.govor_komunikacija, k.pismenost,
				k.odnesuvanje, k.rizici, k.opkruzuvanje, k.interesi, k.kompjuterski_vestini, k.nastavnik, v.ime_prezime as vraboten_ime_prezime, n.nastavnik_ime_prezime
				FROM klient k, vraboten v, nastavnik n
				WHERE k.procenka_napravil = v.id AND n.id_nastavnik = k.nastavnik AND k.id='" .$id_klient. "'" 
				
				);
		
		$this->db->from('klient k');
		
		$this->db->join('vraboten v', 'k.procenka_napravil = v.id');
		
		$this->db->join('nastavnik n', 'n.id_nastavnik = k.nastavnik');
		
		$this->db->where('k.id', $id_klient);
		
		$query = $this->db->get();
		
		*/
		//print_r($rez);
		
		

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



	public function get_evaluacija_korisnik_info($id) {
		$result = $this->db->query ( "SELECT k.raboti_so, v.id, k.id, k.ime_prezime as klient, k.kratkorocni_celi,v.ime_prezime as vraboten
				FROM klient k,vraboten v
				WHERE k.raboti_so = v.id AND k.id='" . $id . "'" );
	
		$data1 = $result->row ();
		$data = ( array ) $data1;
		
		
		return $data;
	}
	
	public function get_evaluacija($id) {
		if ($result = $this->db->get_where ( 'evaluacija', array (
				'id_evaluacija' => $id
		) )) {
			$data1 = $result->row ();
			$data = ( array ) $data1;
			return $data;
		} else
			return false;
	}

	public function zemi_priem($id) {
		$this->db->select ( 'id, ime_prezime, datum_raganje, pol, adresa, majka, zanimanje_m, vraboten_m, tel_m, tatko, zanimanje_t, vraboten_t, tel_t, tip_poseta, tip_obrazovanie, datum_prva_poseta, upaten_od, primen_od,
			ocekuvanja_klient, ocekuvanja_roditel, komentar, raboti_so, datum_prva_poseta' );
		$result = $this->db->get_where ( 'klient', array (
				'id' => $id
		) );
		$res = ( array ) $result->row ();
	
		$this->db->select ( 'tip_poprecenost' );
		$result2 = $this->db->get_where ( 'korisnik_poprecenost', array (
				'klient_id' => $id
		) );
		$poprecenosti = array ();
		foreach ( $result2->result () as $row ) {
			$row1 = ( array ) $row;
			array_push ( $poprecenosti, $row1 ['tip_poprecenost'] );
		}
		$res ['poprecenosti'] = $poprecenosti;
		return $res;
	}
	
	public function site_evaluacii($klient) {
		$this->db->select ( 'id_evaluacija, klient_id, period, datum' );
		if ($result = $this->db->get_where ( 'evaluacija', array (
				'klient_id' => $klient
		) )) {
			$evaluacii = array ();
			foreach ( $result->result () as $row ) {
				$row1 = ( array ) $row;
				array_push ( $evaluacii, $row1 );
			}
			
			return $evaluacii;
		} else
			return false;
	}
	
	public function site_dnevni($klient) {
		$this->db->select ( 'id_poseta, klient_id, datum' );
		if ($result = $this->db->get_where ( 'poseta', array (
				'klient_id' => $klient
		) )) {
			$dnevni = array ();
			foreach ( $result->result () as $row ) {
				$row1 = ( array ) $row;
				array_push ( $dnevni, $row1 );
			}
			
			return $dnevni;
		} else
			return false;
	}

	public function get_klienti_za_lista(){
		//od klientot gi selektiram negovoto id, imeto i prezimeto, tipot na poseta vo otw i vraboteniot so koj raboti.
		$this->db->select('k.id, k.ime_prezime, k.tip_poseta, k.raboti_so, v.ime_prezime as raboti_so_ime');
		
		$this->db->from('klient k');
		
		$this->db->join('vraboten v', 'k.raboti_so = v.id');
		
		$query = $this->db->get();
	
		$result = array();
	
	
		//pristapuvam do sekoj klient koj e zemen od baza, i go zemam imeto na vraboteniot koj raboti so nego
		//za da mozam da go prikazam imeto, a ne negovoto id i isto taka pristapuvam.
		foreach ($query->result() as $row){
			$row1=(array)$row;
			$id=$row1['id'];
			$result[$id]=$row1;
			$result[$id]['poprecenosti']=$this->get_poprecenosti_klient($id);
		}
	/*
				
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
		 * 
		 */
		return $result;
	}
}

?>