<?php
  require "req/funcoesLogin.php";
  include "inc/head.php";

  if ($_REQUEST) {
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];
    $estaLogado = logarUsuario($email, $senha);
  }
?>

  <div class="login">
    <h1>Login</h1>
    <?php if (isset($estaLogado) && $estaLogado): ?>
      <?php header("Location: index.php"); ?>
    <?php elseif (isset($estaLogado) && !$estaLogado) : ?>
      <div class="alert alert-danger" role="alert">
        <span>Email e senha incompatíveis!</span>
      </div>
    <?php endif; ?>
    <form action="login.php" method="post" class="col-7">
      <div class="form-group">
        <label for="exampleInputEmail">Email</label>
        <input type="email" name="email" class="form-control" id="exampleInputNome" placeholder="Insira seu email">
      </div>
      <div class="form-group">
        <label for="exampleInputSenha">Senha</label>
        <input type="password" name="senha" class="form-control" id="exampleInputSenha" placeholder="Insira sua senha">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a class="offset-9" href="cadastro.php">Fazer cadastro!</a>
    </form>
  </div>
<?php
  include "inc/footer.php";
?>
