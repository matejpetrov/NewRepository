<html>

	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
	</head>
	
	<body>

		<h2>Додади нова институција</h2>
		
		<?php
		echo $errors."<br>";
		
			$ime_institucija = array(
				"name" => "ime_institucija",
				"id" => "ime_institucija",
				"value" => set_value("ime_institucija")
			);
			
		
			echo form_open('controller_klienti/dodadi_nova_institucija');
			
				echo form_label("Име на институција:	", "ime_institucija");
				echo form_input($ime_institucija);
				echo form_submit('dodadiInstitucija', 'Додади институција')."<br><br>";
				
			echo form_close();
		
		?>
	
	</body>

</html>