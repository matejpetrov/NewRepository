//fajl vo koj ke gi definiram site funkcii za dodavanje, editiranje i brisenje na tabelite za nastavnici i 
//ucilista


//funckija so pomos na koja preku AJAX ke ispratam baranje do serverot i ke mu dadam podatoci za nov nastavnik, a potoa
//ke napravam refresh samo na delot od stranata koj gi sodrzi nastavnicite, za novo dodadeniot nastanvik da moze da bide vidliv vednas
function dodadi_nov_nastavnik_AJAX(){
	
	//ke gi zemam site promenlivi koi gi vnel vraboteniot za noviot terapevt za da mozam da gi pratam vo request objektot 
    //preku AJAX.
	var controller = 'controller_klienti_nadvoresni';
	var base_url = 'http://localhost/GitHub/NewRepository/otw/';
	
	
    var ime_prezime = document.getElementById("ime_prezime").value;
    var mail = document.getElementById("mail").value;
    var telefon = document.getElementById("telefon").value;
    //tuka treba da ja dobijam vrednosta na selektiranata
    var ucilista = $('#ucilista').val();        
    
    $("#myModal").modal('hide');
    
    $.ajax({
        'url' : base_url + controller + '/dodadi_nov_nastavnik',
        'type' : 'POST', //the way you want to send data to your URL
        //in the post object i am sending this parameter.
        'data' : {'ime_prezime':ime_prezime, 'mail':mail, 'ucilista':ucilista, 'telefon':telefon},
        'success' : function(data){ //probably this request will return anything, it'll be put in var "data"
            var container = $('#container'); //jquery selector (get element by id)
            if(data){
            	
            	document.getElementById("ime_prezime").value = "";
                document.getElementById("mail").value = "";
                document.getElementById("telefon").value = "";                                                
                
            	container.html(data);
                
            }
        }
    });
	
}


