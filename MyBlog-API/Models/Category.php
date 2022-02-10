<?php

    class Category{
        //Funcionalidades do Banco de dados
        private $conn;
        private $table = 'categories';

        //Propriedades da classe Category
        public $id;
        public $name;
        public $created_at;

        // Construtor do Banco de Dados
        public function __construct($db)
        {
            $this->conn = $db; 
        }

        //GET Categories
        public function read(){
            //Criando uma consulta
            $query = 'SELECT id, name,
            created_at
            FROM '. $this->table .'            
            ORDER BY
            created_at DESC';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Executando a query
            $stmt->execute();

            return $stmt;
        }

        //Obtendo single Post
        public function read_single(){
            //Criando uma consulta
            $query = 'SELECT name,
            created_at
            FROM '. $this->table .' 
            WHERE id = ?
            LIMIT 0,1';
            
            //Prepare Stmt
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->id);

            //Executando a query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->name = $row['name'];
            
        }

        //Creando a Postagem
        public function create(){
            //Creando a query
            $query='INSERT INTO ' . $this->table . '
                    SET 
                    name = :name';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Clean data 
            $this->name = htmlspecialchars(strip_tags($this->name));          

            //Bind os dados
            $stmt->bindParam(':name', $this->name);
            
            //Executando a query
            if($stmt->execute()){
                return true;
            }

            // Imprimir erro se alguma coisa correr errado
            printf("Erro: %s.\n", $stmt->error);

            return false;

        }

        //Alterando a Categoria
        public function update(){
            //Creando a query
            $query='UPDATE ' . $this->table . '
                    SET 
                    name = :name
                    WHERE 
                        id = :id';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Tratamento(Limpeza) dos Dados
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            //Bind os dados
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':id', $this->id);

            //Executando a query
            if($stmt->execute()){
                return true;
            }

            // Imprimir erro se alguma coisa correr errado
            printf("Erro: %s.\n", $stmt->error);

            return false;

        }

        //Apagar Categoria
        public function delete(){
            //criando a query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Tratamento(Limpeza) dos Dados
            $this->id = htmlspecialchars(strip_tags($this->id));

            //Bind os dados
            $stmt->bindParam(':id', $this->id);

            //Executando a query
            if($stmt->execute()){
                return true;
            }

            // Imprimir erro se alguma coisa correr errado
            printf("Erro: %s.\n", $stmt->error);

            return false;
        }
    }
    