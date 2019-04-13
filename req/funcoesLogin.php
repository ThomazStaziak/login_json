<?php
  $nomeArquivo = "usuarios.json";

  function cadastrarUsuario($usuario) {
    global $nomeArquivo;

    $jsonUsuarios = file_get_contents($nomeArquivo);

    $arrayUsuarios = json_decode($jsonUsuarios, true);

    array_push($arrayUsuarios["usuarios"], $usuario);

    $jsonUsuarios = json_encode($arrayUsuarios);

    $cadastrou = file_put_contents($nomeArquivo, $jsonUsuarios);

    return $cadastrou;
  }

  function logarUsuario($email, $senha) {
    global $nomeArquivo;
    $logado = false;

    $jsonUsuarios = file_get_contents($nomeArquivo);

    $arrayUsuarios = json_decode($jsonUsuarios, true);

    foreach ($arrayUsuarios["usuarios"] as $key => $value) {
      if ($email == $value["email"] && $senha == $value["senha"]) {
          $logado = true;
          break;
      }
    }

    return $logado;
  }
?>
