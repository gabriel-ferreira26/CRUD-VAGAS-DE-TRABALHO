<?php

require __DIR__ .'/vendor/autoload.php';

use \App\Entity\Vaga;

//debug - se enviou o post:
//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;

//validacao do post
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){
    $obVaga = new Vaga;

    $obVaga->titulo     = $_POST['titulo'];
    $obVaga->descricao  = $_POST['descricao'];
    $obVaga->ativo      = $_POST['ativo'];

    $obVaga->cadastrar();

    header('location: index.php?status=sucess');
    exit;
}

include __DIR__ .'/includes/header.php';
include __DIR__ .'/includes/formulario.php';
include __DIR__ .'/includes/footer.php';
