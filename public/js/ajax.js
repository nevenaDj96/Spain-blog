$(document).ready(function (){
   
    prikaz();
});

function prikaz(id){
            
            if(id == null){
                
                id = 0;
            }
            
            $.ajax({
                
                    type: "GET",
                    url: baseUrl + '/postoviAjax/' + id,
                    success: function(podaci){
                        
                        var ispis = "";
                        for(var i = 0; i<podaci.length; i++){
                        
                            
                            ispis+="<div class='row'>";
                            ispis+="<div class='col-md-7'>";
                            ispis+="<div id='slika'>";
                            ispis+="<img class='img-fluid rounded mb-3 mb-md-0' src='"+baseUrl+podaci[i].putanja+"' alt='"+podaci[i].alt+"'>";
                            ispis+="</div>";
                            ispis+="</div>";
                            ispis+="<div class='col-md-5'>";
                            ispis+="<h3>"+podaci[i].naslov+"</h3>";
                            ispis+="<p>"+podaci[i].opis+"</p>";
                            ispis+="<a class='btn btn-primary' href="+baseUrl+"/destinacija/"+podaci[i].idPost+">Detaljnije</a>";
                            ispis+="</div>";
                            ispis+="<div class='card-footer text-muted'>";
                            
                            var mySQLDate = podaci[i].datum_kreiranja;
                            var datum = new Date(mySQLDate);
                            datum = ('0' + datum.getDate()).slice(-2) + '.'
                            + ('0' + (datum.getMonth()+1)).slice(-2) + '.'
                            + datum.getFullYear();
                            ispis+="Datum: "+datum+"<br/>";
                            
                            
                            
                            //OBJAVIO: KORISNIK
                            
                            ispis+="Broj komentara: "+podaci[i].brojKomentara+"</div>";
                            ispis+="</div></div></div>";
                        }
                        
			$('#postovi').html(ispis);
                        
                    },
                    
                    error: function(greske){
                        console.log(greske);
                    }
                
            });
}

function promeniKategoriju(id){
    
   
    
   $.ajax({
		type: 'GET',
		url: baseUrl + '/postoviAjax/' + id,
		data: {
			_token: token
		},
		success: function(podaci){
			console.log(podaci);
                        if(podaci == "Nema postova trazenog grada"){
                            
                            $('#postovi').html("Nema rezultata");
                        }
                        else{
			prikaz(id);}

		},
		error: function(greske){
			console.log(greske);
		}
	});
}


$('#glasaj').click(function(ev){
    
    var odg = $('.odgovor:checked').val();
    var token = document.querySelector("input[name='_token']").value;
    
    
    $.ajax({
        
        type: 'POST',
        url: baseUrl + '/anketa/dodajGlas',
        data: { 
            _token: token,
            odgovor: odg
        },
        success: function(podaci){
            
            console.log(podaci);
            $('#anketaObavestenje').css('display', 'block');
            $('#anketaObavestenje').html(podaci);
            
        },
        error: function(greske){
            
            console.log(greske);
            $('#anketaObavestenje').css('display', 'block');
            $('#anketaObavestenje').html(greske);
        }
        
    });
    ev.preventDefault();
    
    
    
});

function prikaziOdgovore(id){
    
    var token = document.querySelector("input[name='_token']").value;
    $.ajax({
		type: 'POST',
		url: baseUrl + '/admin/prikaziOdgovore/' + id,
		data: {
			_token: token
		},
		success: function(podaci){
			console.log(podaci);
                        
                        if(podaci.length == 0){
                            $('#odgovori').html("Nema odgovora");
                        }
                        else{
                            
                            $('#odgovori').html(prikazOdgovora(podaci));
			}

		},
		error: function(greske){
			console.log(greske);
		}
	});
    
    
    
}

function prikazOdgovora(odgovori){
    
    
    var ispis = "<table class='table'><tr><th>id</th><th>odgovor</th><th>statistika</th><th>brisanje</th></tr>";
    
    
    for(var i=0; i<odgovori.length; i++){
        
        
        ispis += "<tr><td>"+odgovori[i].idOdgovor+"</td><td>"+odgovori[i].odgovor+"</td><td>"+odgovori[i].rezultat+"</td><td><a href='"+baseUrl+'/admin/odgovor/brisi/'+odgovori[i].idOdgovor+"'>briši</a></td></tr>";
        
    }
    
    ispis += "</table>";
    
    return ispis;
}
