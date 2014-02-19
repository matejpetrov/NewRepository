<?php
//controller vo koj ke gi smestam site funkcii koi mi se potrebni za da napravam edit na bilo koja forma za klientot.
//Isto taka tuka ovie funkcii definirani za edit ke mozam da gi iskoristam i za prikaz, bidejki vsusnost se raboti
//za zemanje na istite podatoci od baza.
//Znaci tuka ke gi definiram

class Controller_klienti_edit_prikaz extends CI_Controller{
	
	public function index(){
		$this->view_edit_prikaz_procenka(1, 0);
	}
	
				
	
	//funckija vo koja ke gi zemam preku povik do model-ot podatocite povrzani so planot za klient cie id ke go dobijam kako argument.
	//Potoa vo zavisnost od flag-ot ili ke napravam samo prikaz na tie podatoci ili ke ovozmozam i edit na istite.
	public function view_edit_prikaz_plan($id_klient, $flag){

		//dokolku flag-ot e ednakov na nula toa znaci deka sakam da napravam samo prikaz na podatocite povrzani so planot.
		if($flag == 0){
			
			$this->load->model('model_klienti_prikaz');
			
			//gi zemam podatocite za plan od baza, za da mozam da mu gi dadam na view-to kade ke se prikazat
			$informacii_plan = $this->model_klienti_prikaz->prikaz_plan($id_klient);
						
			$data['informacii_plan'] = $informacii_plan;
			$data['id_klient'] = $id_klient;
			
			
			
			$this->load->view('views_prikaz/view_prikaz_plan', $data);
		}
		
		//dokolku pak flagot e razlicen od 0, ke go postavuvam na 1, jas sakam da napravam edit na podatocite povrzani so planot za
		//klientot.
		else{
			
			$this->load->model('model_klienti_edit');
			
			$informacii_plan = $this->model_klienti_edit->get_plan($id_klient);
			
			$data['vraboteni'] = $this->get_vraboteni();
			$data['informacii_plan'] = $informacii_plan;			
			$data['id_klient'] = $id_klient;

			$this->load->view('views_edit/view_edit_plan', $data);
				
		}														
		
	}
	
	
	//funckija vo koja ke gi zemam preku povik do model-ot podatocite povrzani so procenkata na klientot cie id ke go dobijam kako
	//argument
	public function view_edit_prikaz_procenka($id_klient, $flag){
		
		//dokolku flag-ot e ednakov na nula toa znaci deka sakam da napravam samo prikaz na podatocite povrzani so procenkata.
		if($flag == 0){
			
			$this->load->model('model_klienti_prikaz');
			
			$informacii_procenka = $this->model_klienti_prikaz->prikaz_procenka($id_klient);
			
			$data['informacii_procenka'] = $informacii_procenka;
			
			$data['terapevti'] = $this->model_klienti_prikaz->get_terapevti_klient($id_klient);
			
			$this->load->view('views_prikaz/view_prikaz_procenka', $data);
		}
		
		//vo sprotivno, najcesto ke go stavam 1, sakam da go prikazam view-to za edit na procenkata
		else{
			
			$this->load->model('model_klienti_edit');
			
			$informacii_procenka = $this->model_klienti_edit->get_procenka($id_klient);
			
			$data_checkbox['site_terapevti'] = $this->get_terapevti();
			
			$data_checkbox['selektirani_terapevti'] = $informacii_procenka['terapevti'];
			
			$data['terapevti'] = $this->load->view('views_edit/view_checkbox_terapevti_edit', $data_checkbox, TRUE);
			
			$data['informacii_procenka'] = $informacii_procenka;
			
			$data['vraboteni'] = $this->get_vraboteni();
			
			$nastavnici = $this->get_nastavnici();
			
			$pom = array_unshift($nastavnici, "-");
			
			$data['nastavnici'] = $nastavnici;
			
			$this->load->view('views_edit/view_edit_procenka', $data);
			
		}
				
		
	}
	
	
	
