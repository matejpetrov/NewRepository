<?php

//controller vo koj ke se spravam so prikaz, edit i dodavanje na site terapevti, nastavnici i odgovorni vo firma.

class Controller_klienti_nadvoresni extends CI_Controller{
	
	public function index(){
		
	}
	
	//------------------------------------------------------------------------------------------------------------------
	//funckii za views
	
	//funckija vo koja ke gi zemam site potrebni informacii koi mu trebaat na view-to za da se prikaze tabela so site 
	//terapevti i nivnite informacii, kako i ke se ponudi moznost za promena na veke postoecki i dodavanje na nov terapevt.
	public function view_lista_terapevti(){
		
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
	
	
	//------------------------------------------------------------------------------------------------------------------
	//informacii
	
	
	//funckija vo koja ke pristapam do modelot models_get/model_get_nadvoresni i ke gi zemam site informacii za terapevtite.
	public function get_terapevti_everything(){
	
		$this->load->model('model_terapevti');
	
		$result = $this->model_terapevti->get_terapevti_everything();
	
		return $result;
	}
	
}

?>