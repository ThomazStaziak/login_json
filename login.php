<?php
  require "req/funcoesLogin.php";
  include "inc/head.php";

  if ($_GET && $_GET['cadastrou']) {
    $cadastrou = true;
  }

  if ($_POST) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $usuario = logarUsuario($email, $senha);

    if ($usuario) {
      if ($_POST['manter']) {
        setcookie('emailUsuario', $usuario['email']);
        setcookie('senhaUsuario', $usuario['senha']);
      }

      session_start();
      $_SESSION["usuario"] = $usuario;

      header("Location: index.php");
    }
  }
?>

  <div class="login">
    <h1>Login</h1>
    <?php if (isset($cadastrou) && $cadastrou) : ?>
      <div class="alert alert-success" role="alert">
        <span>Cadastro realizado com sucesso, faça login para continuar</span>
      </div>
    <?php endif; ?>
    <?php if (isset($estaLogado) && !$estaLogado) : ?>
      <div class="alert alert-danger" role="alert">
        <span>Email e senha incompatíveis!</span>
      </div>
    <?php endif; ?>
    <form action="login.php" method="post" class="col-7">
      <div class="form-group">
        <label for="exampleInputEmail">Email</label>
        <input 
          type="email" 
          name="email" 
          class="form-control" 
          id="exampleInputNome" 
          placeholder="Insira seu email"
          value="<?php if (isset($_COOKIE['emailUsuario'])) echo $_COOKIE['emailUsuario']; ?>"
        >
      </div>
      <div class="form-group">
        <label for="exampleInputSenha">Senha</label>
        <input 
          type="password" 
          name="senha" 
          class="form-control" 
          id="exampleInputSenha" 
          placeholder="Insira sua senha"
          value="<?php if (isset($_COOKIE['senhaUsuario'])) echo $_COOKIE['senhaUsuario']; ?>"
        >
      </div>
      <div class="form-group">
        <div class="custom-control custom-checkbox mr-sm-2">
          <input type="checkbox" name="manter" class="custom-control-input" id="customControlAutosizing">
          <label class="custom-control-label" for="customControlAutosizing">Manter conectado</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a class="offset-9" href="cadastro.php">Fazer cadastro!</a>
    </form>
  </div>
<?php
  include "inc/footer.php";
?>
