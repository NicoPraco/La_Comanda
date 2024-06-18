<?php
    class AccesoDatos
    {
        private static $objAccesoDatos;
        private $objPDO;

        private function __construct()
        {
            $db = 'mysql:host=localhost;dbname=la_comanda;charset=utf8';
            $user = "root";
            $password = "";
            $options = array(PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

            try 
            {
                $this->objPDO = new PDO($db, $user, $password, $options);
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function obtenerInstancia()
        {
            if (!isset(self::$objAccesoDatos)) {
                self::$objAccesoDatos = new AccesoDatos();
            }
            return self::$objAccesoDatos;
        }
    
        public function prepararConsulta($sql)
        {
            return $this->objPDO->prepare($sql);
        }
    
        public function obtenerUltimoId()
        {
            return $this->objPDO->lastInsertId();
        }
    
        public function __clone()
        {
            trigger_error('ERROR: La clonación de este objeto no está permitida', E_USER_ERROR);
        }
    }
?>