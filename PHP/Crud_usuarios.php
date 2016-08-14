<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require 'Database.php';
if (!empty($_POST)) {
    $msg = '';
    //$nombre = $_POST['name'];
    //$precio = $_POST['price'];
    //$desc = $_POST['description'];
    //$category = $_POST['category_id'];
    //$created = $_POST['created'];
    $operacion = $_POST['operacion'];
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($operacion == 'insert') {
        $nombre = $_POST['name'];
        $precio = $_POST['price'];
        $desc = $_POST['description'];
        $category = $_POST['category_id'];
        
        $sql = "INSERT INTO products (name, description, price, category_id, created) "
                . "VALUES(?,?,?,?,now())";
        $query = $pdo->prepare($sql);
        if ($query->execute(array($nombre, $desc, $precio, $category)) == false) {
            $msg = 'Error: ' . $query->errorCode();
        } else {
            $msg = 'Producto creado';
        }
    } elseif ($operacion == 'delete') {
        $id = $_POST['id'];
        $sql = "DELETE FROM products WHERE id = ?";
        $query = $pdo->prepare($sql);
        if ($query->execute(array($id)) == false) {
            $msg = 'Error: ' . $query->errorCode();
        } else {
            $msg = 'Producto eliminado';
        }
    } elseif ($operacion == 'update') {
        $id = $_POST['id'];
        $nombre = $_POST['name'];
        $precio = $_POST['price'];
        $desc = $_POST['description'];
        $category = $_POST['category_id'];
        
        $sql = "UPDATE products  SET name = ?, description = ?, price = ?, category_id = ?, modified = now() WHERE id = ?";
        $query = $pdo->prepare($sql);
        if ($query->execute(array($nombre, $desc, intval($precio), intval($category), intval($id))) == false) {
            $msg = 'Error: ' . $query->errorCode();
        } else {
            $msg = 'Producto Actualizado';
        }
    } elseif($operacion == 'export'){
        
        $sql= "select * from products";

        // Gets the data from the database
        $query = $pdo->prepare($sql);
        if ($query->execute() == false) {
            $msg = 'Error: ' . $query->errorCode();
        } else {
            
            $fp = fopen('products.csv', 'w');

           foreach ($pdo->query($sql) as $row)
            {
                fputcsv($fp, $row);
            }

            fclose($fp);
        }
        
        
        
    }
    Database::disconnect();
    echo $msg;
}
