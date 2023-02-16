<?php

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function san($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function esUltimo($actual, $proximo) :bool{
    if($actual !== $proximo){
        return true;
    }
    return false; 
}

//Funcion que revisa que el susuario este autenticado 

function isAuth()  {
    if(!isset($_SESSION['login'])) {
        header('Location: /');
    }
}

function isAdmin() : void{
    if(!isset($_SESSION['admin'])) {
        header('Location: /');
    }
}

function validarORedireccionar(string $url){
    $id = $_GET["id"];
    $id = filter_var($id, FILTER_VALIDATE_INT); 

    if(!$id){
        header( "Location: ${url}"); 
    }
    return $id;
}


