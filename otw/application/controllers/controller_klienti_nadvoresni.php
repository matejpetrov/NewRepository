<?php

//controller vo koj ke se spravam so prikaz, edit i dodavanje na site terapevti, nastavnici i odgovorni vo firma.

class Controller_klienti_nadvoresni extends CI_Controller{
	
	public function index(){
		$this->view_lista_nadvoresni();
	}

	
	
	//funckija vo koja vo zavisnost od flag-ot gi povikuvam soodvetnite funckii za terapevt, nastavnik ili odogoren 
	//od nekoja firma. Po pristapuvanjeto do models_get/model_get_nadvoresni i zemanjeto na site ovie potebni 
	//informacii jas gi povukuvam view-ata za prikaz na nadvoresnite.
	public function view_lista_nadvoresni($flag){
	
		$nadvoresni = array();
	
	
		if($flag == 1){
				
			$terapevti = $this->get_terapevti_everything();
				
			$nadvoresni = $this->nadvoresni_pole($terapevti, $flag);
		}
		else if($flag == 2){
				
			$nastavnici = $this->get_nastavnici_everything();
				
			$nadvoresni = $this->nadvoresni_pole($nastavnici, $flag);
				
		}
		else if($flag == 3){
			//*************************************
		}
			
	
	
	
		//gi zemam informaciite za site terapevti
		$data_tabela['nadvoresni'] = $nadvoresni;
	
		$data_tabela['flag'] = $flag;
	
	
		$data['nadvoresni_tabela'] = $this->load->view('views_tabeli_raspored/view_tabela_nadvoresni', $data_tabela, TRUE);
	
	
		if($flag == 1){
			$data['institucii'] = $this->get_institucii();
		}
		else if($flag == 2){
			$data['institucii'] = $this->get_ucilista();
		}
		else if($flag == 3){
			//*******************************
		}
	
	
		$data['errors'] = "";
	
		$data['flag'] = $flag;
	
		$var=$this->load->view('views_tabeli_raspored/view_nadvoresni', $data, TRUE);
		$data1['var']=$var;
		$this->load->view("views_content/views_prikaz/master", $data1);
	
	}
	
	//proba
	public function view_lista_nadvoresni_institucii($flag){
		
		$nadvoresni_institucii = array();
		
		if($flag == 1){		
			$institucii = $this->get_institucii();
			
			$nadvoresni_institucii = $institucii;
							
		}
		else if($flag == 2){
		
			$ucilista= $this->get_ucilista();

			$nadvoresni_institucii = $ucilista;
		
		}
		else if($flag == 3){
			//*************************************
		}
		

		$data_tabela['nadvoresni_institucii'] = $nadvoresni_institucii;
		
		$data_tabela['flag'] = $flag;
		
		
		$data['nadvoresni_institucii_tabela'] = $this->load->view('views_tabeli_raspored/view_tabela_nadvoresni_institucii', $data_tabela, TRUE);		
		
		
		$data['errors'] = "";
		
		$data['flag'] = $flag;
		
		$var=$this->load->view('views_tabeli_raspored/view_nadvoresni_institucii', $data, TRUE);
		$data1['var']=$var;
		$this->load->view("views_content/views_prikaz/master", $data1);
		
		
	}
	
	
	//------------------------------------------------------------------------------------------------------------------
	//funckii za terapevt i institucii
	
