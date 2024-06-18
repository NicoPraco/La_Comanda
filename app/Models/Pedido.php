<?php
    class Pedido
    {
        protected int $_id;
        protected int $_idCliente;
        protected int $_idMozo;
        protected string $_codigoMesa; 
        protected string $_codigoPedido; 
        protected string $_pedido; 
        protected float $_precio;
        protected $_estado; // Listo para Servir | En Preparacion | Pendiente

        // CREATE
        public function CrearPedido()
        {
            try
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("INSERT INTO pedidos  (idCliente, idMozo, codigoMesa, codigoPedido, pedido, precio, estado) VALUES (:idCliente, :idMozo, :codigoMesa, :codigoPedido, :pedido, :precio, :estado)");
    
                $consultaSQL->bindValue(':idCliente', $this->_idCliente, PDO::PARAM_INT);
                $consultaSQL->bindValue(':idMozo', $this->_idMozo, PDO::PARAM_INT);
                $consultaSQL->bindValue(':codigoMesa', $this->_codigoMesa, PDO::PARAM_STR);
                $consultaSQL->bindValue(':codigoPedido', $this->_codigoPedido, PDO::PARAM_STR);
                $consultaSQL->bindValue(':pedido', $this->_pedido, PDO::PARAM_STR);
                $consultaSQL->bindValue(':precio', $this->_precio, PDO::PARAM_INT);
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
        public static function ObtenerPedidos()
        {
            try
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, idCliente, idMozo, codigoMesa, codigoPedido, pedido, precio, estado FROM pedidos");
                
                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Pedido');
            }
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function ObtenerUnPedido()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, idCliente, idMozo, codigoMesa, codigoPedido, pedido, precio, estado FROM pedidos WHERE id = :idProducto");
    
                $consultaSQL->execute();
    
                return $consultaSQL->fetchObject('Pedido');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // UPDATE
        public static function ModificarPedido($idPedido, $pedido, $precio, $estado)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("UPDATE pedidos SET pedido = :pedido, precio = :precio, estado = :estado WHERE id = :idPedido");
    
                $consultaSQL->bindValue(':pedido', $pedido, PDO::PARAM_STR);
                $consultaSQL->bindValue(':precio', $precio, PDO::PARAM_STR);
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
        public static function BorrarPedidos()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("TRUNCATE pedidios");

                $consultaSQL->execute();

            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function BorrarUnPedido($idPedido)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("DELETE FROM pedidos WHERE id = :idPedido");

                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }
    }
