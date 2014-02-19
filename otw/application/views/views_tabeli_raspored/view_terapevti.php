
<?php 


//ovoj view ke go iskoristam za 

?>
<html>


	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>	

		<!--ova raboti, mozes da go koristis <link rel="stylesheet" type="text/css" href="assets/css/proba.css"> -->
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="assets/js/procenka.js"></script>
		
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
		
		
		<script>

			function test(){
				
			}

		</script>
		
	</head>
	
	
	<body>
		
		
		<?php echo "View Terapevti, welcome";

			echo "<br>";
			//tuka samo go printam poleto za da proveram sto tocno imam vo nego.
			//print_r($terapevti);
			
			echo "<br>";
			echo "<br>";
			echo $errors;
			
		?>
		
		<div id="container">
				<?php echo $terapevti_tabela;?>
		</div>
		
		
		<br/>
		<br/>
		<br/>
		
		<button type="button" name="dodadiNovTerapevt" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
				Додади нов терапевт
		</button>				
				
	<!-- Modal --> 
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"> 
		<div class="modal-dialog"> 
			<div class="modal-content"> 
				<div class="modal-header"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button> 
					<h4 class="modal-title" id="myModalLabel">Внесете нов терапевт</h4> 
				</div> 
				
				<div class="modal-body"> 
					Име и презиме: <input type="text" name="ime_prezime" id="ime_prezime"/><br/><br/> 
					Институција:	
					
					<select name="institucii" id="institucii">
					<?php 
						
						foreach($institucii as $key => $value){
							
							?>
							
							<option value="<?php echo $key;?>"><?php echo $value;?></option>
							
							<?php }
							//echo form_dropdown('institucii', $institucii);?>																	
					
					
					</select> <br/><br/>
					Маил: <input type="text" name="mail" id="mail"/><br/><br/> 
					Телефон: <input type="text" name="telefon" id="telefon"/><br/><br/>
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="dodadi_nov_terapevt_AJAX();">Додади терапевт</button> 
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
					<h4 class="modal-title" id="myModalLabel">Внесете нов терапевт</h4> 
				</div> 
				
				<div class="modal-body">
					<input type="hidden" id="id_terapevt" name="id_terapevt" /> 
					Име и презиме edit: <input type="text" name="ime_prezime_edit" id="ime_prezime_edit"/><br/><br/> 
					Институција:	
					
					<select name="institucii_edit" id="institucii_edit">
					<?php 
						
						foreach($institucii as $key => $value){
							
							?>
							
							<option value="<?php echo $key;?>"><?php echo $value;?></option>
							
							<?php }
							//echo form_dropdown('institucii', $institucii);?>																	
					
					
					</select> <br/><br/>
					Маил: <input type="text" name="mail_edit" id="mail_edit"/><br/><br/> 
					Телефон: <input type="text" name="telefon_edit" id="telefon_edit"/><br/><br/>
					ID: <input type="text" name="id" id="id"/><br/><br/>
				</div> 
				
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default" data-dismiss="modal">Откажи</button> 
					<button type="button" class="btn btn-primary" onclick="edit_terapevt_AJAX();">Промени терапевт</button> 
				</div> 
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->								
			
	<script src="assets/js/bootstrap.min.js"></script>
	
	<script src="//code.jquery.com/jquery.js"></script>
	
	</body>


</html>