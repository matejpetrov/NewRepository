<?php

//controller vo koj ke se spravuvam so prikaz, edit i dodavanje na site formi koi sodrzat informacii za klientot. 


class Controller_klienti_main extends CI_Controller{
	
	public function index(){
		$this->view_prikaz_procenka(1);
	}
	
	//----------------------------------------------------------------------------------------------------------------------------
	//views za dodavanje
	
	//funckija vo koja gi zemam site potrebni informacii koi mu trebaat na view-to za da se prikaze formata za priem. 	
	public function view_dodadi_korisnik(){
	
		$data=$this->get_denovi_meseci();
		
	
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
		
		$data['pol'] = $pol;
	
		$data['errors'] = "";
	
		$this->load->view('views_content/views_dodavanje/view_dodadi_klient_osnovni', $data);
	}
		
	//funckija vo koja gi zemam podatocite vneseni vo formata za priem i dodavam nov klient vo bazata. Ke pristapam do 
	//models_add/model_add_formulari
	public function dodadi_klient(){
	
		$this->load->model('models_post/model_post_formulari', 'model');
	
		
		foreach($_POST as $key => $value){
			$post[$key] = $value;
		}
	
	
		$den = $post['denovi'];
		$mesec = $post['meseci'];
		$godina = $post['godini'];
	
		//go mestam vo soodvetniot format
		$datum_raganje = $godina."-".$mesec."-".$den;
	
		$pom = explode("-", $post['datum_prva_poseta']);
		
		$datum_prva_poseta = $pom[2]."-".$pom[1]."-".$pom[0];
	
		//tuka ke gi dobijam rezultatite od selektiranjeto na checkbox polinjata.
		//vsusnost promenlivata poprecenosti e pole, od selektirani vrednosti. Ova treba
		//da go dodadam vo baza vo tabelata korisnik_poprecenost.
		$data['poprecenosti'] = $post['poprecenosti'];
	
		//dokolku ne e setirana nitu edna vrednost vo baza ke se smesti -1, treba da probam dali ke uspee toa, da ne padne.		
		$pol = NULL;
	
		if($post['pol'] == 0){
			$pol = 0;
		}
	
		else if($post['pol'] == 1){
			$pol = 1;
		}
	
		$klient = array(
					
				'ime_prezime' => $post['ime_prezime'],
				'datum_raganje' => $datum_raganje,
	
				//$pol dobiva vrednost od $post['pol'], ako e 0 togas e masko i vo baza ke e 0, ako e 1 togas e zensko i vo baza e 1.
				//
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
				'datum_prva_poseta' => $datum_prva_poseta,
				'raboti_so' => $post['raboti_so']//****************
		);
	
		$id = $this->model->dodadi_klient($klient);
			
		if($id != false){
				
			//dokolku korisnikot e uspesno dodaden, togas ke probam da dodadam i
			//poprecenost za istiot. Kako argumenti na ovaa nova funkcija
			//gi davam id-to na toj korisnik i site selektirani poprecenosti
			if($this->model->dodadi_poprecenost($id, $post['poprecenosti'])){
				//gi dobivam site podatoci koi gi vnel klientot i mu gi prakam na kontrolerot.
				$data['podatoci_klient'] = $klient;
	
				$this->load->view('views_content/views_dodavanje/view_klient_profil', $data);
			}
			else {
				$data['errors'] = "Попреченостите не може да се додадат во базата,
						ве молиме пробајте подоцна";
					
				//*******************************************************
				//treba ova da go smenam da ne mi prenasocuva na istata stranica
				$this->load->view('views_content/views_dodavanje/view_dodadi_klient_osnovni', $data);
			}
	
		}
	
		else{
			$data['errors'] = "Клиентот не беше успешно додаден, ве молиме пробајте подоцна";
				
			$this->load->view('views_content/views_dodavanje/view_dodadi_klient_osnovni', $data);
		}
	
	}

	
	//funckija vo koja gi zemam site potrebni informacii koi mu trebaat na view-toza da se prikaze formata za individualen plan
	public function view_dodadi_plan(){
		
		
		$data['vraboteni'] = $this->get_vraboteni();
		
		$den = date('d');
		$mesec = date('m');
		$godina = date('Y');
		
		$tekovenDatum = $godina."-".$mesec."-".$den;
			
		$data['tekovenDatum'] = $tekovenDatum;
		
		$data['errors'] = '';
			
		$this->load->view('views_content/views_dodavanje/view_dodadi_plan', $data);
	}
	
	//funckija vo koja gi zemam podatocite vneseni vo formata za dodavanje na plan i istiot go dodavam vo bazata, za klientot
	//cie id go dobivam kako argument.
	//Ke pristapam do models_add/model_add_formulari		
	public function dodadi_plan_klient($id_klient){
	
		$this->load->model('models_post/model_post_formulari', 'model');
	
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
	
	
		if($this->model->dodadi_plan($id_klient, $plan)){
			$data['podatoci_klient'] = $plan;
				
			$this->load->view('views_content/views_dodavanje/view_klient_profil', $data);
		}
	
		else{
			$data['errors'] = "Во моментов не планот за корисникот не може да се додаде, ве молиме пробајте подоцна";
				
			$this->load->view('views_content/views_dodavanje/view_dodadi_plan', $data);
		}
	
	
	}

