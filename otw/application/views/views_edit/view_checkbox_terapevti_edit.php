<?php 

//ova mi pretstavuva view vo koe gi listam site terapevti od baza. Go koristam za da mozam da pravam AJAX povici
//za da napravam refresh samo na del od stranata.
?>

<div id="site_terapevti">	
	<?php 			
		foreach($site_terapevti as $key => $value){
			
		?>
		
		
		<input type="checkbox" name="terapevti[]" value="<?php echo $key;?>" 
		
		<?php
		$keys = array_keys($selektirani_terapevti); 
		if(in_array($key, $keys)){
			?>
			checked="checked"
			
		<?php }
			
		?> 
		/><?php echo $value;?> 
		
		<br/><br/>
		
	<?php }
	?>	
</div>	