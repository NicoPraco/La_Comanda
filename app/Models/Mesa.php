<?php
    class Mesa
    {
        protected int $_id;
        protected string $_codigoMesa;
        protected $_estado; // Abierta | Cliente Pagando | Cliente Comiendo | Cliente Esperando Pedido | Cerrada

        // CREATE
        public function CrearMesa()
        {
            try
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("INSERT INTO mesas (codigoMesa, estado) VALUES (:codigoMesa, :estado)");
    
                $consultaSQL->bindValue(':codigoMesa', $this->_codigoMesa, PDO::PARAM_STR);
                $consultaSQL->bindValue(':estado', $this->_estado, PDO::PARAM_STR);
    
                $consultaSQL->execute();
    
                return $objPDO->obtenerUltimoId();
            }
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // READ
        public static function ObtenerMesas()
        {
            try
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, codigoMesa, estado FROM mesas");
                
                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Mesa');
            }
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function ObtenerUnaMesa($idMesa)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, codigoMesa, estado FROM mesas WHERE id = :idMesa");
    
                $consultaSQL->execute();
    
                return $consultaSQL->fetchObject('Mesa');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // UPDATE
        public static function ModificarMesa($idMesa, $estado)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("UPDATE mesa SET estado = :estado WHERE id = :idMesa");
    
                $consultaSQL->bindValue(':estado', $estado, PDO::PARAM_STR);
    
                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // DELETE
        public static function BorrarMesas()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("TRUNCATE mesas");

                $consultaSQL->execute();

            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function BorrarUnaMesa($idMesa)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("DELETE FROM mesas WHERE id = :idMesa");

                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }
    }
