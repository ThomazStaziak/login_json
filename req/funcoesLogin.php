<?php
  define("ARQUIVO", "usuarios.json");

  function todosOsUsuarios() {
    $jsonUsuarios = file_get_contents(ARQUIVO);

    if (!$jsonUsuarios) {
      file_put_contents(ARQUIVO, '[]');
      $jsonUsuarios = file_get_contents(ARQUIVO);
    }

    return json_decode($jsonUsuarios, true);
  }

  function cadastrarUsuario($usuario) {
    $arrayUsuarios = todosOsUsuarios();

    $emailExiste = array_search($usuario["email"], array_column($arrayUsuarios, "email"));

    if ($emailExiste !== false)
      return false;

    array_push($arrayUsuarios, $usuario);

    $jsonUsuarios = json_encode($arrayUsuarios);

    $cadastrou = file_put_contents(ARQUIVO, $jsonUsuarios);

    return $cadastrou;
  }

  function logarUsuario($email, $senha) {
    $logado = false;

    $arrayUsuarios = todosOsUsuarios();

    foreach ($arrayUsuarios as $key => $value) {
      if ($email == $value["email"] && $senha == $value["senha"]) {
          $logado = $value;
          break;
      }
    }

    return $logado;
  }

  function logout() {
    if (!session_start())
      session_start();

    session_destroy();
  }
?>
