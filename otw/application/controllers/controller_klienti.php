<?php

class Controller_klienti extends CI_Controller{			
	
	public function index(){
		$this->view_dodadi_plan();
	}
	
	public function view_dodadi_korisnik(){
		
		$denovi = array();
		$meseci = array();
		$godini = array();
		$godiniPriem = array();
		$pol = array();
		
		$denovi[0] = "-";
		for($i=1;$i<=31;$i++){
			array_push($denovi, $i);
		}
		
		$meseci[0] = "-";
		$meseci[1] = "Јануари";
		$meseci[2] = "Февруари";
		$meseci[3] = "Март";
		$meseci[4] = "Април";
		$meseci[5] = "Мај";
		$meseci[6] = "Јуни";
		$meseci[7] = "Јули";
		$meseci[8] = "Август";
		$meseci[9] = "Септември";
		$meseci[10] = "Октомври";
		$meseci[11] = "Ноември";
		$meseci[12] = "Декември";
		
		
		$tekovenDatum = date('d-m-Y');
		
		$tekovnaGodina = date('Y');
		$godini[0] = "-";
		for($j=1960;$j<$tekovnaGodina;$j++){
			$godini[$j] = $j;
		}
		
		for($k=$tekovnaGodina;$k<1960;$k--){
			array_push($godiniPriem, $k);
		}
		
		
		$pol[0] = 'м';
		$pol[1] = 'ж';
		
		$poprecenosti = $this->get_poprecenosti();
		
		
		$obrazovanie = $this->get_obrazovanie();
		
		$pom = array_unshift($obrazovanie, "-");
		
		$poseta = $this->get_tipPoseta();
		
		$pom = array_unshift($poseta, "-");
		
		$data['vraboteni'] = $this->get_vraboteni();
		
		$data['poprecenosti'] = $poprecenosti;
		
		$data['obrazovanie'] = $obrazovanie;
		
		$data['poseta'] = $poseta;
		
		$data['tekovenDatum'] = $tekovenDatum;
		$data['denovi'] = $denovi;
		$data['meseci'] = $meseci;
		$data['godini'] = $godini;
		$data['godiniPriem'] = $godiniPriem;
		$data['pol'] = $pol;
		
		$data['errors'] = "";
		
		$this->load->view('view_dodadi_klient_osnovni', $data);
	}
	
	public function view_dodadi_procenka(){
					
		$data_checkbox['terapevti'] = $this->get_terapevti();
		
		$data['terapevti'] = $this->load->view('view_checkbox_terapevti', $data_checkbox, TRUE);
		
		$data['nastavnici'] = $this->get_nastavnici();
		
		$data['vraboteni'] = $this->get_vraboteni();
		
		$data['institucii'] = $this->get_institucii();
		
		$den = date('d');
		$mesec = date('m');
		$godina = date('Y');
		
		$tekovenDatum = $godina."-".$mesec."-".$den;
		
		$data['tekovenDatum'] = $tekovenDatum;
		
		$data['errors'] = '';
			
		$this->load->view('view_dodadi_procenka_klient', $data);
	}
	
	public function view_dodadi_plan(){
		
		$data['vraboteni'] = $this->get_vraboteni();
		
		$den = date('d');
		$mesec = date('m');
		$godina = date('Y');
		
		$tekovenDatum = $godina."-".$mesec."-".$den;
			
		$data['tekovenDatum'] = $tekovenDatum;
		
		$data['errors'] = '';
			
		$this->load->view('view_dodadi_plan', $data);
	}
	
	public function view_lista_klienti(){
		
		//gi dobivam site klienti so del od nivnite informacii.
		$klienti = $this->get_klienti();				
		
		$data['errors'] = '';
		$data['klienti'] = $klienti;
		
		$this->load->view('view_lista_klienti', $data);
	} 
		
	
	
