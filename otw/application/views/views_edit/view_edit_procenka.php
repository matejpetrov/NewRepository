<?php 
echo "<pre>";
echo print_r($informacii_procenka);

echo "</pre>";
echo "<br><br><br>";

?>

<html>

	<head>
		
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>	

		<!--ova raboti, mozes da go koristis <link rel="stylesheet" type="text/css" href="assets/css/proba.css"> -->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="assets/js/procenka.js"></script>
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
		
	</head>
	
	<body>
		
		<h1>Направете промени и притиснете го копчето Промени проценка</h1>
		
		<br/>
		
		<p><?php //echo $errors;?></p>
		
		<h2>Личен профил на корисникот</h2>
		<br/>		
			<?php
			
		$attributes = array('name' => 'form', 'id' => 'form', 'onsubmit' => 'return test(this);', 'class' => 'form');		
		
		
		echo form_open('controller_klienti_edit_prikaz/edit_procenka_klient/1', $attributes);
			echo form_label("Проценката ја има направено:	");
			echo form_dropdown('vraboteni', $vraboteni, $informacii_procenka['procenka_napravil'])."		";
			
			//sekogas ke dobiva vrednost na tekoven datum.
			echo form_label("Датум кога е направена проценката: ");
			
			?>
			<input type="text" name="datum_procenka" id="datum_procenka" value="<?php echo $informacii_procenka['datum_na_procenka'];?>" readonly="readonly"/>			
			
			<h4>Моторика (горни и долни екстремитети, литерализација, подвижност)</h4>
			
			<textarea name="motorika" id="motorika" rows="7" cols="65"><?php echo $informacii_procenka['motorika'];?></textarea><br/> <br/>
			<?php //echo form_textarea($motorika)."<br>";?>
			
			<h4>Когнитивни способности (внимание, мислење, помнење, ориентација во време и простор,<br/>
			математички способности)</h4>
			
			<textarea name="kognitivni_spos" id="kognitivni_spos" rows="7" cols="65"><?php echo $informacii_procenka['kognitivni_spos'];?></textarea><br/> <br/>
			
			<h4>Говор/комуникација</h4>
			
			<textarea name="govor_komunikacija" id="govor_komunikacija" rows="7" cols="65"><?php echo $informacii_procenka['govor_komunikacija'];?></textarea><br/> <br/>
			
			<h4>Писменост</h4>
			
			<textarea name="pismenost" id="pismenost" rows="7" cols="65"><?php echo $informacii_procenka['pismenost'];?></textarea><br/> <br/>
			
			
			<h4>Однесување</h4>
			
			<textarea name="odnesuvanje" id="odnesuvanje" rows="7" cols="65"><?php echo $informacii_procenka['odnesuvanje'];?></textarea><br/> <br/>
			
			
			<h4>Ризици</h4>
			
			<textarea name="rizici" id="rizici" rows="7" cols="65"><?php echo $informacii_procenka['rizici'];?></textarea><br/> <br/>
			
			<h4>Семејно-срединско опкружување</h4>
			<p><i>(каде живее, со кого, драги личности, од животот, интеракција со врсници, 
			возрасни лица, што најчесто прави дома)</i></p>
							
			<textarea name="opkruzuvanje" id="opkruzucvanje" rows="7" cols="65"><?php echo $informacii_procenka['opkruzuvanje'];?></textarea><br/> <br/>
			
			<h4>Интереси</h4>
			<p><i>(што сака да прави најчесто)</i></p>
							
			<textarea name="interesi" id="interesi" rows="7" cols="65"><?php echo $informacii_procenka['interesi'];?></textarea><br/> <br/>
			
			<h4>Компјутерски вештини</h4>
			<p><i>(дали претходно користел/користела компјутер, за која цел, каде)</i></p>
							
			<textarea name="kompjuterski_vestini" id="kompjuterski_vestini" rows="7" cols="65"><?php echo $informacii_procenka['kompjuterski_vestini'];?></textarea><br/> <br/>						
			
			<h3>Работа со терапевти</h3>
			
			<h4>Терапевт со кој работи: </h4>
			
			<div id="container">
				<?php echo $terapevti;?>
			</div>
																		
			<h4>Наставник со кој работи: </h4>
			
			<?php 	

			echo form_dropdown('nastavnici', $nastavnici, $informacii_procenka['nastavnik']);
						
			echo "<br><br>";
			?>
			
			<input type="submit" name="editProcenka" id="editProcenka" value="Промени проценка" />
			
			<input type="submit" name="otkazi" id="otkazi" value="Откажи" />
			
		<?php echo form_close();?>				

	
	</body>
</html>

