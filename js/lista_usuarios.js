/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {
    $('#btn_usuarios').click(function () {
        $.ajax({
            url: "usuarios.php"
        }).done(function (html) {
            $('#contenido').html(html);
        }).fail(function () {
            alert('Error al cargar modulo');
        });
    });
     $('#example').DataTable();
        
} );

function editar(id, nombre, precio, desc, cat) {
    $.ajax({
        type: "POST",
        url: "PHP/Crud_usuarios.php",
        data: {operacion: 'update', id: id, name: nombre, price: precio, description: desc, category_id: cat }
    }).done(function (html) {
        $('#contenido').html(html);
    }).false(function () {
        alert('Error al cargar modulo');
    });
}
function eliminar(id, este) {
    $.ajax({
        type: "POST",
        url: "PHP/Crud_usuarios.php",
        data: {id: id, operacion: "delete"}
    }).done(function (msg) {
        alert(msg);
        $(este).parent().parent().remove();
    }).fail(function () {
        alert("Error enviando los datos. Intente nuevamente");
    });
}

function newProd(nombre, precio, desc, cat) {
    $.ajax({
        type: "POST",
        url: "PHP/Crud_usuarios.php",
        data: {operacion: 'insert', name: nombre, price: precio, description: desc, category_id: cat }
    }).done(function (html) {
        $('#contenido').html(html);
    }).false(function () {
        alert('Error al cargar modulo');
    });
}

function editForm(id, name, price, desc, cat){
    document.getElementById("edit-id").value = id;
    document.getElementById("namee").value = name;
    document.getElementById("pricee").value = price;
    document.getElementById("descee").value = desc;
    document.getElementById("catege").value = cat;
    
}

function guardaEdit(){
    
    var id = document.getElementById("edit-id").value;
    var nombre = document.getElementById("namee").value;
    var precio = document.getElementById("pricee").value;
    var desc = document.getElementById("descee").value;
    var cat = document.getElementById("catege").value;
    
    editar(id, nombre, precio, desc, cat);
    
}

function guardaNew(){
    
    var nombre = document.getElementById("namen").value;
    var precio = document.getElementById("pricen").value;
    var desc = document.getElementById("descen").value;
    var cat = document.getElementById("categn").value;
    
    newProd(nombre, precio, desc, cat);
    
}

