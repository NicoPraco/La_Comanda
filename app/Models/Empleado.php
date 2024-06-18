<?php

    class Empleado extends Usuario
    {
        protected int $_id;
        protected int $_idUsuario;
        protected float $_salario;
        protected eTipoEmpleado $_rolEmpleado;
        protected DateTime $_fechaIngreso;
        protected $_estado;

        // CREATE
        public function CrearEmpleado()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("INSERT INTO empleados (idUsuario, salario, rol, fechaIngreso, estado) VALUES (:idUsuario, :salario, :rolEmpleado, :fechaIngreso, :estado)");
    
                $fecha = new DateTime();
                $fechaFormateada = $fecha->format("y-m-d");
    
                $consultaSQL->bindValue(':idUsuario', $this->_idUsuario, PDO::PARAM_INT);
                $consultaSQL->bindValue(':salario', $this->_salario, PDO::PARAM_INT);
                $consultaSQL->bindValue(':rolEmpleado', $this->_rolEmpleado, PDO::PARAM_STR);
                $consultaSQL->bindValue(':fechaIngreso', $fechaFormateada);
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
        public static function ObtenerEmpleados()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, idUsuario, salario, rolEmpleado, fechaIngreso, estado FROM empleados");

                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Empleado');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function ObtenerUnEmpleado($idUsuario)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, idUsuario, salario, rolEmpleado, fechaIngreso, estado FROM empleados WHERE idUsuario = :idUsuario");

                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Empleado');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // UPDATE
        public static function ModificarEmpleado($idEmpleado, $salario, $rolEmpleado, $fechaIngreso, $estado) // $idUsuario
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("UPDATE Empleados SET salario = :salario, rolEmpleado = :rolEmpleado, fechaIngreso = :fechaIngreso, estado = :estado, WHERE id = :idEmpleado");
    
                $consultaSQL->bindValue(':id', $idEmpleado, PDO::PARAM_INT);
                //$consultaSQL->bindValue(':idUsuario', $idUsuario, PDO::PARAM_INT);
                $consultaSQL->bindValue(':salario', $salario, PDO::PARAM_STR);
                $consultaSQL->bindValue(':rolEmpleado', $rolEmpleado, PDO::PARAM_STR);
                $consultaSQL->bindValue(':fechaIngreso', $fechaIngreso, PDO::PARAM_STR);
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
        public static function BorrarEmpleados()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("TRUNCATE empleados");

                $consultaSQL->execute();

            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function BorrarUnEmpleado($idEmpleado)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("DELETE FROM empleados WHERE id = :idEmpleado");

                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }
    }








