<html>
	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
		
		</head>
		<body>
		<?php
		$this->load->helper("html");
		echo form_open_multipart("controller_klienti_main/dnevno_sledenje");
		echo $errors;
		
		echo form_label("Датум: ","data");
		$data=array(
				"name" => "data_den",
				"id" => "data_den",
				"style"=>"width: 50px",
				"value" => date("d")
				);
		echo form_input($data);
		echo " - ";
		$data=array(
				"name" => "data_mesec",
				"id" => "data_mesec",
				"style"=>"width: 50px",
				"value" => date("m")
		);
		echo form_input($data);
		echo " - ";
		$data=array(
				"name" => "data_godina",
				"id" => "data_godina",
				"style"=>"width: 70px",
				"value" => date("20y")
		);
		echo form_input($data);
		echo br(2);
		
		echo form_label("Цел на активности: ","cel");
		$data=array(
				"name" => "cel",
				"id" => "cel",
				"value" => set_value("cel"));
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Реализација: ","realizacija");
		$data=array(
				"name" => "realizacija",
				"id" => "realizacija",
				"value" => set_value("realizacija"));
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Постигнувања: ","postignuvanje");
		$data=array(
				"name" => "postignuvanje",
				"id" => "postignuvanje",
				"value" => set_value("postignuvanje"));echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Потешкотии: ","poteskotii");
		$data=array(
				"name" => "poteskotii",
				"id" => "poteskotii",
				"value" => set_value("poteskotii"));echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("План за нареден пат: ","plan");
		$data=array(
				"name" => "plan",
				"id" => "plan",
				"value" => set_value("plan"));echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Додадете документ: ");
				
		//$js = 'onClick="controller_klienti/func"';
		$data=array(
				"name" => "upload",
				"id" => "upliad",
				"value" => "Прикачете документ");
		echo br(1);
		echo form_upload($data);
		
		echo br(2);
		echo form_submit("submitDneven","Внесете дневно следење");
		form_close();
		?>
		
		
		</body>
		</html>


