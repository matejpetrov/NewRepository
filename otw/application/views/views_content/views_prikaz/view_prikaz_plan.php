
	
	<pre>
		<?php 
		
		print_r($informacii_plan);
		
		?>
	</pre>
			
		<h1>Индивидуален план</h1> <br/> 
		
		<p></p> <br/> 
		
		<?php 
		//ke prenasocam na funkcijata koja ke mi go prikaze view-to za edit na plan za klientot, a id-to ke go dadam kako argument.
		echo form_open('controller_klienti_main/prikaz_klienti/'.$id_klient); 
			
			echo form_label("Планот го направил: 	"); 
			echo $informacii_plan['vraboten_ime_prezime']." ";

		?> 
			
			<h4>Долгорочни цели</h4> <?php echo $informacii_plan['dolgorocni_celi'];?> 
			
			<h4>Краткорочни цели</h4> <?php echo $informacii_plan['kratkorocni_celi']; ?> 
			
			<h4>Асистивни уреди и софтвер</h4> <?php echo $informacii_plan['uredi_softver']; ?> 
			
			<h4>Методи и фреквенција на работа</h4> <?php echo $informacii_plan['metodi_frekvencija'] ?> 
			
			<h4>Очекувани резултати</h4> <?php echo $informacii_plan['ocekuvani_rezultati'];?> 
			
			<h4>Планирана евалуација на поставените цели</h4> <?php echo $informacii_plan['planirana_evaluacija_postaveni_celi']; ?>
			
			<br/><br/> 

						
			<input type="submit" name="editPlan" id="editPlan" value="Промени план">
		
		<?php echo form_close();?> 
