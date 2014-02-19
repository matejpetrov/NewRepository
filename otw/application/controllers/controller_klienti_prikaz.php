<?php
//ovoj kontroler ke go koristam za da se spravuvam so prikazot na site formi, samo prikaz.

class Controller_klienti_prikaz extends CI_Controller{
	
	public function index(){
		$this->prikaz_procenka(1);
	}
	
	
	//funckija vo koja ke napravam load na prikazot za procenka na klient cie id ke go pratam kako argument
	public function prikaz_procenka($id_klient){
		
		$this->load->model('model_klienti_prikaz');
		
		//gi zemam podatocite za procenka koi gi zemam od baza vo modelot
		$procenka = $this->model_klienti_prikaz->prikaz_procenka($id_klient);
		
		$data['procenka'] = $procenka;
		
		$this->load->view('views_prikaz/view_prikaz_procenka', $data);
		
	}

	
	
}


?>