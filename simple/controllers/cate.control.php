<?php

  require_once("libs/template_engine.php");
  require_once("models/categorias.model.php");
  function run(){
    //htmlDatos, arreglo que contiene todas las substituciones
    // que se darán en la plantilla.
    $htmlDatos = array();
    $htmlDatos["categoryTitle"] = "";
    $htmlDatos["categoryMode"] = "";
    $htmlDatos["CatCod"] = "";
    $htmlDatos["CatDsc"]="";
    $htmlDatos["CatEst"]="";
    $htmlDatos["actSelected"]="selected";
    $htmlDatos["inaSelected"]="";
    $htmlDatos["disabled"]="";
    if(isset($_GET["acc"])){
      switch($_GET["acc"]){
        //Manejando si es un insert
        case "ins":
          $htmlDatos["categoryTitle"] = "Ingreso de Nueva Categoría";
          $htmlDatos["categoryMode"] = "ins";
          //se determina si es una acción del formulario
          if(isset($_POST["btnacc"])){
            $lastID = insertarCategoria($_POST);
            if($lastID){
              redirectWithMessage("¡Categoría Ingresada!","index.php?page=cate&acc=upd&CatCod=".$lastID);
            }else{
              //Se obtiene los datos que estaban en el post
              $htmlDatos["CatCod"] = $_POST["CatCod"];
              $htmlDatos["CatDsc"]=$_POST["CatDsc"];
              $htmlDatos["CatEst"]=$_POST["CatEst"];
              $htmlDatos["actSelected"]=($_POST["CatEst"] =="ACT")?"selected":"";
              $htmlDatos["inaSelected"]=($_POST["CatEst"] =="INA")?"selected":"";
            }
          }
          //si no es una acción del post se muestra los datos
          renderizar("cate", $htmlDatos);
          break;
        //Manejando si es un Update
        case "upd":
          if(isset($_POST["btnacc"])){
            //implementar logica de guardado
            if(actualizarCategoria($_POST)){
              //forzando a que se actualice con los datos de la db
              redirectWithMessage("¡Categoría Actualizada!","index.php?page=cate&acc=upd&CatCod=".$_POST["CatCod"]);
            }
          }
          if(isset($_GET["CatCod"])){
            $categoria = obtenerCategoria($_GET["CatCod"]);
            if($categoria){
              $htmlDatos["categoryTitle"] = "Actualizar ".$categoria["CatDsc"];
              $htmlDatos["categoryMode"] = "upd";
              $htmlDatos["CatCod"] = $categoria["CatCod"];
              $htmlDatos["CatDsc"]=$categoria["CatDsc"];
              $htmlDatos["CatEst"]=$categoria["CatEst"];
              $htmlDatos["actSelected"]=($categoria["CatEst"] =="ACT")?"selected":"";
              $htmlDatos["inaSelected"]=($categoria["CatEst"] =="INA")?"selected":"";
              renderizar("cate", $htmlDatos);
            }else{
              redirectWithMessage("¡Categoría No Encontrada!","index.php?page=categorias");
            }
          }else{
            redirectWithMessage("¡Categoría No Encontrada!","index.php?page=categorias");
          }
          break;
        //Manejando un delete
        case "dlt":
        if(isset($_POST["btnacc"])){
          //implementar logica de guardado
          if(borrarCategoria($_POST["CatCod"])){
            //forzando a que se actualice con los datos de la db
            redirectWithMessage("¡Categoría Borrada!","index.php?page=categorias");
          }
        }
          if(isset($_GET["ctgid"])){
            $categoria = obtenerCategoria($_GET["CatCod"]);
            if($categoria){
              $htmlDatos["categoryTitle"] = "¿Desea borrar ".$categoria["CatDsc"] . "?";
              $htmlDatos["categoryMode"] = "dlt";
              $htmlDatos["CatCod"] = $categoria["CatCod"];
              $htmlDatos["CatDsc"]=$categoria["CatDsc"];
              $htmlDatos["CatEst"]=$categoria["CatEst"]
              $htmlDatos["actSelected"]=($categoria["CatEst"] =="ACT")?"selected":"";
              $htmlDatos["inaSelected"]=($categoria["CatEst"] =="INA")?"selected":"";
              $htmlDatos["disabled"]='disabled="disabled"';
              renderizar("cate", $htmlDatos);
            }else{
              redirectWithMessage("¡Categoría No Encontrada!","index.php?page=categorias");
            }
          }else{
            redirectWithMessage("¡Categoría No Encontrada!","index.php?page=categorias");
          }
          break;
        defualt:
          redirectWithMessage("¡Acción no permitida!","index.php?page=categorias");
          break;
      }
    }
  }
  run();
?>
