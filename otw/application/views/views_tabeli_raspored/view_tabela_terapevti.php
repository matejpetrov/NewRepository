<table border="1">

			<tr>
				<th colspan="2" style="text-align: center;">Основни информации</th>
				<th colspan="3" style="text-align: center;">Контакт</th>
			</tr>

			<tr>
				<th>Име и презиме</th>
				<th>Институција</th>
				<th>Емаил адреса</th>
				<th>Телефон</th>
				<th>Притиснете за промена</th>		
			</tr>

			<?php 
			foreach($terapevti as $t){

				?>
				<tr>					
					<td id="td_ime_<?php echo $t['id_terapevt'];?>"><?php echo $t['terapevt_ime_prezime'];?></td>
					<td id="td_institucija_<?php echo $t['id_terapevt'];?>"><?php echo $t['ime_institucija'];?></td>
					<td id="td_mail_<?php echo $t['id_terapevt'];?>"><?php echo $t['mail'];?></td>
					<td id="td_telefon_<?php echo $t['id_terapevt'];?>"><?php echo $t['telefon'];?></td>
					<?php 

					//vo ovoj link ke povikam popup na koj ke mu dadam id na klientot koj sakam da go editiram i vo popup-ot 
					//ke imam polinja so vnesenite informacii za selektiraniot terapevt so moznost tie da se izmenat.
					//************************************
					?>
					<td>
					<?php $id_terapevt = $t['id_terapevt'];
						$institucija = $t['institucija'];		
					?>
						<button type="button" name="editTerapevt" class="btn btn-link" data-toggle="modal" data-target="#myModalEdit" onclick="set_terapevt_info('<?= $id_terapevt?>', '<?= $institucija?>');">
							Промени
						</button>								
						
						
						<!--  <a>Промени</a> -->
					</td>
				</tr>
				
				<?php 
			}												

				?>
		
		</table>		