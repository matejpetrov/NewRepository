
<label>Датум на раѓање:</label> 
</br>
		<label>Адреса:</label> </br>
		<label>Работи со:</label> </br>
		<label>Тип на посета:</label> </br>
		<label>Тип на попреченост:</label> </br>
			
			
				
						
			
<ul class="nav nav-tabs" >
	<li
		<?php
			if ($tab == "osnovni_info" && $prv = TRUE) {
				$prv = false;
				echo "class = active";
			}
			?>><a href="#osnovni_info" data-toggle="tab">Формулар за прием</a></li>
	<li 
	<?php
			
			if ($tab == "procenka" && $prv = TRUE) {
				$prv = false;
				echo "class = active";
			}
			?>><a href="#procenka" data-toggle="tab">Формулар за проценка</a></li>
	<li
		<?php
			
			if ($tab == "plan" && $prv = TRUE) {
				$prv = false;
				echo "class = active";
			}
			?>><a href="#plan" data-toggle="tab">Индивидуален план</a></li>
	<li><a href="#evaluacii" data-toggle="tab">Евалуации</a></li>
	<li><a href="#dnevno_sledenje" data-toggle="tab">Дневно следење</a></li>

</ul>

<!-- Tab panes -->
<div class="tab-content">
	<div 
		class="tab-pane <?php
			if ($tab == "osnovni_info" && $prv = TRUE) {
				$prv = false;
				echo "active";
			}
			?> "
		id="osnovni_info"><?php echo $priem?></div>
	<div class="tab-pane <?php
			if ($tab == "procenka" && $prv = TRUE) {
				$prv = false;
				echo "active";
			}
			?> " id="procenka"><?php echo $procenka?></div>
	<div class="tab-pane  <?php
			if ($tab == "plan" && $prv = TRUE) {
				$prv = false;
				echo "active";
			}
			?>"
		id="plan"><?php echo $plan;?></div>
	<div class="tab-pane" id="evaluacii">

		<ul>
	<li><?php echo anchor_popup(base_url()."controller_klienti_main/view_dodadi_evaluacija/".$id,"Додади нова евалуација" );?>
		
			
  <?php
		foreach ( $evaluacii as $row ) {
			?>
<li><?php echo anchor_popup(base_url()."controller_klienti_main/prikaz_evaluacija/".$row['id_evaluacija'] ,$row['period'] );?>
	</li>
<?php
		}
		?>
  </ul>
	</div>
	<div class="tab-pane" id="dnevno_sledenje">
		<ul>
		<li>	<?php echo anchor_popup(base_url()."controller_klienti_main/view_dnevno_sledenje/".$id, "Додадете нова посета" );?> </li>
  		<?php
				foreach ( $dnevni as $row ) {
					?>
<li>	<?php echo anchor_popup(base_url()."controller_klienti_main/view_prikaz_dnevno_sledenje/".$row['id_poseta'] ,$row['datum'] );?> </li>
		<?php
				}
				?>
  </ul>

	</div>
</div>

