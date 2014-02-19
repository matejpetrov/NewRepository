<!DOCTYPE html> 

<html> 
	<head> 
		<title>Bootstrap 101 Template</title> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> <!-- Bootstrap --> 
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" type="text/css" rel="stylesheet" media="screen"/> 
	</head> 
	
	<body> 
	
	<?php print_r($informacii_plan);?>
		<h1>Индивидуален план</h1> <br/> 
		
		<p></p> <br/> 
		
		<?php echo form_open('controller_klienti_edit_prikaz/'); 
			
			echo form_label("Планот го направил: 	"); 
			echo $informacii_plan['vraboten_ime_prezime']." ";

		?> 
			
			<h4>Долгорочни цели</h4> <?php echo $informacii_plan['dolgorocni_celi'];?> 
			
			<h4>Краткорочни цели</h4> <?php echo $informacii_plan['kratkorocni_celi']; ?> 
			
			<h4>Асистивни уреди и софтвер</h4> <?php echo $informacii_plan['uredi_softver']; ?> 
			
			<h4>Методи и фреквенција на работа</h4> <?php echo $informacii_plan['metodi_frekvencija'] ?> 
			
			<h4>Очекувани резултати</h4> <?php echo $informacii_plan['ocekuvani_rezultati'];?> 
			
			<h4>Планирана евалуација на поставените цели</h4> <?php echo $informacii_plan['planirana_evaluacija_postaveni_celi']; ?> 

						
			<?php //da napravam kopce za edit?>
		
		<?php echo form_close();?> </body>