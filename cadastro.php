<?php
  require "req/funcoesLogin.php";
  include "inc/head.php";

  if ($_REQUEST) {
    $nome = $_REQUEST["nome"];
    $email = $_REQUEST["email"];
    $senha = $_REQUEST["senha"];
    $confirmarSenha = $_REQUEST["confirmarSenha"];

    if ($senha != $confirmarSenha) {
      $erro = "Senhas não compatíveis";
    } else {
      $novoUsuario = [
        "nome" => $nome,
        "email" => $email,
        "senha" => $senha
      ];

      $cadastrou = cadastrarUsuario($novoUsuario);
    }
  }
?>

  <div class="cadastro">
    <h1>Cadastre-se</h1>
    <?php if (isset($erro)): ?>
      <div class="alert alert-danger" role="alert">
        <?= $erro; ?>
      </div>
    <?php elseif (isset($cadastrou) && !$cadastrou) : ?>
      <div class="alert alert-danger" role="alert">
        <span>Esse email está sendo utilizado</span>
      </div>
    <?php elseif (isset($cadastrou) && $cadastrou) : ?>
      <div class="alert alert-success" role="alert">
        <span>Usuário cadastrado com sucesso</span>
      </div>
    <?php endif; ?>
    <form action="cadastro.php" method="post" class="col-7">
      <div class="form-group">
        <label for="inputNome">Nome</label>
        <input type="text" name="nome" class="form-control" id="inputNome" placeholder="Insira seu nome" value="<?php if (isset($_REQUEST["nome"])) echo $_REQUEST["nome"] ?>">
      </div>
      <div class="form-group">
        <label for="inputEmail1">Email</label>
        <input type="email" name="email" class="form-control" id="inputEmail1" placeholder="Insira seu email" value="<?php if (isset($_REQUEST["email"])) echo $_REQUEST["email"] ?>">
      </div>
      <div class="form-group">
        <label for="inputSenha">Senha</label>
        <input type="password" name="senha" class="form-control" id="inputSenha" placeholder="Insira sua senha">
      </div>
      <div class="form-group">
        <label for="inputConfirmar">Confirme sua senha</label>
        <input type="password" name="confirmarSenha" class="form-control" id="exampleInputConfirmar" placeholder="Confirme sua senha">
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
      <a class="offset-9" href="login.php">Fazer login!</a>
    </form>
  </div>

<?php
  include "inc/footer.php";
?>
