<?php

class Connection
{
  public static $database = "daw-aluno11";
  public static $address = "150.164.102.160";
  public static $user = "daw-aluno11";
  public static $password = "danilo";

  public static function getConnection() {
    $connection = mysqli_connect(Connection::$address, Connection::$user, Connection::$password, Connection::$database);

    return $connection;
  }
}
