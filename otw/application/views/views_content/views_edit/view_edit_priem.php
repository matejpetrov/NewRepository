
		<?php

		
		///pred sto i da napravam treba header-ot od formularot so data, koja ke ja dobivam od kontrolerot kako denesen datum
		//upaten od pole za popolnuvanje, primen od, treba da bide dropdown lista od site vraboteni. 
		
		//potoa treba da ima datum na prva poseta, tip na poseta, tip na poprecenost, tip na obrazovanie. Ovie moze site direktno 
		//kaj klientot da gi stavime.		
		
		
		$upaten_od=array(
				"name" => "upaten_od",
				"id" => "upaten_od",
				"value" => $upaten_od
		);
		
		
		$ime_prezime=array(
				"name" => "ime_prezime",
				"id" => "ime_prezime",
				"value" => $ime_prezime
		);

		$den = array(
			"name" => "den",
			"id" => "den",
			"value" => set_value("den")		
		);		

		$mesec = array(
			"name" => "mesec",
			"id" => "mesec",
			"value" => set_value("mesec")
		);

		$godina = array(
			"name" => "godina",
			"id" => "godina",
			"value" => set_value("godina")
		);

		$adresa = array(
			"name" => "adresa",
			"id" => "adresa",
			"value" => $adresa
		);

		$majka = array(
			"name" => "majka",
			"id" => "majka",
			"value" => $majka
		);

		$zanimanje_m = array(
			"name" => "zanimanje_m",
			"id" => "zanimanje_m",
			"value" => $zanimanje_m
		);

		$vraboten_m = array(
			"name" => "vraboten_m",
			"id" => "vraboten_m",
			"value" => $vraboten_m	
		);

		$tel_m = array(
			"name" => "tel_m",
			"id" => "tel_m",
			"value" => $tel_m
		);

		$tatko = array(
				"name" => "tatko",
				"id" => "tatko",
				"value" => $tatko				
		);
		
		$zanimanje_t = array(
				"name" => "zanimanje_t",
				"id" => "zanimanje_t",
				"value" => $zanimanje_t
		);
		
		$vraboten_t = array(
				"name" => "vraboten_t",
				"id" => "vraboten_t",
				"value" => $vraboten_t
		);
		
		$tel_t = array(
				"name" => "tel_t",
				"id" => "tel_t",
				"value" => $tel_t
		);
		
		//napisi go javascript-ot za validacija na klient						
		$attributes = array('name' => 'form', 'id' => 'form', 'onsubmit' => 'return test(this);', 'class' => 'form');
		
		
		?>
		
		<h1>Формулар за прием</h1>
		
		
		
		<?php

		echo "<br><br>";
		
		//napisi action del za formata, odnosno koj controller da se povika
		echo form_open_multipart('controller_klienti_main/post_prikaz_klienti/'.$id_klient, $attributes);
			
			echo form_label("Датум на прва посета: ");
			?>
			
			<input type="text" name="datum_prva_poseta" id="datum_prva_poseta" value="<?php echo $datum_prva_poseta;?>" readonly="readonly"/>
			<input type="hidden" name="id" value="<?php echo $id; ?>"/>
			<br/><br/>
			
			<?php 
						
				
			echo form_label("Упатен од: ", "upaten_od");
			echo form_input($upaten_od)."<br>"."<br>";
			
			echo form_label("Примен од:	");
			echo form_dropdown('vraboteni', $vraboteni, $primen_od);
			
			echo "<br><br>";
			
			echo form_label("Ќе работи со:	");
			echo form_dropdown('raboti_so', $vraboteni, $raboti_so);

			
			echo "<br><br><br><br>";
			
			?>
			
			
			<h2>Лични податоци</h2>
				
			<h3>Корисник</h3>
									
			<?php 						
		
			echo form_label("Име и презиме: ", "ime_prezime");
			echo form_input($ime_prezime)."<br>"."<br>";
			
			echo form_label("Датум на раѓање: ");
			echo form_dropdown('denovi', $denovi, $den_r)."	";
			echo form_dropdown('meseci', $meseci, $mesec_r)."	";
			echo form_dropdown('godini', $godini, $godina_r)."<br>"."<br>";

									
			echo form_label("Адреса: ", "adresa");
			echo form_input($adresa)."<br>"."<br>";
									

			echo form_label("Тип на попреченост: ")."<br/>";
			//echo form_multiselect('poprecenosti', $poprecenosti);
			foreach($poprecenosti_site as $p){
			
			?>
			<input type="checkbox" name="poprecenosti[]" value="<?php echo $p;?>" 
			<?php if (in_array($p, $poprecenosti)) {?>
			checked=TRUE
			<?php }?>
			 /><?php echo $p;?><br />
			
			<?php 
			}
			echo "<br><br>";
			
			echo form_label("Тип на образование: ");
			echo form_dropdown('obrazovanie', $obrazovanie, $tip_obrazovanie);
			
			
			echo "<br><br>";
			
			echo form_label("Тип на посета: ");
			echo form_dropdown('poseta', $poseta,$tip_poseta)."<br>"."<br>";
			
			
			echo form_label("Пол: ", "pol");
			echo form_dropdown('pol', $pol)."<br>"."<br>";	
			
			?>	
			
			<h3>Родители</h3> <br/>
			
			<div class="majka">	
				<h4>Мајка</h4>
			
		
				
			<?php
			
			echo form_label("Име и презиме: ", "majka");
			echo form_input($majka)."<br>"."<br>";
				
			echo form_label("Занимање: ", "zanimanje_m");
			echo form_input($zanimanje_m)."<br>"."<br>";
				
			echo form_label("Вработена: ", "vraboten_m");
			echo form_input($vraboten_m)."<br>"."<br>";
				
			echo form_label("Телефон: ", "tel_m");
			echo form_input($tel_m)."<br>"."<br>";			
			
			?>
			</div>
				
			<div class="tatko">
			<h4>Татко</h4>
		
		
			<?php
			
			echo form_label("Име и презиме: ", "tatko");
			echo form_input($tatko)."<br>"."<br>";
				
			echo form_label("Занимање: ", "zanimanje_t");
			echo form_input($zanimanje_t)."<br>"."<br>";
				
			echo form_label("Вработен: ", "vraboten_t");
			echo form_input($vraboten_t)."<br>"."<br>";
				
			echo form_label("Телефон: ", "tel_t");
			echo form_input($tel_t)."<br>"."<br>";
			
			?>
			</div>
		 
		
			<h2>Очекувања</h2><br/>
			
			<h3>На корисникот</h3>
			
			<textarea name="ocekuvanja_klient"  id="ocekuvanja_klient" rows="5" cols="50" placeholder="Внеси очекување"><?php echo  $ocekuvanja_klient;?></textarea><br/> <br/>
			
			<h3>На родителите</h3>
					
			<textarea name="ocekuvanja_roditel" id="ocekuvanja_roditel"  rows="5" cols="50" placeholder="Внеси очекување"><?php echo $ocekuvanja_roditel;?></textarea><br/> <br/>
			
			<h3>Коментар</h3>
					
			<textarea name="komentar" id="komentar"  rows="5" cols="50" placeholder="Внеси коментар"><?php echo $komentar;?></textarea><br/> <br/>
				
		<?php //ova e na kraj vo sekoj slucaj
			echo form_submit('editPriemSave', "Зачувајте ги промените");
			echo form_submit('otkaziPriem', "Откажи");
		echo form_close();?>
		
		
		
	