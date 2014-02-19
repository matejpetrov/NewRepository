<html>

	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
	
	</head>
		

	<body>
		
		<h1>Листа од клиенти</h1>
		
		<?php print_r($klienti);?> 
		
		<form>
			<table border="1">
			
				<tr>
					<th>Име и презиме</th>
					<th>Работи со</th>
					<th>Тип на посета</th>
					<th>Попреченост</th>
				</tr>
				
				<?php 
				for($i=0;$i<sizeof($klienti);$i++){
					
					?>
					<tr>
						<td><a href="controller_klienti/klient_profil/<?php echo $klienti[$i]->id;?>"><?php echo $klienti[$i]->ime_prezime;?></a></td>
						<td><?php echo $klienti[$i]->ime_vraboten;?></td>
						<td><?php echo $klienti[$i]->tip_poseta;?></td>
						<td><?php echo $klienti[$i]->poprecenost;?></td>
						<?php //treba linkov koga ke go kliknam da mi se napravat site polinja textbox-ovi 
							//vo koi ke mozam da editiram podatoci, a ovoj link da stane zacuvaj ili otkazi.?>						
					</tr>
				
				<?php					

				}
				
				?>
			
			</table>
		</form>
		
	</body>
	
	
</html>