	//funkcija preku koja ke povikam metod od model za terapevti i potoa ke vnesam nov terapevt vo baza.
	//Ovaa funckija ja povikuvam preku AJAX povik
	public function dodadi_nov_terapevt(){
	
		$this->load->model('models_post/model_post_nadvoresni', 'model');
	
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
		if($this->model->dodadi_nov_terapevt($terapevt)){

			$nadvoresni = array();
									
			$terapevti = $this->get_terapevti_everything();
			
			$nadvoresni = $this->nadvoresni_pole($terapevti, 1);
	
			$data['nadvoresni'] = $nadvoresni;
			
			$data['flag'] = 1;
				
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni', $data);
		}
			
		//dokolku pak ne e uspesno dodaden ke treba da prenasocam na istata strana, no signaliziram deka ima greska,
		//vo view ke se prikaze greskata zaradi koja ne uspealo dodavanjeto
			
		else{
	
			$this->load->view('view_proba');
	
			$errors = 'Во моментов не може да се додаде нов терапевт, ве молиме пробајте подоцна';
			$data = $this->terapevti($errors);
	
			$tabela = $this->load->view('view_terapevti', $data, TRUE);
			
			return $tabela;
	
		}
	}
	
	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i da napravam edit za veke postoecki terapevt
	//Vo toj model ke ja povikam funckijata edit_terapevt.
	public function edit_terapevt($id_terapevt){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
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
		
		
		if($this->model->edit_terapevt($id_terapevt, $terapevt)){
			
			$nadvoresni = array();
			
			$terapevti = $this->get_terapevti_everything();
			
			$nadvoresni = $this->nadvoresni_pole($terapevti, 1);
			
			$data['nadvoresni'] = $nadvoresni;
			
			$data['flag'] = 1;
			
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni', $data);
			
		}
		
		
		else{
			$this->load->view('view_profil');
		}
	}
	
	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i ke napravam delete na 
	//terapevtot cie id ke go dobijam kako argument.
	public function delete_terapevt($id_terapevt){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
		
		if($this->model->delete_terapevt($id_terapevt)){
			
			$nadvoresni = array();
			
			$terapevti = $this->get_terapevti_everything();
			
			$nadvoresni = $this->nadvoresni_pole($terapevti, 1);
			
			$data['nadvoresni'] = $nadvoresni;
			
			$data['flag'] = 1;
			
			$tabela = $this->load->view('views_tabeli_raspored/view_tabela_nadvoresni', $data);
				
			return $tabela;
		}
		
		
		else{
			
		}
		
	}
	
	
	//funkcija preku koja ke povikam metod od models_post/model_post_nadvoresni i potoa ke vnesam nova institucija vo baza.
	//Ovaa funckija ja povikuvam preku AJAX povik.
	public function dodadi_nova_institucija(){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
		$ime_institucija = $_POST['ime_nadvoresna_institucija'];
			
		$institucija = array('ime_institucija' => $ime_institucija);
			
		//dokolku uspesno e dodaden noviot terapevt, ke treba da ja povikam funkcijata terapevt, vo koja povtorno ke
		//ja prikazam listata od terapevti.
		if($this->model->dodadi_nova_institucija($institucija)){
		
			$institucii = $this->get_institucii();						
				
			$data['nadvoresni_institucii'] = $institucii;
			
			$data['flag'] = 1;
				
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni_institucii', $data);
		}
			
		//dokolku pak ne e uspesno dodaden ke treba da prenasocam na istata strana, no signaliziram deka ima greska,
		//vo view ke se prikaze greskata zaradi koja ne uspealo dodavanjeto
			
		else{					
		
			//
		
		}
		
	}
	
	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i da napravam edit za veke postoecka institucija
	//Vo toj model ke ja povikam funckijata edit_institucija.
	public function edit_institucija($id_institucija){
	
		$this->load->model('models_post/model_post_nadvoresni', 'model');
	
		$ime_institucija = $_POST['ime_nadvoresna_institucija'];
		
		$institucija = array('ime_institucija' => $ime_institucija);
		
		
		if($this->model->edit_institucija($id_institucija, $institucija)){
			
			$institucii = $this->get_institucii();
				
			$data['nadvoresni_institucii'] = $institucii;
			
			$data['flag'] = 1;
				
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni_institucii', $data);
		}
		
		else{
			//
		}
	
	}
	
	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i ke napravam delete na
	//institucijata cie id ke go dobijam kako argument.
	public function delete_institucija($id_institucija){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
		
		if($this->model->delete_institucija($id_institucija)){
				
			$data['nadvoresni_institucii'] = $this->get_institucii();
			
			$data['flag'] = 1;
				
			$tabela = $this->load->view('views_tabeli_raspored/view_tabela_nadvoresni_institucii', $data);
		
			return $tabela;
		}
		
		
		else{
			//
		}
	}
	
	
	