	//funckija vo koja gi zemam site potrebni informacii koi mu trebaat na view-to za da se prikaze formata za dodavanje na 
	//procenka.
	public function view_dodadi_procenka(){
					
		$data_checkbox['terapevti'] = $this->get_terapevti();
		
		$data['terapevti'] = $this->load->view('views_content/views_dodavanje/view_checkbox_list_terapevti', $data_checkbox, TRUE);
		
		$data['nastavnici'] = $this->get_nastavnici();
		
		$data['vraboteni'] = $this->get_vraboteni();
		
		//mi trebaat za da mozam da gi prikazam vo popup formata za dodavanje na nov terapevt.
		$data['institucii'] = $this->get_institucii();
		
		$den = date('d');
		$mesec = date('m');
		$godina = date('Y');
		
		$tekovenDatum = $godina."-".$mesec."-".$den;
		
		$data['tekovenDatum'] = $tekovenDatum;
		
		$data['errors'] = '';
			
		$this->load->view('views_content/views_dodavanje/view_dodadi_procenka', $data);
	}
	
	//funckija vo koja gi zemam podatocite vneseni vo formata za dodavanje na procenka i istata ja dodavam vo bazata, za klientot
	//cie id go dobivam kako argument.
	//Ke pristapam do models_add/model_add_formulari
	public function dodadi_procenka_klient($id_klient){
		$this->load->model('models_post/model_post_formulari', 'model');
		
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
		if($this->model->dodadi_procenka($id_klient, $procenka)){
		
			//dodavam terapevt samo dokolku e selektiran, i samo dokolku pred toa uspesno sum gi dodal ostanatite
			//informacii za procenka, bidejki dokolku tie ne se uspesno vneseni ne treba da go vnesuvam nitu selektiraniot
			//terapevt.
			if(isset($post['terapevti'])){
		
				//dokolku uspesno go dodadam i terapevtot togas prenasocuvam na novata strana.
				if($this->model->dodadi_terapevt_klient($id_klient, $post['terapevti'])){
					$data['podatoci_klient'] = $procenka." plus dodadov i terapevt";
		
					$this->load->view('views_content/views_dodavanje/view_klient_profil', $data);
				}
		
				//dokolku terapevtite ne se uspesno dodadeni davam signalizacija za toa.
				//****************************************************************
				//ova treba da go smenam, mislam sepak da se prenasoci na nekoja druga strana.
				else{
					$data['errors'] = "Terapevtite ne bea uspesno dodadeni, ve molime probajte podocna";
		
					$this->load->view('views_content/views_dodavanje/view_dodadi_procenka_klient', $data);
				}
			}
		
			//dokolku pak vo momentov nemame selektirano terapevt, togas ke treba vednas da prenasocam na drugata strana
			else{
				$data['podatoci_klient'] = $procenka." ne dodavam terapevt, tuku samo osnovni podatoci za procenka";
		
				$this->load->view('views_content/views_dodavanje/view_klient_profil', $data);
			}
		
		
		}
		
		//dokolku osnovnite podatoci za procenka ne se uspesno vneseni vo baza treba toa da go signaliziram
		else{
			$data['errors'] = "Osnovnite podatoci za procenka ne bea uspesno dodadeni, ve molime probajte podocna";
		
			$this->load->view('views_content/views_dodavanje/view_dodadi_procenka_klient', $data);
		}
	}
	
	public function view_dnevno_sledenje(){
		$data["errors"]="";
		$this->load->view ( 'views_content/views_dodavanje/view_dodadi_dnevno_sledenje', $data );
	}
	
	public function dnevno_sledenje() {
		foreach ( $_POST as $key => $value ) {
			$post [$key] = $this->input->post ( $key );
		}
		$date_den = $post ["data_den"];
		$date_mesec = $post ["data_mesec"];
		$date_godina = $post ["data_godina"];
		$cel = $post ["cel"];
		$realizacija = $post ["realizacija"];
		$postignuvanje = $post ["postignuvanje"];
		$poteskotii = $post ["poteskotii"];
		$plan_nareden_pat = $post ["plan"];
	
		// za fajlot podesuvanja
		$config ['upload_path'] = './dokumenti/';
		$config ['allowed_types'] = 'pdf|ppt|docx';
		$config ['max_size'] = '800';
	
		$this->load->library ( 'upload', $config );
		$field_name = "upload"; // od koj upload input da zeme default e userfile
	
		if (! empty ( $_FILES ['upload'] ['name'] )) { // prvo proverka dali e prazen zosto nemora da stavat fajlt
				
			if (! $this->upload->do_upload ( $field_name )) {
				// $data['errors']=array();
				$data ['errors'] = $this->upload->display_errors ();
	
				$this->load->view ( 'views_content/views_dodavanje/view_dodadi_dnevno_sledenje', $data );
				return;
			}
		}
		$upload_data = $this->upload->data ();
		$file = $upload_data ["file_name"];
		$datum = $date_godina . "-" . $date_mesec . "-" . $date_den;
		$poseta = array (
				'klient_id' => "1", // ova kje treba da se zema od query strin ili nesto
				'datum' => $datum,
				'cel' => $cel,
				'realizacija' => $realizacija,
				'postignuvanja' => $postignuvanje,
				'poteskotii' => $poteskotii,
				'plan_naredna_poseta' => $plan_nareden_pat,
				'file' => $file,
				'kategorija' => "kategorija"
		);
		$this->load->model ( "models_post/model_post_formulari", "model_klienti" );
	
		$result = $this->model_klienti->dodadi_dnevno_sledenje ( $poseta );
	
		if ($result) {
				
			$this->load->view ( 'view_profil' );
		} else {
			$data ['errors'] = "Имаше грешка во внесувањето на оваа посета. Ве молам обидете се повторно подоцна";
				
			$this->load->view ( 'views_content/views_dodavanje/view_dodadi_dnevno_sledenje', $data );
		}
	}
	
