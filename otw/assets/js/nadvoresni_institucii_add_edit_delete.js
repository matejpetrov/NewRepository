


//funckija so pomos na koja preku AJAX ke ispratam baranje do serverot i ke mu dadam podatoci za nova nadvoresna institucija,
//a potoa ke napravam refresh samo na delot od stranata koj gi sodrzi nadvoresnite instituciite za vednas 
//da se vidi novododadenata.
function dodadi_nova_nadvoresna_institucija_AJAX(flag){
	
	//ke gi zemam site promenlivi koi gi vnel vraboteniot za noviot terapevt za da mozam da gi pratam vo request objektot 
    //preku AJAX.	
	var controller = 'controller_klienti_nadvoresni/';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var funkcija = '';
	
	if(flag == 1){
		funkcija = 'dodadi_nova_institucija';
	}
	else if(flag == 2){
		funkcija = 'dodadi_novo_uciliste';
	}
	else if(flag == 3){
		
	}
	
	var ime_nadvoresna_institucija = document.getElementById("ime_nadvoresna_institucija").value;
	
	var url = base_url + controller + funkcija;
	         
    $("#myModalNadvoresnaInstitucija").modal('hide');
    
    $.ajax({
        'url' : url,
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'ime_nadvoresna_institucija':ime_nadvoresna_institucija},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){
            	
            	document.getElementById("ime_nadvoresna_institucija").value = "";                
            	container.html(data);            	            	
                
            }
        }
    });
	
}

//funckija vo koja ke treba da gi setiram vrednostite na polinjata vo popup-ot. Text poleto da ja dobie 
//vrednosta na imeto na nadvoresnata institucijata, a hidden poleto da go dobie id-to.
function set_nadvoresna_institucija_info_edit(id){
	
	document.getElementById("id_nadvoresna_institucija").value = id;	
	
	document.getElementById("ime_nadvoresna_institucija_edit").value = document.getElementById("td_nadvoresna_institucija_"+id).innerHTML;		
}


//funckija so pomos na koja preku AJAX ke ispratam podatoci do serverot za edit na veke postoecka institucija, i potoa ke treba 
//povtorno da ja refresh-iram tabelata vo koja se smesteni site institucii
function edit_nadvoresna_institucija_AJAX(flag){
	
	var controller = 'controller_klienti_nadvoresni/';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var funkcija = '';
	
	if(flag == 1){
		funkcija = 'edit_institucija/';
	}
	else if(flag == 2){
		funkcija = 'edit_uciliste/';
	}
	else if(flag == 3){
		//
	}
	
	//zemanje na vrednosta od hidden poleto
	var id = document.getElementById("id_nadvoresna_institucija").value;
	var ime_institucija = document.getElementById("ime_nadvoresna_institucija_edit").value;
	
	var url = base_url + controller + funkcija + id;
	
	$("#myModalNadvoresnaInstitucijaEdit").modal('hide');
  
  $.ajax({
      'url' : url,        
      'type' : 'POST', //the way you want to send data to your URL
      //in the post object i am sending this parameter.
      'data' : {'ime_nadvoresna_institucija':ime_institucija},
      'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
          var container = $('#container'); //jquery selector (get element by id)
          if(data){          	
          	document.getElementById("ime_nadvoresna_institucija_edit").value = "";             
          	
          	container.html(data);            	            	                            
          }
      }
  });
	
}


//funckija koja ja povikuvam so klik na kopceto delete vo tabelata so nadvorensi institucii. Tuka treba, id-to koe ke go dobijam
//kako argument da go dadam kako vrednost na hidden pole od view-to za vo slucaj da se potvrdi namerata da se izbrise
//nadvoresna institucijata od baza, da znam za koja institucija se raboti. Flag-ot mi pomaga da znam koj tekst da 
//go pisam vo zavisnost od tipot na nadvoresna institucija
function set_nadvoresna_institucija_info_delete(id, ime_nadvoresna_institucija, flag){
	
	document.getElementById("id_nadvoresna_institucija_delete").value = id;		
	
	var paragraph = '';
	
	if(flag == 1){
		paragraph = "Дали сте сигурни дека сакате да ја избришете " +
		"институцијата " + ime_nadvoresna_institucija;
	}
	else if(flag == 2){
		paragraph = "Дали сте сигурни дека сакате да го избришете " +
		"училиштето " + ime_nadvoresna_institucija;
	}
	else if(flag == 2){
		//
	}
	
	document.getElementById("paragraph").innerHTML = paragraph; 
}


//funkcija vo koja preku AJAX ke ispratam id na nadvoresna institucijata koja sakam da ja izbrisam do serverot i potoa ke ja 
//refreshiram tabelata vo koja se smesteni site nadvoresni institucii.
function delete_nadvoresna_institucija_AJAX(flag){
	
	var controller = 'controller_klienti_nadvoresni/';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	var funkcija = '';
	
	if(flag == 1){
		funkcija = 'delete_institucija/';
	}
	else if(flag == 2){
		funkcija = 'delete_uciliste/';
	}
	else if(flag == 3){
		//
	}
	
	var id = document.getElementById("id_nadvoresna_institucija_delete").value;
	
	var url = base_url + controller + funkcija + id;
  
  $("#myModalNadvoresnaInstitucijaDelete").modal('hide');
  
  $.ajax({
      'url' : url,        
      'type' : 'POST', //the way you want to send data to your URL
      //in the post object i am sending this parameter.
      'data' : {'id_nadvoresna_institucija':id},
      'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
          var container = $('#container'); //jquery selector (get element by id)
          if(data){            	            	                           
          	container.html(data);            	            	
              
          }
      }
  });
}