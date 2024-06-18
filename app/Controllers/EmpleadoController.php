<?php
    require_once "./app/Models/Usuario.php";
    require_once "./app/Models/Empleado.php";

    class EmpleadoController extends Empleado
    {
        public function CargarUnEmpleado($request, $response, $args)
        {
            $parametros = $request->getParsedBody();

            // PARAM USUARIO
            $nombre = $parametros["nombre"];
            $apellido = $parametros["apellido"];
            $email = $parametros["email"];
            $pass = $parametros["pass"];
            $tipoUsuario = $parametros["tipoUsuario"];

            // PARAM EMPLEADO
            $salario = $parametros["salario"];
            $rolEmpleado = $parametros["rolEmpleado"];
            $fechaIngreso = $parametros["fechaIngreso"]->format("d-m-y");
            $estado = $parametros["estado"];

            // ALTA USUARIO
            $nuevoUsuario = new Usuario();
            $nuevoUsuario->_nombre = $nombre;
            $nuevoUsuario->_apellido = $apellido;
            $nuevoUsuario->_email = $email;
            $nuevoUsuario->_pass = $pass;
            $nuevoUsuario->_tipoUsuario = $tipoUsuario;

            $idUsuario = $nuevoUsuario->CrearUsuario();

            // ALTA EMPLEADO
            $nuevoEmpleado = new Empleado();
            $nuevoEmpleado->_idUsuario = $idUsuario;
            $nuevoEmpleado->_salario = $salario;
            $nuevoEmpleado->_rolEmpleado = $rolEmpleado;
            $nuevoEmpleado->_fechaIngreso = $fechaIngreso;
            $nuevoEmpleado->_estado = $estado;

            $idEmpleado = $nuevoEmpleado->CrearEmpleado();

            $payload = json_encode(array("Mensaje" => "Empleado creado con exito.", "id" => $idEmpleado));
            
            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerTodosLosEmpleados($request, $response, $args)
        {
            $listaEmpleados = Empleado::ObtenerEmpleados();

            $payload = json_encode(array("ListaEmpleados" => $listaEmpleados));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerUnEmpleado($request, $response, $args)
        {
            $idEmpleado = $args["idEmpleado"];

            $emplado = Empleado::ObtenerUnEmpleado($idEmpleado);
            $payload = json_encode($emplado, JSON_PRETTY_PRINT);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }


    }

