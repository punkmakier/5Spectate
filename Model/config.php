<?php

    class config{
        
        private $server = "mysql:host=localhost;dbname=db_5spectate";
        private $user = "root";
        private $pass = "";

        private $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);
        protected $con;
        public function openConnection(){
            try{
                $this->con = new PDO($this->server, $this->user,$this->pass,$this->option);
            }catch(PDOException $e){
                echo "There is some problem in the connection :". $e->getMessage();
            }

            return $this->con;
        }

        public function closeConnection(){
            $this->con = null;
        }

        
    }

    $sd = new config();
    $sd->openConnection();

?>