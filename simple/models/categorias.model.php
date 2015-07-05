<?php

require_once("libs/dao.php");

function obtenerCategorias(){
    $categorias = array();
    $selectQuery = "SELECT * from cate;";
    $categorias = obtenerRegistros($selectQuery);
    return $categorias;
}

?>
