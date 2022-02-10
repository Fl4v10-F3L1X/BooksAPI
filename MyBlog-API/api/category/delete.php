<?php

    //Cabeçalho
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
    Access-Control-Allow-Methods, Authorization, X-Request-With');

    include_once '../../Config/Database.php';
    include_once '../../Models/Category.php';

    // Instanciando o BD & conexão
    $database = new Database();
    $db = $database->connect();

    // Instanciando o Category & conexão
    $category = new Category($db);

    //Obtendo a Categoria crua do banco
    $data = json_decode(file_get_contents("php://input"));

    //Mostra o Id para Apagar
    $category->id = $data->id;

    //Apagando a Categoria
    if($category->delete()){
        echo json_encode(
            array('message' => 'Categoria Eliminada')
        );
    }else{
        echo json_encode(
            array('message' => 'Categoria não Eliminada')
        );
    }