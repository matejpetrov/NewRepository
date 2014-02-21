
	
	<?php //print_r($informacii_procenka);?>
		<h1>Проценка за корисникот <?php echo $informacii_procenka['ime_prezime'];?></h1> <br/> 
		
		
		<?php echo $errors;?>
		
		<p></p> <br/> 
		
		<?php echo form_open('controller_klienti_main/prikaz_klienti/'.$id_klient); 
			
			echo form_label("Проценката ја направил: 	"); 
			echo $informacii_procenka['vraboten_ime_prezime']." ";

		?> 
			
			<h4>Моторика</h4> <?php echo $informacii_procenka['motorika'];?> 
			
			<h4>Когнитивни способности</h4> <?php echo $informacii_procenka['kognitivni_spos']; ?> 
			
			<h4>Говор/комуникација</h4> <?php echo $informacii_procenka['govor_komunikacija']; ?> 
			
			<h4>Писменост</h4> <?php echo $informacii_procenka['pismenost'] ?> 
			
			<h4>Однесување</h4> <?php echo $informacii_procenka['odnesuvanje'];?> 
			
			<h4>Ризици</h4> <?php echo $informacii_procenka['rizici']; ?>
			
			<h4>Семејно-срединско опкружување</h4> <?php echo $informacii_procenka['opkruzuvanje']; ?>
			
			<h4>Интереси</h4> <?php echo $informacii_procenka['interesi']; ?>
			
			<h4>Компјутерски вештини</h4> <?php echo $informacii_procenka['kompjuterski_vestini']; ?> 
			
			<h4>Терапевт со кој работи</h4> <?php if(count($informacii_procenka['terapevti']) > 0){
			
				?>
			
			<ul type="disc">
				<?php 
				
					foreach($informacii_procenka['terapevti'] as $key => $value){
	
				?>
				
					<li><?php echo $value;?></li>
					<?php 
					}
					
				}			
				else echo "/<br><br>";
				
				?>
				
						
			</ul>
			
			<h4>Наставник со кој работи</h4> <?php echo $informacii_procenka['nastavnik_ime_prezime']; ?> 

			<br/><br/>
						
			<input type="submit" name="editProcenka" id="editProcenka" value="Промени проценка" />
		
		<?php echo form_close();?> 