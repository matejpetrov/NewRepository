<?php 

//ova mi pretstavuva view vo koe gi listam site terapevti od baza. Go koristam za da mozam da pravam AJAX povici
//za da napravam refresh samo na del od stranata.
?>

<div id="site_terapevti">	
	<?php 			
		foreach($terapevti as $key => $value){
			
		?>
		
		
		<input type="checkbox" name="terapevti[]" value="<?php echo $key;?>" /><?php echo $value;?> 
		
		<br/><br/>
		
	<?php }
	?>	
</div>	