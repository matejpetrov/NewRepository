<?php
echo heading("Евалуација на постигнувањата на корисникот");
echo form_open_multipart("controller_klienti_main/post_dodadi_evaluacija");

echo form_hidden('id_korisnik', $id_korisnik);

echo form_label("Корисник: ","korisnik");
$data=array(
		"name" => "korisnik",
		"id" => "korisnik",
		"value" => $klient,
		"readonly"=>TRUE
);
echo form_input($data);
echo br(2);

echo form_label("Период за кој е направена евалуацијата: ","period");
$data=array(
		"name" => "period",
		"id" => "period",
		"style"=>"width: 200px",
);
echo form_input($data);
echo br(2);

echo form_label("Датум кога е направена евалуацијата : ");
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


		echo form_label("Од кого е направена евалуацијата: ","evauliral");
		echo form_dropdown("vraboteni",$vraboteni);
		echo br(2);
		
		echo form_label("Со корисникот активностите ги спреведува: ","raboti_so");
		$data=array("name" => "raboti_so",
				"id" => "raboti_so",
				"readonly" => TRUE,
				"value" =>$vraboten
		);
		echo form_input($data);
		echo br(2);
		
		
		echo form_label("Планирани цели: ","planirani");
		$data=array(
				"name" => "planirani",
				"id" => "planirani",
				"style"=>"width: 800px",
				"value" => $kratkorocni_celi);
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Остварени цели: ","ostvareni_celi");
		$data=array(
				"name" => "ostvareni_celi",
				"id" => "ostvareni_celi",
				"style"=>"width: 800px",
				"value" => set_value("ostvareni_celi"));
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Наративен извештај: ","narativen");
		$data=array(
				"name" => "narativen",
				"id" => "narativen",
				"style"=>"width: 800px",
				"value" => set_value("narativen"));
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Поставени цели за периодот кој следува: ","novi_celi");
		$data=array(
				"name" => "novi_celi",
				"id" => "novi_celi",
				"style"=>"width: 800px",
				"value" => set_value("novi_celi"));
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_label("Препораки: ","preporaki");
		$data=array(
				"name" => "preporaki",
				"id" => "preporaki",
				"style"=>"width: 800px",
				"value" => set_value("preporaki"));
		echo br(1);
		echo form_textarea($data);
		echo br(2);
		
		echo form_submit("submitEval","Внесете евалуација");
		form_close();
		
		
?>