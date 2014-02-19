
<?php 


//ovoj view ke go iskoristam za 

?>
<html>


	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
		
		
		<script>

			function test(){
				
			}

		</script>
		
	</head>
	
	
	<body>
		
		
		<?php echo "View Terapevti, welcome";

			echo "<br>";
			//tuka samo go printam poleto za da proveram sto tocno imam vo nego.
			print_r($terapevti);
			
			echo "<br>";
			echo "<br>";
			echo $errors;
			
		?>
		
		<table border="1">
			
			<tr>
				<th colspan="2">Основни информации</th>
				<th colspan="3">Контакт</th>
			</tr>
			
			<tr>
				<th>Име и презиме</th>
				<th>Институција</th>
				<th>Емаил адреса</th>
				<th>Телефон</th>		
			</tr>
			
			<?php 
			for($i=0;$i<sizeof($terapevti);$i++){
				
				?>
				<tr>
					<td><?php echo $terapevti[$i]->terapevt_ime_prezime;?></td>
					<td><?php echo $terapevti[$i]->ime_institucija;?></td>
					<td><?php echo $terapevti[$i]->mail;?></td>
					<td><?php echo $terapevti[$i]->telefon;?></td>
					<?php //treba linkov koga ke go kliknam da mi se napravat site polinja textbox-ovi 
						//vo koi ke mozam da editiram podatoci, a ovoj link da stane zacuvaj ili otkazi.?>
					<td><a href="">Едитирај</a></td>
				</tr>
				
				<?php 
			}												
				
				?>
		
		</table>
		
		<div class="popup">
					
					
			<h3>Внесете информации за терапевтот</h3>
			
			Име и презиме: <input type="text" name="terapevt_ime_prezime" value="<?php set_value('terapevt_ime_prezime');?>"/><br/><br/>
			Институција: <?php /*echo form_dropdown('institucija', $institucii)."	"; 
							echo form_submit('dodadiInstitucija', 'Додади институција')."<br><br>";
							*/
						?>	
			Маил: <input type="text" name="mail" value="<?php set_value('mail');?>"/><br/><br/>
			Телефон: <input type="text" name="telefon" value="<?php set_value('telefon');?>"/><br/><br/>											
										
			
		</div>
	
	</body>


</html>