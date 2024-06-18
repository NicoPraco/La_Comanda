<?php
    require_once "./app/Models/Pedido.php";

    class PedidoController extends Pedido
    {
        // POST -> id | idCliente | idMozo | codigoMesa | codigoPedido | pedido | precio | estado
        public function CargarUnPedido($request, $response, $args) 
        {
            $parametros = $request->getParsedBody();

            $idCliente = $parametros["idCliente"];
            $idMozo = $parametros["idMozo"];
            $codigoMesa = $parametros["codigoMesa"];
            $codigoPedido = $parametros["codigoPedido"];
            $pedido = $parametros["pedido"];
            $precio = $parametros["precio"];
            $estado = $parametros["estado"];

            $nuevoPedido = new Pedido();

            $nuevoPedido->_idCliente = $idCliente;
            $nuevoPedido->_idMozo = $idMozo;
            $nuevoPedido->_codigoMesa = $codigoMesa;
            $nuevoPedido->_codigoPedido = $codigoPedido;
            $nuevoPedido->_pedido = $pedido;
            $nuevoPedido->_precio = $precio;
            $nuevoPedido->_estado = $estado;

            $id = $nuevoPedido->CrearPedido();

            $payload = json_encode(array("Mensaje" => "Pedido creado con exito.", "id" => $id));
            
            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerTodosLosPedidos($request, $response, $args)
        {
            $listaPedidos = Pedido::ObtenerPedidos();

            $payload = json_encode(array("ListaPedidos" => $listaPedidos));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerUnPedido($request, $response, $args)
        {
            $idPedido = $args["idPedido"];

            $pedido = Pedido::ObtenerUnPedido($idPedido);
            $payload = json_encode($pedido);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function EliminarUnPedido($request, $response, $args)
        {
            $idPedido = $args["idPedido"];

            $pedido = Pedido::BorrarUnPedido($idPedido);
            $payload = json_encode($pedido);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function ModificarUnPedido($request, $response, $args)
        {
            $parametros = $request->getParsedBody();

            $idPedido = $parametros["idPedido"];
            $pedido = $parametros["pedido"];
            $precio = $parametros["precio"];
            $estado = $parametros["estado"];

            Pedido::ModificarPedido($idPedido, $pedido, $precio, $estado);
            $payload = json_encode(array("Mensaje" => "Pedido modificado con exito."));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }
    }