<?php

class Controller_vraboteni extends CI_Controller{
	
	public function index(){
		$data['errors'] = "";
		
		$this->load->view('view_dodadi_vraboten', $data);
	}
	
	//ova mi e server side validation, no isto taka so pomos na javascript ke koristam i client side validation. Tuka ke proveram
	//da ne postoi vraboten so istoto korisnicko ime vo koj slucaj ne treba da dozvolam vnesuvanje. Isto taka tuka ke napravam i 
	//namaluvanje na slikata na dimenzii koi ja sakam da bide.
	public function validate(){
		
		$this->load->model('model_vraboteni');
		
		$post = array();
		foreach ( $_POST as $key => $value )
		{
			$post[$key] = $this->input->post($key);
		}
		
		$ime_prezime = $post['ime_prezime'];
		$username = $post['username'];
		$password = $post['password'];
		//$slika = $post['userfile'];
		$checkbox = $this->input->post('slika_check');
		$slika='';
		
		//proveruvam dali veke postoi vraboten so istoto korisnicko ime.		
		$result = $this->model_vraboteni->proveri_username($username);
		
		//dokolku ima red, znaci deka vo bazata imame vraboten so toa korisnicko ime i ne treba da go dozvolime vnesuvanjeto
		if($result->num_rows > 0){
			$data['errors'] = "Веќе постои вработен со ова корисничко име, ве молиме да внесете некое друго.";			
			
			$this->load->view('view_dodadi_vraboten', $data);
		}
		
		//dokolku nema vraboten so toa korisnicko ime treba da proveram dali sum prikacil slika, dokolku da, ja menuvam nejzinata golemina,
		//dokolku pak ne sum prikacil slika treba vo bazata da ja vmetnam predefiniranata slika.
		else{
			
			$config['upload_path'] = './images/';
			$config['allowed_types'] = 'jpg|jpeg|png|gif';
			//goleminata na slikata neka bide do 800 KB.
			$config['max_size'] = '800';
				
			//loading the upload library with the defined preferences
			$this->load->library('upload', $config);
			
			
			//dokolku sum selektiral deka vo momentov nemam slika koja bi ja prikacil, togas treba vo baza da ja smestam
			//predefiniranata slika.
			//Ova znaci deka dokolku go selektiram checkbox-ot jas voopsto nema da napravam upload, duri i da sum selektiral slika, 
			//znaci mora da se vnimava da, dokolku odbereme slika ne go selektirame checkbox-ot. 
			if((int)$checkbox == 1){
				$slika = "no_image.gif";
				
			}
			//dokolku pak imam prikaceno slika, ke treba da ja zemam od upload_data i nejzinoto ime da go stavam vo bazata kako
			//vrednost za slika na ovoj korisnik.
			else{
				
				//no najprvin treba da proveram dali imam greska pri pravenje na upload, vo koj slucaj ke napravam reload na stranata
				if(!$this->upload->do_upload()){
					$data['errors'] = $this->upload->display_errors();	

					$this->load->view('view_dodadi_vraboten', $data);
					return;
				}
				
				else{
					
					$upload_data=$this->upload->data();
										
					$slika=$upload_data['file_name'];

					$this->resize_image($slika);
					
				}
				
			}
			
			 
			//dokolku projde validacijata na klientska strana so javascript i serverskata validacija za prikacenata slika 
			//kako i dokolku nema veke vraboten so isto korisnicko ime togas ke povikame funkcija koja ke go vnese vraboteniot vo baza.
			$vraboten = array(
					'ime_prezime'=>$ime_prezime,
					'username'=>$username,
					'password'=>$password,
					'slika'=>$slika
			);
				
			$this->dodadi_vraboten($vraboten);
									
		}
			
	}	
	
	public function dodadi_vraboten($vraboten){
		
		$this->load->model('model_vraboteni');
			
		$result = $this->model_vraboteni->dodadi_vraboten($vraboten);
			
		//dokolku uspesno sme go dodale korisnikot vo bazata ke prenasocime kon nova strana, odnosno stranata na nasiot profil
		if($result){ 						
						
			$this->load->view('view_profil');				
		}
		else{
			$data['errors']="Додавањето на вработениот беше неуспешно, Ве молиме пробајте подоцна.";
			
			$this->load->view('view_dodadi_vraboten', $data);
		}
	}

	
	public function resize_image($image_location){
		
		$config['image_library'] = 'gd2';
		$config['source_image'] = 'images/'.$image_location;		
		$config['maintain_ratio'] = FALSE;
		$config['width'] = 200;
		$config['height'] = 200;
		
		$this->load->library('image_lib', $config);
		
		$this->image_lib->resize();
		
		
	}
	


}


?>