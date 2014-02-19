<?php

class Controller_klienti_add extends CI_Controller{
	
	
	public function index(){
		
	}
	
	//funkcija vo koja se dodavaat osnovnite podatoci za nekoj nov klient, odnosno podatocite od formular za priem.
	//Tuka dodavam i vo tabelata korisnik_poprecenost za da gi vnesam site poprecenosti koi gi ima kaj noviot korisnik.
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
	
		//proveruvam ovoj povik da ne e napraven od drugo kopce od Dodadi procenka.
	
		//dokolku e pritisnato kopceto dodadiTerapevt ke treba da prenasocam na nova strana kade ke imam lista od
		//terapevti, moznost za editiranje na sekoj od niv i plus moznost da se dodade nov terapevt.
		//******************************************************* treba da go trgnam ova bidejki na klik na toa kopce
		//ke mi se otvori popup vo koj ke mozam samo da dodavam terapevt, a ke imam drug view vo koj ke gi prikazam
		//site terapevti i ke ovozmozam promena na nivnite podatoci
		if(isset($_POST['dodadiTerapevt'])){
	
			$errors = "";
			$data = $this->terapevti($errors);
			$this->load->view('view_terapevti', $data);
			return;
		}
	
		else if(isset($_POST['dodadiNastavnik'])){
				
			$this->nastavnici();
		}
	
		else{
				
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
				$procenka['nastavnici'] = $post['nastavnici'];
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
	
	
	
	}
	
	
	//funckija vo koja dodavam plan za korisnik cie id go dobivam kako argument.
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
	
	
	
	
}

?>