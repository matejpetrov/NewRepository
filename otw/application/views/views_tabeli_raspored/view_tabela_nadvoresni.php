	
	
	
	<table class="table table-striped">
				
			<thead>
				<tr>
					<th colspan="2" style="text-align: center;">Основни информации</th>
					<th colspan="2" style="text-align: center;">Контакт</th>
					<th></th>
				</tr>
				
				<tr>
					<th>Име и презиме</th>
					<?php 
					$institucija = "";
					if($flag == 1){
						$institucija = "Институција";						
					}
					else if($flag == 2){
						$institucija = "Училиште";						
					}
					else if($flag == 3){
						$institucija = "Фирма";						
					}
					
					?>
					
					<th><?php echo $institucija;?></th>
					<th>Емаил адреса</th>
					<th>Телефон</th>
					<th>Притиснете за промена</th>		
				</tr>
			</thead>
			
			<tbody>
				
				<?php 
				foreach($nadvoresni as $n){
						
					?>
					<tr>					
						<td id="td_ime_<?php echo $n['id_nadvoresen'];?>"><?php echo $n['nadvoresen_ime_prezime'];?></td>
						<td id="td_institucija_<?php echo $n['id_nadvoresen'];?>"><?php echo $n['ime_institucija'];?></td>
						<td id="td_mail_<?php echo $n['id_nadvoresen'];?>"><?php echo $n['mail'];?></td>
						<td id="td_telefon_<?php echo $n['id_nadvoresen'];?>"><?php echo $n['telefon'];?></td>
						<?php 
					
						?>
						<td>
						<?php $id_nadvoresen = $n['id_nadvoresen'];
							//mi treba id-to na institucijata, zatoa ne go davam ime_institucija.
							$institucija = $n['institucija'];		
							$ime_prezime = $n['nadvoresen_ime_prezime'];
						?>
							<button type="button" name="editNadvoresen" class="btn btn-link" data-toggle="modal" data-target="#myModalEdit" onclick="set_nadvoresen_info_edit('<?= $id_nadvoresen?>', '<?= $institucija?>');">
								Промени
							</button>	
							
							<button type="button" name="deleteNadvoresen" class="btn btn-link" data-toggle="modal" data-target="#myModalDelete" onclick="set_nadvoresen_info_delete('<?= $id_nadvoresen?>', '<?= $ime_prezime?>', '<?= $flag?>');">
								Избриши
							</button>							
							
							
							<!--  <a>Промени</a> -->
						</td>
					</tr>
					
					<?php 
				}												
					
					?>
					
		</tbody>
	</table>		