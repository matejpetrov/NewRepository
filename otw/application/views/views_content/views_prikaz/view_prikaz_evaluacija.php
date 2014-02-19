<?php
echo heading ( "Евалуација на постигнувањата на корисникот" );
echo form_open_multipart ( "controller_klienti_main/prikaz_evaluacija/".$id );

echo form_hidden ( 'id_korisnik', $id_korisnik );

echo form_label ( "Корисник: ");
echo $klient;
echo br ( 2 );

echo form_label ( "Период за кој е направена евалуацијата: ");
echo $period;
echo br ( 2 );

echo form_label ( "Датум кога е направена евалуацијата : " );
echo $datum;
echo br ( 2 );

echo form_label ( "Од кого е направена евалуацијата: ", "evauliral" );
echo $vraboteni[$evaluiral];
echo br ( 2 );

echo form_label ( "Со корисникот активностите ги спреведува: ");
echo $vraboten;
echo br ( 2 );

echo form_label ( "Планирани цели: ", "planirani" );
echo br ( 1 );
echo $planirani_celi;
echo br ( 2 );

echo form_label ( "Остварени цели: ", "ostvareni_celi" );
echo br ( 1 );
echo $ostvareni_celi;
echo br ( 2 );

echo form_label ( "Наративен извештај: ", "narativen" );
echo br ( 1 );
echo $narativen_izvestaj;
echo br ( 2 );

echo form_label ( "Поставени цели за периодот кој следува: ", "novi_celi" );
echo br ( 1 );
echo $novi_celi;
echo br ( 2 );

echo form_label ( "Препораки: ", "preporaki" );
echo br ( 1 );
echo $preporaki;
echo br ( 2 );
echo form_submit ( "pdf", "Креирајте pdf" );
echo br ( 2 );
echo form_submit ( "edit", "Променете ги податоците" );
form_close ();

?>