	public function dodadi_klient(){
						
		$this->load->model('model_klienti');
		
		
		foreach($_POST as $key => $value){
			$post[$key] = $value;
		}
		
		
		$den = $post['denovi'];
		$mesec = $post['meseci'];
		$godina = $post['godini'];
		
		$datum_raganje = $godina."-".$mesec."-".$den;
		
		
		//tuka ke gi dobijam rezultatite od selektiranjeto na checkbox polinjata.
		//vsusnost promenlivata poprecenosti e pole, od selektirani vrednosti. Ova treba
		//da go dodadam vo baza vo tabelata korisnik_poprecenost.	
		$data['poprecenosti'] = $post['poprecenosti'];
		
		$pol = -1;
		
		if($post['pol'] == 0){
			$pol = 0;
		}
		
		else if($post['pol'] == 1){
			$pol = 1;
		}
		
		$klient = array(
			
			'ime_prezime' => $post['ime_prezime'],//****************
			'datum_raganje' => $datum_raganje,
				
			//$pol dobiva vrednost od $post['pol'], ako e 1 togas e masko i vo baza ke e 0, ako e 2 togas e zensko i vo baza e 1.
			'pol' => $pol,
			'adresa' => $post['adresa'],
			'majka' => $post['majka'],
			'zanimanje_m' => $post['zanimanje_m'],
			'vraboten_m' => $post['vraboten_m'],
			'tel_m' => $post['tel_m'],
			'tatko' => $post['tatko'],
			'zanimanje_t' => $post['zanimanje_t'],
			'vraboten_t' => $post['vraboten_t'],
			'tel_t' => $post['tel_t'],
			'tip_poseta' => $post['poseta'],//****************
			'tip_obrazovanie' => $post['obrazovanie'],
			'upaten_od' => $post['upaten_od'],
			'primen_od' => $post['vraboteni'],
			'ocekuvanja_klient' => $post['ocekuvanja_klient'],
			'ocekuvanja_roditel' => $post['ocekuvanja_roditel'],
			'komentar' => $post['komentar'],	
			'datum_prva_poseta' => $post['datum_prva_poseta'],
			'raboti_so' => $post['raboti_so']//****************
		);
		
		$id = $this->model_klienti->dodadi_klient($klient);	
			
		if($id != false){	
			
			//dokolku korisnikot e uspesno dodaden, togas ke probam da dodadam i 
			//poprecenost za istiot. Kako argumenti na ovaa nova funkcija 
			//gi davam id-to na toj korisnik i site selektirani poprecenosti			
			if($this->model_klienti->dodadi_poprecenost($id, $post['poprecenosti'])){
				//gi dobivam site podatoci koi gi vnel klientot i mu gi prakam na kontrolerot.
				$data['podatoci_klient'] = $klient;
				
				$this->load->view('view_klient_profil', $data);
			}
			else {
				$data['errors'] = "Попреченостите не може да се додадат во базата, 
						ве молиме пробајте подоцна";
					
				//*******************************************************
				//treba ova da go smenam da ne mi prenasocuva na istata stranica
				$this->load->view('view_dodadi_klient_osnovni', $data);
			}			
						
		}
		
		else{
			$data['errors'] = "Клиентот не беше успешно додаден, ве молиме пробајте подоцна";
			
			$this->load->view('view_dodadi_klient_osnovni', $data);
		}	
				
	}

		
	//funkcija so koja ke ja dodadam procenkata za korisnikot, no mora da razmislime
	//kako da se prati id-to za da znaeme za koj korisnik se raboti.
	public function dodadi_procenka_klient($id_klient){
			
		$this->load->model('model_klienti');
		
		foreach($_POST as $key => $value){
			$post[$key] = $value;
		}
		
		$procenka = array(
				'procenka_napravil' => 	$post['vraboteni'],
				'datum_na_procenka' => $post['datum_procenka'],
				'motorika' => $post['motorika'],
				'kognitivni_spos' => $post['kognitivni_spos'],
				'govor_komunikacija' => $post['govor_komunikacija'],
				'pismenost' => $post['pismenost'],
				'odnesuvanje' => $post['odnesuvanje'],
				'rizici' => $post['rizici'],
				'opkruzuvanje' => $post['opkruzuvanje'],
				'interesi' => $post['interesi'],
				'kompjuterski_vestini' => $post['kompjuterski_vestini']
				//treba da se dodade i promenliva vraboten, dokolku klientot raboti vo nekoja firma.
		);
		
		//gi dodavam vo nastavnici i terapevti vo poleto koe go koristam za dodavanje vo baza, samo dokolku se selektirani,
		//vo sprotivno go prakam poleto bez niv. Ova go pravam za da se zastitam od slucajot koga ne sum selektiral
		//nastavik ili terapevt, da mi se dodadat ostanatite podatoci uspesno, pa podocna pri editiranje moze da gi dodadam.
		if(isset($post['nastavnici'])){
			$procenka['nastavnik'] = $post['nastavnici'];
		}
		
		
		//dokolku uspesno sum gi dodal osnovnite podatoci od procenka, treba da proveram dali sum dodal terapevt i dokolku da
		//i nego da go dodadam vo baza vo tabelata klient_terapevt.
		if($this->model_klienti->dodadi_procenka($id_klient, $procenka)){
				
			//dodavam terapevt samo dokolku e selektiran, i samo dokolku pred toa uspesno sum gi dodal ostanatite 
			//informacii za procenka, bidejki dokolku tie ne se uspesno vneseni ne treba da go vnesuvam nitu selektiraniot
			//terapevt.
			if(isset($post['terapevti'])){
		
				//dokolku uspesno go dodadam i terapevtot togas prenasocuvam na novata strana.
				if($this->model_klienti->dodadi_terapevt_klient($id_klient, $post['terapevti'])){
					$data['podatoci_klient'] = $procenka." plus dodadov i terapevt";
		
					$this->load->view('view_klient_profil', $data);
				}
		
				//dokolku terapevtite ne se uspesno dodadeni davam signalizacija za toa.
				//****************************************************************
				//ova treba da go smenam, mislam sepak da se prenasoci na nekoja druga strana.
				else{
					$data['errors'] = "Terapevtite ne bea uspesno dodadeni, ve molime probajte podocna";
						
					$this->load->view('view_dodadi_procenka_klient', $data);
				}
			}
				
			//dokolku pak vo momentov nemame selektirano terapevt, togas ke treba vednas da prenasocam na drugata strana
			else{
				$data['podatoci_klient'] = $procenka." ne dodavam terapevt, tuku samo osnovni podatoci za procenka";
		
				$this->load->view('view_klient_profil', $data);
			}
				
				
		}
		
		//dokolku osnovnite podatoci za procenka ne se uspesno vneseni vo baza treba toa da go signaliziram
		else{
			$data['errors'] = "Osnovnite podatoci za procenka ne bea uspesno dodadeni, ve molime probajte podocna";
				
			$this->load->view('view_dodadi_procenka_klient', $data);
		}	
		
	}
		


	
	public function dodadi_plan_klient($id_klient){
		
		$this->load->model('model_klienti');
		
		foreach($_POST as $key => $value){
			$post[$key] = $value;
		}
		
		
		$plan = array(
			'dolgorocni_celi' => $post['dolgorocni_celi'],
			'kratkorocni_celi' => $post['kratkorocni_celi'],
			'uredi_softver' => $post['uredi_softver'],
			'metodi_frekvencija' => $post['metodi_frekvencija'],
			'ocekuvani_rezultati' => $post['ocekuvani_rezultati'],
			'planirana_evaluacija_postaveni_celi' => $post['planirana_evaluacija_postaveni_celi'],
			'plan_napravil' => $post['vraboteni'],				 
			'datum_plan' => $post['datum_plan']
		);
		
		
		if($this->model_klienti->dodadi_plan($id_klient, $plan)){
			$data['podatoci_klient'] = $plan;
			
			$this->load->view('view_klient_profil', $data);
		}
		
		else{
			$data['errors'] = "Во моментов не планот за корисникот не може да се додаде, ве молиме пробајте подоцна";
			
			$this->load->view('view_dodadi_plan', $data);
		}
		
		
	}
	
