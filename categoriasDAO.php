<?php

require 'connection.php';

class CategoriaDAO {

    function getCategoriaById($id) {
        $connection = Connection::getConnection();
        $sql = "SELECT id, nome, usuarios_login FROM tdit_categorias WHERE id='$id';";
        $result = mysqli_query($connection, $sql);
        if (mysqli_num_rows($result) == 0) {
            return "Categoria not found" . $sql;
        }
        $cidade = mysqli_fetch_object($result);
        return $cidade;
    }

    public static function getAll() {
        $connection = Connection::getConnection();
        $sql = "SELECT id, nome, usuarios_login FROM tdit_categorias";
        $result = mysqli_query($connection, $sql);
        $categorias = array();
        while ($categoria = mysqli_fetch_object($result)) {
            if ($categoria != null) {
                $categorias[] = $categoria;
            }
        }
        return $categorias;
    }

    public static function updateCategoria($categoria, $id) {
        $connection = Connection::getConnection();
        $sql = "UPDATE tdit_categorias SET id='$categoria->id', nome='$categoria->nome', usuarios_login=$categoria->usuarios_login WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        $categoriaAtualizado = CategoriaDAO::getCategoriaById($categoria->id);
        return $categoriaAtualizado;
    }

    public static function deleteCategoria($id) {
        $connection = Connection::getConnection();
        $sql = "DELETE FROM tdit_categorias WHERE id=$id";
        $result = mysqli_query($connection, $sql);

        if ($result == false) {
            return false;
        } else {
            return true;
        }
    }

    public static function addCategoria($categoria) {
        $connection = Connection::getConnection();
        $sql = "INSERT INTO tdit_categoriass (id, nome, usuarios_login) VALUES ('$categoria->id', '$categoria->nome', '$categoria->usuarios_login');";
        $result = mysqli_query($connection, $sql);
        if (!$result) {
            http_response_code(403);
            return "Não foi possível adicionar o categoria :  " . $sql;
        }
        $novoCategoria = CategoriaDAO::getCategoriaById($categoria->id);
        return $novoCategoria;
    }

}
