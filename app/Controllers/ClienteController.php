<?php
    require_once "./app/Models/Usuario.php";
    require_once "./app/Models/Empleado.php";

    class ClienteController extends Cliente
    {
        public function CargarUnCliente($request, $response, $args)
        {
            $parametros = $request->getParsedBody();

            // PARAM USUARIO
            $nombre = $parametros["nombre"];
            $apellido = $parametros["apellido"];
            $email = $parametros["email"];
            $pass = $parametros["pass"];
            $tipoUsuario = $parametros["tipoUsuario"];

            // PARAM CLIENTE
            $codigoPedido = $parametros["codigoPedido"];
            $dineroDisponible = $parametros["dineroDisponible"];

            // ALTA USUARIO
            $nuevoUsuario = new Usuario();
            $nuevoUsuario->_nombre = $nombre;
            $nuevoUsuario->_apellido = $apellido;
            $nuevoUsuario->_email = $email;
            $nuevoUsuario->_pass = $pass;
            $nuevoUsuario->_tipoUsuario = $tipoUsuario;

            $idUsuario = $nuevoUsuario->CrearUsuario();

            // ALTA EMPLEADO
            $nuevoCliente = new Cliente();
            $nuevoCliente->_idUsuario = $idUsuario;
            $nuevoCliente->_codigoPedido = $codigoPedido;
            $nuevoCliente->_dineroDisponible = $dineroDisponible;


            $idEmpleado = $nuevoCliente->CrearCliente();

            $payload = json_encode(array("Mensaje" => "Cliente creado con exito.", "id" => $idEmpleado));
            
            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerTodosLosClientes($request, $response, $args)
        {
            $listaClientes = Cliente::ObtenerClientes();

            $payload = json_encode(array("ListaClientes" => $listaClientes));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerUnCliente($request, $response, $args)
        {
            $idCliente = $args["idCliente"];

            $cliente = Cliente::ObtenerUnCliente($idCliente);
            $payload = json_encode($cliente, JSON_PRETTY_PRINT);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }


    }


