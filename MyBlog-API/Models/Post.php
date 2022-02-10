<?php

    class Post{
        //Funcionalidades do Banco de dados
        private $conn;
        private $table = 'posts';

        //Propriedades da classe Post
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $created_at;

        // Construtor do Banco de Dados
        public function __construct($db)
        {
            $this->conn = $db; 
        }

        //GET Posts
        public function read(){
            //Criando uma consulta
            $query = 'SELECT c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM '. $this->table .' p
            LEFT JOIN categories c ON p.category_id = c.id            
            ORDER BY
            p.created_at DESC';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Executando a query
            $stmt->execute();

            return $stmt;
        }

        //Obtendo single Post
        public function read_single(){
            //Criando uma consulta
            $query = 'SELECT c.name as category_name,
            p.id,
            p.category_id,
            p.title,
            p.body,
            p.author,
            p.created_at
            FROM '. $this->table .' p
            LEFT JOIN categories c ON p.category_id = c.id
            WHERE p.id = ?
            LIMIT 0,1';
            
            //Prepare Stmt
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->id);

            //Executando a query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->title = $row['title'];
            $this->body = $row['body'];
            $this->author = $row['author'];
            $this->category_id = $row['category_id'];
            $this->category_name = $row['category_name'];
        }

        //Creando a Postagem
        public function create(){
            //Creando a query
            $query='INSERT INTO ' . $this->table . '
                    SET 
                    title = :title,
                    body = :body,
                    author = :author,
                    category_id = :category_id';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Clean data 
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            

            //Bind os dados
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);

            //Executando a query
            if($stmt->execute()){
                return true;
            }

            // Imprimir erro se alguma coisa correr errado
            printf("Erro: %s.\n", $stmt->error);

            return false;

        }

        //Alterando a Postagem
        public function update(){
            //Creando a query
            $query='UPDATE ' . $this->table . '
                    SET 
                    title = :title,
                    body = :body,
                    author = :author,
                    category_id = :category_id
                    WHERE 
                        id = :id';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Tratamento(Limpeza) dos Dados
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));
            
            //Bind os dados
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);

            //Executando a query
            if($stmt->execute()){
                return true;
            }

            // Imprimir erro se alguma coisa correr errado
            printf("Erro: %s.\n", $stmt->error);

            return false;

        }

        //Apagar publicação
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
    