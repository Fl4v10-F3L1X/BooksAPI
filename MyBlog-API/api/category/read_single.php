<?php

    //Cabeçalho
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');

    include_once '../../Config/Database.php';
    include_once '../../Models/Category.php';

    // Instanciando o BD & conexão
    $database = new Database();
    $db = $database->connect();

    // Instanciando o Category & conexão
    $category = new Category($db);

    //Obtendo o ID pela URL
    $category->id = isset($_GET['id']) ? $_GET['id'] : die();

    // Obtendo a Categoryagem
    $category->read_single();

    //Create Array
    $category_arr = array(
        'id' => $category->id,
        'name' => $category->name
    );

    //Transormado em tipo JSON
    print_r(json_encode($category_arr));