<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
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

    //Mostra o Id para Atualizar
    $post->id = $data->id;

    $post->title = $data->title;
    $post->body = $data->body;
    $post->author = $data->author;
    $post->category_id = $data->category_id;

    //Atualizando a postagem
    if($post->update()){
        echo json_encode(
            array('message' => 'Publicação Alterada')
        );
    }else{
        echo json_encode(
            array('message' => 'Publicação não alterada')
        );
    }