	//vo ovaa funkcija dodavam vo evaluacija tabela vo baza, a tamu ke go smestam id-to na korisnikot za koj se odnesuva 
	//ovaa evaluacija.
	public function dodadi_evaluacija_klient($id_klient){
		
	} 
	
	public function dodadi_dnevno_sledenje_klient($id_klient){
		
	}
	
	//funkcija preku koja ke povikam metod od model za terapevti i potoa ke vnesam nov terapevt vo baza.
	public function dodadi_nov_terapevt(){

		$this->load->model('model_terapevti');
		
		$terapevt_ime_prezime = $_POST['ime_prezime'];
		$mail = $_POST['mail'];
		$telefon = $_POST['telefon'];
		$institucija = $_POST['institucii'];
			
		$terapevt = array(
				'terapevt_ime_prezime' => $terapevt_ime_prezime,
				'institucija' => $institucija,
				'mail' => $mail,
				'telefon' => $telefon
		);
			
		//dokolku uspesno e dodaden noviot terapevt, ke treba da ja povikam funkcijata terapevt, vo koja povtorno ke
		//ja prikazam listata od terapevti.
		if($this->model_terapevti->dodadi_nov_terapevt($terapevt)){
			
			$terapevti = $this->get_terapevti();

			$data['terapevti'] = $terapevti;
			
			$this->load->view('view_checkbox_terapevti', $data);
		}
			
		//dokolku pak ne e uspesno dodaden ke treba da prenasocam na istata strana, no signaliziram deka ima greska,
		//vo view ke se prikaze greskata zaradi koja ne uspealo dodavanjeto
			
		else{
				
			$this->load->view('view_proba');
				
			$errors = 'Во моментов не може да се додаде нов терапевт, ве молиме пробајте подоцна';
			$data = $this->terapevti($errors);
				
			$this->load->view('view_terapevti', $data);
				
		}
	}
	

