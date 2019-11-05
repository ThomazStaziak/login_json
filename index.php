<?php
  require "req/funcoesLogin.php";
  
  if (isset($_GET["logout"]) && $_GET["logout"]) {
    logout();
    
    header("Location: login.php");
  }
  
  session_start();
  if (!$_SESSION && !$_SESSION["usuario"]) 
  header("Location: login.php");
  
  include "inc/head.php";
 ?>
  <div class="container">
    <div class="jumbotron">
      <h1 class="display-4">Olá <?php echo ucwords(strtolower($_SESSION["usuario"]["nome"])) ?></h1>
      <h4>Usuários cadastrados</h4>
      <?php foreach(todosOsUsuarios() as $key => $value) : ?>
        <div class="border border-secondary p-3 m-1">
          <span class="lead d-block">Nome: <?= ucwords(strtolower($value["nome"])) ?></span>
          <span class="lead">Email: <?= $value["email"] ?></span>
        </div>
      <?php endforeach; ?>
      <p class="lead mt-2">
        <a class="btn btn-danger btn-lg" href="index.php?logout=true">Logout</a>
      </p>
    </div>
  </div>

<?php
  include "inc/footer.php";
 ?>
