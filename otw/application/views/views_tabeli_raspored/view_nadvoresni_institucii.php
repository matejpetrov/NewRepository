
<?php 


//ovoj view ke go iskoristam za 

?>
<html>


	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>	

		<!--ova raboti, mozes da go koristis <link rel="stylesheet" type="text/css" href="assets/css/proba.css"> -->
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/nadvoresni_institucii_add_edit_delete.js"></script>
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
		
	</head>
	
	
	<body>
		
		
		<?php 
		
		$title = "";
		$dodadi = "";
		$title_modal = "";
		$ime = "";
		$edit = "";
		
		if($flag == 1){
			$title = "Институции";
			$dodadi = "нова институција";
			$title_modal = "Нова институција";
			$ime = "Име на институција";
			$edit = "институција";
		}
		else if($flag == 2){
			$title = "Училишта";
			$dodadi = "ново училиште";
			$title_modal = "Ново училиште";
			$ime = "Име на училиште";
			$edit = "училиште";
		} 
		else if($flag == 3){
			$title = "Фирми";
			$dodadi = "нова фирма";
			$title_modal = "Нова фирма";
			$ime = "Име на фирма";
			$edit = "фирма";
		}
		
		?>
			
		
			<h1><?php echo $title;?></h1>
		<?php

			echo "<br>";
			
			echo "<br>";
			echo "<br>";			
			
		?>
		
		<div id="container">
				<?php echo $nadvoresni_institucii_tabela;?>
		</div>
		
		
		<br/>
		<br/>
		<br/>
		
		<button type="button" name="dodadiNovaNadvoresnaInstitucija" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModalNadvoresnaInstitucija">
				Додади <?php echo $dodadi;?>
		</button>				
		
	<!-- Modal za prikaz na popup za dodavanje na nova institucija --> 
	<div class="modal fade" id="myModalNadvoresnaInstitucija" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel"><?php echo $title_modal;?></h4> 
				</div> 
				
				<div class="modal-body">
										
					<form class="form-horizontal">
					
						<div class="form-group">
							    
						    <label for="ime_nadvoresna_institucija" class="col-sm-2 control-label"><?php echo $ime;?></label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="ime_nadvoresna_institucija">
						    </div>
							    
						</div>
					
					</form>										
										
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="dodadi_nova_nadvoresna_institucija_AJAX('<?= $flag?>');">Додади <?php echo $dodadi;?></button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->	
	
	
	
	<!-- Modal --> 
	<div class="modal fade" id="myModalNadvoresnaInstitucijaEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel">Промена на информации за <?php echo $edit;?></h4> 
				</div> 
				
				<div class="modal-body">
					
					<form class="form-horizontal">	 
										
						<div class="form-group">
						    
						    <label for="ime_nadvoresna_institucija_edit" class="col-sm-2 control-label"><?php echo $ime;?> </label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="ime_nadvoresna_institucija_edit">
						    </div>
						    
						</div>																																				
						
						
					</form>
											
					
					<input type="hidden" id="id_nadvoresna_institucija" name="id_nadvoresna_institucija" />									
						
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="edit_nadvoresna_institucija_AJAX('<?= $flag?>');">Промени <?php echo $edit;?></button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
	<!-- Modal --> 
	<div class="modal fade" id="myModalNadvoresnaInstitucijaDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel">Бришење на <?php echo $edit;?></h4> 
				</div> 
				
				<div class="modal-body">
					
					<input type="hidden" id="id_nadvoresna_institucija_delete" name="id_nadvoresna_institucija_delete" />
					<p id="paragraph"></p>					
										
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="delete_nadvoresna_institucija_AJAX('<?= $flag?>');">Избриши <?php echo $edit;?></button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
									
			
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="//code.jquery.com/jquery.js"></script>
	
	</body>


</html>