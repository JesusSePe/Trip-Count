function crearInputInv(){
   
   var div = document.getElementById("form");
   var input = document.createElement("INPUT");         
   input.name = 'emails[]';
   input.type = 'email';
   input.placeholder = 'example@gmail.com';

   div.appendChild(input);
} 

window.onload = function(){
   
   var btnAdd = document.getEmentById("emailsInv");   
   btnAdd.onclick = crearDin;
}      
