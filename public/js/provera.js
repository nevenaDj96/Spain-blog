 function proveraReg(){
    
    
    //regex
    
    var remail = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var reime = /^[A-Z][a-z]{2,15}$/;
    var repass = /^[A-z1-9]{6,15}$/;
    
    
    //podaci
    
    var mail = document.getElementById("email").value;
    var ime = document.getElementById("ime").value;
    var prezime = document.getElementById("prezime").value;
    var pass = document.getElementById("lozinka").value;
    var pass2 = document.getElementById("lozinka2").value;
    
    var errors = [];
    
    
    if(!remail.test(mail)){
		errors.push("Email adresa nije validna");
		document.getElementById('email').style.borderColor="red";
                document.getElementById('emailErr').style.display="inline";
	}
	else{
		document.getElementById('email').style.borderColor="gray";
                document.getElementById('emailErr').style.display="none";

	}
	if(!reime.test(ime)){
		errors.push("Ime nije validno");	
		document.getElementById('ime').style.borderColor="red";
                document.getElementById('imeErr').style.display="inline";
	}
	else{
		document.getElementById('ime').style.borderColor="gray";
                document.getElementById('imeErr').style.display="none";
	}
        if(!reime.test(prezime)){
		errors.push("Prezime nije validno");	
		document.getElementById('prezime').style.borderColor="red";
                document.getElementById('prezimeErr').style.display="inline";
	}
	else{
		document.getElementById('prezime').style.borderColor="gray";
                document.getElementById('prezimeErr').style.display="none";
	}
	if(!repass.test(pass)){
		errors.push("Lozinka nije validna");
		document.getElementById('lozinka').style.borderColor="red";
                document.getElementById('lozinkaErr').style.display="inline";
	}
	else{
		document.getElementById('lozinka').style.borderColor="gray";
                document.getElementById('lozinkaErr').style.display="none";
	}
        if(pass != pass2){
		errors.push("Lozinke se ne poklapaju");
		document.getElementById('lozinka2').style.borderColor="red";
                document.getElementById('lozinka2Err').style.display="inline";
	}
	else{
		document.getElementById('lozinka2').style.borderColor="gray";
                document.getElementById('lozinka2Err').style.display="none";
	}

    
    if(errors.length>0){
        
        return false;
    }
    
    
}

function proveraPrijava(){
    
    //regex
    
    
    var remail = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var repass = /^[A-z1-9]{6,15}$/;
    
    
    //podaci
    
    var email = document.getElementById("email").value;
    var pass = document.getElementById("lozinka").value;
    
    
    var errors = [];
    
	if(!remail.test(email)){
		errors.push("Email polje nije validno");	
		document.getElementById('email').style.borderColor="red";
                document.getElementById('emailErr').style.display="inline";
	}
	else{
		document.getElementById('email').style.borderColor="gray";
                document.getElementById('emailErr').style.display="none";
	}
	if(!repass.test(pass)){
		errors.push("Lozinka nije validna");
		document.getElementById('lozinka').style.borderColor="red";
                document.getElementById('lozinkaErr').style.display="inline";
	}
	else{
		document.getElementById('lozinka').style.borderColor="gray";
                document.getElementById('lozinkaErr').style.display="none";
	}
        

    
    if(errors.length>0){
        
        return false;
    }
}

function proveraPoruke(){
    
    
    //podaci
    
    var mail = document.getElementById("mail").value;
    var naslov = document.getElementById("naslov").value;
    
    
    //regex
    
    var remail = /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var renaslov = /^[A-Z][a-z]+(\s[\w\d\-]+)*$/;
    
    
    var errors = [];
    
    if(!remail.test(mail)){
		errors.push("Email nije validan");	
		document.getElementById('mail').style.borderColor="red";
                document.getElementById('errEmail').style.display="inline";
	}
	else{
		document.getElementById('mail').style.borderColor="gray";
                document.getElementById('errEmail').style.display="none";
	}
	if(!renaslov.test(naslov)){
		errors.push("Lozinka nije validna");
		document.getElementById('naslov').style.borderColor="red";
                document.getElementById('errNaslov').style.display="inline";
	}
	else{
		document.getElementById('naslov').style.borderColor="gray";
                document.getElementById('errNaslov').style.display="none";
	}
        
        if(errors.length>0){
        
        return false;
    }
    
    
}


