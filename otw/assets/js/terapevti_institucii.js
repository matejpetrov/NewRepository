//fajl vo koj ke gi definiram site funkcii za dodavanje, editiranje i brisenje na tabelite za terapevti i 
//institucii

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
    
    $("#myModal").modal('hide');
    
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
function set_terapevt_info_edit(id, institucija){
		
	document.getElementById("id_terapevt").value = id;	
	
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
    
    $("#myModalEdit").modal('hide');
    
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


//funckija koja ja povikuvam so klik na kopceto delete vo tabelata so terapevti. Tuka treba, id-to koe ke go dobijam
//kako argument da go dadam kako vrednost na hidden pole od view-to za vo slucaj da se potvrdi namerata da se izbrise
//terapevtot od baza, da znam za koj terapevt se raboti.
function set_terapevt_info_delete(id, ime_prezime){

	document.getElementById("id_terapevt_delete").value = id;	
	
	document.getElementById("paragraph").innerHTML = "Дали сте сигурни дека сакате да го избришете " +
			"терапевтот " + ime_prezime;
	
	
}


//funkcija vo koja preku AJAC ke ispratam id na terapevtot koj sakam da go izbrisam do serverot i potoa ke ja 
//refreshiram tabelata vo koja se smesteni site terapevti.
function delete_terapevt_AJAX(){
	
	var controller = 'controller_klienti_nadvoresni';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var edit_terapevt = '/delete_terapevt/';
	
	var id = document.getElementById("id_terapevt_delete").value;
	
	var url = base_url + controller + edit_terapevt + id;
    
    $("#myModalDelete").modal('hide');
    
    $.ajax({
        'url' : url,        
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'id_terapevt':id},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){            	            	                           
            	container.html(data);            	            	
                
            }
        }
    });
	
	
}


//funckija so pomos na koja preku AJAX ke ispratam baranje do serverot i ke mu dadam podatoci za nova institucija, a potoa
//ke napravam refresh samo na delot od stranata koj gi sodrzi instituciite za vednas da se vidi novododadenata.
function dodadi_nova_institucija_AJAX(){
	
	//ke gi zemam site promenlivi koi gi vnel vraboteniot za noviot terapevt za da mozam da gi pratam vo request objektot 
    //preku AJAX.	
	var controller = 'controller_klienti_nadvoresni';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var dodadi_nova_institucija = '/dodadi_nova_institucija';
	
	var ime_institucija = document.getElementById("ime_institucija").value;
	
	var url = base_url + controller + dodadi_nova_institucija;
	         
    $("#myModalInstitucija").modal('hide');
    
    $.ajax({
        'url' : url,        
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'ime_institucija':ime_institucija},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){
            	
            	document.getElementById("ime_institucija").value = "";             
                
            	container.html(data);            	            	              
                
            }
        },        
        'error' : function(){
        	var ime_institucija = document.getElementById("ime_institucija").value;
        	
        	document.getElementById("pom").value =  ime_institucija; 
        }
    });
	
}	


//funckija vo koja ke treba da gi setiram vrednostite na polinjata vo popup-ot. Text poleto da ja dobie 
//vrednosta na imeto na institucijata, a hidden poleto da go dobie id-to.
function set_institucija_info_edit(id){
	
	document.getElementById("id_institucija").value = id;	
	
	document.getElementById("ime_institucija_edit").value = document.getElementById("td_institucija_"+id).innerHTML;
}


//funckija so pomos na koja preku AJAX ke ispratam podatoci do serverot za edit na veke postoecka institucija, i potoa ke treba 
//povtorno da ja refresh-iram tabelata vo koja se smesteni site institucii
function edit_institucija_AJAX(){
	
	var controller = 'controller_klienti_nadvoresni';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var edit_terapevt = '/edit_institucija/';
	
	//zemanje na vrednosta od hidden poleto
	var id = document.getElementById("id_institucija").value;
	var ime_institucija = document.getElementById("ime_institucija_edit").value;
	
	var url = base_url + controller + edit_terapevt + id;
	
	$("#myModalInstitucijaEdit").modal('hide');
    
    $.ajax({
        'url' : url,        
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'ime_institucija':ime_institucija},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){
            	
            	document.getElementById("ime_institucija_edit").value = "";             
                
            	container.html(data);            	            	              
                
            }
        }
    });
	
}


//funckija koja ja povikuvam so klik na kopceto delete vo tabelata so institucii. Tuka treba, id-to koe ke go dobijam
//kako argument da go dadam kako vrednost na hidden pole od view-to za vo slucaj da se potvrdi namerata da se izbrise
//institucijata od baza, da znam za koja institucija se raboti.
function set_institucija_info_delete(id, ime_institucija){
	
	document.getElementById("id_institucija_delete").value = id;		
	
	document.getElementById("paragraph").innerHTML = "Дали сте сигурни дека сакате да ја избришете " +
			"институцијата " + ime_institucija;
}


//funkcija vo koja preku AJAC ke ispratam id na institucijata koja sakam da ja izbrisam do serverot i potoa ke ja 
//refreshiram tabelata vo koja se smesteni site institucii.
function delete_institucija_AJAX(){
	
	var controller = 'controller_klienti_nadvoresni';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var edit_terapevt = '/delete_institucija/';
	
	var id = document.getElementById("id_institucija_delete").value;
	
	var url = base_url + controller + edit_terapevt + id;
    
    $("#myModalInstitucijaDelete").modal('hide');
    
    $.ajax({
        'url' : url,        
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'id_institucija':id},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){            	            	                           
            	container.html(data);            	            	
                
            }
        }
    });
}