	//funckija koja ke ja povikam od view_edit_plan, i vo koja ke treba da pratam pole od promenlivi na modelot koj ke gi napravi
	//promenite za planot za klientot cie id ke go dademe kako argument.
	public function edit_plan_klient($id_klient){
		
		$this->load->model('model_klienti_edit');
						
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
		if($this->model_klienti_edit->edit_plan($id_klient, $plan)){

			$data['plan'] = $plan;
									
			$this->load->view('views_edit/view_pom', $data);
			
		}
		
		else{
			//**************************************
		}
				
		
	}
	
	
	//funckija koja ke ja povikam od view_edit_procenka, i vo koja prakam pole od promenlivi na modelot koj ke gi napravi 
	//promenite za procenkata na klientot. Isto taka tuka ke treba da pristapam do baza za da gi smenam terapevtite za 
	//klientot.
	//************************ Imam mnogu if uslovi, za uspesnost da proveram dali e kako sto treba.
	public function edit_procenka_klient($id_klient){
		
		//mi treba za da ja povikam funckijata dodadi_procenka koja ke mi napravi update za site raboti.
		$this->load->model('model_klienti');
		$this->load->model('model_klienti_edit');
		
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
		if($this->model_klienti->dodadi_procenka($id_klient, $procenka)){
		
			//dokolku se setirani terapevtite vo post, togas treba da pristapam do baza, da gi izbrisam veke postoeckite 
			//za tekovniot klient i da gi dodadam novite. Vo sprotiven slucaj jas ke treba samo da gi izbrisam site stavki 
			//od klient_terapevt bidejki sum odselektiral se.
			if(isset($post['terapevti'])){

				//najprvin gi brisam prethodnite terapevti za toj klient od baza.
				if($this->model_klienti_edit->brisi_terapevti_klient($id_klient)){
					
					//gi imam izbrisano site i vednas potoa povikuvam funckija od drugiot model kade gi dodavam site terapevti za
					//toj klient.
					if($this->model_klienti->dodadi_terapevt_klient($id_klient, $post['terapevti'])){
						//uspesno sum gi dodal novite terapevti, treba da prenasocam na view kade ke napravam prikaz.
						//*************************************************
						
						$procenka['dodavanje'] = "dodadov i terapevt";
						$data['procenka'] = $procenka;
						$this->load->view('views_prikaz/view_procenka', $data);
						
					}
					else{
						$procenka['greska'] = "greska pri povtornoto dodavanje na terapevtite";
						$data['procenka'] = $procenka;
						$this->load->view('views_prikaz/view_procenka', $data);
					}
					
				}
				else{
					$procenka['greska'] = "Greska pri delete, po koj treba da sledi dodavanje";
					$data['procenka'] = $procenka;
					$this->load->view('views_prikaz/view_procenka', $data);
				}
				
				
			}
		
			//brisenje na site terapevti bidejki nemam selektirano nitu eden.
			else{		
								
				if($this->model_klienti_edit->brisi_terapevti_klient($id_klient)){
					//dokolku uspesno sum gi izbrisal site, vednas prenasocuvam na prikazot na procenkata za klientot.
					//**********************************************************
					$data['dodavanje'] = "ne dodadov terapevt tuku gi izbrisav site, bidejki nemam nitu eden selektirano";
					$data['procenka'] = $procenka;
					$this->load->view('views_prikaz/view_procenka', $data);
				}
				
				else{
					$procenka['greska'] = "Greka pri delete po koj ne sledi dodavanje";
					$data['procenka'] = $procenka;
					$this->load->view('views_prikaz/view_procenka', $data);
				}
				
			}
		
		
		}
		
		//dokolku osnovnite podatoci za procenka ne se uspesno vneseni vo baza treba toa da go signaliziram
		else{
			
		}
	}
					
	
	
	//funckija so koja pristapuvam do modelot za vrabotenite i gi zemam site vraboteni od baza.
	//************************************************************ visok
	public function get_vraboteni(){
		$this->load->model('model_vraboteni');
		$result = $this->model_vraboteni->get_vraboteni();
		
		return $result;
	}
	
	//funckija koja pristapuva do baza i gi zema site terapevti
	//************************************************************ visok
	public function get_terapevti(){
	
		$this->load->model('model_terapevti');
		$result = $this->model_terapevti->get_terapevti();
	
		return $result;
	}

	//funckija koja pristapuva do baza i gi zema site nastavnici
	//************************************************************ visok
	public function get_nastavnici(){
		$this->load->model('model_klienti');
	
		$result = $this->model_klienti->get_nastavnici();
	
		return $result;
	}

}

?>