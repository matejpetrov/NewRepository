	
	
	
	<?php 
	
	$naziv_institucija = "";
	
	if($flag == 1){
		$naziv_institucija = "институција";		
	}
	else if($flag == 2){
		$naziv_institucija = "училиште";		
	}
	else if($flag == 3){
		$naziv_institucija = "фирма";		
	}
	
	?>
	
	
	<table class="table table-striped">
			
		<thead>
			<tr>
				<th style="text-align: left;">Име на <?php echo $naziv_institucija;?></th>	
				<th style="text-align: left;">Притиснете за промена</th>								
			</tr>
			
		</thead>
		
		<tbody>
			
			<?php 								
			
			foreach($nadvoresni_institucii as $key => $value){
					
				?>
				<tr>					
					<td id="td_nadvoresna_institucija_<?php echo $key;?>"><?php echo $value;?></td>	
					
					<td>
					
					<?php
					
					$id_nadvoresna_institucija = $key;
					$ime_nadvoresna_institucija = $value;						
					
					?>
						<button type="button" name="editNadvoresnaInstitucija" class="btn btn-link" data-toggle="modal" data-target="#myModalNadvoresnaInstitucijaEdit" onclick="set_nadvoresna_institucija_info_edit('<?= $id_nadvoresna_institucija?>');">
							Промени
						</button>	
						
						<button type="button" name="deleteNadvoresnaInstitucija" class="btn btn-link" data-toggle="modal" data-target="#myModalNadvoresnaInstitucijaDelete" onclick="set_nadvoresna_institucija_info_delete('<?= $id_nadvoresna_institucija?>', '<?= $ime_nadvoresna_institucija?>', '<?= $flag?>');">
							Избриши
						</button>							
																				
					</td>
				</tr>
				
				<?php 
			}												
				
				?>
				
		</tbody>
	</table>		