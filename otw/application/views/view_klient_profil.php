<html>

	<head>
	
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
	
	</head>

<?php
//vo ovoj view ke prikazam ime i prezime, datum na raganje, adresa, tip na poprecenost, site nabrojani, 
//i ke ponudam kopcinja za pregled na formularite za priem, plan i procenka kako i dnevno sledenje.

?>

<h2>Профил за корисникот <?php echo $klient['ime_prezime']?></h2>
	
	<div id="osnovni_info">
		<label>Датум на раѓање:</label> <?php echo $klient['datum_raganje']."<br>";?>
		<label>Адреса:</label> <?php echo $klient['adresa']."<br>";?>
		<label>Работи со:</label> <?php echo $ime_vraboten."<br>";?>
		<label>Тип на посета:</label> <?php echo $klient['tip_poseta']."<br>";?>
		<label>Тип на попреченост:</label> 
			
			<?php if(count($poprecenosti) > 0){
			
				?>
			
			<ul type="disc">
				<?php 
				
					foreach($poprecenosti as $p){
	
				?>
				
					<li><?php echo $p;?></li>
					<?php 
					}
					
				}			
				else echo "/<br><br>";
				
				?>
				
						
			</ul>
	</div>
	
</html>