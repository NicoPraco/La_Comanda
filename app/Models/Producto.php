<?php
    class Producto
    {
        protected int $_id;
        protected string $_nombreProducto;
        protected $_tipo; // COMIDA | BEBIDA
        protected $_productoSector; // Barra de Tragos y Vinos | Barra de Cerveza Artesanal | Cocina | Candy Bar
        protected int $_tiempoDePreparacion;
        protected $_estado; // Listo | En Preparacion | Pendiente

        // CREATE
        public function CrearProducto()
        {   
            try
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("INSERT INTO productos (nombreProducto, tipo, productoSector, tiempoDePreparacion, estado) VALUES (:nombreProducto, :tipo, :productoSector, :tiempoDePreparacion, :estado)");
    
                $consultaSQL->bindValue(':nombreProducto', $this->_nombreProducto, PDO::PARAM_STR);
                $consultaSQL->bindValue(':tipo', $this->_tipo, PDO::PARAM_STR);
                $consultaSQL->bindValue(':productoSector', $this->_productoSector, PDO::PARAM_STR);
                $consultaSQL->bindValue(':tiempoDePreparacion', $this->_tiempoDePreparacion, PDO::PARAM_INT);
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
        public static function ObtenerProductos()
        {
            try
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, nombreProducto, tipo, productoSector, tiempoDePreparacion, estado FROM productos");
                
                $consultaSQL->execute();

                return $consultaSQL->fetchAll(PDO::FETCH_CLASS, 'Producto');
            }
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function ObtenerUnProducto($idProducto)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("SELECT id, nombreProducto, tipo, productoSector, tiempoDePreparacion, estado FROM productos WHERE id = :idProducto");
    
                $consultaSQL->execute();
    
                return $consultaSQL->fetchObject('Producto');
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        // UPDATE

        public static function ModificarProducto($idProducto, $nombreProducto, $tipo, $productoSector, $tiempoDePreparacion, $estado)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("UPDATE productos SET nombreProducto = :nombreProducto, tipo = :tipo, productoSector = :productoSector, tiempoDePreparacion = tiempoDePreparacion, estado = :estado WHERE id = :idProducto");
    
                $consultaSQL->bindValue(':nombreProducto', $nombreProducto, PDO::PARAM_INT);
                $consultaSQL->bindValue(':productoSector', $tipo, PDO::PARAM_STR);
                $consultaSQL->bindValue(':productoSector', $productoSector, PDO::PARAM_STR);
                $consultaSQL->bindValue(':tiempoDePreparacion', $tiempoDePreparacion, PDO::PARAM_STR);
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

        public static function BorrarProductos()
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("TRUNCATE productos");

                $consultaSQL->execute();

            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }

        public static function BorrarUnProducto($idProducto)
        {
            try 
            {
                $objPDO = AccesoDatos::obtenerInstancia();
                $consultaSQL = $objPDO->prepararConsulta("DELETE FROM productos WHERE id = :idProducto");

                $consultaSQL->execute();
            } 
            catch (PDOException $e) 
            {
                print "Ha ocurrido el siguiente error: " . $e->getMessage();
                die();
            }
        }
    }



