<?php
echo heading ( "Евалуација на постигнувањата на корисникот" );
echo form_open_multipart ( "controller_klienti_main/post_edit_evaluacija/" . $id );

echo form_hidden ( 'id_korisnik', $id_korisnik );

echo form_label ( "Корисник: ", "korisnik" );
$data = array (
		"name" => "korisnik",
		"id" => "korisnik",
		"value" => $klient,
		"readonly" => TRUE 
);
echo form_input ( $data );
echo br ( 2 );

echo form_label ( "Период за кој е направена евалуацијата: ", "period" );
$data = array (
		"name" => "period",
		"id" => "period",
		"style" => "width: 200px",
		"value" => $period 
);
echo form_input ( $data );
echo br ( 2 );

echo form_label ( "Датум кога е направена евалуацијата : " );
$data = array (
		"name" => "data_den",
		"id" => "data_den",
		"style" => "width: 50px",
		"value" => $day 
);
echo form_input ( $data );
echo " - ";
$data = array (
		"name" => "data_mesec",
		"id" => "data_mesec",
		"style" => "width: 50px",
		"value" => $month 
);
echo form_input ( $data );
echo " - ";
$data = array (
		"name" => "data_godina",
		"id" => "data_godina",
		"style" => "width: 70px",
		"value" => $year 
);
echo form_input ( $data );
echo br ( 2 );

echo form_label ( "Од кого е направена евалуацијата: ", "evauliral" );
echo form_dropdown ( "vraboteni", $vraboteni, $evaluiral );
echo br ( 2 );

echo form_label ( "Со корисникот активностите ги спреведува: ", "raboti_so" );
$data = array (
		"name" => "raboti_so",
		"id" => "raboti_so",
		"readonly" => TRUE,
		"value" => $vraboten 
);
echo form_input ( $data );
echo br ( 2 );

echo form_label ( "Планирани цели: ", "planirani" );
$data = array (
		"name" => "planirani",
		"id" => "planirani",
		"style" => "width: 800px",
		"value" => $planirani_celi 
);
echo br ( 1 );
echo form_textarea ( $data );
echo br ( 2 );

echo form_label ( "Остварени цели: ", "ostvareni_celi" );
$data = array (
		"name" => "ostvareni_celi",
		"id" => "ostvareni_celi",
		"style" => "width: 800px",
		"value" => $ostvareni_celi 
);
echo br ( 1 );
echo form_textarea ( $data );
echo br ( 2 );

echo form_label ( "Наративен извештај: ", "narativen" );
$data = array (
		"name" => "narativen",
		"id" => "narativen",
		"style" => "width: 800px",
		"value" => $narativen_izvestaj 
);
echo br ( 1 );
echo form_textarea ( $data );
echo br ( 2 );

echo form_label ( "Поставени цели за периодот кој следува: ", "novi_celi" );
$data = array (
		"name" => "novi_celi",
		"id" => "novi_celi",
		"style" => "width: 800px",
		"value" => $novi_celi 
);
echo br ( 1 );
echo form_textarea ( $data );
echo br ( 2 );

echo form_label ( "Препораки: ", "preporaki" );
$data = array (
		"name" => "preporaki",
		"id" => "preporaki",
		"style" => "width: 800px",
		"value" => $preporaki 
);
echo br ( 1 );
echo form_textarea ( $data );
echo br ( 2 );

echo form_submit ( "submitEval", "Зачувајте ги промените" );
form_close ();

?>