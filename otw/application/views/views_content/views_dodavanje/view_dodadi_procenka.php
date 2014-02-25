
	<?php 
	
		$motorika = array(
			"name" => "motorika",
			"id" => "motorika",
			"value" => set_value("motorika"),
			"rows" => "7",
			"columns" => "65"
		);
	
	
	?>
		
		<h1>Формулар за проценка</h1>
		
		<br/>
		
		<p><?php echo $errors;?></p>
		
		<h2>Личен профил на корисникот</h2>
		<br/>		
			<?php
			
		$attributes = array('name' => 'form', 'id' => 'form', 'onsubmit' => 'return test(this);', 'class' => 'form');			
		
		
		echo form_open('controller_klienti_main/post_prikaz_klienti/'.$id_klient, $attributes);
			echo form_label("Проценката ја прави:	");
			echo form_dropdown('vraboteni', $vraboteni)."		";
			
			//sekogas ke dobiva vrednost na tekoven datum.
			echo form_label("Датум кога е направена проценката: ");
			
			?>
			<input type="text" name="datum_procenka" id="datum_procenka" value="<?php echo $tekovenDatum;?>" readonly="readonly"/>			
			
			<h4>Моторика (горни и долни екстремитети, литерализација, подвижност)</h4>
			
			<textarea name="motorika" id="motorika" rows="7" cols="65"><?php set_value("motorika");?></textarea><br/> <br/>
			<?php //echo form_textarea($motorika)."<br>";?>
			
			<h4>Когнитивни способности (внимание, мислење, помнење, ориентација во време и простор,<br/>
			математички способности)</h4>
			
			<textarea name="kognitivni_spos" id="kognitivni_spos" rows="7" cols="65"></textarea><br/> <br/>
			
			<h4>Говор/комуникација</h4>
			
			<textarea name="govor_komunikacija" id="govor_komunikacija" rows="7" cols="65"></textarea><br/> <br/>
			
			<h4>Писменост</h4>
			
			<textarea name="pismenost" id="pismenost" rows="7" cols="65"></textarea><br/> <br/>
			
			
			<h4>Однесување</h4>
			
			<textarea name="odnesuvanje" id="odnesuvanje" rows="7" cols="65"></textarea><br/> <br/>
			
			
			<h4>Ризици</h4>
			
			<textarea name="rizici" id="rizici" rows="7" cols="65"></textarea><br/> <br/>
			
			<h4>Семејно-срединско опкружување</h4>
			<p><i>(каде живее, со кого, драги личности, од животот, интеракција со врсници, 
			возрасни лица, што најчесто прави дома)</i></p>
							
			<textarea name="opkruzuvanje" id="opkruzucvanje" rows="7" cols="65"></textarea><br/> <br/>
			
			<h4>Интереси</h4>
			<p><i>(што сака да прави најчесто)</i></p>
							
			<textarea name="interesi" id="interesi" rows="7" cols="65"></textarea><br/> <br/>
			
			<h4>Компјутерски вештини</h4>
			<p><i>(дали претходно користел/користела компјутер, за која цел, каде)</i></p>
							
			<textarea name="kompjuterski_vestini" id="kompjuterski_vestini" rows="7" cols="65"></textarea><br/> <br/>						
			
			<h3>Работа со терапевти</h3>
			
			<h4>Терапевт со кој работи: </h4>
			
			<div id="container">
				<?php echo $terapevti;?>
			</div>
			
			<button type="button" name="dodadiTerapevt" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
				Додади терапевт
			</button>									
			
			
			<h4>Наставник со кој работи: </h4>
			
			<?php 					
			foreach($nastavnici as $key => $value){
			
			?>
			<input type="radio" name="nastavnici" id="nastavnici" value="<?php echo $key;?>" /><?php echo $value;?>
			
			<br/><br/>
			
			<?php }?>
			
			<input type="submit" name="dodadiProcenka" id="dodadiProcenka" value="Внеси проценка" />
			
		<?php echo form_close();?>				

	<!-- Modal --> 
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel">Внесете нов терапевт</h4> 
				</div> 
				
				<div class="modal-body"> 
					Име и презиме: <input type="text" name="ime_prezime" id="ime_prezime"/><br/><br/> 
					Институција:	
					
					<select name="institucii" id="institucii">
					<?php 
						
						foreach($institucii as $key => $value){
							
							?>
							
							<option value="<?php echo $key;?>"><?php echo $value;?></option>
							
							<?php }
							//echo form_dropdown('institucii', $institucii);?>																	
					
					
					</select> <br/><br/>
					Маил: <input type="text" name="mail" id="mail"/><br/><br/> 
					Телефон: <input type="text" name="telefon" id="telefon"/><br/><br/>
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="dodadi_nov_terapevt_AJAX();">Додади терапевт</button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->

			
