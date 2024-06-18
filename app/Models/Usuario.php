<?php

    class Usuario
    {
        protected int $_id;
        protected string $_nombre;
        protected string $_apellido;
        protected string $_email;
        protected string $_pass;
        protected eTipoUsuario $_tipoUsuario;

        // CREATE
        public function CrearUsuario()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("INSERT INTO usuarios (nombre, apellido, email, pass, tipoUsuario) VALUES (:nombre, :apellido, :email, :pass, :tipo)");

                $consultaSQL->bindValue(':nombre', $this->_nombre, PDO::PARAM_STR);
                $consultaSQL->bindValue(':apellido', $this->_apellido, PDO::PARAM_STR);
                $consultaSQL->bindValue(':email', $this->_email, PDO::PARAM_STR);
                $consultaSQL->bindValue(':password', $this->_pass, PDO::PARAM_STR);
                $consultaSQL->bindValue('tipoUsuario', $this->_tipoUsuario, PDO::PARAM_STR);

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
        public static function ObtenerUsuarios()
        {
            try
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, nombre, apellido, email, password, tipoUsuario FROM usuarios");
                
                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Usuario');
            }
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // READ
        public static function ObtenerUnUsuario($idUsuario)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, nombre, apellido, email, password, tipoUsuario FROM usuarios WHERE id = :idUsuario");
    
                $consultaSQL->execute();
    
                return $consultaSQL->fetchObject('Usuario');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // UPDATE
        public static function ModificarUsuario($idUsuario, $nombre, $apellido, $mail, $pass) // $tipoUsuario
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("UPDATE usuarios SET nombre = :nombre, apelldio = :apellido, mail = :mail, password = :password, tipoUsuario = :tipoUsuario WHERE id = :idUsuario");
    
                $consultaSQL->bindValue('idUsuario', $idUsuario, PDO::PARAM_INT);
                $consultaSQL->bindValue(':nombre', $nombre, PDO::PARAM_STR);
                $consultaSQL->bindValue(':apellido', $apellido, PDO::PARAM_STR);
                $consultaSQL->bindValue(':email', $mail, PDO::PARAM_STR);
                $consultaSQL->bindValue(':password', $pass, PDO::PARAM_STR);
                //$consultaSQL->bindValue('tipoUsuario', $tipoUsuario, PDO::PARAM_STR);
    
                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // DELETE
        public static function BorrarUsuarios()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("TRUNCATE usuarios");

                $consultaSQL->execute();

            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function BorrarUnUsuario($idUsuario)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("DELETE FROM usuarios WHERE id = :idUsuario");

                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }
    }
?>