<html>


	<head>
		<meta http-equiv ="Content-Type" content = "text/html" charset ="UTF-8"/>
	
		<!-- tuka treba da go dodadam javascript file-ot za validiranje na podatocite koi gi vnesuvam vo polinjata za vnesuvanje. -->
		
		<script type="text/javascript">				

			function test(form){
				
				var ck_name = /^[A-Za-z ]{3,20}$/;
				var ck_username = /^[A-Za-z0-9_]{5,20}$/;
				var ck_password =  /^[A-Za-z0-9!@#$%^&*()_]{6,20}$/;

				var errors = new Array();
				
				var ime_prezime = form.ime_prezime.value; 
				var username = form.username.value;
				var password = form.password.value;
				
				if(!ck_name.test(ime_prezime)){
					errors[errors.length] = "Името не е успешно валидирано. Мора да биде помеѓу 3-20 карактери, без специјални знаци и бројки";					
				}

				if(!ck_username.test(username)){
					errors[errors.length] = "Корисничкото име не е успешно валидирано. Мора да биде помеѓу 5-20 карактери, може да "+ 
						"содржи бројки и само _ како специјален знак";
				}

				if(!ck_password.test(password)){
					errors[errors.length] = "Лозинката не е успешно валидирана. Мора да биде помеѓу 6-20 карактери, може да "+ 
						"содржи бројки и специјални знаци";
				}

				if (errors.length > 0) {
					  reportErrors(errors);
					  return false;
				}
				else{
					alert("Podatocite se uspesno validirani");
				}
			}

			
			function reportErrors(errors){
				 var msg = "Некои од внесените податоци не се валидни...\n";
				 for (var i = 0; i<errors.length; i++) {
					  var numError = i + 1;
					  msg += "\n" + numError + ". " + errors[i];
				 }
				 alert(msg);
			}

		</script>
		
	</head>

	<body>
	
				
		<h3>Внесете податоци за новиот вработен</h3>
		
		<p><?php echo $errors;?></p>
		
		<?php

			//we use these arrays to define the name and id and the value and other attributes
			//of the input element in html
			$ime_prezime=array(
					"name" => "ime_prezime",
					"id" => "ime_prezime",
					"value" => set_value("ime_prezime")
			);
			
			$username=array(
					"name" => "username",
					"id" => "username",
					"value" => set_value("username")
			);
			
			
			$password=array(
					"name" => "password",
					"id" => "password",
					//we do this so that the value won't be lost when we reload the page for instance if
					//the validation is unsuccessfull.
					"value" => ""
			);
		
			$slika=array(
					"name" => "userfile",
					"id" => "userfile",
					"value" => "прикачи слика"
			);
			
			//this will produce the following html
			//<form method="post" accept-charset="utf-8" action="http:/localhost/otw/controller_vraboteni/validate" />
			$attributes = array('name' => 'form', 'id' => 'form', 'onsubmit' => 'return test(this);', 'class' => 'form');			
			echo form_open_multipart("controller_vraboteni/validate", $attributes);
			
				//the second parameter of label is the for attribute of the html tag
				echo form_label("Ime i prezime: ", "ime_prezime");
				echo form_input($ime_prezime)."<br>"."<br>";
				
				echo form_label("Корисничко име: ", "username");
				echo form_input($username)."<br>"."<br>";
				
				echo form_label("Лозинка: ", "password");
				echo form_password($password)."<br>"."<br>";
				
				echo form_label("Прикачи слика");
				echo form_upload($slika)."<br>"."<br>";
				
				//kreiram checkbox i dokolku e selektiran negovata vrednost ke bide 1, sto znaci deka koga ke proveruvam vo controller-ot
				//dokolku vrednosta e 1 znaci deka checkbox-ot bil selektiran
				$data = array(
						"name" => "slika_check",
						"id"   => "slika_check",						
						"checked" => FALSE,
						"value" => "1"
				);
				echo form_checkbox($data);
				echo form_label("во моментов немам слика, ќе додадам покасно", 'slika')."<br>"."<br>";
				
				echo form_submit("vrabotenSubmit", "Додади вработен");
								
			
			echo form_close();

?>
	

	</body>


</html>