

<div id="site_terapevti">	
<?php 					


foreach($nastavnici as $key => $value){
			
	?>
	<input type="radio" name="nastavnici" id="nastavnici" value="<?php echo $key;?>" /><?php echo $value;?>
	
	<br/><br/>
	
	<?php 
}?>
			
			
</div>
