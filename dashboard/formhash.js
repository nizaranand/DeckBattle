function formhash(form, password) {
   // Create a new element input, this will be out hashed password field.
   var p = document.createElement("input");
   // Add the new element to our form.
   form.appendChild(p);
   p.name = "p";
   p.type = "hidden"
   p.value = hex_sha512(password.value);
   // Make sure the plaintext password doesn't get sent.
   password.value = "";
   // Finally submit the form.
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

function makeid()
{
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}