	//------------------------------------------------------------------------------------------------------------------
	//funckii za nastavnici i ucilista
	
	
	//funkcija preku koja ke povikam metod od models_post/model_post_nadvoresni i potoa ke vnesam nov nastanvik vo baza.
	//Ovaa funckija ja povikuvam preku AJAX povik
	public function dodadi_nov_nastavnik(){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
		$nastavnik_ime_prezime = $_POST['ime_prezime'];
		$mail = $_POST['mail'];
		$telefon = $_POST['telefon'];
		$uciliste = $_POST['institucii'];
			
		$nastavnik = array(
				'nastavnik_ime_prezime' => $nastavnik_ime_prezime,
				'uciliste' => $uciliste,
				'mail' => $mail,
				'telefon' => $telefon
		);
			
		//dokolku uspesno e dodaden noviot terapevt, ke treba da ja povikam funkcijata terapevt, vo koja povtorno ke
		//ja prikazam listata od terapevti.
		if($this->model->dodadi_nov_nastavnik($nastavnik)){
		
			$nadvoresni = array();
			
			$nastavnici = $this->get_nastavnici_everything();
			
			$nadvoresni = $this->nadvoresni_pole($nastavnici, 2);
		
			$data['nadvoresni'] = $nadvoresni;
			
			$data['flag'] = 2;
		
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni', $data);
		}
		
		else{
			//
		}
		
	}

	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i da napravam edit za veke postoecki nastavnik
	//Vo toj model ke ja povikam funckijata edit_nastavnik.
	public function edit_nastavnik($id_nastavnik){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
		$nastavnik_ime_prezime = $_POST['ime_prezime'];
		$mail = $_POST['mail'];
		$telefon = $_POST['telefon'];
		$uciliste = $_POST['institucii'];
			
		$nastavnik = array(
				'nastavnik_ime_prezime' => $nastavnik_ime_prezime,
				'uciliste' => $uciliste,
				'mail' => $mail,
				'telefon' => $telefon
		);
		
		
		if($this->model->edit_nastavnik($id_nastavnik, $nastavnik)){

			$nadvoresni = array();
			
			$nastavnici = $this->get_nastavnici_everything();
			
			$nadvoresni = $this->nadvoresni_pole($nastavnici, 2);
				
			$data['nadvoresni'] = $nadvoresni;
			
			$data['flag'] = 2;
				
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni', $data);
				
		}
		
		
		else{
			$this->load->view('view_profil');
		}
	}
	
	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i ke napravam delete na
	//nastavnikot cie id ke go dobijam kako argument.
	public function delete_nastavnik($id_nastavnik){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
		
		if($this->model->delete_nastavnik($id_nastavnik)){
				
			$nadvoresni = array();
			
			$nastavnici = $this->get_nastavnici_everything();
			
			$nadvoresni = $this->nadvoresni_pole($nastavnici, 2);
			
			$data['nadvoresni'] = $nadvoresni;
			
			$data['flag'] = 2;
				
			$tabela = $this->load->view('views_tabeli_raspored/view_tabela_nadvoresni', $data);
		
			return $tabela;
		}
		
		
		else{
			
		}
		
	}
	
	
	//funkcija preku koja ke povikam metod od models_post/model_post_nadvoresni i potoa ke vnesam novo uciliste vo baza.
	//Ovaa funckija ja povikuvam preku AJAX povik.
	public function dodadi_novo_uciliste(){
		
		$this->load->model('models_post/model_post_nadvoresni', 'model');
		
		$ime_uciliste = $_POST['ime_nadvoresna_institucija'];
			
		$uciliste = array('ime_uciliste' => $ime_uciliste);
			
		//dokolku uspesno e dodaden noviot terapevt, ke treba da ja povikam funkcijata terapevt, vo koja povtorno ke
		//ja prikazam listata od terapevti.
		if($this->model->dodadi_novo_uciliste($uciliste)){
		
			$ucilsita = $this->get_ucilista();						
				
			$data['nadvoresni_institucii'] = $ucilsita;
			
			$data['flag'] = 2;
				
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni_institucii', $data);
		}
			
		//dokolku pak ne e uspesno dodaden ke treba da prenasocam na istata strana, no signaliziram deka ima greska,
		//vo view ke se prikaze greskata zaradi koja ne uspealo dodavanjeto
			
		else{					
		
			//
		
		}
				
	}
	
	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i da napravam edit za veke postoecko uciliste
	//Vo toj model ke ja povikam funckijata edit_uciliste.
	public function edit_uciliste($id_uciliste){
	
		$this->load->model('models_post/model_post_nadvoresni', 'model');
	
		$ime_uciliste = $_POST['ime_nadvoresna_institucija'];
		
		$uciliste = array('ime_uciliste' => $ime_uciliste);
		
		
		if($this->model->edit_uciliste($id_uciliste, $uciliste)){
			
			$ucilista = $this->get_ucilista();
				
			$data['nadvoresni_institucii'] = $ucilista;
			
			$data['flag'] = 2;
				
			$this->load->view('views_tabeli_raspored/view_tabela_nadvoresni_institucii', $data);
		}
		
		else{
			//
		}
	
	}
	
	
	//funckija preku koja ke pristapam do modelot models_post/model_post_nadvoresni i ke napravam delete na
	//ucilisteto cie id ke go dobijam kako argument.
	public function delete_uciliste($id_uciliste){
	
		$this->load->model('models_post/model_post_nadvoresni', 'model');
	
	
		if($this->model->delete_uciliste($id_uciliste)){
	
			$data['nadvoresni_institucii'] = $this->get_ucilista();
			
			$data['flag'] = 2;
	
			$tabela = $this->load->view('views_tabeli_raspored/view_tabela_nadvoresni_institucii', $data);
	
			return $tabela;
		}
	
	
		else{
			//
		}
	}
	
