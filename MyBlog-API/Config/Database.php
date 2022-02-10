<?php

    class Database{
        //Parametros do Banco de Dados
        private $host = 'localhost';
        private $db_name = 'myblog';
        private $username = 'root';
        private $password = '1234';
        private $conn;

        //Conexão com o Banco de Dados
        public function connect(){
            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, 
                $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);           
            }catch(PDOException $e){
                echo 'Erro de conexão: ' . $e->getMessage();
            }

            return $this->conn;
        }
    }