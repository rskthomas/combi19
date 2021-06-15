$(document).ready(function(){
    modificarTotales(document.getElementById("totalPasaje").val());
    alert("ok");



document.getElementById("botonContinuar").hidden=true;


})


$("#addproductos").click(function (e){

    document.getElementById("listaproductos").hidden=false;

})
function addPasaje(precio){
    document.getElementById('cantPasajes').value++;
    document.getElementById("totalPasaje").value = parseFloat(document.getElementById("totalPasaje").value ) +parseFloat(precio);
    modificarTotales(precio);


}
function subsPasaje(precio){
    if($("#cantPasajes").val() >1){
    document.getElementById('cantPasajes').value--;
    document.getElementById("totalPasaje").value = parseFloat(document.getElementById("totalPasaje").value ) - parseFloat(precio);
   
    modificarTotales("-"+precio);
}
else{
    alert("El minimo de pasajes para esta compra es 1 ")
}


}

function modificarTotales(precio){
    if ($("#gold").val()!=0){
        descuento= Math.round(precio *0.2,-2);
        document.getElementById("totalDescuentos").value = parseFloat(document.getElementById("totalDescuentos").value ) +parseFloat(descuento);
        document.getElementById("totalCompra").value = parseFloat(document.getElementById("totalCompra").value ) +parseFloat(precio)-parseFloat(descuento);
    }
    else{
    document.getElementById("totalCompra").value = parseFloat(document.getElementById("totalCompra").value ) +parseFloat(precio);
    }
}

function agregar(idproducto,precio){

    concatenado="cantidad"+idproducto;
    document.getElementById(concatenado).value++;
    modificartotal="total"+idproducto;
    document.getElementById(modificartotal).value = parseFloat(document.getElementById(modificartotal).value ) +parseFloat(precio);
    document.getElementById("totalProductos").value = parseFloat(document.getElementById("totalProductos").value ) +parseFloat(precio);
    modificarTotales(precio);


}

function substraer(idproducto,precio){

    concatenado="cantidad"+idproducto;
    if(document.getElementById(concatenado).value >0){
    document.getElementById(concatenado).value--;
    modificartotal="total"+idproducto;
    document.getElementById(modificartotal).value = parseFloat(document.getElementById(modificartotal).value ) -parseFloat(precio);
    document.getElementById("totalProductos").value = parseFloat(document.getElementById("totalProductos").value ) -parseFloat(precio);
    modificarTotales("-"+precio);

}

}






