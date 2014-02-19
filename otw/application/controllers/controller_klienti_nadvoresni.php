<?php

//controller vo koj ke se spravam so prikaz, edit i dodavanje na site terapevti, nastavnici i odgovorni vo firma.

class Controller_klienti_nadvoresni extends CI_Controller{
	
	public function index(){
		$this->view_lista_terapevti();
	}
	
	//------------------------------------------------------------------------------------------------------------------
	//funckii za views
	
	//funckija vo koja ke gi zemam site potrebni informacii koi mu trebaat na view-to za da se prikaze tabela so site 
	//terapevti i nivnite informacii, kako i ke se ponudi moznost za promena na veke postoecki i dodavanje na nov terapevt.
	public function view_lista_terapevti(){
		
		$this->load->model('models_get/model_get_nadvoresni', 'model');
		
		//gi zemam informaciite za site terapevti
		$data_tabela['terapevti'] = $this->get_terapevti_everything();
		
		
		$data['terapevti_tabela'] = $this->load->view('views_tabeli_raspored/view_tabela_terapevti', $data_tabela, TRUE);
		
		$data['terapevti'] = $data_tabela['terapevti'];
		
		$data['institucii'] = $this->get_institucii();
		
		$data['errors'] = "";
		
		$this->load->view('views_tabeli_raspored/view_terapevti', $data);
		
	}
	
	
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
				
			$terapevti = $this->get_terapevti_everything();
	
			$data['terapevti'] = $terapevti;
				
			$this->load->view('views_tabeli_raspored/view_tabela_terapevti', $data);
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
	
	
	//funckija preku koja ke pristapam do modelot models_post/models_post/nadvoresni i da napravam edit za veke postoecki terapevt
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
			
			$terapevti = $this->get_terapevti_everything();
			
			$data['terapevti'] = $terapevti;
			
			$this->load->view('views_tabeli_raspored/view_tabela_terapevti', $data);
			
		}
		
		
		else{
			$this->load->view('view_profil');
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
		
		$this->load->model('models_get/model_get_nadvoresni', 'model');
		
		$result = $this->model->get_institucii();
		
		return $result;
		
	}
	
}

?>