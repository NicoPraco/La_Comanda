<?php

    class Cliente extends Usuario
    {
        protected int $_id;
        protected int $_idUsuario;
        protected string $_codigoPedido;
        protected float $_dineroDisponible;

        // CREATE
        public function CrearCliente()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("INSERT INTO clientes (idUsuario, codigoPedido, dineroDisponible) VALUES (:idUsuario, :codigoPedido, :dineroDisponible)");
    
                $consultaSQL->bindValue(':idUsuario', $this->_idUsuario, PDO::PARAM_INT);
                $consultaSQL->bindValue(':codigoPedido', $this->_codigoPedido, PDO::PARAM_STR);
                $consultaSQL->bindValue(':dineroDisponible', $this->_dineroDisponible, PDO::PARAM_STR);
    
                $consultaSQL->execute();
    
                return $objPDO->obtenerUltimoId();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function ObtenerClientes()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, idUsuario, codigoPedido, dineroDisponible FROM clientes");

                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Clientes');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function ObtenerUnCliente($idCliente)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, idUsuario, codigoPedido, dineroDisponible FROM clientes WHERE id = :idCliente");

                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Clientes');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // UPDATE
        public static function ModificarCliente($id, $codigoPedido, $dineroDisponible) // $idUsuario
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("UPDATE clientes SET codigoPedido = :codigoPedido, dineroDisponible = :dineroDisponible WHERE id = :id");
    
                $consultaSQL->bindValue(':id', $id, PDO::PARAM_INT);
                //$consultaSQL->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
                $consultaSQL->bindValue(':codigoPedido', $codigoPedido, PDO::PARAM_STR);
                $consultaSQL->bindValue(':dineroDisponible', $$dineroDisponible, PDO::PARAM_STR);
    
                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // DELETE
        public static function BorrarClientes()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("TRUNCATE clientes");

                $consultaSQL->execute();

            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function BorrarUnCliente($idCliente)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("DELETE FROM clientes WHERE id = :idCliente");

                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }
    }
    