	//funkcija preku koja ke kreiram array od vrednosti i potoa ke povikam funkcija od model i ke vnesam nova institucija 
	//vo baza.
	public function dodadi_nova_institucija(){
		
		$ime_institucija = $_POST['ime_institucija'];
		
		$institucija = array('ime_institucija' => $ime_institucija);
		
		$this->load->model('model_terapevti');
		
		//dokolku uspesno ja vnesam institucijata davam izvestuvanje za toa.
		if($this->model_terapevti->dodadi_nova_institucija($institucija)){
			$data['errors'] = "Uspesno dodadov nova institucija";
			
			$this->load->view('view_dodadi_institucija', $data);
			
		}
		else{
			
			$errors = "Neuspesno dodadov nova institucija";
				
			$this->load->view('view_dodadi_institucija', $data);
			
		}
		
	} 
	
	//ovaa mi e funkcija vo koja go povikucam view-to view_terapevti kade mi se pojavuva tabela vo koja se smesteni site 
	//dosega vneseni terapevti, moznost za editiranje na sekoj terapevt postoi, i moznost za vnesuvanje na nov terapevt
	//postoi.
	public function terapevti($errors){
		
		$terapevti = $this->get_terapevti_everything();
		
		$institucii = $this->get_institucii();
		
		//dodavam / za vo prikazot na telefon i mail dokolku se prazni da ne se prikaze null ili prazno, tuku /, sto znaci deka
		//nemaat vneseno.		
		for($i=0;$i<sizeof($terapevti);$i++){						
			
			if($terapevti[$i]->mail==NULL){
				$terapevti[$i]->mail = "/";
			}
			
			if($terapevti[$i]->telefon==NULL){
				$terapevti[$i]->telefon = "/";
			}
			
		}
		
		$data['terapevti'] = $terapevti;
		$data['institucii'] = $institucii;						
		$data['errors'] = $errors;				
		
		return $data;
	}

	
	public function nastavnici(){
		
		
		
		$this->load->view('view_nastavnici');
	}

	//funkcija vo koja ke prikazeme strana so osnovnite informacii za eden klient cie id go davam kako argument na
	//funckijata. Tuka ke pristapam do baza i ke gi zemam osnovnite informacii za klientot, a vo samata strana 
	//ke imam kopcinja koi ke me nosat do 
	public function klient_profil($id){
		
		$this->load->model('model_klienti');
		
		$klient = $this->model_klienti->get_klient_info($id);
		
		$poprecenosti = array();
		
		//dobivam lista od site poprecenosti kako rezultat
		$poprecenosti = $this->model_klienti->get_poprecenosti_klient($id);

		//ke dobijam ime na vraboten so koj sto raboti klientot.
		$ime_vraboten = $this->model_klienti->get_vraboten_za_klient($id);
		
		$data['klient'] = $klient;
		
		$data['id'] = $id;
		
		$data['poprecenosti'] = $poprecenosti;
		
		$data['ime_vraboten'] = $ime_vraboten;
		
		$this->load->view('view_klient_profil', $data);
		
	} 

	
	public function get_vraboteni(){
		$this->load->model('model_vraboteni');
		$result = $this->model_vraboteni->get_vraboteni();
		
		return $result;
	}
	
	public function get_poprecenosti(){
		$this->load->model('model_klienti');
		$result = $this->model_klienti->get_poprecenosti();
		
		return $result;
	}
	
	public function get_obrazovanie(){
		$this->load->model('model_klienti');
		$result = $this->model_klienti->get_obrazovanie();
		
		return $result;
	}
	
	public function get_tipPoseta(){
		$this->load->model('model_klienti');
		$result = $this->model_klienti->get_tipPoseta();
		
		return $result;
	}
		
	public function get_terapevti(){
		
		$this->load->model('model_terapevti');
		$result = $this->model_terapevti->get_terapevti();
		
		return $result;
	}

	public function get_terapevti_everything(){
		
		$this->load->model('model_terapevti');
		
		$result = $this->model_terapevti->get_terapevti_everything();
		
		return $result;
	}
	
	public function get_nastavnici(){
		$this->load->model('model_klienti');
		
		$result = $this->model_klienti->get_nastavnici();
		
		return $result;
	}
	
	public function get_institucii(){
		$this->load->model('model_klienti');
		
		$result = $this->model_klienti->get_institucii();
		
		return $result;
	}	
	
	//funkcija vo koja gi zemam site klienti od baza, so del od informaciite za potoa da gi prikazam vo lista.
	public function get_klienti(){
		$this->load->model('model_klienti');
		
		$result = $this->model_klienti->get_klienti_za_lista();
		
		return $result;
		
	}
	
}


?>