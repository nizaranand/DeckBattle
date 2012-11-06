function formhash(form, password) {
   
   var p = document.createElement("input");
   form.appendChild(p);
   p.name = "p";
   p.type = "hidden"
   
   if (password.value != "")
   {	   
	   p.value = hex_sha512(password.value);
   }
   else
   {
	   p.value = "";
   }
   
   // Make sure the plaintext password doesn't get sent.
   password.value = "";

   form.submit();
}

function formhashrecovery(form) {
   // WARNING: this is not safe. the generated pass is also added to the form. For now this is the swiftest solution because it keeps the original signup/login flow. rethink at a later time.
   var passgenerated = makeid();	
    
   var p = document.createElement("input");
   form.appendChild(p);
   p.name = "p";
   p.type = "hidden"
   p.value = hex_sha512(passgenerated);
   
   var pgen = document.createElement("input");
   form.appendChild(pgen);
   pgen.name = "pgen";
   pgen.type = "hidden"
   pgen.value = passgenerated;
   
   form.submit();
}


function formchangepass(form,p1,p2) {
 
   var p = document.createElement("input");
   form.appendChild(p);
   p.name = "p";
   p.type = "hidden"
   
   if (p1.value != "")
   {
   p.value = hex_sha512(p1.value);
   }
   else
   {
	   p.value = "";
   }
   
   var pcheck = document.createElement("input");
   form.appendChild(pcheck);
   pcheck.name = "pcheck";
   pcheck.type = "hidden"

   if (p2.value != "")
   {	   

   pcheck.value = hex_sha512(p2.value);
   
   }
   else
   {
   pcheck.value = "";
   }
   
   p1.value = "";
   p2.value = "";
      
   form.submit();
}

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}