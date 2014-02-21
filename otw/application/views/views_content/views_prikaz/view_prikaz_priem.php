
<div class=pre-scrollable>
	<div class="priem" style="border: double;">
    <?php
				echo form_open ( "controller_klienti_main/prikaz_klienti" );
				echo heading ( "Формулар за прием", 2 );
				
				echo br ( 2 );
				
				echo form_label ( "Датум на прием:  " );
				echo $datum_prva_poseta;
				echo br ( 2 );
				echo form_label ( "Упатен од: ", "upaten_od" );
				echo $upaten_od;
				echo br ( 2 );
				
				echo form_label ( "Примен од:	" );
				echo $vraboteni [$primen_od];
				echo br ( 2 );
				
				echo form_label ( "Ќе работи со:	" );
				echo $vraboteni [$raboti_so];
				echo br ( 3 );
				echo heading ( "Лични податоци", 3 );
				?>
<div class="row">

			<div class="col-md-6">
	
		<?php
		echo heading ( 'Корисник', 4 );
		echo br ( 1 );
		
		echo form_label ( "Име и презиме: ", "ime_prezime" );
		echo $ime_prezime;
		echo br ( 2 );
		
		echo form_label ( "Датум на раѓање: " );
		echo $datum_raganje;
		echo br ( 2 );
		echo form_label ( "Адреса: ", "adresa" );
		echo $adresa;
		echo br ( 2 );
		
		echo form_label ( "Тип на попреченост: " );
		echo br ( 1 );
		// echo form_multiselect('poprecenosti', $poprecenosti);
		$attributes = array (
				'id' => 'mylist' 
		);
		echo ul ( $poprecenosti, $attributes );
		echo br ( 2 );
		
		echo form_label ( "Тип на образование: " );
		echo $tip_obrazovanie;
		echo br ( 2 );
		
		echo form_label ( "Тип на посета: " );
		echo $tip_poseta;
		echo br ( 2 );
		
		echo form_label ( "Пол: ", "pol" );
		echo "zenski"; // /smeni ova obavezno!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
		
		?>
				</div>

			<div class="col-md-6">

					<?php
					
					echo heading ( 'Родители', 4 );
					echo br ( 1 );
					
					echo heading ( '<span style="display:block; border:solid" >Majka</span>', 5 );
					echo br ( 1 );
					
					echo form_label ( "Име и презиме: ", "majka" );
					echo $majka;
					echo br ( 2 );
					
					echo form_label ( "Занимање: ", "zanimanje_m" );
					echo $zanimanje_m;
					echo br ( 2 );
					
					echo form_label ( "Вработена: ", "vraboten_m" );
					echo $vraboten_m;
					echo br ( 2 );
					
					echo form_label ( "Телефон: ", "tel_m" );
					echo $tel_m;
					echo br ( 1 );
					
					echo heading ( '<span style="display:block; border:solid" >Татко</span>', 5 );
					echo br ( 1 );
					
					echo form_label ( "Име и презиме: ", "tatko" );
					echo $tatko;
					echo br ( 2 );
					
					echo form_label ( "Занимање: ", "zanimanje_t" );
					echo $zanimanje_t;
					echo br ( 2 );
					
					echo form_label ( "Вработен: ", "vraboten_t" );
					echo $vraboten_t;
					echo br ( 2 );
					
					echo form_label ( "Телефон: ", "tel_t" );
					echo $tel_t;
					echo br ( 2 );
					
					?>
			</div>

		</div>



		<div class="row">
			<div class="col-md-12">


				<h3>Очекувања</h3>
				<br />

				<h4>На корисникот</h4>
				<p>
<?php echo $ocekuvanja_klient;?>
</p>
				</br>
				<h4>На родителите</h4>
				<p>
<?php echo $ocekuvanja_roditel;?>
</p>
				</br>
				<h4>Коментар</h4>
				<p>
<?php echo $komentar;?>
</p>
				
		
		<?php
		// ova e na kraj vo sekoj slucaj
		echo br ( 2 );
		echo form_submit ( 'edit_priem', "Променете ги податоците" );
		echo br ( 1 );
		echo form_submit ( 'pdf_priem', "Креирајте PDF" );
		?>
		</div>
		</div>
<?php
echo form_close ();
?>
</div>
</div>

