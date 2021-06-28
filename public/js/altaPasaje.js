$(document).ready(function () {
  modificarTotales($("#totalPasaje").val());
  productos = {}

  document.getElementById("botonContinuar").hidden = true;
  document.getElementById( "opcionesNuevaTarjeta").hidden = false;
  
});

$("#addproductos").click(function (e) {
  document.getElementById("listaproductos").hidden = false;
});




function modificarTotales(precio) {
  if ($("#gold").val() != "0" ) {
    descuento = Math.round(precio * 0.2, -2);
    document.getElementById("totalDescuentos").value = parseFloat(document.getElementById("totalDescuentos").value) + parseFloat(descuento);
    document.getElementById("totalCompra").value = parseFloat(document.getElementById("totalCompra").value) + parseFloat(precio) - parseFloat(descuento);
  } else {
    document.getElementById("totalCompra").value = parseFloat(document.getElementById("totalCompra").value) + parseFloat(precio);
  }
}

function agregar(idproducto, precio,nombre,descripcion) {
 

  concatenado = "cantidad" + idproducto;
  document.getElementById(concatenado).value++;
  modificartotal = "total" + idproducto;
  precio_total_productos=document.getElementById(modificartotal).value = parseFloat(document.getElementById(modificartotal).value) + parseFloat(precio);
  
  var productos=JSON.parse($("#productos").val())

  productos[nombre]={"precio":precio,"id": idproducto,"totalProducto":precio_total_productos,"cantidad":document.getElementById(concatenado).value };
 
  document.getElementById("productos").value = JSON.stringify(productos);

  document.getElementById("totalProductos").value = parseFloat(document.getElementById("totalProductos").value) + parseFloat(precio);
  modificarTotales(precio);
  

}

function substraer(idproducto, precio,nombre) {
  concatenado = "cantidad" + idproducto;
  if (document.getElementById(concatenado).value > 0) {
    document.getElementById(concatenado).value--;
    modificartotal = "total" + idproducto;
    precio_total_productos=document.getElementById(modificartotal).value = parseFloat(document.getElementById(modificartotal).value) - parseFloat(precio);
    var productos=JSON.parse($("#productos").val())
    
    if(document.getElementById(concatenado).value == 0){
      delete(productos[nombre]);
     }
    else{
    
    productos[nombre]={"precio":precio,"id": idproducto,"totalProducto":precio_total_productos,"cantidad":document.getElementById(concatenado).value };
  
  }
    document.getElementById("totalProductos").value = parseFloat(document.getElementById("totalProductos").value) - parseFloat(precio);
    modificarTotales("-" + precio);
  }
}

function addTarjeta(){
  document.getElementById("nuevaTarjetaAgregada").value="1";
  document.getElementById("nuevaTarjeta").hidden=false;
  document.getElementById("nuevaTarjeta").disabled=false;
  document.getElementById("tarjetaprecargada").hidden=true;
  document.getElementById("botonCancelar").hidden=false;




}
$('#botonCancelar').click(function(){
  document.getElementById("nuevaTarjetaAgregada").value="";
  document.getElementById("nuevaTarjeta").hidden=true;
  document.getElementById("tarjetaprecargada").hidden=false;


})


