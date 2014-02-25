
	
<h1>Направете промени и притиснете го копчето Промени план</h1>

<br/>

<p><?php echo $errors;?></p>

		
		<br/>		
			<?php
			
		$attributes = array('name' => 'form', 'id' => 'form', 'class' => 'form');		
		

		echo form_open('controller_klienti_main/post_prikaz_klienti/'.$id_klient, $attributes);
			
			echo form_label("Планот го прави:	");
			echo form_dropdown('vraboteni', $vraboteni, $informacii_plan['plan_napravil'])."		";
			
			//sekogas ke dobiva vrednost na tekoven datum.
			echo form_label("Датум кога е направен планот: ");
			
			?>
			<input type="text" name="datum_plan" id="datum_plan" value="<?php echo $informacii_plan['datum_plan'];?>" readonly="readonly"/>			
			
			<h4>Долгорочни цели</h4>
			
			<textarea name="dolgorocni_celi" id="dolgorocni_celi" rows="7" cols="65"><?php echo $informacii_plan['dolgorocni_celi'];?></textarea><br/> <br/>
			
			<h4>Краткорочни цели</h4>
			
			<textarea name="kratkorocni_celi" id="kratkorocni_celi" rows="7" cols="65"><?php echo $informacii_plan['kratkorocni_celi'];?></textarea><br/> <br/>
			
			<h4>Асистивни уреди и софтвер</h4>
			
			<textarea name="uredi_softver" id="uredi_softver" rows="7" cols="65"><?php echo $informacii_plan['uredi_softver'];?></textarea><br/> <br/>
			
			<h4>Методи и фреквенција на работа</h4>	
			
			<textarea name="metodi_frekvencija" id="metodi_frekvencija" rows="7" cols="65"><?php echo $informacii_plan['metodi_frekvencija'];?></textarea><br/> <br/>
			
			
			<h4>Очекувани резултати</h4>
			
			<textarea name="ocekuvani_rezultati" id="ocekuvani_rezultati" rows="7" cols="65"><?php echo $informacii_plan['ocekuvani_rezultati'];?></textarea><br/> <br/>
			
			
			<h4>Планирана евалуација на поставените цели</h4>
			
			<textarea name="planirana_evaluacija_postaveni_celi" id="planirana_evaluacija_postaveni_celi" rows="7" cols="65"><?php echo $informacii_plan['planirana_evaluacija_postaveni_celi'];?></textarea><br/> <br/>
		
		
			<input type="submit" name="editPlanSave" id="editPlanSave" value="Промени план">
			
			<input type="submit" name="otkaziPlan" id="otkaziPlan" value="Откажи">
			
		<?php echo form_close();?>
	
	

