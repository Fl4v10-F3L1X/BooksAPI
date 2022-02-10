<?php

    //Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../Config/Database.php';
    include_once '../../Models/Category.php';

    // Instanciando o BD & conexão
    $database = new Database();
    $db = $database->connect();

    // Instanciando o Category & conexão
    $categories = new Category($db);

    //Blog categories query
    $result = $categories->read();

    //Obtém a contagem de linhas
    $num = $result->rowCount();

    //Verifica se exite um categories
    if($num > 0){
        //categories array
        $categories_arr = array();
        $categories_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $categories_item = array(
                'id' => $id,
                'name' => $name                
            );


            //Trazendo o dado
            array_push($categories_arr['data'], $categories_item);
        }
        //Transformando em JSON & output
        echo json_encode($categories_arr);
    }else {
        //NO categoriess
        echo json_encode(
            array('message' => 'Nenhuma categoria encontrada')
        );
    }

