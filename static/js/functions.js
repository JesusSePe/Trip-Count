function crearInputInv(){
   
   var div = document.getElementById("form");
   var input = document.createElement("INPUT");         
   input.name = 'emails[]';
   input.type = 'email';
   input.placeholder = 'example@gmail.com';

   div.appendChild(input);
} 

function eliminarInputInv() {

   var div = document.getElementById("form");
   var del = div.removeChild(div.lastChild);
} 

window.onload = function(){
   
   var btnAdd = document.getEmentById("emailsInv");   
   btnAdd.onclick = crearDin;
}      
