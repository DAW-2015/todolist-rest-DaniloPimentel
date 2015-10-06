<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

require 'usuarioDAO.php';

$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->get('/usuarios/:login', function ($login) {
  //recupera o usuario
  $usuario = UsuarioDAO::getUsuarioByLogin($login);
  echo json_encode($usuario);
});

$app->get('/usuarios', function() {
  // recupera todos os usuarios
  $usuarios = UsuarioDAO::getAll();
  echo json_encode($usuarios);
});

$app->post('/usuarios', function() {
  // recupera o request
  $request = \Slim\Slim::getInstance()->request();

  // insere o usuario
  $novoUsuario = json_decode($request->getBody());
  $novoUsuario = UsuarioDAO::addUsuario($novoUsuario);

  echo json_encode($novoUsuario);
});

$app->put('/usuarios/:login', function ($login) {
  // recupera o request
  $request = \Slim\Slim::getInstance()->request();

  // atualiza o usuario
  $usuario = json_decode($request->getBody());
  $usuario = UsuarioDAO::updateUsuario($usuario, $login);

   echo json_encode($usuario);
});

$app->delete('/usuarios/:login', function($login) {
  // exclui o usuario
  $isDeleted = UsuarioDAO::deleteUsuario($login);

  // verifica se houve problema na exclusão
  if ($isDeleted) {
    echo "{'message':'Usuario excluído'}";
  } else {
    echo "{'message':'Erro ao excluir usuario'}";
  }
});
$app->run();