//js file vo koj ke se spravam so dodavanjeto, editiranjeto i brisenjeto na site terapevti, nastavnici i 
//odgovorni od firma, kako i institucii, ucilista i firmi. So pomos na flag-oovi ke znam za koj od trite izbori
//se raboti i soodvetno ke gi povikuvam pravilnite funckii od controller-ite.



//funckija so pomos na koja preku AJAX ke ispratam baranje do serverot i ke mu dadam podatoci za nov nadvoresen, a potoa
//ke napravam refresh samo na delot od stranata koj ja sodrzi tabelata so nadvoresnite, za novo dodadeniot nadvoresen 
//da moze da bide vidliv vednas. Flag-ot go koristam za da znam koja funckija od controller-ot da ja povikam, odnsono
//mi pomaga da zaklucam dali se raboti za dodavanje na terapevt, nastavnik ili odgovoren_firma
function dodadi_nov_nadvoresen_AJAX(flag){
	
	 //ke gi zemam site promenlivi koi gi vnel vraboteniot za noviot nadvoresen za da mozam da gi pratam vo request 
    //objektot preku AJAX.	
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var controller = 'controller_klienti_nadvoresni/';
	
	var funckija = "";
	 
	if(flag == 1){
		funckija = 'dodadi_nov_terapevt';
	}
	else if(flag == 2){
		funckija = 'dodadi_nov_nastavnik';
	}
	else if(flag == 3){
		funckija = 'dodadi_nov_odgovorenFirma';
	}
	
	
    var ime_prezime = document.getElementById("ime_prezime").value;
    var mail = document.getElementById("mail").value;
    var telefon = document.getElementById("telefon").value;
    //tuka treba da ja dobijam vrednosta na selektiranata
    var institucii = $('#institucii').val();  
    
    var url = base_url + controller + funckija;
    
    $("#myModal").modal('hide');
    
    $.ajax({
        'url' : url,
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



//funckija vo koja gi setiram vrednostite na popup-ot koj mi se pojavuva za da napravam edit na nekoj nadvoresen.
//Gi zemam vrednostite od redot kade mi e pritisnato kopceto Promeni
function set_nadvoresen_info_edit(id, institucija){
		
	document.getElementById("id_nadvoresen").value = id;	
	
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

//funckija so pomos na koja preku AJAX ke ispratam podatoci do serverot za edit na veke postoecki nadvoresen, i potoa ke treba 
//povtorno da ja refresh-iram tabelata vo koja se smesteni site nadvoresni. Informacijata za toa za kakov tip na 
//nadvoresen se raboti ke ja odredam od flag-ot koj ke go dobijam.
function edit_nadvoresen_AJAX(flag){
	
	var controller = 'controller_klienti_nadvoresni/';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var funkcija = '';
	
	
	if(flag == 1){
		funkcija = 'edit_terapevt/';
	}
	else if(flag == 2){
		funkcija = 'edit_nastavnik/';
	}
	else if(flag == 3){
		funkcija = 'edit_odgovorenFirma/';
	}
	
	
	var id = document.getElementById("id_nadvoresen").value;
	var ime_prezime = document.getElementById("ime_prezime_edit").value;
	var mail = document.getElementById("mail_edit").value;
	var telefon = document.getElementById("telefon_edit").value;
	//tuka treba da ja dobijam vrednosta na selektiranata
	var institucii = $('#institucii_edit').val();
  
	var url = base_url + controller + funkcija + id;
  
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
   
          }
      	}
	});
	
}


//funckija koja ja povikuvam so klik na kopceto delete vo tabelata so nadvoresni. Tuka treba, id-to koe ke go dobijam
//kako argument da go dadam kako vrednost na hidden pole od view-to za vo slucaj da se potvrdi namerata da se izbrise
//nadvoresniot od baza, da znam za koj nadvoresen se raboti. Tipot na nadvoresen ke go odredam spored flag-ot koj 
//ke go dobijam kako argument.
function set_nadvoresen_info_delete(id, ime_prezime, flag){

	document.getElementById("id_nadvoresen_delete").value = id;	
	
	var nadvoresen = '';

	if(flag == 1){
		nadvoresen = "терапевтот";
	}
	else if(flag == 2){
		nadvoresen = "наставникот";
	}
	else if(flag == 3){
		nadvoresen = "одговориот од фирма";
	}
	
	document.getElementById("paragraph").innerHTML = "Дали сте сигурни дека сакате да го избришете " + nadvoresen + " " + ime_prezime;	 
	
}


//funkcija vo koja preku AJAC ke ispratam id na nadvoresniot koj sakam da go izbrisam do serverot i potoa ke ja 
//refreshiram tabelata vo koja se smesteni site nadvoresni. Za koj tip na nadvoresen se raboti ke odredam od 
//flag-ot koj ke go dobijam kako argument.
function delete_nadvoresen_AJAX(flag){
	
	var controller = 'controller_klienti_nadvoresni/';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var funkcija = '';
	
	if(flag == 1){
		funkcija = 'delete_terapevt/';
	}
	else if(flag == 2){
		funkcija = 'delete_nastavnik/';
	}
	else if(flag == 1){
		//
	}
	
	var id = document.getElementById("id_nadvoresen_delete").value;
	
	var url = base_url + controller + funkcija + id;
  
  $("#myModalDelete").modal('hide');
  
  //'data' : {'id_nadvoresen':id},
  
  $.ajax({
      'url' : url,        
      'type' : 'POST', //the way you want to send data to your URL
      //in the post object i am sending this parameter.      
      'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
          var container = $('#container'); //jquery selector (get element by id)
          if(data){            	            	                           
          	container.html(data);            	            	
              
          }
      }
  });
	
	
}