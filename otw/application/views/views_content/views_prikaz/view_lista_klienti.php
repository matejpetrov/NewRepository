<script type="text/javascript">
<!--

//-->
$(document).ready(function() 
	    { 
	        $("#myTable").tablesorter(); 
	    } 
	); 

</script>




		
		<h1>Листа од клиенти</h1>
		
		<?php //print_r($klienti);?> 
		
		<form>
			<table id="myTable" class="tablesorter"> <!-- class="table table-hover"> -->
			 <thead>
				<tr>
					<th>Име и презиме</th>
					<th>Работи со</th>
					<th>Тип на посета</th>
					<th>Попреченост</th>
				</tr>
				 <thead>
				 
				 <tbody>
				<?php 
				foreach ($klienti as $klient)
				{
					?>
					<tr onclick=" window.location ='<?php echo base_url();?>controller_klienti_main/prikaz_klienti/<?php echo $klient['id']?>'"> 
						<td><?php // echo anchor(base_url()."controller_klienti_main/prikaz_klienti/".$klient['id'], 
						echo $klient['ime_prezime'];?>
						<td><?php echo $klient['raboti_so_ime'];?></td>
						<td><?php echo $klient['tip_poseta'];?></td>
						<td><?php
						$attributes = array(

								'id'    => 'mylist'
						);
						echo ul($klient['poprecenosti']);?></td>
						<?php //treba linkov koga ke go kliknam da mi se napravat site polinja textbox-ovi 
							//vo koi ke mozam da editiram podatoci, a ovoj link da stane zacuvaj ili otkazi.?>						
					</tr>
				
				<?php					

				}
				
				?>
				</tbody>
			
			</table>
		</form>
		
	

