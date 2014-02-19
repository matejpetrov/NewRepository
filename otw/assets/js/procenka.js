//fajl vo koj ke gi definiram site funkcii za rabota so formata za procenka. Tuka ke ja definiram validacijata na klientska strana
//i isto taka i funkcijata vo koja preku AJAX povik ke dodadam nov terapevt, nov nastavnik i/ili nov vraboten.

function test(form){
	var ck_motorika = /^[A-Za-zА-Ша-ш ]{3,500}$/;

	var errors = new Array();
	
	var motorika = form.motorika.value;

		
	if(!ck_motorika.test(motorika)){
		errors[errors.length] = "Полето за моторика не е успешно валидирано. Внесувај само букви.";
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


//funckija so pomos na koja preku AJAX ke ispratam baranje do serverot i ke mu dadam podatoci za nov vraboten, a potoa
//ke napravam refresh samo na delot od stranata koj gi sodrzi terapevtite, za novo dodadeniot terapevt da moze da bide vidliv vednas
function dodadi_nov_terapevt_AJAX(){
    //ke gi zemam site promenlivi koi gi vnel vraboteniot za noviot terapevt za da mozam da gi pratam vo request objektot 
    //preku AJAX.
	var controller = 'controller_klienti_nadvoresni';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	
	
    var ime_prezime = document.getElementById("ime_prezime").value;
    var mail = document.getElementById("mail").value;
    var telefon = document.getElementById("telefon").value;
    //tuka treba da ja dobijam vrednosta na selektiranata
    var institucii = $('#institucii').val();
    
    $.ajax({
        'url' : base_url + controller + '/dodadi_nov_terapevt',
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'ime_prezime':ime_prezime, 'mail':mail, 'institucii':institucii, 'telefon':telefon},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){
            	
            	document.getElementById("ime_prezime").value = "";
                document.getElementById("mail").value = "";
                document.getElementById("telefon").value = "";                
                
            	container.html(data);
            	            	
                //treba da vidam sto ke napravam so institucii vrednosta.
                
            }
        }
    });
    
}


//funckija vo koja gi setiram vrednostite na popup-ot koj mi se pojavuva za da napravam edit na nekoj terapevt.
//Gi zemam vrednostite od redot kade mi e pritisnato kopceto Promeni
function set_terapevt_info(id, institucija){
		
	document.getElementById("id_terapevt").value = id;
	document.getElementById("id").value = document.getElementById("id_terapevt").value;
	
	document.getElementById("ime_prezime_edit").value = document.getElementById("td_ime_"+id).innerHTML;	
	
	if(document.getElementById("td_mail_"+id).innerHTML!="/"){
		document.getElementById("mail_edit").value = document.getElementById("td_mail_"+id).innerHTML;
	}
	else{
		document.getElementById("mail_edit").value = "";
	}
	
	if(document.getElementById("td_telefon_"+id).innerHTML!="/"){
		document.getElementById("telefon_edit").value = document.getElementById("td_telefon_"+id).innerHTML;
	}
	
	else{
		document.getElementById("telefon_edit").value = "";
	}
	
	$('#institucii_edit').val(institucija);
	
	
	
}


//funckija so pomos na koja preku AJAX ke ispratam podatoci do serverot za edit na veke postoecki terapevt, i potoa ke treba 
//povtorno da ja refresh-iram tabelata vo koja se smesteni site terapevti
function edit_terapevt_AJAX(){
	
	var controller = 'controller_klienti_nadvoresni';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var edit_terapevt = '/edit_terapevt/';
	
	var id = document.getElementById("id_terapevt").value;
	var ime_prezime = document.getElementById("ime_prezime_edit").value;
    var mail = document.getElementById("mail_edit").value;
    var telefon = document.getElementById("telefon_edit").value;
    //tuka treba da ja dobijam vrednosta na selektiranata
    var institucii = $('#institucii_edit').val();
    
    var url = base_url + controller + edit_terapevt + id;
    
    $.ajax({
        'url' : url,        
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'ime_prezime':ime_prezime, 'mail':mail, 'institucii':institucii, 'telefon':telefon},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){
            	
            	document.getElementById("ime_prezime_edit").value = "";
                document.getElementById("mail_edit").value = "";
                document.getElementById("telefon_edit").value = "";              
                
            	container.html(data);
            	            	
                //treba da vidam sto ke napravam so institucii vrednosta.
                
            }
        }
    });
	
}