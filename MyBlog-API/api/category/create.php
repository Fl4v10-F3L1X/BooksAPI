<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
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

    $category->name = $data->name;
   

    //Creando a Categoria
    if($category->create()){
        echo json_encode(
            array('message' => 'Categoria Criada')
        );
    }else{
        echo json_encode(
            array('message' => 'Categoria não criada')
        );
    }