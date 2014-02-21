<html>
	<head>
		
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
		</head>

<?php
$this->load->helper("html");
$attributes = array('name' => 'form', 'id' => 'form');
	echo form_open_multipart("controller_klienti_main/view_prikaz_dnevno_sledenje",$attributes);	
	/*echo form_label("Датум: ");
	echo $datum;
	echo br(2);
	*/
	echo form_label("Цел на активности: ");
	?>
	</br>
	<p>
	<?php
	echo $cel;
	?>
		</p>
		<?php
	echo br(2);
	echo form_label("Реализација: ");
	?>
		</br>
		<p>
		<?php
	echo $realizacija;
	?>
			</p>
			<?php
	echo br(2);
	echo form_label("Постигнувања: ");
	?>
			</br>
			<p>
			<?php
	echo $postignuvanja;
	?>
				</p>
				<?php
	echo br(2);
	echo form_label("Потешкотии: ");
	?>
				</br>
				<p>
				<?php
	echo $poteskotii;
	?>
				
				</p>
				<?php
	echo br(2);
	echo form_label("План за нареден пат: ");
	?>
				</br>
				<p>
				<?php
	echo $plan_naredna_poseta;
	?>
			
				</p>
				<?php
	echo br(2);
	if($file != ""){
	echo form_label("Документ: ");
	//echo $file;
	//echo br(2);
	
	echo anchor_popup($file, $file);
	//echo form_submit("pregled","Прегледајте го Документот");
	echo br(2);
	echo form_submit("download","Симнете го Документот");
	echo br(2);
	}
	echo form_submit("pdf","Креирајте pdf");
	echo br(2);
	echo form_submit("edit","Edit");
	
	echo form_close();

?>
</html>