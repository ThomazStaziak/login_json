<?php
  require "req/funcoesLogin.php";
  include "inc/head.php";

  if ($_POST) {
    $erro = [
      'nome' => '',
      'email' => '',
      'senha' => '',
      'confirmarSenha' => ''
    ];

    if (empty($_REQUEST['nome'])) {
      $erro['nome'] = 'O campo é obrigatório';
    }

    if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
      $erro['email'] = 'Você precisa utilizar um email válido';
    }

    if (empty($_REQUEST['senha'])) {
      $erro['senha'] = 'O campo é obrigatório';
    }

    if (empty($_REQUEST['confirmarSenha'])) {
      $erro['confirmarSenha'] = 'O campo é obrigatório';
    }
    
    if ($_REQUEST['senha'] != $_REQUEST['confirmarSenha']) {
      $erro['senha'] = "Senhas não compatíveis";
    }
    
    if (
      empty($erros['nome']) &&
      empty($erros['email']) &&
      empty($erros['senha']) &&
      empty($erros['confirmarSenha'])
    ) {
      $novoUsuario = [
        'nome' => $_REQUEST['nome'],
        'email' => $_REQUEST['email'],
        'senha' => $_REQUEST['senha'],
      ];

      $cadastrou = cadastrarUsuario($novoUsuario);

      if ($cadastrou) {
        header('Location: login.php?cadastrou=true');
      }
    }
  }
?>

  <div class="cadastro">
    <h1>Cadastre-se</h1>
    <form action="cadastro.php" method="post" class="col-7">
      <div class="form-group">
        <label for="inputNome">Nome</label>
        <input type="text" name="nome" class="form-control <?php if (isset($erro['nome']) && $erro['nome']) echo 'is-invalid' ?>" id="inputNome" placeholder="Insira seu nome" value="<?php if (isset($_REQUEST["nome"])) echo $_REQUEST["nome"] ?>">
        <?php if (isset($erro['nome']) && $erro['nome']) : ?>
          <div class="invalid-feedback">
            <?= $erro['nome'] ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="inputEmail1">Email</label>
        <input type="email" name="email" class="form-control <?php if ((isset($erro['email']) && $erro['email']) || (isset($cadastrou) && !$cadastrou)) echo 'is-invalid'; ?>" id="inputEmail1" placeholder="Insira seu email" value="<?php if (isset($_REQUEST["email"])) echo $_REQUEST["email"] ?>">
        <?php if ((isset($erro['email']) && $erro['email']) || (isset($cadastrou) && !$cadastrou)) : ?>
          <div class="invalid-feedback">
            <?php 
              if (isset($erro['email']) && $erro['email']) echo $erro['email'];
              else if (isset($cadastrou) && !$cadastrou) echo 'Email já cadastrado';
            ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="inputSenha">Senha</label>
        <input type="password" name="senha" class="form-control <?php if (isset($erro['senha']) && $erro['senha']) echo 'is-invalid' ?>" id="inputSenha" placeholder="Insira sua senha">
        <?php if (isset($erro['senha']) && $erro['senha']) : ?>
          <div class="invalid-feedback">
            <?= $erro['senha'] ?>
          </div>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <label for="inputConfirmar">Confirme sua senha</label>
        <input type="password" name="confirmarSenha" class="form-control <?php if (isset($erro['confirmarSenha']) && $erro['confirmarSenha']) echo 'is-invalid' ?>" id="exampleInputConfirmar" placeholder="Confirme sua senha">
        <?php if (isset($erro['confirmarSenha']) && $erro['confirmarSenha']) : ?>
          <div class="invalid-feedback">
            <?= $erro['confirmarSenha'] ?>
          </div>
        <?php endif; ?>
      </div>
      <button type="submit" class="btn btn-primary">Cadastrar</button>
      <a class="offset-9" href="login.php">Fazer login!</a>
    </form>
  </div>

<?php
  include "inc/footer.php";
?>
