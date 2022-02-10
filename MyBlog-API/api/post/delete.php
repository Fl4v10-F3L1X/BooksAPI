<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,
    Access-Control-Allow-Methods, Authorization, X-Request-With');

    include_once '../../Config/Database.php';
    include_once '../../Models/Post.php';

    // Instanciando o BD & conexão
    $database = new Database();
    $db = $database->connect();

    // Instanciando o Post & conexão
    $post = new Post($db);

    //Obtendo a publicação crua do banco
    $data = json_decode(file_get_contents("php://input"));

    //Mostra o Id para Apagar
    $post->id = $data->id;

    //Apagando a postagem
    if($post->delete()){
        echo json_encode(
            array('message' => 'Publicação Eliminada')
        );
    }else{
        echo json_encode(
            array('message' => 'Publicação não Eliminada')
        );
    }