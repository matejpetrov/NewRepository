<html>
	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
		
		</head>
		<body>
		<?php
		$this->load->helper("html");
		echo form_open_multipart("controller_klienti_main/post_edit_dnevno_sledenje/".$id);
		echo $errors;
		
		echo form_label("Датум: ","data");
		$data=array(
				"name" => "data_den",
				"id" => "data_den",
				"style"=>"width: 50px",
				"value" => $day
				);
		echo form_input($data);
		echo " - ";
		$data=array(
				"name" => "data_mesec",
				"id" => "data_mesec",
				"style"=>"width: 50px",
				"value" => $month
		);
		echo form_input($data);
		echo " - ";
		$data=array(
				"name" => "data_godina",
				"id" => "data_godina",
				"style"=>"width: 70px",
				"value" => $year
		);
		echo form_input($data);
		echo br(2);
		
		echo form_label("Цел на активности: ","cel");
		$data=array(
				"name" => "cel",
				"id" => "cel",
				"value" => $cel);
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Реализација: ","realizacija");
		$data=array(
				"name" => "realizacija",
				"id" => "realizacija",
				"value" => $realizacija);
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Постигнувања: ","postignuvanje");
		$data=array(
				"name" => "postignuvanje",
				"id" => "postignuvanje",
				"value" => $postignuvanja);
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Потешкотии: ","poteskotii");
		$data=array(
				"name" => "poteskotii",
				"id" => "poteskotii",
				"value" => $poteskotii);
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("План за нареден пат: ","plan");
		$data=array(
				"name" => "plan",
				"id" => "plan",
				"value" => $plan_naredna_poseta);
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		
		echo form_label("Променете го документот: ");
				
		//$js = 'onClick="controller_klienti/func"';
		echo anchor_popup("/dokumenti/$file", $file);
		$data=array(
				"name" => "upload",
				"id" => "upliad",
				"value" => "Прикачете документ");
		echo br(1);
		echo form_upload($data);
		
		echo br(2);
		echo form_submit("submitEdit","Зачувајте ги промените");
		form_close();
		?>
		
		
		</body>
		</html>
