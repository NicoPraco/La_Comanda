<?php
    require_once "./app/Models/Producto.php";

    class ProductoController extends Producto
    {
        // POST -> id | nombreProducto | tipo | productoSector | tiempoDePreparacion | estado
        public function CargarUnProducto($request, $response, $args) 
        {
            $parametros = $request->getParsedBody();

            $nombreProducto = $parametros["nombreProducto"];
            $tipo = $parametros["tipo"];
            $productoSector = $parametros["productoSector"];
            $tiempoDePreparacion = $parametros["tiempoDePreparacion"];
            $estado = $parametros["estado"];

            $nuevoProducto = new Producto();

            $nuevoProducto->_nombreProducto = $nombreProducto;
            $nuevoProducto->_tipo = $tipo;
            $nuevoProducto->_productoSector = $productoSector;
            $nuevoProducto->_tiempoDePreparacion = $tiempoDePreparacion;
            $nuevoProducto->_estado = $estado;

            $id = $nuevoProducto->CrearProducto();

            $payload = json_encode(array("Mensaje" => "Producto creado con exito.", "id" => $id));
            
            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerTodosLosProductos($request, $response, $args)
        {
            $listaProductos = Producto::ObtenerProductos();

            $payload = json_encode(array("ListaProductos" => $listaProductos));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerUnProducto($request, $response, $args)
        {
            $idProducto = $args["idProducto"];

            $producto = Producto::ObtenerUnProducto($idProducto);
            $payload = json_encode($producto);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function EliminarUnProducto($request, $response, $args)
        {
            $idProducto = $args["idProducto"];

            $producto = Producto::BorrarUnProducto($idProducto);
            $payload = json_encode($producto);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function ModificarUnProducto($request, $response, $args)
        {
            $parametros = $request->getParsedBody();

            $idProducto = $parametros["idProducto"];
            $nombreProducto = $parametros["nombreProducto"];
            $tipo = $parametros["tipo"];
            $productoSector = $parametros["productoSector"];
            $tiempoDePreparacion = $parametros["tiempoDePreparacion"];
            $estado = $parametros["estado"];

            Producto::ModificarProducto($idProducto, $nombreProducto, $tipo, $productoSector, $tiempoDePreparacion, $estado);
            $payload = json_encode(array("Mensaje" => "Producto modificado con exito."));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }
    }