	//------------------------------------------------------------------------------------------------------------------
	//informacii
	
	
	//funckija vo koja ke pristapam do modelot models_get/model_get_nadvoresni i ke gi zemam site informacii za terapevtite.
	public function get_terapevti_everything(){	
	
		$this->load->model('models_get/model_get_nadvoresni', 'model_get');
		
		$result = $this->model_get->get_terapevi_everything();
	
		return $result;
	}
	
	
	//funckija vo koja pristapuvam do modelot models_get/model_get_nadvoresni i ja povikuvam funckijata get_institucii. 
	//Gi zemam iminjata na site institucii, key mi e id, a value mi e imeto na institucijata
	public function get_institucii(){
		
		$this->load->model('models_get/model_get_nadvoresni', 'model_get');
		
		$result = $this->model_get->get_institucii();
		
		return $result;
		
	}
		
	//funckija vo koja ke pristapam do modelot models_get/model_get_nadvoresni i ke gi zemam site informacii za nastavnicite.
	public function get_nastavnici_everything(){
		
		$this->load->model('models_get/model_get_nadvoresni', 'model_get');
		
		$result = $this->model_get->get_nastavnici_everything();
		
		return $result;
	}
	
	//funckija vo koja pristapuvam do modelot models_get/model_get_nadvoresni i ja povikuvam funckijata get_ucilista.
	//Gi zemam iminjata na site ucilistata, key mi e id, a value mi e imeto na ucilisteto
	public function get_ucilista(){
		
		$this->load->model('models_get/model_get_nadvoresni', 'model_get');
		
		$result = $this->model_get->get_ucilista();
		
		return $result;
		
	}


	
	//----------------------------------------------------------------------------------------------------------------
	//konverzija za nadvoresni
	
	//funckija vo koja dobieniot argument mi e lista od terapevti, nastavnici ili odgovorni_firma, toa go odreduvam 
	//od flag-ot. Nezavisno koj tip na pole mi e jas go konvertiram vo $nadvoresni za da mozam da go prikazam
	//view_nadvoresni i view_tabela_nadvoresni.
	public function nadvoresni_pole($pole, $flag){
		
		$nadvoresni = array();
		
		if($flag == 1){
			$terapevti = array();
			$terapevti = $pole;
			
			foreach($terapevti as $t){
				$n['id_nadvoresen'] = $t['id_terapevt'];
				$n['nadvoresen_ime_prezime'] = $t['terapevt_ime_prezime'];
				$n['mail'] = $t['mail'];
				$n['telefon'] = $t['telefon'];
				$n['ime_institucija'] = $t['ime_institucija'];
				$n['institucija'] = $t['institucija'];
					
				$nadvoresni[$n['id_nadvoresen']] = $n;
			
			}					
			
		}
		else if($flag == 2){
			$nastavnici = array();
			$nastavnici = $pole;
			

			foreach($nastavnici as $na){
				$n['id_nadvoresen'] = $na['id_nastavnik'];
				$n['nadvoresen_ime_prezime'] = $na['nastavnik_ime_prezime'];
				$n['mail'] = $na['mail'];
				$n['telefon'] = $na['telefon'];
				$n['ime_institucija'] = $na['ime_uciliste'];
				$n['institucija'] = $na['uciliste'];
					
				$nadvoresni[$n['id_nadvoresen']] = $n;
			
			}
			
		}
		else if($flag == 3){
			//*******************************************
		}
		
		return $nadvoresni;
		
	}


	
}

?>