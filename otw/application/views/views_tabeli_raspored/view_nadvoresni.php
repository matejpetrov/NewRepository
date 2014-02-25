<html>


	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>	
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/nadvoresni_add_edit_delete.js"></script>
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
		
		
		<script>

			function test(){
				
			}

		</script>
		
	</head>
	
	
	<body>
		
		
		<?php 
		
		$title = "";
		$nadvoresen = "";
		$institucija = "";
		
		if($flag == 1){
			$title = "Терапевти";
			$nadvoresen = "терапевт";
			$institucija = "Институции";
		}
		else if($flag == 2){
			$title = "Наставници";
			$nadvoresen = "наставник";
			$institucija = "Училишта";
		}
		else if($flag == 3){
			$title = "Одговорни од фирми";
			$nadvoresen = "вработен";
			$institucija = "Фирми";
		}
		
		?>
			
		
			<h1><?php echo $title;?></h1>
		<?php

			echo "<br>";
			
			echo "<br>";
			echo "<br>";
			echo $errors;
			
		?>
		
		<div id="container">
				<?php echo $nadvoresni_tabela;?>
		</div>
		
		
		<br/>
		<br/>
		<br/>
		
		<button type="button" name="dodadiNovNadvoresen" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
				Додади нов <?php echo $nadvoresen;?>
		</button>		
		
				
				
	<!-- Modal --> 
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel">Внесете нов <?php echo $nadvoresen;?></h4> 
				</div> 
				
				
				<div class="modal-body">
				
					<form class="form-horizontal">	 
										
						<div class="form-group">
						    
						    <label for="ime_prezime" class="col-sm-2 control-label">Име и презиме: </label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="ime_prezime">
						    </div>
						    
						</div>
												
						
						<div class="form-group">
							
							<label for="institucii" class="col-sm-2 control-label"><?php echo $institucija;?> </label>
							
							<div class="col-sm-10">
								<select name="institucii" id="institucii" class="form-control">
								<?php 
									
									foreach($institucii as $key => $value){
										
										?>
										
										<option value="<?php echo $key;?>"><?php echo $value;?></option>
										
										<?php }
										//echo form_dropdown('institucii', $institucii);?>																	
								
								
								</select>
							</div>
						</div>
							
						<div class="form-group">
						    
						    <label for="mail" class="col-sm-2 control-label">Маил: </label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="mail">
						    </div>
						    
						</div>
						
						<div class="form-group">
						    
						    <label for="telefon" class="col-sm-2 control-label">Телефон: </label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="telefon">
						    </div>
						    
						</div>
						
					</form>
				</div> 				
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="dodadi_nov_nadvoresen_AJAX('<?= $flag?>');">Додади <?php echo $nadvoresen;?></button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->					
	
	
	<!-- Modal --> 
	<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel">Промена на информации за <?php echo $nadvoresen;?></h4> 
				</div> 
				
				<div class="modal-body">
					
					<form class="form-horizontal">	 
										
						<div class="form-group">
						    
						    <label for="ime_prezime_edit" class="col-sm-2 control-label">Име и презиме: </label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="ime_prezime_edit">
						    </div>
						    
						</div>
												
						
						<div class="form-group">
							
							<label for="institucii_edit" class="col-sm-2 control-label"><?php echo $institucija;?> </label>
							
							<div class="col-sm-10">
								<select name="institucii_edit" id="institucii_edit" class="form-control">
								<?php 
									
									foreach($institucii as $key => $value){
										
										?>
										
										<option value="<?php echo $key;?>"><?php echo $value;?></option>
										
										<?php }
										//echo form_dropdown('institucii', $institucii);?>																	
								
								
								</select>
							</div>
						</div>
							
						<div class="form-group">
						    
						    <label for="mail_edit" class="col-sm-2 control-label">Маил: </label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="mail_edit">
						    </div>
						    
						</div>
						
						<div class="form-group">
						    
						    <label for="telefon_edit" class="col-sm-2 control-label">Телефон: </label>
						    <div class="col-sm-10">
						      <input type="text" class="form-control" id="telefon_edit">
						    </div>
						    
						</div>
						
					</form>
											
					
					<input type="hidden" id="id_nadvoresen" name="id_nadvoresen" /> 				
						
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="edit_nadvoresen_AJAX('<?= $flag?>');">Промени <?php echo $nadvoresen;?></button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	
	
	<!-- Modal --> 
	<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel">Бришење на <?php echo $nadvoresen;?></h4> 
				</div> 
				
				<div class="modal-body">
					
					<input type="hidden" id="id_nadvoresen_delete" name="id_nadvoresen_delete" />
					<p id="paragraph"></p>										
										
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="delete_nadvoresen_AJAX('<?= $flag?>');">Избриши <?php echo $nadvoresen;?></button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->							
			
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="//code.jquery.com/jquery.js"></script>
	
	</body>


</html>