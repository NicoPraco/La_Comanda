<?php
    require_once "./app/Models/Usuario.php";
    require_once "./app/Models/Empleado.php";
    require_once "./app/Models/Cliente.php";

    class UsuarioController extends Usuario
    {
        public function CargarUnUsuario($request, $response, $args) // POST -> id | nombre | apellido | email | pass | tipoUsuario
        {
            $parametros = $request->getParsedBody();

            $nombre = $parametros["nombre"];
            $apellido = $parametros["apellido"];
            $email = $parametros["email"];
            $pass = $parametros["pass"];
            $tipoUsuario = $parametros["tipoUsuario"];

            $nuevoUsuario = new Usuario();

            $nuevoUsuario->_nombre = $nombre;
            $nuevoUsuario->_apellido = $apellido;
            $nuevoUsuario->_email = $email;
            $nuevoUsuario->_pass = $pass;
            $nuevoUsuario->_tipoUsuario = $tipoUsuario;

            $id = $nuevoUsuario->CrearUsuario();

            $payload = json_encode(array("Mensaje" => "Usuario creado con exito.", "id" => $id));
            
            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerTodosLosUsuarios($request, $response, $args)
        {
            $listaUsuarios = Usuario::ObtenerUsuarios();

            $payload = json_encode(array("ListaUsuarios" => $listaUsuarios));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function TraerUnUsuario($request, $response, $args)
        {
            $idUsuario = $args["idUsuario"];

            $usuario = Usuario::ObtenerUnUsuario($idUsuario);
            $payload = json_encode($usuario);

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function EliminarUnUsuario($request, $response, $args)
        {
            $idUsuario = $args["idUsuario"];

            Usuario::BorrarUnUsuario($idUsuario);
            $payload = json_encode(array("Mensaje" => "Usuario borrado con exito."));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }

        public function ModificarUnUsuario($request, $response, $args)
        {
            $parametros = $request->getParsedBody();

            $idUsuario = $parametros["idUsuario"];
            $nombre = $parametros["nombre"];
            $apellido = $parametros["apellido"];
            $email = $parametros["email"];
            $pass = $parametros["pass"];

            Usuario::ModificarUsuario($idUsuario, $nombre, $apellido, $email, $pass);
            $payload = json_encode(array("Mensaje" => "Usuario modificado con exito."));

            $response->getBody()->write($payload);
            return $response->withHeader("Content-Type", "application/json");
        }
    }




