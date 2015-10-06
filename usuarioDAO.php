<?php

require 'connection.php';

class UsuarioDAO {

    function getUsuarioByLogin($login) {
        $connection = Connection::getConnection();
        $sql = "SELECT login, nome, email FROM tdit_usuarios WHERE login='$login';";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) == 0) {
            return "Usuario not found" . $sql;
        }
        $cloginade = mysqli_fetch_object($result);
        return $cloginade;
    }

    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT login, nome, email FROM tdit_usuarios";
        $result = mysqli_query($connection, $sql);
        $usuarios = array();
        while ($usuario = mysqli_fetch_object($result)) {
            if ($usuario != null) {
                $usuarios[] = $usuario;
            }
        }
        return $usuarios;
    }

    public static function updateUsuario($usuario, $login) {
        $connection = Connection::getConnection();
        $sql = "UPDATE tdit_usuarios SET login='$usuario->login', nome='$usuario->nome', email=$usuario->email, senha=$usuario->senha WHERE login=$login";
        $result = mysqli_query($connection, $sql);

        $usuarioAtualizado = UsuarioDAO::getUsuarioByCPF($usuario->login);
        return $usuarioAtualizado;
    }

    public static function deleteUsuario($login) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM tdit_usuarios WHERE login=$login";
        $result = mysqli_query($connection, $sql);

        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public static function addUsuario($usuario) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO tdit_usuarioss (login, nome, cloginades_login) VALUES ('$usuario->login', '$usuario->nome', '$usuario->cloginades_login');";
        $result = mysqli_query($connection, $sql);
        if (!$result) {
            http_response_code(403);
            return "Não foi possível adicionar o usuario :  " . $sql;
        }
        $novoUsuario = UsuarioDAO::getUsuarioByCPF($usuario->login);
        return $novoUsuario;
    }

}
