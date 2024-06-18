<?php
    require_once "./app/Models/Mesa.php";

    class MesaController extends Mesa
    {
        public function CargarUnMesa($request, $response, $args) // POST -> id | codigoMesa | estado 
        {
            $parametros = $request->getParsedBody();

            $codigoMesa = $parametros["codigoMesa"];
            $estado = $parametros["estado"];

            $nuevaMesa = new Mesa();

            $nuevaMesa->_codigoMesa = $codigoMesa;
            $nuevaMesa->_estado = $estado;

            $id = $nuevaMesa->CrearMesa();

            $payload = json_encode(array("Mensaje" => "Mesa creado con exito.", "id" => $id));
            
            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerTodosLasMesas($request, $response, $args)
        {
            $listaMesas = Mesa::ObtenerMesas();

            $payload = json_encode(array("ListaMesas" => $listaMesas));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }


        public function TraerUnaMesa($request, $response, $args)
        {
            $idMesa = $args["idMesa"];

            $producto = Mesa::ObtenerUnaMesa($idMesa);
            $payload = json_encode($producto);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function EliminarUnaMesa($request, $response, $args)
        {
            $idMesa = $args["idMesa"];

            $producto = Mesa::BorrarUnaMesa($idMesa);
            $payload = json_encode($producto);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function ModificarUnaMesa($request, $response, $args)
        {
            $parametros = $request->getParsedBody();

            $idMesa = $parametros["idMesa"];
            $estado = $parametros["estado"];

            Mesa::ModificarMesa($idMesa, $estado);
            $payload = json_encode(array("Mensaje" => "Mesa modificado con exito."));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }







        
    }