	public function view_dodadi_evaluacija($id_korisnik = '1') {
		$this->load->model ( 'models_get/model_get','model_klienti' );
		$data = $this->model_klienti->get_evaluacija_korisnik_info ( $id_korisnik );
		
		
	
		$vraboteni =$this->get_vraboteni();
		//print_r($vraboteni);
	
		$data ['vraboteni'] = $vraboteni;
		$data ['id_korisnik'] = $id_korisnik;
		$this->load->view ( 'views_content/views_dodavanje/view_dodadi_evaluacija', $data );
	}
	
	public function post_dodadi_evaluacija() {
		foreach ( $_POST as $key => $value ) {
			$post [$key] = $this->input->post ( $key );
		}
		// print_r($post);
		$korisnik = $post ['id_korisnik'];
		$period = $post ['period'];
		$evauliral = $post ['vraboteni'];
		$raboti_so = $post ['raboti_so'];
		$date_den = $post ["data_den"];
		$date_mesec = $post ["data_mesec"];
		$date_godina = $post ["data_godina"];
		$planirani = $post ["planirani"];
		$ostvareni_celi = $post ["ostvareni_celi"];
		$narativen = $post ["narativen"];
		$novi_celi = $post ["novi_celi"];
		$preporaki = $post ["preporaki"];
	
		$datum = $date_godina . "-" . $date_mesec . "-" . $date_den;
		$eval = array (
				'klient_id' => $korisnik,
				'period' => $period,
				'datum' => $datum,
				'evaluiral' => $evauliral,
				'planirani_celi' => $planirani,
				'ostvareni_celi' => $ostvareni_celi,
				'narativen_izvestaj' => $narativen,
				'novi_celi' => $novi_celi,
				'preporaki' => $preporaki
		);
	
		$this->load->model ( "models_post/model_post_formulari","model_klienti" );
		
	
		$result = $this->model_klienti->dodadi_evaluacija ( $eval );
	
		if ($result) {
				
			$this->load->view ( 'view_profil' );
		} else {
			$data ['errors'] = "Имаше грешка во внесувањето на оваа посета. Ве молам обидете се повторно подоцна";
				
			$this->load->view ( 'view_dodadi_evaluacija', $data );
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------
	//views za edit
	
	//funckija vo koja gi zemam site potrebni informacii koi mu trebaat na view-to za da se prikaze formata za edit na plan 
	//za klient cie id go dobivam kako parametar. Ke pristapam do model_get i tamu ke ja povikam funckijata get_plan
	public function view_edit_plan($id_klient){
		
		$this->load->model('models_get/model_get', 'model_get');
			
		$informacii_plan = $this->model_get->get_plan($id_klient);
			
		$data['vraboteni'] = $this->get_vraboteni();
		$data['informacii_plan'] = $informacii_plan;
		$data['id_klient'] = $id_klient;
		$data['errors'] = "";
		
		$var = $this->load->view('views_content/views_edit/view_edit_plan', $data,TRUE);
		return $var;
	}
		
	
	//funckija vo koja ke resam dali post-ot od edit stranata za plan dosol od pritiskanje na kopceto Otkazi ili Promeni plan. 
	//Dokolku e otkazi ke prenasocam vednas da mi se prikaze prikazot na planot, a vo sprotivno 
	//ke treba da napravam promeni i potoa da go prikazam prikazot na planot vo koj ovie promeni ke bidat evidentirani.
	public function edit_plan($id_klient){
		
		//vednas prenasocuvam na view-to za prikaz na planot za klientot.
		if(isset($_POST['otkazi'])){
			$this->view_prikaz_plan($id_klient);
		}
		
		//ja povikuvam funckijata vo koja ke napravam promeni za planot i potoa ke go prikazam view-to za prikaz na plan
		else if(isset($_POST['editPlan'])){
			$this->edit_plan_klient($id_klient);
		}
	}

	
	//funckija koja ke ja povikam od view_edit_plan, i vo koja ke treba da pratam pole od promenlivi na modelot koj ke gi napravi
	//promenite za planot za klientot cie id ke go dademe kako argument.
	public function edit_plan_klient($id_klient){
	
		$this->load->model('models_post/model_post_formulari', 'model');
	
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
	
		//dokolku uspesno napravam promeni na planot, togas ke prenasocam kon view-to vo koe ke go prikazam planot.
		if($this->model->edit_plan($id_klient, $plan)){
	
			//$this->view_prikaz_plan($id_klient);
			$this->prikaz_klienti($id_klient,$plan);
		}
	
		else{
			//povtorno vrakam na istiot view, so toa sto davam informacija deka nastanala greska.
			$data['informacii_plan'] = $plan;
			$data['errors'] = "Во моментов не може да се направат промени за планот, Ве молиме стиснете на Откажи ипробајте подоцна";
			
		
		}
	
	
	}
	
	
	//funckija vo koja gi zemam site potrebni informacii koi mu trebaat na view-to za da se prikaze formata za edit na procenka
	//za klient cie id go dobivam kako parametar. Ke pristapam do model_get i tamu ke ja povikam funckijata get_procenka
	public function view_edit_procenka($id_klient){
		
		$this->load->model('models_get/model_get', 'model');
			
		$informacii_procenka = $this->model->get_procenka($id_klient);
			
		$data_checkbox['site_terapevti'] = $this->get_terapevti();
			
		$data_checkbox['selektirani_terapevti'] = $informacii_procenka['terapevti'];
			
		$data['terapevti'] = $this->load->view('views_content/views_edit/view_edit_checkbox_list_terapevti', $data_checkbox, TRUE);
			
		$data['informacii_procenka'] = $informacii_procenka;
			
		$data['vraboteni'] = $this->get_vraboteni();
		
		$data['id_klient'] = $id_klient;
			
		$nastavnici = $this->get_nastavnici();
			
		$pom = array_unshift($nastavnici, "-");
			
		$data['nastavnici'] = $nastavnici;
		
		$data['errors'] = "";
			
		$var=$this->load->view('views_content/views_edit/view_edit_procenka', $data, TRUE);
		return $var;
		
	}

	
	//funckija vo koja ke resam dali post-ot od edit stranata za procenka dosol od pritiskanje na kopceto Otkazi ili Promeni procenka.
	//Dokolku e otkazi ke prenasocam vednas da mi se prikaze prikazot na procenkata, a vo sprotivno
	//ke treba da napravam promeni i potoa da go prikazam prikazot na procenkata vo koj ovie promeni ke bidat evidentirani.
	public function edit_procenka($id_klient){
		//vednas prenasocuvam na view-to za prikaz na planot za klientot.
		if(isset($_POST['otkazi'])){
			$this->view_prikaz_procenka($id_klient);
		}
		
		//ja povikuvam funckijata vo koja ke napravam promeni za planot i potoa ke go prikazam view-to za prikaz na plan
		else if(isset($_POST['editProcenka'])){
			$this->edit_procenka_klient($id_klient);
		}
	}

	
	//funckija koja ke ja povikam od view_edit_procenka, i vo koja prakam pole od promenlivi na modelot koj ke gi napravi
	//promenite za procenkata na klientot. Isto taka tuka ke treba da pristapam do baza za da gi smenam terapevtite za
	//klientot.
	//************************ Imam mnogu if uslovi, za uspesnost da proveram dali e kako sto treba.
	public function edit_procenka_klient($id_klient){
	
		$this->load->model('models_post/model_post_formulari', 'model');		
	
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
				'kompjuterski_vestini' => $post['kompjuterski_vestini'],
				'nastavnik' => $post['nastavnici']
				//treba da se dodade i promenliva vraboten, dokolku klientot raboti vo nekoja firma.
		);
	
	
		//dokolku uspesno sum gi editiral osnovnite podatoci od procenka, treba da proveram dali sum dodal terapevt i dokolku da
		//i nego da go dodadam vo baza vo tabelata klient_terapevt.
		if($this->model->edit_procenka($id_klient, $procenka)){
	
			//dokolku se setirani terapevtite vo post, togas treba da pristapam do baza, da gi izbrisam veke postoeckite
			//za tekovniot klient i da gi dodadam novite. Vo sprotiven slucaj jas ke treba samo da gi izbrisam site stavki
			//od klient_terapevt bidejki sum odselektiral se.
			if(isset($post['terapevti'])){
	
				//najprvin gi brisam prethodnite terapevti za toj klient od baza.
				if($this->model->brisi_terapevti_klient($id_klient)){
						
					//gi imam izbrisano site i vednas potoa povikuvam funckija od istiot model kade gi dodavam site terapevti za
					//toj klient.
					if($this->model->dodadi_terapevt_klient($id_klient, $post['terapevti'])){
						//uspesno sum gi dodal novite terapevti, treba da prenasocam na view kade ke napravam prikaz.
						//*************************************************
	
						$this->view_prikaz_procenka($id_klient);
	
					}
					else{
						//povtorno vrakam na istiot view, so toa sto davam informacija deka nastanala greska.
						$data['informacii_procenka'] = $procenka;
						$data['errors'] = "Имаше грешка при додавањето на новите терапевти, Ве молиме пробајте подоцна";
						
						$this->load->view('views_content/views_edit/view_edit_procenka', $data);
					}
						
				}
				else{					
					//povtorno vrakam na istiot view, so toa sto davam informacija deka nastanala greska.
					$data['informacii_procenka'] = $procenka;
					$data['errors'] = "Имаше грешка при бришење на терапевти, по кое бришење треба да следува додавање";
					
					$this->load->view('views_content/views_edit/view_edit_procenka', $data);
				}
	
	
			}
	
			//brisenje na site terapevti bidejki nemam selektirano nitu eden.
			else{
	
				if($this->model->brisi_terapevti_klient($id_klient)){
					//dokolku uspesno sum gi izbrisal site, vednas prenasocuvam na prikazot na procenkata za klientot.
					//**********************************************************
					$this->view_prikaz_procenka($id_klient);
				}
	
				else{
					$data['errors'] = "Greka pri delete po koj ne sledi dodavanje";
					//povtorno vrakam na istiot view, so toa sto davam informacija deka nastanala greska.
					$data['informacii_procenka'] = $procenka;
					$data['errors'] = "Имаше грешка при бришење на терапевти по кои не следува додавање на нови";
					
					$this->load->view('views_content/views_edit/view_edit_procenka', $data);
				}
	
			}
	
	
		}
	
		//dokolku osnovnite podatoci za procenka ne se uspesno vneseni vo baza treba toa da go signaliziram
		else{
			$data['errors'] = "Не можев успешно да направам промена на формата за проценка, Ве молиме притиснете на Откажи и 
					пробајте подоцна";
			$data['informacii_procenka'] = $procenka;
			
			$this->load->view('views_content/views_edit/view_edit_procenka', $data);
			
		}
	}
	
	public function edit_dnevno_sledenje($id = '1') {
		$this->load->model ( '/models_get/model_get','model_klienti' );
		$data = $this->model_klienti->get_dnevno_sledenje ( $id );
		
		$datum = explode ( "-", $data ['datum'] );
		$data ['year'] = $datum ['0'];
		$data ['month'] = $datum ['1'];
		$data ['day'] = $datum ['2'];
	
		$data ['errors'] = "";
		$data['id']=$id;
		$this->load->view ( 'views_content/views_edit/view_edit_dnevno_sledenje', $data );
		// echo $var;
	}

	public function post_edit_dnevno_sledenje($id = '1') {
		foreach ( $_POST as $key => $value ) {
			$post [$key] = $this->input->post ( $key );
		}
		$date_den = $post ["data_den"];
		$date_mesec = $post ["data_mesec"];
		$date_godina = $post ["data_godina"];
		$cel = $post ["cel"];
		$realizacija = $post ["realizacija"];
		$postignuvanje = $post ["postignuvanje"];
		$poteskotii = $post ["poteskotii"];
		$plan_nareden_pat = $post ["plan"];
	
		$config ['upload_path'] = './dokumenti/';
		$config ['allowed_types'] = 'pdf|ppt|docx';
		$config ['max_size'] = '800';
	
		$this->load->library ( 'upload', $config );
		$field_name = "upload"; // od koj upload input da zeme default e userfile
	
		if (! empty ( $_FILES ['upload'] ['name'] )) { // prvo proverka dali e prazen zosto nemora da stavat fajlt
				
			if (! $this->upload->do_upload ( $field_name )) {
				// $data['errors']=array();
				$data ['errors'] = $this->upload->display_errors ();
				// $this->load->view('view_edit_dnevno_sledenje', $data);
				return;
			}
		}
	
		$upload_data = $this->upload->data ();
		$file = $upload_data ["file_name"];
		$data ['file'] = $file;
		// $this->load->view('view_edit_dnevno_sledenje', $data);
	
		$datum = $date_godina . "-" . $date_mesec . "-" . $date_den;
		$poseta = array (
				'datum' => $datum,
				'cel' => $cel,
				'realizacija' => $realizacija,
				'postignuvanja' => $postignuvanje,
				'poteskotii' => $poteskotii,
				'plan_naredna_poseta' => $plan_nareden_pat,
				'file' => $file,
				'kategorija' => "kategorija"
		);
		$this->load->model ( "models_post/model_post_formulari","model_klienti" );
	
		$result = $this->model_klienti->update_dnevno_sledenje ( $poseta, $id );
	
		if ($result) {
				
			$this->load->view ( 'view_profil' );
		} else {
			$data ['errors'] = "Имаше грешка во внесувањето на оваа посета. Ве молам обидете се повторно подоцна";
				
			$this->load->view ( 'views_content/views_edit/view_edit_dnevno_sledenje', $data );
		}
	}
	
	public function edit_evaluacija($id = '1') {
		$this->load->model ( 'models_get/model_get','model_klienti' );
		$data = $this->model_klienti->get_evaluacija ( $id );
	
	
	
		$datum = explode ( "-", $data ['datum'] );
		$data ['year'] = $datum ['0'];
		$data ['month'] = $datum ['1'];
		$data ['day'] = $datum ['2'];
		$data ['errors'] = "";
	
		$id_korisnik = $data ['klient_id'];
		
		$data_klient = $this->model_klienti->get_evaluacija_korisnik_info ( $id_korisnik );
		
		
	
		$vraboteni =$this->get_vraboteni();
		
		$data ['klient'] = $data_klient ['klient'];
		$data ['vraboten'] = $data_klient ['vraboten'];
	
	
		$data ['vraboteni'] = $vraboteni;
		$data ['id_korisnik'] = $id_korisnik;
		$data['id']=$id;
		// mozno e idto vo hidden da go cuvam da treba ili neso takvo ?????
		$var = $this->load->view ( 'views_content/views_edit/view_edit_evaluacija', $data, TRUE );
		echo $var;
		//return $var;
	}

	public function post_edit_evaluacija($id = '1') {
		// !!!!!! ДА СЕ СМЕНИ varchar za period!!!!
		if (isset ( $_POST ['submitEval'] )) {
				
			foreach ( $_POST as $key => $value ) {
				$post [$key] = $this->input->post ( $key );
			}
				
			$datum = $post ['data_den'] . "-" . $post ['data_mesec'] . "-" . $post ['data_godina'];
				
			$evaluacija = array (
					'datum' => $datum,
					'klient_id' => $post ['id_korisnik'],
					'period' => $post ['period'],
					'evaluiral' => $post ['vraboteni'],
					'planirani_celi' => $post ['planirani'],
					'ostvareni_celi' => $post ['ostvareni_celi'],
					'narativen_izvestaj' => $post ['narativen'],
					'novi_celi' => $post ['novi_celi'],
					'preporaki' => $post ['preporaki']
			);
			$this->load->model ( "models_post/model_post_formulari","model_klienti" );
				
			$result = $this->model_klienti->update_evaluacija ( $evaluacija, $id );
				
			if ($result) {
	
				$this->load->view ( 'view_profil' );
			} else {
				$data ['errors'] = "Имаше грешка во внесувањето на оваа посета. Ве молам обидете се повторно подоцна";
	
				$this->load->view ( 'view_edit_evaluacija', $data );
			}
		}
	}
	
	public function edit_priem($id='1'){
		$this->load->model ( 'models_get/model_get','model_klienti' );
		$query = $this->model_klienti->zemi_priem ( $id );
		$data1 = $query;
		$datum=explode("-", $data1['datum_raganje']);
		$data1['den_r']=$datum[2];
		$data1['mesec_r']=$datum[1];
		$data1['godina_r']=$datum[0];
		$data2=$this->get_denovi_meseci();
		$data=array_merge($data1,$data2);
		$pol[0] = 'м';
		$pol[1] = 'ж';
		$data['pol']=$pol;
		$data ["vraboteni"] = $this->get_vraboteni ();
		$data["obrazovanie"]=$this->get_obrazovanie();
		$data["poprecenosti_site"]=$this->get_poprecenosti();
		$data["poseta"]=$this->get_tipPoseta();
		$data["id"]=$id;
		//echo "<pre>";
			//print_r($data);
		//echo "</pre>";
		
		$var=$this->load->view("views_content/views_edit/view_edit_priem", $data,TRUE);
		return $var;
	}

	public function post_edit_priem(){
		foreach ( $_POST as $key => $value ) {
			$post [$key] = $this->input->post ( $key );
		}
	
		$this->load->model('models_post/model_post_formulari','model_klienti');
	
	
		foreach($_POST as $key => $value){
			$post[$key] = $value;
		}
	
	
		$den = $post['denovi'];
		$mesec = $post['meseci'];
		$godina = $post['godini'];
	
		$datum_raganje = $godina."-".$mesec."-".$den;
	
	
	
		$data['poprecenosti'] = $post['poprecenosti'];
	
		$pol = -1;
	
		if($post['pol'] == 1){
			$pol = 0;
		}
	
		else if($post['pol'] == 2){
			$pol = 1;
		}
		$id=$post['id'];
	
		$klient = array(
					
				'ime_prezime' => $post['ime_prezime'],
				'datum_raganje' => $datum_raganje,
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
				'tip_poseta' => $post['poseta'],
				'tip_obrazovanie' => $post['obrazovanie'],
				'upaten_od' => $post['upaten_od'],
				'primen_od' => $post['vraboteni'],
				'ocekuvanja_klient' => $post['ocekuvanja_klient'],
				'ocekuvanja_roditel' => $post['ocekuvanja_roditel'],
				'komentar' => $post['komentar'],
				'datum_prva_poseta' => $post['datum_prva_poseta'],
				'raboti_so' => $post['raboti_so']
		);
	
		$result = $this->model_klienti->post_edit_priem($klient,$id);
		if($result != false){
	
	
			if($this->model_klienti->edit_poprecenost($id, $post['poprecenosti'])){
					
				$data['podatoci_klient'] = $klient;
	
				$this->prikaz_klienti($id,"osnovni_info");
			}
			else {
				$data['errors'] = "Попреченостите не може да се додадат во базата,
						ве молиме пробајте подоцна";
					
				//*******************************************************
				//treba ova da go smenam da ne mi prenasocuva na istata stranica
				echo "Greska poprecenosti";
			}
	
		}
	
		else{
			$data['errors'] = "Клиентот не беше успешно додаден, ве молиме пробајте подоцна";
	
			echo "klient greska";
	
	
		}
	}
	
	
	
	//--------------------------------------------------------------------------------------------------------------------------
	//views za prikaz
	
	
	//funckija vo koja pristapuvam do model_get i gi zemam site potrebni podatoci za da mozam da ja prikazam procenkata na 
	//klientot cie id go dobivam kako parametar.
	public function view_prikaz_plan($id_klient){
		
		$this->load->model('models_get/model_get', 'model_get');
			
		//gi zemam podatocite za plan od baza, za da mozam da mu gi dadam na view-to kade ke se prikazat
		$informacii_plan = $this->model_get->get_prikaz_plan($id_klient);
		
		$data['informacii_plan'] = $informacii_plan;
		$data['id_klient'] = $id_klient;
			
			
			
		$var=$this->load->view('views_content/views_prikaz/view_prikaz_plan', $data,TRUE);
		
		return $var;
		
	}
	
	
	public function view_prikaz_procenka($id_klient){
		
		$this->load->model('models_get/model_get', 'model_get');
			
		$informacii_procenka = $this->model_get->get_prikaz_procenka($id_klient);
			
		$data['informacii_procenka'] = $informacii_procenka;

		$data['id_klient'] = $id_klient;
		
		$data['errors'] = "";
			
		$var=$this->load->view('views_content/views_prikaz/view_prikaz_procenka', $data,TRUE);
		
		//print_r($informacii_procenka);
		//echo $var;
		return $var;
		
	}

	public function view_prikaz_dnevno_sledenje($id = '2') {//ova e id na dnevno sledenje
		// dali da pravime join so klienti za i informacii
		// za klientot da kazuvame????
		// $id='1';//ova kje bide neso od query
		// $data=array();
		$this->load->model ( '/models_get/model_get','model_klienti' );
		$data = $this->model_klienti->get_dnevno_sledenje ( $id );
		
		// $var="";
		if (! (isset ( $_POST ['edit'] ))) {
			$var = $this->load->view ( 'views_content/views_prikaz/view_prikaz_dnevno_sledenje', $data, TRUE );
			echo $var; // ova e za pdfot
		}
		$file = $data ['file'];
		$path = "/dokumenti/$file";
		if (isset ( $_POST ['download'] )) {
			$this->load->helper ( 'download' );
			force_download ( $path, $file );
		} else if (isset ( $_POST ['edit'] )) {
			$this->edit_dnevno_sledenje ($id);
		} else if (isset ( $_POST ['pdf'] )) {
			$this->pdf ( $var );
		}
	}
	
	public function prikaz_evaluacija($id = '1') {
	$this->load->model ( 'models_get/model_get','model_klienti' );
		$data = $this->model_klienti->get_evaluacija ( $id );
	
		$data ['errors'] = "";
		$id_korisnik = $data ['klient_id'];
		
		$this->load->model ( 'models_get/model_get','model_klienti' );
		$data_klient = $this->model_klienti->get_evaluacija_korisnik_info ( $id_korisnik );
		
		$vraboteni =$this->get_vraboteni();
		
		$data ['klient'] = $data_klient ['klient'];
		$data ['vraboten'] = $data_klient ['vraboten'];
	
	
		$data ['vraboteni'] = $vraboteni;
		$data ['id_korisnik'] = $id_korisnik;
		$data['id']=$id;
		// mozno e idto vo hidden da go cuvam da treba ili neso takvo ?????
		$var = $this->load->view ( 'views_content/views_prikaz/view_prikaz_evaluacija', $data, TRUE );
		if (! (isset ( $_POST ['edit'] ))) {
			echo $var;
		}
		else if ( isset ( $_POST ['edit'] )){
			$this->edit_evaluacija($id);
		}
		if (isset ( $_POST ['pdf'] )) {
			$this->pdf ( $var );
		}
		return $var;
	}
	
	public function prikaz_priem($id = '1') {
		$this->load->model ( 'modeles_get/model_get','model_klienti' );
		$query = $this->model_klienti->zemi_priem ( $id );
		$data = $query;
		$pol1 = array ();
		$pol1 [0] = '-';
		$pol1 [1] = 'male';
		$pol1 [2] = 'female';
		$data ['pol1'] = $pol1;
		$data ["vraboteni"] = $this->get_vraboteni ();
		$var = $this->load->view ( 'views_content/views_prikaz/view_prikaz_priem', $data, TRUE );
		return $var;
	}
	
	public function view_lista_klienti(){
	
		//gi dobivam site klienti so del od nivnite informacii.
		$klienti = $this->get_klienti();
	
		$data['errors'] = '';
		$data['klienti'] = $klienti;
	
		$var=$this->load->view('views_content/views_prikaz/view_lista_klienti', $data, TRUE);
		$data1["var"]=$var;
		$this->load->view ("views_content/views_prikaz/master",$data1);
	}
	
	public function prikaz_klienti($id = "1", $tab="osnovni_info") {
		$this->load->model ( 'models_get/model_get','model_klienti' );
		$evaluacii = $this->model_klienti->site_evaluacii ( $id );
		$dnevni = $this->model_klienti->site_dnevni ( $id );
		
		$data['tab']=$tab;
		$data ["evaluacii"] = $evaluacii;
		$data ["dnevni"] = $dnevni;
		
		if(isset( $_POST['edit_priem'] )){
			$data ["priem"] = $this->edit_priem($id);
			$data["tab"]="osnovni_info";
		}else{
			$data ["priem"] = $this->prikaz_priem($id);
		}
		if(isset( $_POST['editPlan'] )){
			$data ["plan"] = $this->view_edit_plan($id);
			$data["tab"]="plan";
		}else{
			$data ["plan"] = $this->view_prikaz_plan ( $id );
		}
		if(isset( $_POST['editProcenka'] )){
			$data ["procenka"] = $this->view_edit_procenka($id);
			$data["tab"]="procenka";
		}else{
			$data ["procenka"] = $this->view_prikaz_procenka($id);
		}
		if(isset( $_POST['pdf_priem'] )){
			$var=$this->prikaz_priem ( $id );
			$this->pdf($var);
		}
		$data["prv"]=TRUE;
		$data['id']=$id;
		$var=$this->load->view ( "views_content/views_prikaz/view_prikaz_klienti", $data, TRUE);
	
		$data1["var"]=$var;
		$this->load->view ("views_content/views_prikaz/master",$data1);
	}
	
	//----------------------------------------------------------------------------------------------------------------------
	//informacii
	
	//funckija vo koja pristapuvam do model_vraboteni za da gi zemam imeto i id-to na site vraboteni od baza. Vo toj model ja
	//povikuvam istoimenata funkcija get_vraboteni
	public function get_vraboteni(){
		
		$this->load->model('models_get/model_vraboteni');
		$result = $this->model_vraboteni->get_vraboteni();
	
		return $result;
	}
	
	//funckija vo koja pristapuvam do models_get/model_get za da gi zemam site poprecenosti koi postojat vo bazata na podatoci.
	//Vo toj model ja povukuvam istata funckija get_poprecenosti
	public function get_poprecenosti(){
		$this->load->model('models_get/model_get', 'model');
		$result = $this->model->get_poprecenosti();
	
		return $result;
	}
	
	//funckija vo koja pristapuvam do models_get/model_get za da gi zemam site tipovi na obrazovanie koi postojat vo bazata na podatoci.
	//Vo toj model ja povukuvam istata funckija get_obrazovanie
	public function get_obrazovanie(){
		$this->load->model('models_get/model_get', 'model');
		$result = $this->model->get_obrazovanie();
	
		return $result;
	}
	
	//funckija vo koja pristapuvam do models_get/model_get za da gi zemam site tipovi na poseta koi postojat vo bazata na podatoci.
	//Vo toj model ja povukuvam istata funckija get_tipPoseta
	public function get_tipPoseta(){
		$this->load->model('models_get/model_get', 'model');
		$result = $this->model->get_tipPoseta();
	
		return $result;
	}
	
	
	//funckija vo koja pristapuvam do modelot models_get/model_get_nadvoresni za da gi zemam id-to i imeto na site terapevti
	//koi gi ima vo bazata. Vo toj model ja povikuvam funkcijata get_terapevti
	public function get_terapevti(){
	
		//kreiram alias za imeto, za da mi e poednostavno
		$this->load->model('models_get/model_get_nadvoresni', 'model_get_nadvoresni');
		$result = $this->model_get_nadvoresni->get_terapevti();
	
		return $result;
	}
	
	//funckija vo koja pristapuvam do modelot models_get/model_get_nadvoresni za da gi zemam site institucii vo koi moze da pripaga
	//eden terapevt. Vo toj model ja povikuvam funckijata get_institucii.
	public function get_institucii(){
		$this->load->model('models_get/model_get_nadvoresni', 'model');
		
		$result = $this->model->get_institucii();
		
		return $result;
	}
	
	//funckija vo koja pristapuvam do modelot models_get/model_get_nadvoresni za da gi zemam id-to i imeto na site nastavnici
	//koi gi ima vo bazata. Vo toj model ja povikuvam funkcijata get_nastavnici
	public function get_nastavnici(){
		
		//kreiram alias za imeto, za da mi e poednostavno
		$this->load->model('models_get/model_get_nadvoresni', 'model_get_nadvoresni');
	
		$result = $this->model_get_nadvoresni->get_nastavnici();
	
		return $result;
	}
	
	public function get_denovi_meseci(){
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
			//key e godinata i value e godinata, za da mi bide polesno za vnesuvanje vo baza.
			$godini[$j] = $j;
		}
		$data['tekovenDatum'] = $tekovenDatum;
		$data['denovi'] = $denovi;
		$data['meseci'] = $meseci;
		$data['godini'] = $godini;
		
		return $data;
	}

	//funkcija za zemanje site info za klienti od baza
	public function get_klienti(){
		$this->load->model('models_get/model_get', 'model_klienti');
	
		$result = $this->model_klienti->get_klienti_za_lista();
	
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";
		*/
		return $result;
	
	}


}




?>