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

function details(id) {
   newClass = "details"+id;
   details_rows = document.getElementsByClassName(newClass);
   if (details_rows[0].style.display != 'table-row') {
      for (let index = 0; index < details_rows.length; index++) {
         const detail = details_rows[index];
         detail.style.display = 'table-row';
      }
   } else {
      for (let index = 0; index < details_rows.length; index++) {
         const detail = details_rows[index];
         detail.style.display = 'none';
      }
   }
} 