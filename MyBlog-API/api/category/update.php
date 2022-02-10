<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
    Access-Control-Allow-Methods, Authorization, X-Request-With');

    include_once '../../Config/Database.php';
    include_once '../../Models/Category.php';

    // Instanciando o BD & conexão
    $database = new Database();
    $db = $database->connect();

    // Instanciando o Category & conexão
    $category = new Category($db);

    //Obtendo a publicação crua do banco
    $data = json_decode(file_get_contents("php://input"));

    //Mostra o Id para Atualizar
    $category->id = $data->id;

    $category->name = $data->name;
  
    //Atualizando a Categoryagem
    if($category->update()){
        echo json_encode(
            array('message' => 'Categoria Alterada')
        );
    }else{
        echo json_encode(
            array('message' => 'Categoria não alterada')
        );
    }