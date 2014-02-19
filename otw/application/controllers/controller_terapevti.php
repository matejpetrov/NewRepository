<?php

//vo ovaa klasa ke gi implementiram metodite za dodavanje i azuriranje na terapevt, dodavanje i azuriranje na 
//institucija i slicno. Malku da go olabavam controller_klienti, da ne e se tamu implementirano

class Controller_terapevti extends CI_Controller{
			
	public function index(){
		
	}
	
	//funkcija preku koja ke povikam metod od model za terapevti i potoa ke vnesam nov terapevt vo baza.
	public function dodadi_nov_terapevt(){
	
		//dokolku selektiram da se vratam nazad, togas treba da go povikam prikazuvanjeto na prethodniot view.
		if(isset($_POST['nazad_do_procenka'])){
			//******************************************************
			//treba da napravam eden tip na view_state, za da mi se zacuvaat podatocite koi veke sum gi vnel
			$this->view_dodadi_procenka();
		}
	
		//dokolku sum selektiral za da dodadam nova institucija, togas treba da prenasocam na druga strana, koja vsusnost ke bide pop up so javascript
		//vo koja ke vnesam ime na nova institucija
		//**********************
		//ova ke treba da go promenam bidejki nema da mi se pojavuva nova strana vo koja ke dodavam nova instucija tuku ke imam
		//samo pole i kopce i vednas ke se dodade institucijata vo dropdown lista koristejki AJAX za da se napravi
		//refresh samo na toj del od stranata.
		else if(isset($_POST['dodadiInstitucija'])){
			$data['errors'] = '';
				
			//go pokazuvam view-to za dodavanje na nova institucija.
			$this->load->view('view_dodadi_institucija', $data);
				
		}
	
		else{
				
			$this->load->model('model_terapevti');
				
			//gi zemam site vrednosti prateni vo povikot
			foreach($_POST as $key => $value){
				$post[$key] = $value;
			}
				
			$terapevt = array(
					'terapevt_ime_prezime' => $post['terapevt_ime_prezime'],
					'institucija' => $post['institucija'],
					'mail' => $post['mail'],
					'telefon' => $post['telefon']
			);
				
			//dokolku uspesno e dodaden noviot terapevt, ke treba da ja povikam funkcijata terapevt, vo koja povtorno ke
			//ja prikazam listata od terapevti.
			if($this->model_terapevti->dodadi_nov_terapevt($terapevt)){
				$errors = '';
				$data = $this->terapevti($errors);
					
				$this->load->view('view_terapevti', $data);
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
	
	
			
	
	} 
	
	
	public function azururaj_terapevt(){
		
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
	
	
	
	
}


?>